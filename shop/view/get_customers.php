<?php
    include '../functions/get_product.php';
    $user_role = "";
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
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
  <?php echo $session_mes ?>
  <div class='container'>
    <div class='row'>
      <div class='col-6'>
        <p>Total Number of Customers: 
        	<?php
        		if ($cusrownum['totalRows']) {
        			$totalnum = $cusrownum['totalRows'];
        			echo "<span class='text-success'>$totalnum</span>";
        		}else{
        			echo "<span class='text-success'>0</span>";
        		}
        	 ?></p>
      </div>
      <div class='col-6'>
        <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-customer'>Add Customer</button>
      </div>
    </div>
    <!-- <form action="../functions/process.php" method="post"> -->
      <div class='table-responsive small'>
        <table class='table table-striped table-sm' id='dash-activity'>
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
            <?php 
                while($row=$cusres->fetch_assoc()){ 
            ?>
            <tr>
              <td><?php echo $row['customer_id']; ?></td>
              <td><?php echo $row['customer_name']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td><?php echo $row['contact']; ?></td>
              <td><?php echo $row['prod_name']; ?></td>
              <td><?php echo $row['membership_number']; ?></td>
              <td><?php echo $row['note']; ?></td>
              <td><?php echo $row['expected_date']; ?></td>
              <td><a class="btn btn-outline-warning text-capitalize" href="editcustomer_view.php?user_role=<?php echo $user_role; ?>&customer_id=<?php echo $row['customer_id']; ?>">Edit</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <!-- </form> -->
  </div>
</main>

<!-- add customer -->
<div class='modal fade' id='add-customer'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Add Customer</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/processcustomer.php' method='post'>
          <div class="form-group mb-2">
            <label for='customer-name'>Full Name</label>
            <input class='form-control' name='customer_name' type='text' placeholder='Enter full name' id='customer-name'>
          </div>
          <div class="form-group mb-2">
            <label for='address'>Address</label>
            <input class='form-control' name='address' type='text' placeholder='Enter address'id='address'>
          </div>
          <div class="form-group mb-2">
            <label for='contact_person'>Contact</label>
            <input class='form-control' name='contact' type='tel' placeholder='Enter contact' id='contact_person'>
          </div>
          <div class="form-group mb-2">
            <label for='product-name'>Product Name</label>
            <textarea class='form-control' name='product_name' type='text' id='product-name'></textarea>
          </div>
          <div class="form-group mb-2">
            <label for='total'>Total</label>
            <input class='form-control' name='total' type='text' placeholder='Enter total' id='total'>
          </div>
          <div class="form-group mb-2">
            <label for='notes'>Note</label>
            <textarea class='form-control' name='note' type='text' placeholder='Enter a note' id='notes'></textarea>
          </div>
          <div class="form-group mb-2">
            <label for='expected-date'>Expected Date</label>
            <input class='form-control' name='expected_date' type='date' id='expected-date'>
          </div>
          <div class="form-group p-3 d-flex justify-content-center">
            <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
            <button class='btn btn-outline-secondary' name='submit' type='submit'>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>