<?php
    date_default_timezone_set("UTC");
    $hero = date_default_timezone_get();
    $today = date('l'); 
    $timer = date('Y.m.d H:i:s a');
    
    if (isset($_SESSION['session_status'])) {
      $session_status = $_SESSION['session_status'];
      $session_mes = "<div class='alert alert-dismissible fade show alert-success' role='alert'>$session_status<button data-bs-dismiss='alert' type='button' aria-label='close' class='btn-close'></button></div>";
    }else{
      $session_mes = "";
    }
    $conn = new mysqli("localhost","root","","sales");
    $prodres = mysqli_query($conn, 'SELECT * FROM products');
    $prodsqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM products";
    // $totalrows = $conn->query($prodsqlcount);
    $st = $conn->query("SELECT found_rows() AS totalRows");
    $rownum = $st->fetch_assoc();

    //supplier
    $suplres = mysqli_query($conn, 'SELECT * FROM suppliers');
    $suplsqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM suppliers";
    $suplst = $conn->query("SELECT found_rows() AS totalRows");
    $suplrownum = $suplst->fetch_assoc();

    //customer
    $cusres = mysqli_query($conn, 'SELECT * FROM customer');
    $cusqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM customer";
    $cust = $conn->query("SELECT found_rows() AS totalRows");
    $cusrownum = $cust->fetch_assoc();

    //orders
     $orders = mysqli_query($conn, 'SELECT * FROM sales_order');

?>