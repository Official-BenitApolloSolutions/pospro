<?php
session_start();
require '../settings/config.php';
	if (isset($_POST['submit'])) {
		$productbrand = $_POST['product-brand'];
		$productname = $_POST['product-name'];
		$productdesc = $_POST['product-description'];
		$arrivaldate = $_POST['arrival-date'];
		$expirydate = $_POST['expiry-date'];
		$sellingprice = $_POST['selling-price'];
		$originalprice = $_POST['original-price'];
		$productprofit = $_POST['product-profit'];
		$supplier = $_POST['supplier'];
		$productqty = $_POST['product-quantity'];
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Successfully added record","Problems were encounted"];
		if (empty($productbrand)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($productname)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($productdesc)) {
			array_push($error_status, $status_messages[0]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode => $value) {
				echo $error_mode;
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
			$_SESSION['session_status'] = $status_messages[1];
			header('Location: ../view/products.php');
			header('Refresh: 0');
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}

?>