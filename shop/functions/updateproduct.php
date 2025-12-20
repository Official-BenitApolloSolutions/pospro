<?php
	session_start();
	require_once '../settings/config.php';
	$user_role = "";
	$invoice = "";
	$error_status = array();
	$uri = "../view/products.php?user_role=$user_role";
	$path = urlencode($uri);
	$route = urldecode($path);
	$status_messages = ["Fields cannot be left empty","product brand cannot be left empty","supplier cannot be left empty","product quantity cannot be left empty","Successfully added record","Problems were encounted"];
	if (isset($_SESSION['user_role'])) {
		$user_role = $_SESSION['user_role'];
	}
	if (isset($_SESSION['invoice'])) {
		$invoice = $_SESSION['invoice'];
	}
	if (isset($_POST['update_product'])) {
		$updateid = $_POST['updateproduct_id'];
		$updateproductbrand = getData($_POST['updateproduct_brand']);
		$updateproductname = getData($_POST['updateproduct_name']);
		$updateproductdesc = getData($_POST['updateproduct_description']);
		$updatearrivaldate = getData($_POST['updatearrival_date']);
		$updateexpirydate = getData($_POST['updateexpiry_date']);
		$updatesellingprice = getData($_POST['updateselling_price']);
		$updateoriginalprice = getData($_POST['updateoriginal_price']);
		$updateproductprofit = getData($_POST['updateproduct_profit']);
		$updatesupplier = getData($_POST['updatesupplier']);
		$updateproductqty = getData($_POST['updateproduct_quantity']);
		if (empty($updateproductbrand)) {
			array_push($error_status, $status_messages[1]);
		}
		if (empty($updateproductname)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updateproductdesc)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updatearrivaldate)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updateexpirydate)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updatesellingprice)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updateoriginalprice)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updateproductprofit)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($updatesupplier)) {
			array_push($error_status, $status_messages[2]);
		}
		if (empty($updateproductqty)) {
			array_push($error_status, $status_messages[3]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode) {
				$_SESSION['error_status'] = $error_mode;
			}
		}
	 	$sql = "UPDATE products SET product_name = :productname, gen_name = :brandname, product_code = :productdesc, supplier = :supplier, date_arrival = :date_arrival, expiry_date = :expiry_date, o_price = :o_price, price = :price, profit = :profit, qty = :prodquantity WHERE product_id = :userid";
		 try {
		   $stmt=$dbc->prepare($sql);
		   $stmt->bindValue(":userid",$updateid, PDO::PARAM_INT);
		   $stmt->bindValue(":productname",$updateproductname, PDO::PARAM_STR);
		   $stmt->bindValue(":brandname", $updateproductbrand, PDO::PARAM_STR);
		   $stmt->bindValue(":productdesc", $updateproductdesc, PDO::PARAM_STR);
		   $stmt->bindValue(":supplier", $updatesupplier, PDO::PARAM_STR);
		   $stmt->bindValue(":date_arrival", $updatearrivaldate, PDO::PARAM_STR);
		   $stmt->bindValue(":expiry_date", $updateexpirydate, PDO::PARAM_STR);
		   $stmt->bindValue(":o_price", $updateoriginalprice, PDO::PARAM_STR);
		   $stmt->bindValue(":price", $updatesellingprice, PDO::PARAM_STR);
		   $stmt->bindValue(":profit", $updateproductprofit, PDO::PARAM_STR);
		   $stmt->bindValue(":prodquantity", $updateproductqty, PDO::PARAM_INT);
		   $stmt->execute();
		   header("Location: $route");
		 } catch (PDOException $e) {
		   echo "error: " . $e->getMessage();
		 }

			$dbc = null;
		}else{
			header("Location: ../view/editproduct_view.php?user_role=$user_role");
		}

		function getData($data){
			$data = trim($data);
			$data = htmlspecialchars($data);
			$data = stripcslashes($data);
			return $data;
		}
?>