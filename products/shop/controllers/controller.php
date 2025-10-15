<?php
	$login = 'Location: /products/shop/auth/index.php';

	if (!isset($_SESSION['user'])) {
			header($login);
	}
	if (isset($_SESSION['company_name'])) {
		$company = $_SESSION['company_name'];
	}
	else{
		$company = "Your company name";
		// header($dashboard);
	}

	

?>