<?php
session_start();
require '../settings/config.php';

$error_status = array();
$status_messages = ["Fields cannot be left empty","product brand cannot be left empty","supplier cannot be left empty","product quantity cannot be left empty","Successfully added record","Problems were encounted"];

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

	$dbc = null;
}else{
	print_r($_POST);
	die("cannot add product now, try again later");
}

// updates
// if (isset($_POST['update_product'])) {
// 	$updateid = $_POST['product_id'];
// 	$updateproductbrand = getData($_POST['updateproduct-brand']);
// 	$updateproductname = getData($_POST['updateproduct-name']);
// 	$updateproductdesc = getData($_POST['updateproduct-description']);
// 	$updatearrivaldate = getData($_POST['updatearrival-date']);
// 	$updateexpirydate = getData($_POST['updateexpiry-date']);
// 	$updatesellingprice = getData($_POST['updateselling-price']);
// 	$updateoriginalprice = getData($_POST['updateoriginal-price']);
// 	$updateproductprofit = getData($_POST['updateproduct-profit']);
// 	$updatesupplier = getData($_POST['updatesupplier']);
// 	$updateproductqty = getData($_POST['updateproduct-quantity']);
// 	if (empty($updateproductbrand)) {
// 		array_push($error_status, $status_messages[1]);
// 	}
// 	if (empty($updateproductname)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updateproductdesc)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updatearrivaldate)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updateexpirydate)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updatesellingprice)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updateoriginalprice)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updateproductprofit)) {
// 		array_push($error_status, $status_messages[0]);
// 	}
// 	if (empty($updatesupplier)) {
// 		array_push($error_status, $status_messages[2]);
// 	}
// 	if (empty($updateproductqty)) {
// 		array_push($error_status, $status_messages[3]);
// 	}
// 	if (!empty($error_status)) {
// 		foreach ($error_status as $error_mode) {
// 			$_SESSION['error_status'] = $error_mode;
// 		}
// 	}
//  $sql = "UPDATE products SET product_name = :productname, gen_name = :brandname, product_code = :productdesc, supplier = :supplier, date_arrival = :date_arrival, expiry_date = :expiry_date, o_price = :o_price, price = :price, profit = :profit, qty = :prodquantity WHERE product_id = :userid";
//  try {
//    $stmt=$dbc->prepare($sql);
//    $stmt->bindValue(":userid",$id, PDO::PARAM_INT);
//    $stmt->bindValue(":productname",$updateproductname, PDO::PARAM_STR);
//    $stmt->bindValue(":brandname", $updatebrandname, PDO::PARAM_STR);
//    $stmt->bindValue(":productdesc", $updateproductdesc, PDO::PARAM_STR);
//    $stmt->bindValue(":supplier", $updatesupplier, PDO::PARAM_STR);
//    $stmt->bindValue(":date_arrival", $updatedate_arrival, PDO::PARAM_STR);
//    $stmt->bindValue(":expiry_date", $updateexpiry_date, PDO::PARAM_STR);
//    $stmt->bindValue(":o_price", $updateoriginalprice, PDO::PARAM_STR);
//    $stmt->bindValue(":price", $updatesellingprice, PDO::PARAM_STR);
//    $stmt->bindValue(":profit", $updateproductprofit, PDO::PARAM_STR);
//    $stmt->bindValue(":prodquantity", $updateproductqty, PDO::PARAM_INT);
//    $stmt->execute();
//    header("Refresh: 0");
//  } catch (PDOException $e) {
//    echo "error: " . $e->getMessage();
//  }

// 	$dbc = null;
// }else{
// 	print_r($_POST);
// 	die("cannot update product now, try again later");
// }

function getData($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}
?>