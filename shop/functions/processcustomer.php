<?php
session_start();
require '../settings/config.php';
if (isset($_SESSION['user_role'])) {
	$user_role = $_SESSION['user_role'];
}

if (isset($_SESSION['customer_id'])) {
	$custid = $_SESSION['customer_id'];
}
if (isset($_POST['submit'])) {
	$customername = getData($_POST['customer_name']);
	$address = getData($_POST['address']);
	$contact = getData($_POST['contact']);
	$productname = getData($_POST['product_name']);
	$total = getData($_POST['total']);
	$note = getData($_POST['note']);
	$expected_date = getData($_POST['expected_date']);
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
	$sql = "INSERT INTO customer (customer_name, address, contact, membership_number, prod_name, expected_date, note) VALUES (:customername,:address,:contact, :total, :productname,:expected_date,:note)";
	$stmt = $dbc->prepare($sql);
	$stmt->bindParam(':customername',$customername);
	$stmt->bindParam(':address',$address);
	$stmt->bindParam(':contact',$contact);
	$stmt->bindParam(':total',$total);
	$stmt->bindParam(':productname',$productname);
	$stmt->bindParam(':note',$note);
	$stmt->bindParam(':expected_date',$expected_date);
	try {
	   $stmt->execute();
	   echo "successfully added customer";
	   $_SESSION['session_status'] = $status_messages[1];
	   $uri = "../view/customers.php?user_role=$user_role";
	   $path = urlencode($uri);
	   $route = urldecode($path);
	   header("Location: $route");
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$tbh = null;
}

if (isset($_POST['update_customer'])) {
	$customerid = getData($_POST['customer_id']);
	$upcustomername = getData($_POST['upcustomer_name']);
	$upaddress = getData($_POST['upaddress']);
	$upcontact = getData($_POST['upcontact']);
	$upproductname = getData($_POST['upproduct_name']);
	$uptotal = getData($_POST['uptotal']);
	$upnote = getData($_POST['upnote']);
	$upexpected_date = getData($_POST['upexpected_date']);
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
	$sql = "UPDATE customer SET customer_name = :upcustomername, address = :upaddress, contact = :upcontact, membership_number = :uptotal, prod_name = :upproductname, expected_date = :upexpected_date, note = :upnote WHERE customer_id = :customerid";
	$custmt = $dbc->prepare($sql);
	$custmt->bindParam(':customerid',$customerid);
	$custmt->bindParam(':upcustomername',$upcustomername);
	$custmt->bindParam(':upaddress',$upaddress);
	$custmt->bindParam(':upcontact',$upcontact);
	$custmt->bindParam(':uptotal',$uptotal);
	$custmt->bindParam(':upproductname',$upproductname);
	$custmt->bindParam(':upnote',$upnote);
	$custmt->bindParam(':upexpected_date',$upexpected_date);
	try {
	   $custmt->execute();
	   echo "successfully added customer";
	   $_SESSION['session_status'] = $status_messages[1];
	   $_SESSION['customer_id'] = $customerid;
	   $uri = "../view/editcustomer_view.php?user_role=$user_role&customer_id=$custid";
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