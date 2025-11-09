<?php
    include '../functions/get_product.php';
    include '../functions/processorder.php';
    $user_role = "";
    $date = "";
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
    if (isset($_SESSION['date_ordered'])) {
      $date = $_SESSION['date_ordered'];
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
        <a class='btn btn-outline-secondary text-capitalize' href='sales.php?user_role=<?php echo $user_role; ?>&id=cash&invoice=<?php echo $invoice; ?>'>back to sales</a>
      </h1>
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
    <div class="container">
      <h3 class="text-center text-capitalize">sales receipt</h3>
      <p class="text-capitalize text-center">city, town.</p>
      <p>
        OR No: <?php echo $invoice; ?><br>
        Date: <?php echo $date; ?>
      </p>
      <div class="table">
      <table class="table table-bordered">
        <thead>
          <th class="text-capitalize">product code</th>
          <th class="text-capitalize">product name</th>
          <th class="text-capitalize">quantity</th>
          <th class="text-capitalize">price</th>
          <th class="text-capitalize">discount</th>
          <th class="text-capitalize">amount</th>
        </thead>
        <tbody>
          <?php for ($i=0; $row = $orders->fetch(); $i++) { ?>
          <tr>
            <td><?php echo $row['product_code'] ?></td>
            <td><?php echo $row['product'] ?></td>
            <td><?php echo $row['qty'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['discount'] ?></td>
            <td><?php echo $row['amount'] ?></td>
          </tr>
        <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-end text-capitalize" colspan="5">total</th>
            <th colspan="5">
              <?php
                $totalamount_ = "0.00";
                for ($i=0; $row = $resam->fetch(); $i++) { 
                  $_SESSION['totalamount'] = $row['totalamount'];
                }
                if (isset($_SESSION['totalamount'])) {
                  $totalamount_ = $_SESSION['totalamount'];
                  echo $totalamount_;
                }
              ?>
            </th>
          </tr>
          <tr>
            <th class="text-end text-capitalize" colspan="5">cash tendered</th>
            <th colspan="5">
              <?php
                $cash = "0.00";
                for ($i=0; $row = $llc->fetch(); $i++) { 
                  $_SESSION['cash_tendered'] = $row['amount'];
                }
                if (isset($_SESSION['cash_tendered'])) {
                  $cash = $_SESSION['cash_tendered'];
                  echo $cash;
                }
              ?>
            </th>
          </tr>
          <tr>
            <th class="fs-3 text-end text-capitalize" colspan="5">change</th>
            <th colspan="5">
              <?php
                $balance = $cash - $totalamount_;
                if ($balance !== null) {
                  echo $balance;
                }else{
                  $balance = "0.00";
                  echo $balance;
                }
              ?>
            </th>
          </tr>
        </tfoot>
      </table>
      <button class="btn btn-outline-success text-capitalize float-end me-5 mb-3 mt-3">print</button>
    </div>
    </div>
</main>