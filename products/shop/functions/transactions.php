<?php  
	function processOrders(){
		$myorders = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>Orders</h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
			</main>";
		echo $myorders;
	}

	function processProducts(){
    include 'get_product.php';
    date_default_timezone_set("UTC");
    $hero = date_default_timezone_get();
    $today = date('l'); 
    $timer = date('Y-m-d H:i:s a');
    
    if (isset($_SESSION['session_status'])) {
      $session_status = $_SESSION['session_status'];
      $session_mes = "<div class='alert alert-dismissible fade show alert-success' role='alert'>$session_status<button data-bs-dismiss='alert' type='button' aria-label='close' class='btn-close'></button></div>";
    }else{
      $session_mes = "";
    }
    $getProducts = getProducts();
      $products_ = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>Products - $timer, $hero</h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary' id='export-btn'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
          <div class='container'>
            <h3>$today Inventory</h3>
            $session_mes
            <div class='row'>
              <div class='col'>
                <div class='bg-body-tertiary rounded p-3'>
                  <small class='text-end'>Products added: $0</small><br/>
                  <div class='d-flex'>
                    <button class='btn btn-bd-primary mt-2 mx-auto' data-bs-toggle='modal' data-bs-target='#addproduct'>Add Product</button>
                  </div>
                </div>
              </div>
              <div class='col'>
                <div class='bg-body-tertiary p-3 rounded'>
                  <small>Products sold: 0 units</small>
                  <div class='d-flex'>
                    <a class='btn btn-bd-primary mt-2 mx-auto' href='/products/shop/view/sales.php'>Add Sales</a>
                  </div>
                </div>
              </div>
              <div class='col'>
                <div class='bg-body-tertiary p-3 rounded'>
                  <small>Suppliers: 0</small>
                  <div class='d-flex'>
                    <a class='btn btn-bd-primary mt-2 mx-auto' href='supplier.php'>Add Supplier</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            $getProducts
          </div>
        </main>
        <div class='modal fade' id='addproduct'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h3 class='modal-title'>Add Product</h3>
                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
              </div>
              <div class='modal-body'>
                <form action='../functions/processproduct.php' method='post'>
                  <div class='form-group mb-2'>
                    <label for='product_brand'>Brand Name</label>
                    <input class='form-control' name='product-brand' type='text' placeholder='Enter product brand'id='product_brand'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='product_name'>Product Name</label>
                    <input class='form-control' name='product-name' type='text' placeholder='Enter product name'id='product_name'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='product_desc'>Product Description</label>
                    <input class='form-control' name='product-description' type='text' placeholder='Enter product category / description' id='product_desc'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='date_of_arrival'>Date of Arrival</label>
                    <input class='form-control' name='arrival-date' type='date' id='date_of_arrival'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='expiry_date'>Expiry Date</label>
                    <input class='form-control' name='expiry-date' type='date' id='expiry_date'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='selling_price'>Selling Price</label>
                    <input class='form-control' name='selling-price' type='number' placeholder='Enter product price' id='selling_price' value='0.00'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='original_price'>Original Price</label>
                    <input class='form-control' name='original-price' type='number' placeholder='Enter product price' id='original_price' value='0.00'>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='profit'>Profit</label>
                    <input class='form-control' name='product-profit' type='number' id='profit' value='1' readonly>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='supplier'>Supplier</label>
                    <select class='form-control' name='supplier'>
                      <option value=''>&nbsp;</option>
                    </select>
                  </div>
                  <div class='form-group mb-2'>
                    <label for='product_quantity'>Quantity</label>
                    <input class='form-control' name='product-quantity' type='number' id='product_quantity' value='0'>
                  </div>
              </div>
              <div class='modal-footer'>
                <button class='btn btn-outline-danger' type='button' data-bs-dismiss='modal'>Cancel</button>
                <button class='btn btn-outline-secondary' name='submit' type='submit'>Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>";
        print($products_);
	}

  function processSales(){
    $sales = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>
              <nav aria-label='breadcrumb'>
                <ol class='breadcrumb'>
                  <li class='breadcrumb-item'><a href='./products.php' class='text-decoration-none text-muted'>Product</a></li>
                  <li class='breadcrumb-item'>Sales</li>
                </ol>
              </nav>
              <a class='btn btn-outline-secondary' href='products.php'>Back</a>
            </h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary' id='sales-analysis'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
          <form>
            <div class='row'>
              <div class='col-6'>
                <select class='form-control form-control-lg'>
                  <option>item</option>
                  <option selected disabled>Select a Product</option>
                </select>
              </div>
              <div class='col-6'>
                <div class='row'>
                  <div class='col-3'>
                    <input class='form-control form-control-lg w-100' type='number' value='1'/>
                  </div>
                  <div class='col-9'>
                    <button class='btn btn-outline-secondary w-50 mt-2'>Add</button>
                  </div>
                </div>
              </div>
            </div>
            <div class='mt-5 table-responsive small'>
              <table class='table table-striped table-sm' id='sales-activity'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Product Name</th>
                    <th scope='col'>Generic Name</th>
                    <th scope='col'>Category / Description</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Qty</th>
                    <th scope='col'>Amount</th>
                    <th scope='col'>Profit</th>
                    <th scope='col'>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1,001</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class='border-primary'><span class='text-muted'>Total Amount</span></td>
                    <td class='border-primary'><span class='text-muted'>Total Profit</span></td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan='6'>Total</th>
                    <th class='border-primary'>0.00</th>
                    <th class='border-primary'>0.00</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class='mt-4 d-flex'>
              <button class='btn btn-success w-75 h-50 mx-auto'>SAVE</button>
            </div>
          </form>
      </main>";
      print($sales);
  }

  function processSuppliers(){
    if (isset($_SESSION['session_status'])) {
      $session_status = $_SESSION['session_status'];
      $session_mes = "<div class='alert alert-dismissible fade show alert-success' role='alert'>$session_status<button data-bs-dismiss='alert' type='button' aria-label='close' class='btn-close'></button></div>";
    }else{
      $session_mes = "";
    }
    // $productid = $row['gen_name'];
    // $productname = $row['product_name'];
    // while($totalrows > 0){
      print("<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>
              <nav aria-label='breadcrumb'>
                <ol class='breadcrumb'>
                  <li class='breadcrumb-item'><a href='./products.php' class='text-decoration-none text-muted'>Product</a></li>
                  <li class='breadcrumb-item'>Suppliers</li>
                </ol>
              </nav>
              <a class='btn btn-outline-secondary' href='products.php'>Back</a>
            </h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary' id='sales-analysis'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
            $session_mes
            <div class='row'>
              <div class='col-6'>
                <p>Total Number of Suppliers: <span class='text-success'>0</span></p>
              </div>
              <div class='col-6'>
                <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-supplier'>Add Supplier</button>
              </div>
            </div>
            <div class='mt-5 table-responsive small'>
              <table class='table table-striped table-sm' id='sales-activity'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Supplier</th>
                    <th scope='col'>Contact Person</th>
                    <th scope='col'>Address</th>
                    <th scope='col'>Contact No.</th>
                    <th scope='col'>Note</th>
                    <th scope='col'>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>$prodcutid</td>
                      <td>$productname</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </div>
      </main>
      <div class='modal fade' id='add-supplier'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h3 class='modal-title'>Add Supplier</h3>
              <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
            </div>
            <div class='modal-body'>
              <form action='../functions/process_supplier.php' method='post'>
                <div class='form-group mb-2'>
                  <label for='supplier_name'>Supplier Name</label>
                  <input class='form-control' name='supplier-name' type='text' placeholder='Enter supplier name'id='supplier_name'>
                </div>
                <div class='form-group mb-2'>
                  <label for='address'>Address</label>
                  <input class='form-control' name='customer-address' type='text' placeholder='Enter address'id='address'>
                </div>
                <div class='form-group mb-2'>
                  <label for='contact_person'>Contact Person</label>
                  <input class='form-control' name='contact-description' type='text' placeholder='Enter contact person' id='contact_person'>
                </div>
                <div class='form-group mb-2'>
                  <label for='contact_number'>Contact No.</label>
                  <input class='form-control' name='contact-number' type='tel' placeholder='Enter contact number' id='contact_number'>
                </div>
                <label for='notes'>Note</label>
                <textarea class='form-control' name='product-price' type='text' placeholder='Enter a note' id='notes'></textarea>
            </div>
            <div class='modal-footer'>
              <button class='btn btn-outline-danger' type='button' data-bs-dismiss='modal'>Cancel</button>
              <button class='btn btn-outline-secondary' name='submit' type='submit'>Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>");
    // }
      print($supplier);
  }

	function processCustomers(){
    if (isset($_SESSION['session_status'])) {
      $session_status = $_SESSION['session_status'];
      $session_mes = "<div class='alert alert-dismissible fade show alert-success' role='alert'>$session_status<button data-bs-dismiss='alert' type='button' aria-label='close' class='btn-close'></button></div>";
    }else{
      $session_mes = "";
    }
		$customers_ = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>Customers</h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
          $session_mes
          <div class='container'>
            <div class='row'>
              <div class='col-6'>
                <p>Total Number of Customers: <span class='text-success'>0</span></p>
              </div>
              <div class='col-6'>
                <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-customer'>Add Customer</button>
              </div>
            </div>
            <div class='table-responsive small'>
              <table class='table table-striped table-sm' id='report-activity'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Fullname</th>
                    <th scope='col'>Address</th>
                    <th scope='col'>Contact Number</th>
                    <th scope='col'>Product Name</th>
                    <th scope='col'>Total</th>
                    <th scope='col'>Note</th>
                    <th scope='col'>Due Date</th>
                    <th scope='col'>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
			</main>
      <div class='modal fade' id='add-customer'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h3 class='modal-title'>Add Customer</h3>
              <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
            </div>
            <div class='modal-body'>
              <form action='../functions/processcustomer.php' method='post'>
                <label for='customer_name'>Full Name</label>
                <input class='form-control' name='customer-name' type='text' placeholder='Enter full name' id='customer_name'>
                <label for='address'>Address</label>
                <input class='form-control' name='address' type='text' placeholder='Enter address'id='address'>
                <label for='contact_person'>Contact</label>
                <input class='form-control' name='contact' type='tel' placeholder='Enter contact' id='contact_person'>
                <label for='product_name'>Product Name</label>
                <textarea class='form-control' name='product-name' type='text' id='product_name'></textarea>
                <label for='total'>Total</label>
                <input class='form-control' name='total' type='text' placeholder='Total' id='total'>
                <label for='notes'>Note</label>
                <textarea class='form-control' name='note' type='text' placeholder='Enter a note' id='notes'></textarea>
                <label for='expected_date'>Expected Date</label>
                <input class='form-control' name='expected-date' type='date' id='expected_date'>
            </div>
            <div class='modal-footer'>
              <button class='btn btn-outline-danger' type='button' data-bs-dismiss='modal'>Cancel</button>
              <button class='btn btn-outline-secondary' name='submit' type='submit'>Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>";
			print($customers_);
	}

	function processReports(){
		$reports_ = "<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>Reports</h1>
            <div class='btn-toolbar mb-2 mb-md-0'>
              <div class='btn-group me-2'>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
                <button type='button' class='btn btn-sm btn-outline-secondary'>Export</button>
              </div>
              <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
                <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
                This week
              </button>
            </div>
          </div>
          <div class='container'>
            <div class='row'>
              <div class='col-4'>
                <label>From</label>
                <input type='date' class='form-control'>
              </div>
              <div class='col-4'>
                <label>To</label>
                <input type='date' class='form-control' >
              </div>
              <div class='col-4 mt-4'>
                <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-customer'>Search</button>
              </div>
            </div>
            <div class='mt-5'>
              <p class='fw-bold text-center'>Sales Report from 0 to 0</p>
            </div>
            <div class='mt-3 table-responsive small'>
              <table class='table table-striped table-sm' id='report-activity'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Transaction Date</th>
                    <th scope='col'>Customer Name</th>
                    <th scope='col'>Invoice Number</th>
                    <th scope='col'>Amount</th>
                    <th scope='col'>Profit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>0.00</td>
                    <td>0.00</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan='4'>Total</th>
                    <td>0.00</td>
                    <td>0.00</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
			</main>";
			print($reports_);
	}

  ?>