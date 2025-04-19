<?php
include "connectdb.php";
?>
<html>
<head>
<title>My online Shop</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<style>
h1{
color: #f95e00;
font-size: 36px;
line-height: 40px;
}
table{
    border-collapse: collapse;
    width: 100%;
}
th,td{
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th{
    background-color: #f95e00;
    color: white;
}
</style>
</head>
<body>
<?php
$strSQL = "SELECT * FROM products where status='1' and instock>0";
$objQuery = mysqli_query($db,$strSQL) or die(mysqli_errono());
?>
<h1> Best Fan Seller of the year 2023</h1>
<table>
    <tr>
        <th>Picture</td>
        <th>ProductID</td>
        <th>Productname</td>
        <th>Price</td>
        <th>Instock</td>
        <th>cart</td>
</tr>
<?php
while($objResult = mysqli_fetch_array($objQuery))
{
?>
<tr>
<td><img src="images/<?php echo $objResult["productimage"];?>"</td>
 <td><?php echo $objResult["productcode"];?></td>
 <td><?php echo $objResult["productname"];?></td>
 <td><?php echo $objResult["unitprice"];?></td>
 <td><?php echo $objResult["instock"];?></td>
 <td><a href="order.php?productcode=<?php echo $objResult["productcode"];?>">order</a></td>
</tr>
<?php
}
?>
</table>
<br><br><a href="show.php"><img src="images/smallcart.png"/></a>
<?php
mysqli_close($db);
?>
</body>
</html>