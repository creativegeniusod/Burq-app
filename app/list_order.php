<?php

if($_GET['shop'])
{
$_GET['shop']=$_GET['shop'];

}
else
{
if(empty($_POST))
{
$qs = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
if(!empty($qs)){
    parse_str($qs, $output);
    $_GET['shop']=$output['shop'];
  
}
}
else
{
    
 //   $_GET['shop']=$_POST['storee'];
}
}
?>
<html>
<head> 
    <link rel="stylesheet" href="assets/css/burq.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>  -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
<div class="container">   
<a class="burq-link"  href="index.php?shop=<?php echo $_GET['shop'];?>">Back to Home</a>
<?php

include 'db_config.php';


$query = mysqli_query($conn, "SELECT * FROM stores WHERE store='" . $_GET['shop'] . "'");

$row = $query->fetch_array(MYSQLI_ASSOC);

?>

<div class="table_con">

<h2>Recent Orders</h2>
 
<table class="ord_table" id="orderTable">
    <thead>
  <tr>
     <th><input type="checkbox"  id="all_check"></th>
    <th>Order</th>
    <th>Placed By</th>
    <th>Payment Status</th>
     <th>Fulfillment Status</th> 
    <th>Shipping Cost</th> 
    <th>Actions</th> 
  </tr></thead><tbody>
  <?php

    $query = "SELECT * FROM orders WHERE store_id='" . $row['id'] . "' order by id desc";


if ($result = $conn->query($query))
{

    /* fetch object array */
    while ($row1 = $result->fetch_assoc())
    { ?>
        <tr>
        <td><input type="checkbox" class="order_check" value="<?php echo $row1['order_id']; ?>"></td>
        <td><a href="https://<?php echo $_GET['shop']; ?>/admin/orders/<?php echo $row1['order_id']; ?>" target="_blank">#<?php echo $row1['order_num']; ?></a></td>
       
        <td><?php echo $row1['placed_by']; ?></td>
        <td><?php echo $row1['payment_status']; ?></td>
         <td><?php if ($row1['fulfillment_status'] == NULL)
        {
            echo 'Not Fulfilled';
        }
        else
        {
            echo ucwords($row1['fulfillment_status']);
        } ?></td> 
        <td><?php echo $row1['shipping']; ?></td>
        <td><?php if ($row1['track_id'] != NULL)
        {
       echo  '<a href="https://burqup.com/track/'.$row1["track_id"].'" target="_blank">Track order</a></td>';
      }
      ?>
   
 </tr>
  <?php
    }

    /* free result set */
    $result->close();
}
?>
  
  
</tbody></table>
</div></div>
</body>
   </html>
 
<script type="text/javascript">
    
$(document).ready(function(){
    $('#orderTable').DataTable();
});
</script>

