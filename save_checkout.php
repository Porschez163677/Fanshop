<?php
session_start();
include 'connectdb.php';

if (isset($_POST['Submit'])) {
  
    $name = $_POST['txtName'];
    $address = $_POST['txtAddress'];
    $tel = $_POST['txtTel'];
    $email = $_POST['txtEmail'];

   
    $intLine = isset($_SESSION["intLine"]) ? (int)$_SESSION["intLine"] : 0;
    $SumTotal = 0;
    for ($i = 0; $i <= $intLine; $i++) {
        if (isset($_SESSION["strproductcode"][$i]) && $_SESSION["strproductcode"][$i] != "") {
            $strSQL = "SELECT * FROM products WHERE productcode = '" . $_SESSION["strproductcode"][$i] . "' ";
            $objQuery = mysqli_query($db, $strSQL) or die(mysqli_error($db));
            $objResult = mysqli_fetch_array($objQuery);
            $Total = $_SESSION["strQty"][$i] * $objResult["unitprice"];
            $SumTotal = $SumTotal + $Total;
        }
    }

   
    $strSQL = "INSERT INTO orders (Name, Address, Tel, Email) 
               VALUES ('$name', '$address', '$tel', '$email')";
    $result = mysqli_query($db, $strSQL);
    if ($result) {
        
        $orderID = mysqli_insert_id($db);

        
        for ($i = 0; $i <= $intLine; $i++) {
            if (isset($_SESSION["strproductcode"][$i]) && $_SESSION["strproductcode"][$i] != "") {
                $productCode = $_SESSION["strproductcode"][$i];
                $qty = $_SESSION["strQty"][$i];
                $strSQL = "INSERT INTO orderdetails (OrderID, productode, qty) 
                           VALUES ($orderID, '$productCode', $qty)";
                $result = mysqli_query($db, $strSQL);
                if (!$result) {
                    die("Error in orderdetails query: " . mysqli_error($db));
                }
            }
        }

        
        unset($_SESSION['intLine']);
        unset($_SESSION['strproductcode']);
        unset($_SESSION['strQty']);

       
        header("Location: Thanku.php");
        exit();
    } else {
        die("Error in orders query: " . mysqli_error($db));
    }
   
}
?>
