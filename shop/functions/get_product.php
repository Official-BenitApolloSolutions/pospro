<?php
    require_once '../settings/config.php';
    date_default_timezone_set("UTC");
    $hero = date_default_timezone_get();
    $today = date('l'); 
    $timer = date('Y.m.d H:i:s a');
    if (isset($_GET['product_id'])) {
      $productid = $_GET['product_id'];
    }
    if (isset($_GET['supplier_id'])) {
      $supplierid = $_GET['supplier_id'];
    }
    if (isset($_GET['customer_id'])) {
      $customerid = $_GET['customer_id'];
    }
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
    
    // products
    $prodres = mysqli_query($conn, 'SELECT * FROM products');
    $prodsqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM products";
    // $totalrows = $conn->query($prodsqlcount);
    $st = $conn->query("SELECT found_rows() AS totalRows");
    $rownum = $st->fetch_assoc();

    // pdo products
    $query = "SELECT * FROM products";
    $products = $dbc->prepare($query);
    $products->execute();

    $prodsqlcount = "SELECT COUNT(*) FROM products";
    $rownum = $dbc->query($prodsqlcount)->fetchColumn();

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
    $sal_query = "SELECT * FROM sales";
    $sales = $dbc->prepare($sal_query);
    $sales->execute();

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
     $stmt->bindParam(":userid", $productid);
     $stmt->execute();
     $uprow = $stmt->fetch();

     // update supplier
     $fetchsup = "SELECT * FROM suppliers WHERE supplier_id = :supid";
     $sutmt = $dbc->prepare($fetchsup);
     $sutmt->bindParam(":supid", $supplierid);
     $sutmt->execute();
     $suprow = $sutmt->fetch();

     // update customer
     $fetchup = "SELECT * FROM customer WHERE customer_id = :custid";
     $custmt = $dbc->prepare($fetchup);
     $custmt->bindParam(":custid", $customerid);
     $custmt->execute();
     $cusrow = $custmt->fetch();
?>