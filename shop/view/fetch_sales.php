<?php include '../functions/get_product.php'; ?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
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
          <form name="addsales" action="../api/services/sales_order.php" method="post">
            <div class='row'>
              <div class='col-8'>
                <select name="product" class='form-control form-control-lg' required>
                  <?php while ($row=$prodres->fetch_assoc()) {
                   ?>
                  <option class="w-100" value="<?php echo $row['product_id'] ?>"><?php echo $row['product_code'] . " - " . $row['gen_name'] . " - " . $row['product_name'] . " | EXPIRES AT: " . $row['expiry_date']; ?></option>
                <?php } ?>
                  <option selected disabled>Select a Product</option>
                </select>
              </div>
              <div class='col-4 d-inline-flex'>
                <input name="qty" class='form-control form-control-lg w-25' type='number' value='1' min="1" autocomplete="off" placeholder="Qty" required />
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
          <form>
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
                  <?php while ($row=$orders->fetch_assoc()) {
                   ?>
                  <tr>
                    <td><?php echo $row['transaction_id'] ?></td>
                    <td><?php echo $row['product'] ?></td>
                    <td><?php echo $row['gen_name'] ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td class='border-primary'><span class='text-muted'>0.00</span></td>
                    <td class='border-primary'><span class='text-muted'>0.00</span></td>
                    <td>&nbsp;</td>
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
                    <th class='border-primary'>0.00</th>
                    <th class='border-primary'>0.00</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <input type="hidden" name="date_ordered" value="<?php echo date("m-d-Y") ?>">
            <div class='mt-4 d-flex'>
              <button class='btn btn-success w-75 h-50 mx-auto'>SAVE</button>
            </div>
          </form>
      </main>