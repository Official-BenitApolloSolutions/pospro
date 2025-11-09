<?php
	session_start();
	require_once "../settings/config.php";
	$user_role = "";
	$invoice = "";
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
	if (isset($_SESSION['invoice'])) {
		$invoice = $_SESSION['invoice'];
	}
	$uri = "../view/sales_preview.php?user_role=$user_role&id=cash&invoice=$invoice";
	$path = urlencode($uri);
	$route = urldecode($path);
	if (isset($_POST['save'])) {
		$customer = $_POST['customer'];
		$paymenttype = $_POST['payment_type'];
		$date = $_POST['date_ordered'];
		$amount = $_POST['cash'];
		$totalamount = $_POST['totalamount'];
		$balance = floatval($amount) - floatval($totalamount);
		$profit = $_POST['totalprofit'];
		$sql = "INSERT INTO sales (invoice_number, cashier, date_ordered, type, amount, profit, name, balance) VALUES (:invoice, :cashier, :date_ordered, :type, :amount, :profit, :name, :balance)";
			try{
				$res = $dbc->prepare($sql);
				$res->bindValue(":invoice", $invoice, PDO::PARAM_STR);
				$res->bindValue(":cashier", $user_role, PDO::PARAM_STR);
				$res->bindValue(":date_ordered", $date, PDO::PARAM_STR);
				$res->bindValue(":type", $paymenttype, PDO::PARAM_STR);
				$res->bindValue(":amount", $amount, PDO::PARAM_STR);
				$res->bindValue(":profit", $profit, PDO::PARAM_STR);
				// $res->bindValue(":due_date", $cashier, PDO::PARAM_STR);
				$res->bindValue(":name", $customer, PDO::PARAM_STR);
				$res->bindValue(":balance", $balance, PDO::PARAM_STR);
				$res->execute();
				$_SESSION['date_ordered'] = $date;
				header("Location: $route");
			}catch(PDOException $e){
				echo "error: " . $e->getMessage();
				// header("Location: $route");
			}
	}
	
?>