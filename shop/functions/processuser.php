<?php
	session_start();
	require '../settings/config.php';
	if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role']; 
    }

    if (isset($_SESSION['user_id'])) {
      $usrid = $_SESSION['user_id']; 
    }

    // add user
	if (isset($_POST['submit_user'])) {
		$fullname = getData($_POST['fullname']);
		$address = getData($_POST['address']);
		$contact = getData($_POST['contact']);
		$position = getData($_POST['position']);
		$username = getData($_POST['username']);
		$password = getData($_POST['password']);
		$note = getData($_POST['note']);
		$assigned_date = getData($_POST['assigned_date']);
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Successfully added user","Problems were encounted"];
		if (empty($fullname)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($address)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($contact)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($position)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($username)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($password)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($note)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($assigned_date)) {
			array_push($error_status, $status_messages[0]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode => $value) {
				echo $error_mode;
			}
		}
		$uri = "../view/user_management.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$sql = "INSERT INTO user_account (fullname, address, contact_info, position, username, password, note, assigned_date) VALUES (:fullname, :address, :contact, :position, :username, password(:password), :note, :assigned_date)";
		$stmt = $dbc->prepare($sql);
		$stmt->bindParam(':fullname',$fullname);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':contact',$contact);
		$stmt->bindParam(':position',$position);
		$stmt->bindParam(':username',$username);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':note',$note);
		$stmt->bindParam(':assigned_date',$assigned_date);
		try {
			$stmt->execute();
			echo "successfully added user";
			$_SESSION['session_status'] = $status_messages[1];
			header("Location: $route");
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$tbh = null;
	}

	// update user
	if (isset($_POST['updatedata'])) {
		$userid = getData($_POST['userid']);
		$upfullname = getData($_POST['upfullname']);
		$upaddress = getData($_POST['upaddress']);
		$upcontact_info = getData($_POST['upcontact']);
		$upposition = getData($_POST['upposition']);
		$upusername = getData($_POST['upusername']);
		$uppassword = getData($_POST['uppassword']);
		$upnote = getData($_POST['upnote']);
		$upassigned_date = getData($_POST['upassigned_date']);
		$error_status = array();
		$status_messages = ["Fields cannot be left empty","Address cannot be left empty","Contact information cannot be left empty","position cannot be left empty","Successfully added record","Problems were encounted"];
		if (empty($fullname)) {
			array_push($error_status, $status_messages[1]);
		}
		if (empty($address)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($contact_info)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($position)) {
			array_push($error_status, $status_messages[2]);
		}
		if (empty($username)) {
			array_push($error_status, $status_messages[3]);
		}
		if (empty($password)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($note)) {
			array_push($error_status, $status_messages[0]);
		}
		if (empty($assigned_date)) {
			array_push($error_status, $status_messages[0]);
		}
		if (!empty($error_status)) {
			foreach ($error_status as $error_mode) {
				$_SESSION['error_status'] = $error_mode;
			}
		}
		$sql = "UPDATE user_account SET fullname = :upfullname, address = :upaddress, contact_info = :upcontact_info, position = :upposition, username = :upusername, password = password(:uppassword), note = :upnote, assigned_date = :upassigned_date WHERE user_id = '$userid'";
		$utmt = $dbc->prepare($sql);
		$utmt->bindParam(':upfullname',$upfullname);
		$utmt->bindParam(':upaddress',$upaddress);
		$utmt->bindParam(':upcontact_info',$upcontact_info);
		$utmt->bindParam(':upposition',$upposition);
		$utmt->bindParam(':upusername',$upusername);
		$utmt->bindParam(':uppassword',$uppassword);
		$utmt->bindParam(':upnote',$upnote);
		$utmt->bindParam(':upassigned_date',$upassigned_date);
		try {
			$utmt->execute();
			if ($utmt->affected_rows < 1) {
				echo "successfully updated record";
				$_SESSION['session_status'] = $status_messages[4];
				$_SESSION['user_id'] = $userid;
				$uri = "../view/editusers_view.php?user_role=$user_role&userid=$usrid";
				$path = urlencode($uri);
				$route = urldecode($path);
				header("Location: $route");
			}
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