<html>
<head>
<title>ThaiCreate.Com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<<?php
if (isset($_GET["OrderID"])) {
    $strSQL = "SELECT * FROM orders WHERE OrderID = '".$_GET["OrderID"]."' ";
    $objQuery = mysqli_query($strSQL) or die(mysqli_error());
    $objResult = mysqli_fetch_array($objQuery);
?>

 <table width="304" border="1">
    <tr>
      <td width="71">OrderID</td>
      <td width="217">
	  <?php echo $objResult["OrderID"];?></td>
    </tr>
    <tr>
      <td width="71">Name</td>
      <td width="217">
	  <?php echo $objResult["Name"];?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $objResult["Address"];?></td>
    </tr>
    <tr>
      <td>Tel</td>
      <td><?php echo $objResult["Tel"];?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $objResult["Email"];?></td>
    </tr>
  </table>

  <br>

<table width="400"  border="1">
  <tr>
    <td width="101">ProductID</td>
    <td width="82">ProductName</td>
    <td width="82">Price</td>
    <td width="79">Qty</td>
    <td width="79">Total</td>
  </tr>
<?php

$Total = 0;
$SumTotal = 0;

$strSQL2 = "SELECT * FROM orders_detail WHERE OrderID = '".$_GET["OrderID"]."' ";
$objQuery2 = mysqli_query($strSQL2)  or die(mysqli_error());

while($objResult2 = mysqli_fetch_array($objQuery2))
{
		$strSQL3 = "SELECT * FROM product WHERE productcode = '".$objResult2["productcode"]."' ";
		$objQuery3 = mysqli_query($strSQL3)  or die(mysqli_error());
		$objResult3 = mysqli_fetch_array($objQuery3);
		$Total = $objResult2["instock"] * $objResult3["unitprice"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
		<td><?php echo $objResult2["productcode"];?></td>
		<td><?php echo $objResult3["productName"];?></td>
		<td><?php echo $objResult3["unitprice"];?></td>
		<td><?php echo $objResult2["instock"];?></td>
		<td><?php echo number_format($Total,2);?></td>
	  </tr>
	  <?php
 }
  ?>
</table>
Sum Total <?php echo number_format($SumTotal,2);?>

<?php
mysqli_close();
}
?>
</body>
</html>
