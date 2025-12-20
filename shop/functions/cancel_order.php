<?php
	session_start();
	require_once '../settings/config.php';
	$user_role = "";
	$invoice = "";
	// $id = "";
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		if (isset($_SESSION['invoice'])) {
			$invoice = $_SESSION['invoice'];
		}
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$uri = "../view/sales.php?user_role=$user_role&id=cash&invoice=$invoice";
			$path = urlencode($uri);
			$route = urldecode($path);
			$sql = "DELETE FROM sales_order WHERE transaction_id = :userid";
			try{
				$stmt = $dbc->prepare($sql);
				$stmt->bindValue(":userid", $id, PDO::PARAM_INT);
				$stmt->execute();
				header("Location: $route");
				// echo $id;
			}catch(PDOException $e){
				echo "Exception: " . "<br>" . $sql . $e->getMessage();
				header("Location: $route");
			}
		}else{
			echo "nothing to show" . "<a href='$uri'>Go back</a>";
		}

?>