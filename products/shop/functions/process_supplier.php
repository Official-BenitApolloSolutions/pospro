<?php
session_start();
require '../settings/config.php';
	if (isset($_POST['submit'])) {
		$suppliername = $_POST['supplier-name'];
		$customeraddress = $_POST['customer-address'];
		$contactdesc = $_POST['contact-description'];
		$contactnumber = $_POST['contact-number'];
		$productprice = $_POST['product-price'];
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Successfully added supplier","Problems were encounted"];
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
		$sql = "INSERT INTO supliers (suplier_name, suplier_address, suplier_contact, contact_person, note) VALUES (:suppliername,:customeraddress,:contactdesc,:contactnumber,:productprice)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':suppliername',$suppliername);
		$stmt->bindParam(':customeraddress',$customeraddress);
		$stmt->bindParam(':contactdesc',$contactdesc);
		$stmt->bindParam(':contactnumber',$contactnumber);
		$stmt->bindParam(':productprice',$productprice);
		try {

			$stmt->execute();
			echo "successfully added record";
			$_SESSION['session_status'] = $status_messages[1];
			header('Location: ../view/supplier.php');
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}

?>