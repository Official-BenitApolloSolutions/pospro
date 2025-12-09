<?php
	session_start();
	require '../settings/config.php';
	if (isset($_SESSION['Institution_name'])) {
		$institute = $_SESSION['Institution_name'];
	}

	if (isset($_POST['institution-name']) && isset($_POST['address']) && isset($_POST['contact_info']) && isset($_POST['tax_id']) && isset($_POST['currency']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['institution-description']) && isset($_POST['establishment-date']) && isset($_POST['institution_type']) && isset($_POST['employee-number'])) {
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
		$filename = $_FILES['logo']['tmp_name'];
		if (move_uploaded_file($filename, '../resources/comp_img/logo.jpg')) {
			$_SESSION['logo'] = $filename;
		}
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
		}else{
			$sql = "UPDATE account SET institution_name = :institutionname, address = :address, contact_info = :contact_info, tax_id = :tax_id, currency = :currency, username = :username, password = :password, institution_desc = :institutiondesc, established_date = :establishmentdate, institution_type = :institutiontype, number_of_employees = :employeenumber";
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
			}
		
	}
	else{
		die("ENCOUNTERED Problems");
	}

	function getData($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripcslashes($data);
		return $data;
	}
?>