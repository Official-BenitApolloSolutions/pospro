<?php
    include '../functions/get_product.php';
    include '../functions/account.php';
    $user_role = "";
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>Settings - <?php echo $timer . " " . $hero ?></h1>
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
      <?php
          if (isset($_SESSION['error_status'])) {
            echo "<div class='alert alert-danger alert-dismissible'>". $_SESSION['error_status'] . "<button class='btn-close' data-bs-dismiss='alert'></button></div>";
          }
          echo "<h3>Shop Management </h3>";
        ?>
        <div class='row mt-3'>
	        <div class='col'>
	          <div class='bg-body-tertiary rounded p-3'>
	            <h4 class='text-center fs-5 fw-bold'>Store Info</h4>
	            <div class='d-flex'>
                <?php
                  if ($rowsnum < 1) {
                    echo "<button class='btn btn-bd-primary m-3 mx-auto' data-bs-toggle='modal' data-bs-target='#add-to-account'>Edit</button>";
                  }else{
                    echo "<button class='btn btn-bd-primary m-3 mx-auto' data-bs-toggle='modal' data-bs-target='#update-account'>Update</button>";
                  }
                ?>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fs-5 fw-bold">Payment Options</h4>
	            <div class="d-flex">
	              <a class="btn btn-bd-primary m-3 mx-auto" data-bs-toggle="offcanvas" href="#payment-options">Edit</a>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fs-5 fw-bold">Reporting</h4>
	            <div class='d-flex'>
	              <a class='btn btn-bd-primary m-3 mx-auto' href='supplier.php?user_role=<?php echo $user_role; ?>&id=cash'>Edit</a>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fs-5 fw-bold">Sync and Backup</h4>
	            <div class='d-flex'>
	              <a class='btn btn-bd-primary m-3 mx-auto' href='supplier.php?user_role=<?php echo $user_role; ?>&id=cash'>Edit</a>
	            </div>
	          </div>
	        </div>
      	</div>
      	<div class='row mt-3'>
	        <div class='col'>
	          <div class='bg-body-tertiary rounded p-3'>
	            <h4 class='text-center fs-5 fw-bold'>Tax Settings</h4>
	            <div class='d-flex'>
	              <button class='btn btn-bd-primary m-3 mx-auto' data-bs-toggle='modal' data-bs-target='#add-product'>Edit</button>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fs-5 fw-bold">Inventory</h4>
	            <div class="d-flex">
	              <a class="btn btn-bd-primary m-3 mx-auto" href="/products/shop/view/inventory.php?user_role=<?php echo $user_role; ?>&id=cash&invoice=<?php echo $invoice; ?>">Edit</a>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fs-5 fw-bold">Receipt Settings</h4>
	            <div class='d-flex'>
	              <a class='btn btn-bd-primary m-3 mx-auto' href='supplier.php?user_role=<?php echo $user_role; ?>&id=cash'>Edit</a>
	            </div>
	          </div>
	        </div>
	        <div class='col'>
	          <div class='bg-body-tertiary p-3 rounded'>
	            <h4 class="text-center fw-bold fs-5">User Management</h4>
	            <div class='d-flex'>
	              <a class='btn btn-bd-primary m-3 mx-auto' href='user_management.php?user_role=<?php echo $user_role; ?>&id=cash'>Edit</a>
	            </div>
	          </div>
	        </div>
      	</div>
    </div>
    <!-- <div class="container">
      <form action="../functions/process.php" method="post">
        <div class='mt-5 table-responsive small'>
          <table class='table table-striped table-sm' id='dash-activity'>
            <thead>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Product Name</th>
                <th scope='col'>Generic Name</th>
                <th scope='col'>Category / Description</th>
                <th scope='col'>Supplier</th>
                <th scope='col'>Date Received</th>
                <th scope='col'>Expiry Date</th>
                <th scope='col'>Original Price</th>
                <th scope='col'>Selling Price</th>
                <th scope='col'>QTY</th>
                <th scope='col'>Qty Left</th>
                <th scope='col'>Total</th>
                <th scope='col'>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // include '../functions/get_product.php';
                // require_once '../settings/config.php';
                // $sqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM products";
                // $result = $dbc->query($sql);
                // $totalrows = $dbc->query($sqlcount);
                // $st = $dbc->query("SELECT found_rows() AS totalRows");
                // $rownum = $st->fetch();
                // // $result->execute();
                // $rows = $result->fetch();
                // $row = $result->fetch_assoc();
                // while($rows < $row["totalRows"]){
                  // foreach ($totalrows->fetchall() as $row) {
                  //   $productid = $rows["product_id"];
                  //   $productgen = $rows['gen_name'];
                  //   $productname = $rows["product_name"];
                      // $id = 0;
                 while($row = $prodres->fetch_assoc()) {
                     $_SESSION['id'] = $row["product_id"];
              ?>
              <tr>
                <td>
                  <?php 
                     echo "pos" . $row["product_id"];
                  ?>
                </td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["gen_name"]; ?></td>
                <td><?php echo $row["product_code"]; ?></td>
                <td><?php echo $row["supplier"]; ?></td>
                <td><?php echo $row["date_arrival"]; ?></td>
                <td><?php echo $row["expiry_date"]; ?></td>
                <td><?php echo $row["o_price"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["qty"]; ?></td>
                <td><?php echo $row["onhand_qty"]; ?></td>
                <td>&nbsp;</td>
                <td>
                  <div>
                    <button type="button" class="btn btn-warning" name="update" data-bs-target="#update-product" data-bs-toggle="modal">update</button>
                  </div>&nbsp;
                  <div>
                    <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>
                  </div>
                </td>
              </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>0.00</td>
                    <td>0</td>
                    <td>0</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>             
                  </tr>
                </tfoot>
          </table>
        </div>  
      </form>
    </div> -->
</main>
<!-- account information -->
<div class='modal fade' id='add-to-account'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Store Info</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/processemployee.php' method='post' enctype="multipart/form-data">
          <div class='form-group mb-2'>
            <label for='institution_name'>Institution Name</label>
            <input class='form-control' name='institution-name' type='text' placeholder='Enter institution name' id='institution_name' required>
          </div>
          <div class='form-group mb-2'>
            <label for='address'>Address</label>
            <input class='form-control' name='address' type='text' placeholder='Enter address' id='address' required>
          </div>
          <div class='form-group mb-2'>
            <label for='contact_info'>Contact Info</label>
            <input class='form-control' name='contact_info' type='tel' placeholder='Enter contact information' id='contact_info' required>
          </div>
          <div class='form-group mb-2'>
            <label for='logo'>Logo</label>
            <input class='form-control' name='logo' type='file' id='logo' accept='image/jpeg'>
          </div>
          <div class='form-group mb-2'>
            <label for='tax_id'>Tax Id</label>
            <input class='form-control' name='tax_id' type='text' id='tax_id' placeholder="Enter tax id" required>
          </div>
          <div class='form-group mb-2'>
            <label for='currency'>Currency</label>
            <input type="text" class="form-control" name="currency" id="currency" list="currencies" placeholder="Enter currency" required>
            <datalist id="currencies">
              <option value="GHS">Ghana Cedi</option>
              <option value="USD">US Dollar</option>
              <option value="EUR">Euro</option>
              <option value="GBP">British Pound</option>
              <option></option>
            </datalist>
          </div>
          <div class='form-group mb-2'>
            <label for='username'>Username</label>
            <input class='form-control' name='username' type='text' placeholder='Enter product name'id='username' required>
          </div>
          <div class='form-group mb-2'>
            <label for='password'>Password</label>
            <input class='form-control' name='password' type='password' placeholder='Enter password'id='password' required>
          </div>
          <div class='form-group mb-2'>
            <label for='institution_desc'>Institution Description</label>
            <textarea class="form-control" name="institution-description" placeholder="institution description" id="institution_desc" required></textarea>
          </div>
          <div class='form-group mb-2'>
            <label for='date_of_establishment'>Business Inception Date</label>
            <input class='form-control' name='establishment-date' type='date' id='date_of_establishment' required>
          </div>
          <div class='form-group mb-2'>
            <label for='institution-type'>Institution Type</label>
            <select class='form-control' name='institution_type' id="institution-type" required>
              <option selected disabled>select institution type</option>
              <option value="sole proprietor">Sole Proprietor</option>
              <option value="partnership">Partnership</option>
              <option value="public company">Public Company</option>
              <option value="private company">Private Company</option>
            </select>
          </div>
          <div class='form-group mb-2'>
            <label for='employee_number'>Number of employees</label>
            <input class='form-control' name='employee-number' type='number' id='employee_number' placeholder="total number of employees" min="0" required>
          </div>
          <div class="form-group m-3 d-flex justify-content-center">
            <button class='btn btn-outline-danger me-3' type='button' data-bs-dismiss='modal'>Cancel</button>
            <button class='btn btn-outline-secondary' name='submit_info' type='submit'>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- update account information -->
<div class='modal fade' id='update-account'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Update Product</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/updateaccount.php' method='post' enctype="multipart/form-data">
          <div class='form-group mb-2'>
            <label for='update_institution'>Institution Name</label>
            <input class='form-control' name='institution-name' type='text' placeholder='Enter institution name' id="update_institution" required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_address'>Address</label>
            <input class='form-control' name='address' type='text' placeholder='Enter address' id='update_address' required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_contact_info'>Contact Info</label>
            <input class='form-control' name='contact_info' type='tel' placeholder='Enter contact information' id='update_contact_info' required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_logo'>Logo</label>
            <input class='form-control' name='logo' type='file' id='update_logo' accept='image/jpeg'>
          </div>
          <div class='form-group mb-2'>
            <label for='update_tax_id'>Tax Id</label>
            <input class='form-control' name='tax_id' type='text' id='update_tax_id' placeholder="Enter tax id" required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_currency'>Currency</label>
            <input type="text" class="form-control" name="currency" id="update_currency" list="update_currency" placeholder="Enter currency" required>
            <datalist id="update_currency">
              <option value="GHS">Ghana Cedi</option>
              <option value="USD">US Dollar</option>
              <option value="EUR">Euro</option>
              <option value="GBP">British Pound</option>
              <option></option>
            </datalist>
          </div>
          <div class='form-group mb-2'>
            <label for='update_username'>Username</label>
            <input class='form-control' name='username' type='text' placeholder='Enter product name'id='update_username' required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_password'>Password</label>
            <input class='form-control' name='password' type='password' placeholder='Enter password'id='update_password' required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_institution_desc'>Institution Description</label>
            <textarea class="form-control" name="institution-description" placeholder="institution description" id="update_institution_desc" required></textarea>
          </div>
          <div class='form-group mb-2'>
            <label for='update_date_of_establishment'>Business Inception Date</label>
            <input class='form-control' name='establishment-date' type='date' id='update_date_of_establishment' required>
          </div>
          <div class='form-group mb-2'>
            <label for='update_typeinstitution'>Institution Type</label>
            <input class="form-control" type="text" placeholder="Enter type of institution" name="institution_type" required list="institution_typeupdate" id="update_typeinstitution">
            <datalist id="institution_typeupdate">
              <option value="sole proprietor">Sole Proprietor</option>
              <option value="partnership">Partnership</option>
              <option value="public company">Public Company</option>
              <option value="private company">Private Company</option>
            </datalist>
          </div>
          <div class='form-group mb-2'>
            <label for='updateemployee_number'>Number of employees</label>
            <input class='form-control' name='employee-number' type='number' id='updateemployee_number' placeholder="total number of employees" min="0" required>
          </div>
          <div class="form-group d-flex justify-content-center">
            <div class="m-3">
              <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
              <button class='btn btn-outline-secondary' type='submit'>Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- payment options -->
<div class="offcanvas offcanvas-end" id="payment-options">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title">Payment Options</h3>
    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <small style="font-variant: small-caps;">Transactions convenient to you</small>
    <form action="" method="post">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="add-mobile-money">
        <label class="form-check-label">Mobile Money</label>
      </div>
      <div class="form-group d-none m-3" id="mobile-money-setting">
        <label for="mobile-money">Merchant Number</label>
        <input type="chat" class="form-control" placeholder="Enter number" id="mobile-money" required>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="add-account-number">
        <label class="form-check-label">Bank Transfer</label>
      </div>
      <div class="form-group d-none m-3" id="account-number-setting">
        <label for="account-number">Account Number</label>
        <input type="chat" class="form-control" placeholder="Enter account details" id="account-number" required>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label">Card Payments</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label">Cash Payments</label>
      </div>
      <div class="form-btn mt-3 d-flex">
        <button name="payment-options" type="submit" class="btn btn-bd-primary mx-auto">Submit</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  const intstitutiontype = document.getElementById("institution-type");
  intstitutiontype.addEventListener('invalid', (event)=>{
    event.target.setCustomValidity('Please select institution type');
  });

  document.getElementById('add-mobile-money').addEventListener('change',function() {
    const momo = document.getElementById('mobile-money-setting');
    if (this.checked) {
      momo.classList.remove('d-none');
      momo.classList.add('d-block');
    }else{
      momo.classList.remove('d-block');
      momo.classList.add('d-none');
    }
  });

  document.getElementById('add-account-number').addEventListener('change',function() {
    const account = document.getElementById('account-number-setting');
    if (this.checked) {
      account.classList.remove('d-none');
      account.classList.add('d-block');
    }else{
      account.classList.remove('d-block');
      account.classList.add('d-none');
    }
  });
</script>