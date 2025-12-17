<?php
require_once '../settings/config.php';
    date_default_timezone_set("UTC");
    $hero = date_default_timezone_get();
    $today = date('l'); 
    $timer = date('Y.m.d H:i:s a');
    if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
    }

    if (isset($_SESSION['session_status'])) {
      $session_status = $_SESSION['session_status'];
      $session_mes = "<div class='alert alert-dismissible fade show alert-success text-capitalize' role='alert'>$session_status<button data-bs-dismiss='alert' type='button' aria-label='close' class='btn-close'></button> at $timer, $today</div>";
    }else{
      $session_mes = "";
    }

    $conn = new mysqli("localhost","root","","sales");
    
    // users
    $user_res = mysqli_query($conn, 'SELECT * FROM user_account');
    $user_sqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM user_account";
    // $totalrows = $conn->query($prodsqlcount);
    $st = $conn->query("SELECT found_rows() AS totalRows");
    $rownum = $st->fetch_assoc();

    //user
    $userlres = mysqli_query($conn, "SELECT * FROM user_account WHERE user_id = $id");
    $usersqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM user_account";
    $userst = $conn->query("SELECT found_rows() AS totalRows");
    $userrownum = $userst->fetch_assoc();

    //customer
    $cusres = mysqli_query($conn, 'SELECT * FROM customer');
    $cusqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM customer";
    $cust = $conn->query("SELECT found_rows() AS totalRows");
    $cusrownum = $cust->fetch_assoc();

    //orders
     function getRandomPars(){
      $chars = "003232303232023232023456789";
      srand((double)microtime()*1000000);
      $i = 0;
      $pass = '' ;
      while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

      }
      return $pass;
    }

     $invoice = '34' . getRandomPars();

    // update product
     $fetchprod = "SELECT * FROM products WHERE product_id = :userid";
     $stmt = $dbc->prepare($fetchprod);
     $stmt->bindParam(":userid", $id);
     $stmt->execute();
     $uprow = $stmt->fetch();
?>