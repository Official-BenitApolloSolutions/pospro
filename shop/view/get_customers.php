<?php
	include '../functions/get_product.php';
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
            <form action="../functions/process.php" method="post">
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
                        $_SESSION['id'] = $row['customer_id'];
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
                      <td><div><button type="submit" class="btn btn-outline-warning text-capitalize" name="edit_customer">edit</button></div>&nbsp;
                        <div><button type="submit" class="btn btn-outline-danger text-capitalize" name="delete_customer">delete</button></div></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </form>
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
          <input class='form-control' name='total' type='number' min="0" autocomplete="off" placeholder='Total' id='total'>
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
</div>