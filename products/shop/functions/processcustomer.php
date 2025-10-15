<?php
session_start();
require '../settings/config.php';
	if (isset($_POST['submit'])) {
		$customername = $_POST['customer-name'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$productname = $_POST['product-name'];
		$total = $_POST['total'];
		$note = $_POST['note'];
		$expected_date = $_POST['expected-date'];
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Successfully added customer","Problems were encounted"];
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
		$sql = "INSERT INTO customer (customer_name, address, contact, prod_name, expected_date, note) VALUES (:customername,:address,:contact,:productname,:expected_date,:note)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':customername',$customername);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':contact',$contact);
		$stmt->bindParam(':productname',$productname);
		$stmt->bindParam(':note',$note);
		$stmt->bindParam(':expected_date',$expected_date);
		try {

			$stmt->execute();
			echo "successfully added customer";
			$_SESSION['session_status'] = $status_messages[1];
			header('Location: ../view/customers.php');
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}

?>