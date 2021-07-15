<?php

// $store="burq-dev.myshopify.com";
// $acs_tkn="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";



//  $fullfill = array(
//             'fulfillment' => array(
//                 "notify_customer" => true,
//                 "tracking_info" => array(
//                     'number' => $row1['track_id'],
//                     'url' => 'https://burqup.com/track/'.$row1['awb_no'],
//                     'company' => "Burq Shipping"

//                 )
//             )
//         );
//         $curl = curl_init();

//         curl_setopt_array($curl, array(
//             CURLOPT_URL => 'https://' . $store . '/admin/api/2021-01/fulfillments/' . $orders['fulfillments'][$update_full]['id'] . '/update_tracking.json',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "POST",
//             CURLOPT_POSTFIELDS => json_encode($fullfill) ,
//             CURLOPT_HTTPHEADER => array(
//                 'Content-Type: application/json',
//                 'X-Shopify-Access-Token:' . $acs_tkn

//             ) ,
//         ));
//         $response1 = curl_exec($curl);
//         curl_close($curl);
//          echo '<pre>';
//             print_r($store_data);
//             die;

// $curl = curl_init();

//             curl_setopt_array($curl, array(
//                 CURLOPT_URL => 'https://' . $store . '/admin/api/2021-04/webhooks.json',
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => '',
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => 'GET',
//                 CURLOPT_HTTPHEADER => array(
//                     'Content-Type: application/json',
//                     'X-Shopify-Access-Token:' . $acs_tkn

//                 ) ,
//             ));

//             $response = curl_exec($curl);

//             curl_close($curl);
//             $store_data = json_decode($response);
//             echo '<pre>';
//             print_r($store_data);
//             die;


//     $curl = curl_init();

//     curl_setopt_array($curl, array(
//         CURLOPT_URL => 'https://' . $store . '/admin/api/2021-04/orders/3900349055149.json',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'GET',
//         CURLOPT_HTTPHEADER => array(
//             'Content-Type: application/json',
//             'X-Shopify-Access-Token:' . $acs_tkn

//         ) ,
//     ));

//     $response = curl_exec($curl);

//     curl_close($curl);
//     $data = json_decode($response);
//     $items=array();
//     $i=0;
//     foreach($data->order->line_items as $item)
//     {
//     	$items[$i]['name']=$item->name;
//     	$items[$i]['quantity']=$item->quantity;
//     	$items[$i]['size']="small";
//     	$i++;
//     }
//     $final_data=array();
//     $final_data['items']=$items;
//     echo '<pre>';
//     echo json_encode($final_data);
    
//     print_r($data);
//     echo '</pre>';
?>