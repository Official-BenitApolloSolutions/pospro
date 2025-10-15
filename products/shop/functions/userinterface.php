<?php
	include 'transactions.php';
	include 'backgroundSettings.php';

	function toggleMode(){
		optimizeBackground();
	}

	function loadHeader(){
		$header = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
			  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en' data-bs-theme='auto'><head>
		    <meta charset='utf-8'>
		    <meta name='viewport' content='width=device-width, initial-scale=1'>
		    <meta name='description' content='>
		    <meta name='author' content='Mark Otto, Jacob Thornton, and Bootstrap contributors'>
		    <meta name='generator' content='Astro v5.9.2'>
		    <title>Dashboard Template · <?php echo 'company' ?> v5.3</title>
		    <link rel='canonical' href='https://benitapollosolutions/products/'>
		    <script src='/products/shop/assets/js/color-modes.js'></script>
		    <script src='/products/shop/assets/js/jquery-3.7.1.min.js'></script>
		    <link href='/products/shop/assets/dist/css/bootstrap.min.css' rel='stylesheet'>
		    <meta name='theme-color' content='#712cf9'>
		    <link href='/products/shop/pos/dashboard.css' rel='stylesheet'>
		    <style>
		      .bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;user-select:none}
		      @media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}
		      .b-example-divider{width:100%;height:3rem;background-color:#0000001a;border:solid rgba(0,0,0,.15);border-width:1px 0;box-shadow:inset 0 .5em 1.5em #0000001a,inset 0 .125em .5em #00000026}
		      .b-example-vr{flex-shrink:0;width:1.5rem;height:100vh}
		      .bi{vertical-align:-.125em;fill:currentColor}
		      .nav-scroller{position:relative;z-index:2;height:2.75rem;overflow-y:hidden}
		      .nav-scroller .nav{display:flex;flex-wrap:nowrap;padding-bottom:1rem;margin-top:-1px;overflow-x:auto;text-align:center;white-space:nowrap;-webkit-overflow-scrolling:touch}
		      .btn-bd-primary{--bd-violet-bg: #712cf9;--bd-violet-rgb: 112.520718, 44.062154, 249.437846;--bs-btn-font-weight: 600;--bs-btn-color: var(--bs-white);--bs-btn-bg: var(--bd-violet-bg);--bs-btn-border-color: var(--bd-violet-bg);--bs-btn-hover-color: var(--bs-white);--bs-btn-hover-bg: #6528e0;--bs-btn-hover-border-color: #6528e0;--bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);--bs-btn-active-color: var(--bs-btn-hover-color);--bs-btn-active-bg: #5a23c8;--bs-btn-active-border-color: #5a23c8}
		      .bd-mode-toggle{z-index:1500}
		      .bd-mode-toggle .bi{width:1em;height:1em}
		      .bd-mode-toggle .dropdown-menu .active .bi{display:block!important}
		    </style>
		    <link rel='stylesheet' href='/products/shop/assets/DataTables/datatables.css' />
				<script src='/products/shop/assets/DataTables/datatables.js'></script>
				<script src='https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.min.js'></script>
				<script src='https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js'></script>
		  </head><body>";
  		print($header);
	}

	function loadFixedNav(){
		$fixednav = "<header class='navbar sticky-top bg-dark flex-md-nowrap p-0 shadow' data-bs-theme='dark'>
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
          <div class='container'><p>bug</p></div>
          <canvas class='my-4 w-100' id='myChart' width='900' height='380'></canvas>
          <h2 contenteditable>Section title</h2>
          <div class='table-responsive small'>
            <table class='table table-striped table-sm' id='dash-activity'>
              <thead>
                <tr>
                  <th scope='col'>#</th>
                  <th scope='col'>Header</th>
                  <th scope='col'>Header</th>
                  <th scope='col'>Header</th>
                  <th scope='col'>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>random</td>
                  <td>data</td>
                  <td>placeholder</td>
                  <td>text</td>
                </tr>
                <tr>
                  <td>1,002</td>
                  <td>placeholder</td>
                  <td>irrelevant</td>
                  <td>visual</td>
                  <td>layout</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>data</td>
                  <td>rich</td>
                  <td>dashboard</td>
                  <td>tabular</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>information</td>
                  <td>placeholder</td>
                  <td>illustrative</td>
                  <td>data</td>
                </tr>
                <tr>
                  <td>1,004</td>
                  <td>text</td>
                  <td>random</td>
                  <td>layout</td>
                  <td>dashboard</td>
                </tr>
                <tr>
                  <td>1,005</td>
                  <td>dashboard</td>
                  <td>irrelevant</td>
                  <td>text</td>
                  <td>placeholder</td>
                </tr>
                <tr>
                  <td>1,006</td>
                  <td>dashboard</td>
                  <td>illustrative</td>
                  <td>rich</td>
                  <td>data</td>
                </tr>
                <tr>
                  <td>1,007</td>
                  <td>placeholder</td>
                  <td>tabular</td>
                  <td>information</td>
                  <td>irrelevant</td>
                </tr>
                <tr>
                  <td>1,008</td>
                  <td>random</td>
                  <td>data</td>
                  <td>placeholder</td>
                  <td>text</td>
                </tr>
                <tr>
                  <td>1,009</td>
                  <td>placeholder</td>
                  <td>irrelevant</td>
                  <td>visual</td>
                  <td>layout</td>
                </tr>
                <tr>
                  <td>1,010</td>
                  <td>data</td>
                  <td>rich</td>
                  <td>dashboard</td>
                  <td>tabular</td>
                </tr>
                <tr>
                  <td>1,011</td>
                  <td>information</td>
                  <td>placeholder</td>
                  <td>illustrative</td>
                  <td>data</td>
                </tr>
                <tr>
                  <td>1,012</td>
                  <td>text</td>
                  <td>placeholder</td>
                  <td>layout</td>
                  <td>dashboard</td>
                </tr>
                <tr>
                  <td>1,013</td>
                  <td>dashboard</td>
                  <td>irrelevant</td>
                  <td>text</td>
                  <td>visual</td>
                </tr>
                <tr>
                  <td>1,014</td>
                  <td>dashboard</td>
                  <td>illustrative</td>
                  <td>rich</td>
                  <td>data</td>
                </tr>
                <tr>
                  <td>1,015</td>
                  <td>random</td>
                  <td>tabular</td>
                  <td>information</td>
                  <td>text</td>
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
?>