<?php
	session_start();
	require '../settings/config.php';
	if (isset($_SESSION['Institution_name'])) {
		$institute = $_SESSION['Institution_name'];
	}
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
		$filename = $_FILES['logo']['tmp_name'];
		if (move_uploaded_file($filename, '../resources/comp_img/logo.jpg')) {
			$_SESSION['logo'] = $filename;
		}
		$institutiontype = getData($_POST['institution_type']);
		$employeenumber = getData($_POST['employee-number']);
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
		die();
	}

	if (isset($_POST['update_info'])) {
		$institutionname = getData($_POST['institution-name']);
		$address = getData($_POST['address']);
		$contact_info = getData($_POST['contact_info']);
		$tax_id = getData($_POST['tax_id']);
		$currency = getData($_POST['currency']);
		$username = getData($_POST['username']);
		$password = getData($_POST['password']);
		$institutiondesc = getData($_POST['institution-description']);
		$establishmentdate = getData($_POST['establishment-date']);
		$filename = $_FILES['logo']['tmp_name'];
		if (move_uploaded_file($filename, '../resources/comp_img/logo.jpg')) {
			$_SESSION['logo'] = $filename;
		}
		$institutiontype = getData($_POST['institution_type']);
		$employeenumber = getData($_POST['employee-number']);
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
		$sql = "UPDATE account SET institution_name = :institutionname, address = :address, contact_info = :contact_info, tax_id = :tax_id, currency = :currency, username = :username, password = :password, institution_desc = :institutiondesc, establishment_date = :establishmentdate, institution_type = :institutiontype, employee_number = :employeenumber WHERE institution_name = $institute";
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
			echo "successfully updated record";
			$_SESSION['session_status'] = $status_messages[4];
			header('Location: ../pos/index.php');
			header('Refresh: 0');
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}else{
		die();
	}

	function getData($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripcslashes($data);
		return $data;
	}
?>