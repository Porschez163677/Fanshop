<?php
ob_start();
session_start();

if (!isset($_SESSION["intLine"])) {
    $_SESSION["intLine"] = 0;
    $_SESSION["strproductcode"][0] = $_GET["productcode"];
    $_SESSION["strQty"][0] = 1;

    header("location:show.php");
} else {
    // Check if the array is set before using array_search
    if (isset($_SESSION["strproductcode"])) {
        $key = array_search($_GET["productcode"], $_SESSION["strproductcode"]);
    } else {
        $key = false;
    }

    if ($key !== false) {
        $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
    } else {
        $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
        $intNewLine = $_SESSION["intLine"];
        $_SESSION["strproductcode"][$intNewLine] = $_GET["productcode"];
        $_SESSION["strQty"][$intNewLine] = 1;
    }

    header("location:show.php");
}
?>