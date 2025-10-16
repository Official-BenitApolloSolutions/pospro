<?php include '../functions/get_product.php'; ?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
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
            <?php echo $session_mes; ?>
            <div class='row'>
              <div class='col-6'>
                <p>Total Number of Suppliers: <span class='text-success'><?php echo $suplrownum['totalRows']; ?></span></p>
              </div>
              <div class='col-6'>
                <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-supplier'>Add Supplier</button>
              </div>
            </div>
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
                  <?php while($row=$suplres->fetch_assoc()){ ?>
                  <tr>
                      <td><?php echo $row['supplier_id'] ?></td>
                      <td><?php echo $row['supplier_name'] ?></td>
                      <td><?php echo $row['supplier_contact'] ?></td>
                      <td><?php echo $row['supplier_address'] ?></td>
                      <td><?php echo $row['contact_person'] ?></td>
                      <td><?php echo $row['note'] ?></td>
                      <td>&nbsp;</td>
                  </tr>
                <?php } ?>
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
</div>