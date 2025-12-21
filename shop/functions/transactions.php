<?php  
	function processOrders(){
		include '../view/vieworders.php';
	}

	function processProducts(){
    include '../view/get_products.php';
	}

  function processSales(){
    include '../view/fetch_sales.php';
  }

  function processSuppliers(){
    include '../view/get_suppliers.php';
  }

	function processCustomers(){
    include '../view/get_customers.php';
	}

	function processReports(){
		include '../view/get_reports.php';
	}

  function processPreview(){
    include '../view/fetch_preview.php';
  }

  // management
  function processSettings(){
    include '../view/view_settings.php';
  }

  function processEditSuppliers(){
    include '../view/editsupplier.php';
  }

  function processEditCustomers(){
    include '../view/editcustomer.php';
  }

  function processEditProducts(){
    include '../view/editproduct.php';
  }
  
  function processUsers(){
    include '../view/users.php';
  }

  function processEditUsers(){
    include '../view/editusers.php';
  }

  ?>