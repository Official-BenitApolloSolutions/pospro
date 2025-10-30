<?php
	require_once '../../settings/config.php';

	if (isset($_POST['submit'])) {
		// $productname = $_POST['product'];
		// include '../../functions/get_product.php';
		$productqty = $_POST['qty'];
		$productid = $_POST['product'];
		$invoice = $_POST['invoice'];
		$date = date("Y-m-d H:i:s a");
			try{

				// for ($i=0; $rowpro = $respro->fetch(); $i++) { 
				// 	$totalprofit_ = $rowpro['sum(profit)'];
				// 	$_SESSION['profit_'] = (int)$totalprofit_;
				// }

				$sql = "SELECT * FROM products WHERE product_id = :productid";
				$stmt = $dbc->prepare($sql);
		    	$stmt->bindValue(":productid", $productid, PDO::PARAM_INT);
		    	$stmt->execute();
		    	foreach($stmt->fetchAll() as $row){
		    		$productname = $row['product_name'];
		    		$productprice = $row['price'];
		    		$amount = floatval($productprice) * floatval($productqty);
		    		$productgen = $row['gen_name'];
		    		$productcode = $row['product_code'];
		    		$profit_ = $row['profit'] ;
		    	}
		    	$profit = $profit_ *  $productqty;

		    	// query
		    	$query = "INSERT INTO sales_order (invoice,qty, amount, profit, product_code, gen_name, product, price, order_date) VALUES (:invoice, :productqty, :amount, :profit, :productcode,:productgen, :productname, :productprice, :date)";
		    	$stmt2 = $dbc->prepare($query);
		    	$stmt2->bindValue(':invoice', $invoice, PDO::PARAM_STR);
		    	$stmt2->bindValue(':productqty', $productqty, PDO::PARAM_INT);
		    	$stmt2->bindValue(':amount', $amount, PDO::PARAM_INT);
		    	$stmt2->bindValue(':profit', $profit, PDO::PARAM_INT);
		    	$stmt2->bindValue(':productcode', $productcode, PDO::PARAM_STR);
		    	$stmt2->bindValue(':productgen', $productgen, PDO::PARAM_STR);
		    	$stmt2->bindValue(':productname', $productname, PDO::PARAM_STR);
		    	$stmt2->bindValue(':productprice', $productprice, PDO::PARAM_INT);
		    	$stmt2->bindValue(':date', $date, PDO::PARAM_STR);
		    	$stmt2->execute();

		    	// redirect
		    	echo "successfully inserted";
				header("Location: ../../view/sales.php?id=cash&invoice=$invoice");
			}catch(PDOException $e){
				die("error: " . $e->getMessage());
			}
	}else{
		die("something went wrong");
	}
?>