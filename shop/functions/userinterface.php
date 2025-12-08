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
		$fixednav = "<header class='navbar sticky-top bg-dark flex-md-nowrap p-0 shadow' data-bs-theme='dark' id='heading'>
					      <a class='navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white' href='#'>company</a>
					      <ul class='navbar-nav flex-row d-md-none'>
					        <li class='nav-item text-nowrap'>
					          <button class='nav-link px-3 text-white' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSearch' aria-controls='navbarSearch' aria-expanded='false' aria-label='Toggle search'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#search'></use></svg>
					          </button>
					        </li>
					        <li class='nav-item text-nowrap'>
					          <button class='nav-link px-3 text-white' type='button' data-bs-toggle='offcanvas' data-bs-target='#sidebarMenu' aria-controls='sidebarMenu' aria-expanded='false' aria-label='Toggle navigation'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#list'></use></svg>
					          </button>
					        </li>
					      </ul>
					      <div id='navbarSearch' class='navbar-search w-100 collapse'>
					        <input class='form-control w-100 rounded-0 border-0' type='text' placeholder='Search' aria-label='Search'>
					      </div>
		</header><div class='container-fluid'>
      <div class='row'>";
		print($fixednav);
	}

	function loadSidebar(){
		// $user_role = $_SESSION['user_role'];
		$homePage = '/products/shop/pos/index.php';
		$ordersPage = '/products/shop/view/orders.php';
		$productsPage = '/products/shop/view/products.php';
		$customersPage = '/products/shop/view/customers.php';
		$reportPage = '/products/shop/view/reports.php';
		if (isset($_SESSION['user_role'])) {
			$user_role = $_SESSION['user_role'];
		}
		switch ($user_role) {
			case 'administrator':
				$sidebar = "<div class='sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary'>
					  <div class='offcanvas-md offcanvas-end bg-body-tertiary' tabindex='-1' id='sidebarMenu' aria-labelledby='sidebarMenuLabel'>
					    <div class='offcanvas-header'>
					      <h5 class='offcanvas-title' id='sidebarMenuLabel'>Company name</h5>
					      <button type='button' class='btn-close' data-bs-dismiss='offcanvas' data-bs-target='#sidebarMenu' aria-label='Close'></button>
					    </div>
					    <div class='offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto'>
					      <ul class='nav flex-column'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2 active' aria-current='page' href='$homePage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#house-fill'></use></svg>
					            Dashboard
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$ordersPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark'></use></svg>
					            Orders
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$productsPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#cart'></use></svg>
					            Products
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$customersPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#people'></use></svg>
					            Customers
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$reportPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#graph-up'></use></svg>
					            Reports
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='/products/shop/pos/integrations.php?user_role=$user_role' target='_blank'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#puzzle'></use></svg>
					            Integrations
					          </a>
					        </li>
					      </ul>
					      <h6 class='sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase'>
					        <span>Saved reports</span>
					        <a class='link-secondary' href='#' aria-label='Add a new report'>
					          <svg class='bi' aria-hidden='true'><use xlink:href='#plus-circle'></use></svg>
					        </a>
					      </h6>
					      <ul class='nav flex-column mb-auto'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Current month
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Last quarter
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Social engagement
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Year-end sale
					          </a>
					        </li>
					      </ul>
					      <hr class='my-3'>
					      <ul class='nav flex-column mb-auto'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='/products/shop/view/settings.php?user_role=$user_role'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#gear-wide-connected'></use></svg>
					            Settings
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='/products/shop/pos/logout.php'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#door-closed'></use></svg>
					            Sign out
					          </a>
					        </li>
					      </ul>
					    </div>
					  </div>
					</div>";
				break;
			case 'sales agent':
				$sidebar = "<div class='sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary'>
					  <div class='offcanvas-md offcanvas-end bg-body-tertiary' tabindex='-1' id='sidebarMenu' aria-labelledby='sidebarMenuLabel'>
					    <div class='offcanvas-header'>
					      <h5 class='offcanvas-title' id='sidebarMenuLabel'>Company name</h5>
					      <button type='button' class='btn-close' data-bs-dismiss='offcanvas' data-bs-target='#sidebarMenu' aria-label='Close'></button>
					    </div>
					    <div class='offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto'>
					      <ul class='nav flex-column'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2 active' aria-current='page' href='$homePage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#house-fill'></use></svg>
					            Dashboard
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$ordersPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark'></use></svg>
					            Orders
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$customersPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#people'></use></svg>
					            Customers
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='$productsPage?user_role=". urlencode($user_role) ."'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#cart'></use></svg>
					            Products
					          </a>
					        </li>
					      </ul>
					      <h6 class='sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase'>
					        <span>Saved reports</span>
					        <a class='link-secondary' href='#' aria-label='Add a new report'>
					          <svg class='bi' aria-hidden='true'><use xlink:href='#plus-circle'></use></svg>
					        </a>
					      </h6>
					      <ul class='nav flex-column mb-auto'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Current month
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Last quarter
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Social engagement
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#file-earmark-text'></use></svg>
					            Year-end sale
					          </a>
					        </li>
					      </ul>
					      <hr class='my-3'>
					      <ul class='nav flex-column mb-auto'>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='#'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#gear-wide-connected'></use></svg>
					            Settings
					          </a>
					        </li>
					        <li class='nav-item'>
					          <a class='nav-link d-flex align-items-center gap-2' href='/products/shop/pos/logout.php'>
					            <svg class='bi' aria-hidden='true'><use xlink:href='#door-closed'></use></svg>
					            Sign out
					          </a>
					        </li>
					      </ul>
					    </div>
					  </div>
					</div>";
				break;
			
			default:
				$sidebar = 'nothing to show';
				break;
		}
		print($sidebar);
	}

	function loadHome(){
		$home = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>Dashboard</h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary' id='share-report-btn'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary' id='export-btn'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
          <div class='container'></div>
          <canvas class='my-4 w-100' id='myChart' width='900' height='380'></canvas>
          <h2 contenteditable>Section title</h2>
          <p id='status-messages'></p>
          <div class='table-responsive small'>
            <table class='table table-striped table-sm' id='dash-activity'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Header1</th>
                  <th scope='col'>Header2</th>
                  <th scope='col'>Header3</th>
                  <th scope='col'>Header4</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
			</main>";
		print($home);
	}

	function loadOrders(){
		processOrders();
	}

	function loadProducts(){
		processProducts();
	}

	function loadSettings(){
		processSettings();
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
			$footer = "</div>
    </div><script src='../assets/dist/js/bootstrap.bundle.min.js' class='astro-vvvwv3sm'></script>
	    <script src='https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js' integrity='sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp' crossorigin='anonymous' class='astro-vvvwv3sm'></script><script src='/products/shop/pos/dashboard.js' class='astro-vvvwv3sm'></script>
	    <script>
	    	$(document).ready( function () {
    				$('#dash-activity').DataTable();
				} );
	    </script>
	    <script src='../assets/js/custom.js'></script>
	    </body>
				</html>";
			print($footer); 
	}

	function loadPreview(){
		processPreview();
	}
?>