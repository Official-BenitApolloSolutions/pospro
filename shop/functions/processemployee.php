<?php
	session_start();
	require '../settings/config.php';
	if (isset($_POST['submit_info'])) {
		$institutionname = getData($_POST['institution-name']);
		$address = getData($_POST['address']);
		$contact_info = getData($_POST['contact_info']);
		$tax_id = getData($_POST['tax_id']);
		$currency = getData($_POST['currency']);
		$username = getData($_POST['username']);
		$password = getData($_POST['password']);
		$institutiondesc = getData($_POST['institution-description']);
		$establishmentdate = getData($_POST['establishment-date']);
		$institutiontype = getData($_POST['institution_type']);
		$employeenumber = getData($_POST['employee-number']);
		// $originalprice = getData($_POST['original-price']);
		// $productprofit = getData($_POST['product-profit']);
		// $supplier = getData($_POST['supplier']);
		// $productqty = getData($_POST['product-quantity']);
		// $filename = $_FILES['logo']['name'];
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Address cannot be left empty","Contact information cannot be left empty","tax id cannot be left empty","Successfully added record","Problems were encounted"];
		if (empty($institutionname)) {
			array_push($error_status, $status_messages[1]);
		}
		if (empty($address)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($contact_info)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($tax_id)) {
			array_push($error_status, $status_messages[2]);
		}
		if (empty($currency)) {
			array_push($error_status, $status_messages[3]);
		}
		if (empty($username)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($institutiondesc)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($establishmentdate)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($institutiontype)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($employeenumber)) {
			array_push($error_status, $status_messages[0]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode) {
				$_SESSION['error_status'] = $error_mode;
			}
		}
		// print_r($_POST);
		$sql = "INSERT INTO account (Institution_name, address, contact_info, tax_id, currency, username, password, institution_desc, established_date, institution_type, number_of_employees) VALUES (:institutionname,:address,:contact_info,:tax_id,:currency,:username,password(:password),:institutiondesc,:establishmentdate,:institutiontype,:employeenumber)";
		$stmt = $dbc->prepare($sql);
		$stmt->bindParam(':institutionname',$institutionname);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':contact_info',$contact_info);
		$stmt->bindParam(':tax_id',$tax_id);
		$stmt->bindParam(':currency',$currency);
		$stmt->bindParam(':username',$username);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':institutiondesc',$institutiondesc);
		$stmt->bindParam(':establishmentdate',$establishmentdate);
		$stmt->bindParam(':institutiontype',$institutiontype);
		$stmt->bindParam(':employeenumber',$employeenumber);
		try {

			$stmt->execute();
			echo "successfully added record";
			$_SESSION['session_status'] = $status_messages[4];
			header('Location: ../pos/index.php');
			header('Refresh: 0');
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}else{
		die("ENCOUNTERED Problems");
	}

	function getData($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripcslashes($data);
		return $data;
	}
?>