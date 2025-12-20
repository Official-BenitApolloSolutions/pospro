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

	// Delete supplier 
	if (isset($_POST['delete_customer'])) {
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}
		$uri = "../view/customers.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$sql = "DELETE FROM customer WHERE customer_id = :userid";
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

	// Delete user
	if (isset($_POST['delete_user'])) {
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}
		$uri = "../view/user_management.php?user_role=$user_role";
		$path = urlencode($uri);
		$route = urldecode($path);
		$sql = "DELETE FROM user_account WHERE user_id = :userid";
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
?>