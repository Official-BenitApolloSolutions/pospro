<?php
session_start();
require '../settings/config.php';

if (isset($_POST['submit_product'])) {
	$productbrand = getData($_POST['product-brand']);
	$productname = getData($_POST['product-name']);
	$productdesc = getData($_POST['product-description']);
	$arrivaldate = getData($_POST['arrival-date']);
	$expirydate = getData($_POST['expiry-date']);
	$sellingprice = getData($_POST['selling-price']);
	$originalprice = getData($_POST['original-price']);
	$productprofit = getData($_POST['product-profit']);
	$supplier = getData($_POST['supplier']);
	$productqty = getData($_POST['product-quantity']);
	$error_status = array();
	$status_messages = ["Fields cannot be left empty","product brand cannot be left empty","supplier cannot be left empty","product quantity cannot be left empty","Successfully added record","Problems were encounted"];
	if (empty($productbrand)) {
		array_push($error_status, $status_messages[1]);
	}
	if (empty($productname)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($productdesc)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($arrivaldate)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($expirydate)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($sellingprice)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($originalprice)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($productprofit)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($supplier)) {
		array_push($error_status, $status_messages[2]);
	}
	if (empty($productqty)) {
		array_push($error_status, $status_messages[3]);
	}
	if (!empty($error_status)) {
		foreach ($error_status as $error_mode) {
			$_SESSION['error_status'] = $error_mode;
		}
	}
	$sql = "INSERT INTO products (product_code, gen_name, product_name, o_price, price, profit, supplier, qty, expiry_date, date_arrival) VALUES (:productbrand,:productname,:productdesc,:originalprice,:sellingprice,:productprofit,:supplier,:productqty,:expirydate,:arrivaldate)";
	$stmt = $dbc->prepare($sql);
	$stmt->bindParam(':productbrand',$productbrand);
	$stmt->bindParam(':productname',$productname);
	$stmt->bindParam(':productdesc',$productdesc);
	$stmt->bindParam(':arrivaldate',$arrivaldate);
	$stmt->bindParam(':expirydate',$expirydate);
	$stmt->bindParam(':sellingprice',$sellingprice);
	$stmt->bindParam(':originalprice',$originalprice);
	$stmt->bindParam(':productprofit',$productprofit);
	$stmt->bindParam(':supplier',$supplier);
	$stmt->bindParam(':productqty',$productqty);
	try {
		$stmt->execute();
		echo "successfully added record";
		$_SESSION['session_status'] = $status_messages[4];
		header('Location: ../view/products.php');
		header('Refresh: 0');
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$tbh = null;
}else{
	die("somehing");
}

// updates
if (isset($_POST['update_product'])) {
	$id = $_SESSION['id'];
	$productbrand = getData($_POST['product-brand']);
	$productname = getData($_POST['product-name']);
	$productdesc = getData($_POST['product-description']);
	$arrivaldate = getData($_POST['arrival-date']);
	$expirydate = getData($_POST['expiry-date']);
	$sellingprice = getData($_POST['selling-price']);
	$originalprice = getData($_POST['original-price']);
	$productprofit = getData($_POST['product-profit']);
	$supplier = getData($_POST['supplier']);
	$productqty = getData($_POST['product-quantity']);
	$error_status = array();
	$status_messages = ["Fields cannot be left empty","product brand cannot be left empty","supplier cannot be left empty","product quantity cannot be left empty","Successfully added record","Problems were encounted"];
	if (empty($productbrand)) {
		array_push($error_status, $status_messages[1]);
	}
	if (empty($productname)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($productdesc)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($arrivaldate)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($expirydate)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($sellingprice)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($originalprice)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($productprofit)) {
		array_push($error_status, $status_messages[0]);
	}
	if (empty($supplier)) {
		array_push($error_status, $status_messages[2]);
	}
	if (empty($productqty)) {
		array_push($error_status, $status_messages[3]);
	}
	if (!empty($error_status)) {
		foreach ($error_status as $error_mode) {
			$_SESSION['error_status'] = $error_mode;
		}
	}
		// $query = "SELECT * FROM products";
		// $rows = mysqli_query($dbc, $query);
		// $currentrow = "";
		// for ($i=0; $row = $rows->fetch(); $i++) { 
		// 	$currentrow = $row['product_id'];
		// }
     $sql = "UPDATE products SET product_name = :productname, gen_name = :brandname, product_code = :productdesc, supplier = :supplier, date_arrival = :date_arrival, expiry_date = :expiry_date, o_price = :o_price, price = :price, profit = :profit, qty = :prodquantity WHERE product_id = :userid";
     try {
       $stmt=$dbc->prepare($sql);
       // $stmt->bindValue(":userid",$currentrow, PDO::PARAM_INT);
       $stmt->bindValue(":productname",$productname, PDO::PARAM_STR);
       $stmt->bindValue(":brandname", $brandname, PDO::PARAM_STR);
       $stmt->bindValue(":productdesc", $productdesc, PDO::PARAM_STR);
       $stmt->bindValue(":supplier", $supplier, PDO::PARAM_STR);
       $stmt->bindValue(":date_arrival", $date_arrival, PDO::PARAM_STR);
       $stmt->bindValue(":expiry_date", $expiry_date, PDO::PARAM_STR);
       $stmt->bindValue(":o_price", $originalprice, PDO::PARAM_STR);
       $stmt->bindValue(":price", $sellingprice, PDO::PARAM_STR);
       $stmt->bindValue(":profit", $productprofit, PDO::PARAM_STR);
       $stmt->bindValue(":prodquantity", $productqty, PDO::PARAM_INT);
       $stmt->execute();
       header("Refresh: 0");
     } catch (PDOException $e) {
       echo "error: " . $e->getMessage();
     }
}
function getData($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}
?>