<?php
session_start();
require_once '../settings/config.php';
if (isset($_SESSION['user_role'])) {
	$user_role = $_SESSION['user_role'];
}
if (isset($_SESSION['invoice'])) {
	$invoice = $_SESSION['invoice'];
}

if (isset($_POST['submit'])) {
	$suppliername = getData($_POST['supplier_name']);
	$supplieraddress = getData($_POST['supplier_address']);
	$contactdesc = getData($_POST['contact_description']);
	$contactnumber = getData($_POST['contact_number']);
	$suppliernote = getData($_POST['supplier_note']);
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

if(isset($_SESSION["supplier_id"])){
	$supid = $_SESSION['supplier_id']; 
}

if (isset($_POST['update_supplier'])) {
	$upsupplierid = getData($_POST['supplier_id']);
	$upsuppliername = getData($_POST['upsupplier_name']);
	$upsupplieraddress = getData($_POST['upsupplier_address']);
	$upcontactdesc = getData($_POST['upcontact_description']);
	$upcontactnumber = getData($_POST['upcontact_number']);
	$upsuppliernote = getData($_POST['upsupplier_note']);
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
	$sql = "UPDATE suppliers SET supplier_name = :suppliername, supplier_address = :supplieraddress, supplier_contact = :contactdesc, contact_person = :contactnumber, note =:suppliernote WHERE supplier_id = :supplierid";
	$stmt = $dbc->prepare($sql);
	$stmt->bindParam(':supplierid',$upsupplierid);
	$stmt->bindParam(':suppliername',$upsuppliername);
	$stmt->bindParam(':supplieraddress',$upsupplieraddress);
	$stmt->bindParam(':contactdesc',$upcontactdesc);
	$stmt->bindParam(':contactnumber',$upcontactnumber);
	$stmt->bindParam(':suppliernote',$upsuppliernote);
	try {
		$stmt->execute();
		echo "successfully added record";
		$_SESSION['session_status'] = $status_messages[1];
		$_SESSION['supplier_id'] = $upsupplierid;
		$uri = "../view/editsupplier_view.php?user_role=$user_role&supplier_id=$supid";
		$path = urlencode($uri);
		$route = urldecode($path);
		header("Location: $route");
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$tbh = null;
}

function getData($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripcslashes($data);
	return $data;
}

?>