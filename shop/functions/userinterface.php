<?php
	include 'transactions.php';
	include 'backgroundSettings.php';
	include 'account.php';

	function toggleMode(){
		optimizeBackground();
	}

	function loadHeader(){
		include '../view/header.php';
	}

	function loadFixedNav(){
		include '../view/fixednav.php';
	}

	function loadSidebar(){
		include '../view/sidebar.php';
	}

	function loadHome(){
		include '../view/home.php';
	}

	function loadOrders(){
		processOrders();
	}

	function loadProducts(){
		processProducts();
	}

	function loadSales(){
		processSales();
	}

	function loadSuppliers(){
		processSuppliers();
	}

	function loadCustomers(){
		processCustomers();
	}

	function loadReports(){
		processReports();
	}

	function loadFooter(){
			include '../view/footer.php'; 
	}

	function loadPreview(){
		processPreview();
	}

	// management
	function loadSettings(){
		processSettings();
	}
	
	function loadUsers(){
		processUsers();
	}
?>