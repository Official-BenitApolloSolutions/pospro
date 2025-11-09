<?php include '../functions/get_product.php';
      include '../functions/processorder.php';
      $user_role = "";
      if (isset($_SESSION['user_role'])) {
        $user_role = $_SESSION['user_role'];
      }
 ?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
          <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
            <h1 class='h2'>
              <nav aria-label='breadcrumb'>
                <ol class='breadcrumb'>
                  <li class='breadcrumb-item'><a href='./products.php?user_role=<?php echo $user_role; ?>' class='text-decoration-none text-muted'>Product</a></li>
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
          <form name="addsales" action="../api/services/sales_order.php" method="post">
            <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>">
            <div class='row'>
              <div class='col-8'>
                <select name="product" class='form-control form-control-lg' required>
                  <?php while ($row=$prodres->fetch_assoc()) {
                   ?>
                  <option class="w-100" value="<?php echo $row['product_id']; ?>"><?php echo $row['product_code'] . " - " . $row['gen_name'] . " - " . $row['product_name'] . " | EXPIRES AT: " . $row['expiry_date']; ?></option>
                <?php } ?>
                  <option selected disabled>Select a Product</option>
                </select>
              </div>
              <div class='col-4 d-inline-flex'>
                <input name="qty" class='form-control form-control-lg w-25' type='number' min="1" autocomplete="off" placeholder="Qty" value="1" required />
                <button type="submit" name="submit" class='btn btn-outline-secondary w-50 ms-3 mt-2'>Add</button>
                <!-- <div class='row'>
                  <div class='col'>
                    <input name="qty" class='form-control form-control-lg w-75' type='number' value='1' min="1" autocomplete="off" placeholder="Qty" required />
                  </div>
                  <div class='col'>
                    <button type="submit" name="submit" class='btn btn-outline-secondary w-100 ms-auto mt-2'>Add</button>
                  </div>
                </div> -->
              </div>
            </div>
          </form>
          <form method="post" action="../functions/cancel_order.php">
            <div class='mt-5 table-responsive small'>
              <table class='table table-striped table-sm' id='dash-activity'>
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
                  <?php for ($i=0; $row = $orders->fetch() ; $i++) { 
                      $_SESSION['id'] = $row['transaction_id'];
                   ?>
                  <tr>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['product']; ?></td>
                    <td><?php echo $row['gen_name']; ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td class='border-primary'><span class='text-muted'><?php echo $row['amount']; ?></span></td>
                    <td class='border-primary'><span class='text-muted'><?php echo $row['profit']; ?></span></td>
                    <td><button type="submit" class="btn btn-warning" name="cancel">cancel</button></td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                    <th class='border-primary'>Total Amount</th>
                    <th class='border-primary'>Total Profit</th>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th colspan='6'>Total</th>
                    <th class='border-primary'>
                      <?php
                        for ($i=0; $totalam = $resam->fetch(); $i++) { 
                          $totalamount = $totalam['totalamount'];
                          if ($totalamount) {
                           echo $totalamount; 
                          }else{
                            echo "0.00";
                          }
                        }
                      ?>
                    </th>
                    <th class='border-primary'><?php
                      for ($i=0; $totalprof = $respro->fetch(); $i++) { 
                        $totalprofit = $totalprof['totalprofit'];
                        if ($totalprofit) {
                         echo $totalprofit;
                        }else{
                          echo "0.00";
                        }
                      }
                     ?>
                     </th>
                    <td>
                      &nbsp;
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <input type="hidden" name="date_ordered" value="<?php echo date("m-d-Y") ?>">
            <div class='mt-4 d-flex'>
              <button type="button" class='btn btn-success w-75 h-50 mx-auto text-uppercase m-3' data-bs-toggle="modal" data-bs-target="#confirm-order">save</button>
            </div>
          </form>
</main>
<div class="modal fade" id="confirm-order">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title mx-auto text-uppercase">cash</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="../functions/preview.php" method="post">
          <input type="hidden" name="payment_type" value="<?php echo $_GET['id']; ?>">
          <input type="hidden" name="date_ordered" value="<?php echo date('Y-m-d'); ?>">
          <input type="hidden" name="totalamount" value="<?php echo $totalamount; ?>">
          <input type="hidden" name="totalprofit" value="<?php echo $totalprofit; ?>">
          <div class="form-group mb-3">
            <input name="customer" type="text" class="form-control text-capitalize" placeholder="enter customer name" list="customer">
            <datalist id="customer">
              <?php while ($row=$cusres->fetch_assoc()) {
              ?>
              <option value="<?php echo $row['customer_name']; ?>"><?php echo $row['customer_name']; ?></option>
            <?php } ?>
            </datalist>
          </div>
          <div class="form-group">
            <input type="number" name="cash" class="form-control text-capitalize" placeholder="cash" min="1" required>
          </div>
          <div class="form-group mb-2 mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success text-uppercase" name="save">save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>