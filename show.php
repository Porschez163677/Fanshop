<?php
include "connectdb.php";
?>
<html>
<head>
<title>My Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
  h1 {
    color: #14D198;
    font-size: 36px;
    line-height: 40px;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    text-align: left;
    padding: 8px;
  }
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  th {
    background-color: #14D198;
    color: white;
  }
</style>
</head>
<body>
<?php
if (!isset($_SESSION["intLine"]) || !isset($_SESSION["strproductcode"])) {
    echo "Cart empty";
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "myshopdb");
?>
<h1>Your Shopping Cart</h1>
<table>
  <tr>
    <th>ProductID</th>
    <th>ProductName</th>
    <th>Unit Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Delete</th>
  </tr>
  <?php
  $Total = 0;
  $SumTotal = 0;
  for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
      if (isset($_SESSION["strproductcode"][$i]) && $_SESSION["strproductcode"][$i] != "") {
        $strSQL = "SELECT * FROM products WHERE productcode = '".$_SESSION["strproductcode"][$i]."' ";
        $objQuery = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
        $objResult = mysqli_fetch_array($objQuery);

     
        if (isset($objResult["unitprice"])) {
            $Total = $_SESSION["strQty"][$i] * $objResult["unitprice"];
            $SumTotal = $SumTotal + $Total;
        } else {
           
            echo "Error: unitprice not found.";
        }
  ?>
  <tr>
    <td><?php echo $_SESSION["strproductcode"][$i];?></td>
    <td><?php echo $objResult["productname"];?></td>
    <td><?php echo isset($objResult["unitprice"]) ? $objResult["unitprice"] : "N/A";?></td>
    <td><?php echo $_SESSION["strQty"][$i];?></td>
    <td><?php echo number_format($Total, 2);?></td>
    <td><a href="delete.php?Line=<?php echo $i;?>">x</a></td>
  </tr>
  <?php
      }
  }
  ?>
</table>
Sum Total <?php echo number_format($SumTotal, 2);?>
<br><br><a href="product.php">Go to Product</a>
<?php
    if ($SumTotal > 0) {
?>
    | <a href="checkout.php">CheckOut</a>
<?php
    }
?>
</body>
</html>
