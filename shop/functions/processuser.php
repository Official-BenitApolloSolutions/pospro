<?php
	session_start();
	require '../settings/config.php';
    $user_role = "";
	if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role']; 
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
	}else{
		die("ENCOUNTERED Problems");
	}

	// update user
	if (isset($_POST['submit_user'])) {
		$id = getData($_POST['id']);
		$fullname = getData($_POST['fullname']);
		$address = getData($_POST['address']);
		$contact_info = getData($_POST['contact']);
		$position = getData($_POST['position']);
		$username = getData($_POST['username']);
		$password = getData($_POST['password']);
		$note = getData($_POST['note']);
		$assigned_date = getData($_POST['assigned_date']);
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
		}else{
			$uri = "../view/user_management.php?user_role=$user_role";
			$path = urlencode($uri);
			$route = urldecode($path);
			$sql = "UPDATE user_account SET fullname = :fullname, address = :address, contact_info = :contact_info, position = :position, username = :username, password = password(:password), note = :note, assigned_date = :assigned_date WHERE user_id = $id";
				$stmt = $dbc->prepare($sql);
				$stmt->bindParam(':fullname',$fullname);
				$stmt->bindParam(':address',$address);
				$stmt->bindParam(':contact_info',$contact_info);
				$stmt->bindParam(':position',$position);
				$stmt->bindParam(':username',$username);
				$stmt->bindParam(':password',$password);
				$stmt->bindParam(':note',$note);
				$stmt->bindParam(':assigned_date',$assigned_date);
				try {
					$stmt->execute();
					if ($stmt->affected_rows < 1) {
						echo "successfully updated record";
						$_SESSION['session_status'] = $status_messages[4];
						header("Location: $route");
						// header('Refresh: 0');
					}
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