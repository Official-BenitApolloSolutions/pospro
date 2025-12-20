<?php
    include '../functions/get_product.php';
    $user_role = "";
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
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
  <div class='container'>
      <?php
          if (isset($_SESSION['error_status'])) {
            echo "<div class='alert alert-danger alert-dismissible'>". $_SESSION['error_status'] . "<button class='btn-close' data-bs-dismiss='alert'></button></div>";
          }
          echo "<h3>$today Inventory </h3>";
        ?>
        <div class='row'>
        <div class='col'>
          <div class='bg-body-tertiary rounded p-3'>
            <small class='text-end'>Products added: <?php echo $rownum; ?>, $0</small><br/>
            <div class='d-flex'>
              <!-- <button class='btn btn-bd-primary mt-2 mx-auto' data-bs-toggle='modal' data-bs-target='#add-product'>Add Product</button> -->
            </div>
          </div>
        </div>
        <div class='col'>
          <div class='bg-body-tertiary p-3 rounded'>
            <small>Products sold: 0 units</small>
            <div class="d-flex">
              <!-- <a class="btn btn-bd-primary mt-2 mx-auto" href="/products/shop/view/sales.php?user_role=<?php //echo $user_role; ?>&id=cash&invoice=<?php //echo $invoice; ?>">Add Sales</a> -->
            </div>
          </div>
        </div>
        <div class='col'>
          <div class='bg-body-tertiary p-3 rounded'>
            <small>Suppliers: <?php if($suplrownum['totalRows']){
              echo $suplrownum['totalRows'];
            }else{
              echo "0";
            } ?></small>
            <div class='d-flex'>
              <!-- <a class='btn btn-bd-primary mt-2 mx-auto' href='supplier.php?user_role=<?php //echo $user_role; ?>&id=cash'>Add Supplier</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <div class='mt-5 table-responsive small'>
          <table class='table table-striped table-sm' id='dash-activity'>
            <thead>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>invoice_number</th>
                <th scope='col'>cashier</th>
                <th scope='col'>date_ordered</th>
                <th scope='col'>type</th>
                <th scope='col'>amount</th>
                <th scope='col'>profit</th>
                <th scope='col'>due_date</th>
                <th scope='col'>name</th>
                <th scope='col'>balance</th>
                <th scope='col'>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                 for($i=0; $row = $sales->fetch(); $i++) {
              ?>
              <tr>
                <td>
                  <?php 
                      $orderid = $row["transaction_id"];
                     echo "pos" . $orderid;
                  ?>
                </td>
                <td><?php echo $row["invoice_number"]; ?></td>
                <td><?php echo $row["cashier"]; ?></td>
                <td><?php echo $row["date_ordered"]; ?></td>
                <td><?php echo $row["type"]; ?></td>
                <td><?php echo $row["amount"]; ?></td>
                <td><?php echo $row["profit"]; ?></td>
                <td><?php echo $row["due_date"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["balance"]; ?></td>
                <td>&nbsp;</td>
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
                <td>0.00</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>0.00</td>
                <td>&nbsp;</td>             
              </tr>
            </tfoot>
          </table>
        </div>  
    </div>
</main>