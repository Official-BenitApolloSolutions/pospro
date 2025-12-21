<?php
	session_start();
	require_once '../settings/config.php';
	$error_status = array();
	$status_messages = ["Fields cannot be left empty","product brand cannot be left empty","supplier cannot be left empty","product quantity cannot be left empty","Successfully added record","Problems were encounted"];
	if (isset($_SESSION['user_role'])) {
		$user_role = $_SESSION['user_role'];
	}
	if (isset($_SESSION['invoice'])) {
		$invoice = $_SESSION['invoice'];
	}

	$uri = "../view/products.php?user_role=$user_role";
	$path = urlencode($uri);
	$route = urldecode($path);

	// Termination
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM products WHERE product_id = :userid";
		try{
			$stmt = $dbc->prepare($sql);
			$stmt->bindValue(":userid", $id, PDO::PARAM_INT);
			$stmt->execute();
			header("Location: $route");
		}catch(PDOException $e){
			echo "Exception: " . "<br>" . $sql . $e->getMessage();
			header("Location: $route");
		}
	}

	// delete supplier
	if (isset($_GET['supplier_id'])) {
		$id = $_GET['supplier_id'];
		$uri = "../view/supplier.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$sql = "DELETE FROM suppliers WHERE supplier_id = :userid";
		try{
			$stmt = $dbc->prepare($sql);
			$stmt->bindValue(":userid", $id, PDO::PARAM_STR);
			$stmt->execute();
			header("Location: $route");
		}catch(PDOException $e){
			echo "Exception: " . "<br>" . $sql . $e->getMessage();
			header("Location: $route");
		}
	}

	// Delete customer 
	if (isset($_GET['customer_id'])) {
		$customer_id = $_GET['customer_id'];
		$uri = "../view/customers.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$cusql = "DELETE FROM customer WHERE customer_id = :custeid";
		try{
			$custmt = $dbc->prepare($cusql);
			$custmt->bindValue(":custeid", $customer_id, PDO::PARAM_INT);
			$custmt->execute();
			header("Location: $route");
		}catch(PDOException $e){
			echo "Exception: " . "<br>" . $cusql . $e->getMessage();
			header("Location: $route");
		}
	}

	// Delete user
	if (isset($_GET['userid'])) {
		$userid = $_GET['userid'];
		$uri = "../view/user_management.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$userl = "DELETE FROM user_account WHERE user_id = :userid";
		try{
			$usertmt = $dbc->prepare($userl);
			$usertmt->bindValue(":userid", $userid, PDO::PARAM_INT);
			$usertmt->execute();
			header("Location: $route");
		}catch(PDOException $e){
			echo "Exception: " . "<br>" . $userl . $e->getMessage();
			header("Location: $route");
		}
	}
?>