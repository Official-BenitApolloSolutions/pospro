<?php
    require_once '../settings/config.php';

     $id = $_GET['invoice'];
     $res = "SELECT * FROM sales_order WHERE invoice = :userid";
     $orders = $dbc->prepare($res);
     $orders->bindValue(":userid", $id, PDO::PARAM_INT);
     $orders->execute();
     
    // fetch profits
     $respro = $dbc->prepare("SELECT sum(profit) AS totalprofit FROM sales_order WHERE invoice = :userid");
     $respro->bindValue(":userid",$id, PDO::PARAM_STR);
     $respro->execute();

     // fetch amounts
     $resam = $dbc->prepare("SELECT sum(amount) AS totalamount FROM sales_order WHERE invoice = :invoice");
     $resam->bindValue(":invoice",$id, PDO::PARAM_STR);
     $resam->execute();

     // sales preview
     $pre = "SELECT * FROM sales WHERE invoice_number = :userid";
     $llc = $dbc->prepare($pre);
     $llc->bindValue(":userid", $id, PDO::PARAM_STR);
     $llc->execute();
?>