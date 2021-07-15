<?php


include 'db_config.php';

$query = mysqli_query($conn, "SELECT * FROM stores WHERE store='" . $_GET['shop'] . "'");

$row = $query->fetch_array(MYSQLI_ASSOC);


$webhook_content = '';
$webhook = fopen('php://input', 'rb');
while (!feof($webhook))
{ //loop through the input stream while the end of file is not reached
    $webhook_content .= fread($webhook, 4096); //append the content on the current iteration
    
}
fclose($webhook); //close the resource
$orders = json_decode($webhook_content, true); //convert the json to array
//Save to text file for checking
if ($orders['id'])
{

	if ($orders['shipping_lines'][0]['source'] == 'Burq Shipping')
    {
		$json_string = json_encode($orders, JSON_PRETTY_PRINT);
    $dataa = json_decode($json_string);

    $placed_by = $dataa
        ->customer->first_name . ' ' . $dataa
        ->customer->last_name;
    $str_id = $row['id'];
    $ord_id = $orders['id'];
    $ord_num = $orders['order_number'];
    $pay_status = $orders['financial_status'];
    $shipping=$orders['shipping_lines'][0]['price'];

    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");

    $check_ord_query = mysqli_query($conn, "SELECT * FROM orders WHERE order_id='" . $ord_id . "'");

    if (mysqli_num_rows($check_ord_query) < 1)
    {

        $sql = "INSERT INTO orders(store_id,order_id,order_num,placed_by,shipping,payment_status,created_at,modified_on) VALUES('$str_id','$ord_id','$ord_num','$placed_by', 
                 '$shipping','$pay_status','$created','$modified')";

        mysqli_query($conn, $sql);

    }

 if ($dataa->shipping_address->phone == "")
        {
            $phone = $dataa->phone;

        }
        else
        {
            $phone = $dataa->shipping_address->phone;
        }

        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://' . $_GET['shop'] . '/admin/api/2021-01/shop.json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'X-Shopify-Access-Token:' . $row['access_token']

                ) ,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $store_data = json_decode($response);
         $items=array();
    $i=0;
    $note=array();
    foreach($orders['line_items'] as $item)
    {
        $note[] = $item['name'];
        $items[$i]['name']=$item['name'];
        $items[$i]['quantity']=$item['quantity'];
        $items[$i]['size']="small";
        $i++;
    }
    $final_note = implode(",", $note);
    $final_data=array();
    $final_data['items']=$items;
    $final_data['quote_id']=$orders['shipping_lines'][0]['code'];
    $final_data['dropoff_name']=$placed_by;
    $final_data['dropoff_phone_number']=$phone;
    $final_data['pickup_phone_number']=$store_data->shop->phone;
    $final_data['pickup_name']=$store_data->shop->name;
    $final_data['items_description']=$final_note;
	


        //*******************Create delivery****************//
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.burqup.com/v1/deliveries",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>json_encode($final_data),
      CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-api-key: ".$row['api_key']
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
   

    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
			if($httpcode==200)
			{
				$re=json_decode($response);
				$delivery_id=$re->delivery_id;
				$track_id=$re->id;
				$str_id=$row['id'];
				    $sql = "UPDATE orders SET delivery_id='$delivery_id',track_id='$track_id' WHERE store_id='$str_id' AND order_id='" . $orders['id'] . "'";
       				 $result = mysqli_query($conn, $sql);
			}
			else
			{
				echo file_put_contents('result/'.$orders['id'].'.log', $response);
			}


    
}
}
?>
