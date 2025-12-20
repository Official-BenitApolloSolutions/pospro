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
          <li class='breadcrumb-item'><a href='./supplier.php?user_role=<?php echo $user_role ?>' class='text-decoration-none text-muted'>Suppliers</a></li>
          <li class='breadcrumb-item'>Edit Supplier</li>
        </ol>
      </nav>
      <a class='btn btn-outline-secondary' href='./supplier.php?user_role=<?php echo $user_role ?>'>Back</a>
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
  <?php echo $session_mes; ?>
  <div class='mt-5 table-responsive small'>
    <table class='table table-striped table-sm' id='dash-activity'>
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
        <tr class="p-5">
            <td><?php if(isset($suprow['supplier_id'])){ echo $suprow['supplier_id']; } ?></td>
            <td><?php if(isset($suprow['supplier_name'])){ echo $suprow['supplier_name']; } ?></td>
            <td><?php if(isset($suprow['supplier_contact'])){ echo $suprow['supplier_contact']; } ?></td>
            <td><?php if(isset($suprow['supplier_address'])){ echo $suprow['supplier_address']; } ?></td>
            <td><?php if(isset($suprow['contact_person'])){ echo $suprow['contact_person']; } ?></td>
            <td><?php if(isset($suprow['note'])){ echo $suprow['note']; } ?></td>
            <td>
              <?php if (isset($suprow["supplier_id"])): ?>
                <button data-bs-target="#update-supplier" class="btn btn-outline-warning text-capitalize m-2" data-bs-toggle="modal">Update</button>
                <button data-bs-target="#delete-supplier" data-bs-toggle="modal" class="btn btn-outline-danger text-capitalize m-2">Delete</button>
              <?php endif ?>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
</main>

<!-- update supplier -->
<div class='modal fade' id='update-supplier'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Update Supplier</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/process_supplier.php' method='post'>
          <input type="hidden" name="supplier_id" value="<?php if(isset($_GET["supplier_id"])){ echo $_GET['supplier_id']; } ?>">
          <div class='form-group mb-2'>
            <label for='supplier_name'>Supplier Name</label>
            <input class='form-control' name='upsupplier_name' type='text' placeholder='Enter supplier name'id='supplier-name' value="<?php if(isset($suprow['supplier_name'])){echo $suprow['supplier_name'];} ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='address'>Address</label>
            <input class='form-control' name='upsupplier_address' type='text' placeholder='Enter address'id='address' value="<?php if(isset($suprow['supplier_address'])){echo $suprow['supplier_address'];} ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='contact_person'>Contact Person</label>
            <input class='form-control' name='upcontact_description' type='text' placeholder='Enter contact person' id='contact_person' value="<?php if(isset($suprow['contact_person'])){echo $suprow['contact_person'];} ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='contact-number'>Contact No.</label>
            <input class='form-control' name='upcontact_number' type='tel' placeholder='Enter contact number' id='contact-number' value="<?php if(isset($suprow['contact_person'])){echo $suprow['contact_person'];} ?>" required>
          </div>
          <label for='notes'>Note</label>
          <textarea class='form-control' name='upsupplier_note' placeholder='Enter a note' id='notes' required><?php if(isset($suprow['note'])){echo $suprow['note'];} ?></textarea>
      </div>
      <div class='modal-footer p-3 d-flex justify-content-center'>
        <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
        <button class='btn btn-outline-secondary' name='update_supplier' type='submit'>Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete supplier -->
<div class="modal fade" id="delete-supplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Remove Supplier</h3>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-center fs-5">Are you sure you want to remove supplier</p>
        <a class="btn btn-outline-danger m-3 d-flex justify-content-center" href="../functions/process.php?user_role=<?php echo $user_role; ?>&supplier_id=<?php echo $suprow['supplier_id']; ?>">remove supplier</a>
      </div>
    </div>
  </div>
</div>