<?php include '../functions/get_product.php';
      if (isset($_SESSION['user_role'])) {
        $user_role = $_SESSION['user_role'];
      }
 ?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
  <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>
      <nav aria-label='breadcrumb'>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'><a href='./customers.php?user_role=<?php echo $user_role; ?>' class='text-decoration-none text-muted'>Customers</a></li>
          <li class='breadcrumb-item'>Edit Customer</li>
        </ol>
      </nav>
      <a class='btn btn-outline-secondary' href='./customers.php?user_role=<?php echo $user_role; ?>'>Back</a>
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
  <div class="container">
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
            <tr class="p-3">
              <td><?php if(isset($cusrow['customer_id'])){ echo $cusrow['customer_id']; } ?></td>
              <td><?php if(isset($cusrow['customer_name'])){ echo $cusrow['customer_name']; } ?></td>
              <td><?php if(isset($cusrow['address'])){ echo $cusrow['address']; } ?></td>
              <td><?php if(isset($cusrow['contact'])){ echo $cusrow['contact']; } ?></td>
              <td><?php if(isset($cusrow['prod_name'])){ echo $cusrow['prod_name']; } ?></td>
              <td><?php if(isset($cusrow['membership_number'])){ echo $cusrow['membership_number']; } ?></td>
              <td><?php if(isset($cusrow['note'])){ echo $cusrow['note']; } ?></td>
              <td><?php if(isset($cusrow['expected_date'])){ echo $cusrow['expected_date']; } ?></td>
              <td>
                <?php if (isset($cusrow['customer_id'])): ?>
                <button type="button" data-bs-toggle="modal" data-bs-target="#update-customer" class="btn btn-outline-warning text-capitalize m-2">update</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#delete-customer" class="btn btn-outline-danger text-capitalize m-2">delete</button>
              <?php endif ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</main>

<!-- update customer -->
<div class='modal fade' id='update-customer'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title text-capitalize'>update customer</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/processcustomer.php' method='post'>
          <input type="hidden" name="customer_id" value="<?php if(isset($_GET['customer_id'])){ echo $_GET['customer_id']; } ?>">
          <div class="form-group mb-2">
            <label for='customer-name'>Full Name</label>
            <input class='form-control' name='upcustomer_name' type='text' placeholder='Enter full name' id='customer-name' value="<?php if (isset($cusrow['customer_name'])){ echo $cusrow['customer_name']; } ?>">
          </div>
          <div class="form-group mb-2">
            <label for='address'>Address</label>
            <input class='form-control' name='upaddress' type='text' placeholder='Enter address'id='address' value="<?php if (isset($cusrow['address'])){ echo $cusrow['address']; } ?>">
          </div>
          <div class="form-group mb-2">
            <label for='contact_person'>Contact</label>
            <input class='form-control' name='upcontact' type='tel' placeholder='Enter contact' id='contact_person' value="<?php if (isset($cusrow['contact'])){ echo $cusrow['contact']; } ?>">
          </div>
          <div class="form-group mb-2">
            <label for='product-name'>Product Name</label>
            <textarea class='form-control' name='upproduct_name' type='text' id='product-name'><?php if (isset($cusrow['prod_name'])){ echo $cusrow['prod_name']; } ?></textarea>
          </div>
          <div class="form-group mb-2">
            <label for='total'>Total</label>
            <input class='form-control' name='uptotal' type='text' placeholder='Enter total' id='total' value="<?php if (isset($cusrow['membership_number'])){ echo $cusrow['membership_number']; } ?>">
          </div>
          <div class="form-group mb-2">
            <label for='notes'>Note</label>
            <textarea class='form-control' name='upnote' type='text' placeholder='Enter a note' id='notes'><?php if (isset($cusrow['note'])){ echo $cusrow['note']; } ?></textarea>
          </div>
          <div class="form-group mb-2">
            <label for='expected-date'>Expected Date</label>
            <input class='form-control' name='upexpected_date' type='date' id='expected-date' value="<?php if (isset($cusrow['expected_date'])){ echo $cusrow['expected_date']; } ?>">
          </div>
          <div class="form-group p-3 d-flex justify-content-center">
            <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
            <button class='btn btn-outline-secondary text-capitalize' name='update_customer' type='submit'>update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete product -->
<div class="modal fade" id="delete-customer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Remove Customer</h3>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-center fs-5">Are you sure you want to remove customer</p>
        <a class="btn btn-outline-danger m-3 d-flex justify-content-center text-capitalize" href="../functions/process.php?user_role=<?php echo $user_role; ?>&customer_id=<?php echo $cusrow['customer_id']; ?>">delete customer</a>
      </div>
    </div>
  </div>
</div>
