<?php
  session_start();
  require '../controllers/controller.php';
  include 'userinterface.php';

  function loadBackground(){
    toggleMode();
  }

  function showHeader(){
    loadHeader();
  }

  function showFixedNav(){
    loadFixedNav();
  }

	function showSidebar()
	{
		loadSidebar();
	}

  function showHome(){
    loadHome();
  }

  function showOrders(){
    loadOrders();
  }

  function showProducts(){
    loadProducts();
  }

  function showSales(){
    loadSales();
  }

  function showSuppliers(){
    loadSuppliers();
  }

  function showCustomers(){
    loadCustomers();
  }

  function showReports(){
    loadReports();
  }

  function showFooter(){
    loadFooter();
  }

  // routes
  function OrdersPage(){
    RouteOrders();
  }
?>