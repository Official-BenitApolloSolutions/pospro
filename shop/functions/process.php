<?php
	session_start();
	require_once '../settings/config.php';
	$user_role = "";
	$invoice = "";
	$id = "";
	// updates
	
	// termination
	if (isset($_POST['delete'])) {
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		if (isset($_SESSION['invoice'])) {
			$invoice = $_SESSION['invoice'];
		}
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}
		$uri = "../view/products.php?user_role=$user_role&id=cash&invoice=$invoice";
		$path = urlencode($uri);
		$route = urldecode($path);
		$sql = "DELETE FROM products WHERE product_id = :userid";
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

	if (isset($_POST['delete_supplier'])) {
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}
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