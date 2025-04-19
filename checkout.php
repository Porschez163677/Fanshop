<?php
include "connectdb.php";
?>
<html>
<head>
<title>My Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
  h1 {
    color: #4da614;
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
    background-color: #D8DCDC;
  }
  th {
    background-color: #057FAD;
    color: white;
  }
</style>
</head>
<body>

<table>
<tr>
  <th>Product Code</th>
  <th>Product Name</th>
  <th>Price</th>
  <th>Quantity</th>
  <th>Total</th>
</tr>
<?php
$Total = 0;
$SumTotal = 0;

$intLine = isset($_SESSION["intLine"]) ? (int)$_SESSION["intLine"] : 0;

for ($i = 0; $i <= $intLine; $i++) {
    if (isset($_SESSION["strproductcode"][$i]) && $_SESSION["strproductcode"][$i] != "") {
        $strSQL = "SELECT * FROM products WHERE productcode = '" . $_SESSION["strproductcode"][$i] . "' ";
        $objQuery = mysqli_query($db, $strSQL) or die(mysqli_error($db));

        $objResult = mysqli_fetch_array($objQuery);
        $Total = $_SESSION["strQty"][$i] * $objResult["unitprice"];
        $SumTotal = $SumTotal + $Total;
?>
        <tr>
            <td><?php echo $_SESSION["strproductcode"][$i];?></td>
            <td><?php echo $objResult["productname"];?></td>
            <td><?php echo $objResult["unitprice"];?></td>
            <td><?php echo $_SESSION["strQty"][$i];?></td>
            <td><?php echo number_format($Total,2);?></td>
        </tr>
<?php
    }   
}
?>
</table>

<p>Sum Total: <?php echo number_format($SumTotal,2);?></p>
<br><br>

<form name="form1" method="post" action="save_checkout.php">
  <table>
    <tr>
      <th>Name</th>
      <td><input type="text" name="txtName"></td>
    </tr>
    <tr>
      <th>Address</th>
      <td><textarea name="txtAddress"></textarea></td>
    </tr>
    <tr>
      <th>Tel</th>
      <td><input type="text" name="txtTel"></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><input type="text" name="txtEmail"></td>
    </tr>
  </table>

  <input type="submit" name="Submit" value="Submit">
</form>
<br><br><a href="show.php">Go to your cart</a>
<?php
mysqli_close($db);
?>
</body>
</html>
