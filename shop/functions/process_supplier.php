<?php
session_start();
require_once '../settings/config.php';
	if (isset($_POST['submit'])) {
		$suppliername = $_POST['supplier_name'];
		$supplieraddress = $_POST['supplier_address'];
		$contactdesc = $_POST['contact_description'];
		$contactnumber = $_POST['contact_number'];
		$suppliernote = $_POST['supplier_note'];
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Successfully added supplier","Problems were encounted"];
		if (empty($suppliername)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($supplieraddress)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($contactdesc)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($contactnumber)) {
			array_push($error_status, $status_messages[0]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode => $value) {
				echo $error_mode;
			}
		}
		$sql = "INSERT INTO suppliers (supplier_name, supplier_address, supplier_contact, contact_person, note) VALUES (:suppliername,:supplieraddress,:contactdesc,:contactnumber,:suppliernote)";
		$stmt = $dbc->prepare($sql);
		$stmt->bindParam(':suppliername',$suppliername);
		$stmt->bindParam(':supplieraddress',$supplieraddress);
		$stmt->bindParam(':contactdesc',$contactdesc);
		$stmt->bindParam(':contactnumber',$contactnumber);
		$stmt->bindParam(':suppliernote',$suppliernote);
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