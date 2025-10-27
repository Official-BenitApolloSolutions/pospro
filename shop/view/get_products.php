<?php
    include '../functions/get_product.php';
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
      <h1 class='h2'>Products - <?php echo $timer . " " . $hero ?></h1>
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
          echo "<h3>$today Inventory </h3>";
        ?>
        <div class='row'>
        <div class='col'>
          <div class='bg-body-tertiary rounded p-3'>
            <small class='text-end'>Products added: <?php echo $rownum["totalRows"]; ?>, $0</small><br/>
            <div class='d-flex'>
              <button class='btn btn-bd-primary mt-2 mx-auto' data-bs-toggle='modal' data-bs-target='#addproduct'>Add Product</button>
            </div>
          </div>
        </div>
        <div class='col'>
          <div class='bg-body-tertiary p-3 rounded'>
            <small>Products sold: 0 units</small>
            <div class='d-flex'>
              <a class='btn btn-bd-primary mt-2 mx-auto' href='/products/shop/view/sales.php'>Add Sales</a>
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
              <a class='btn btn-bd-primary mt-2 mx-auto' href='supplier.php'>Add Supplier</a>
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
              ?>
              <tr>
                <td><?php 
                       echo "pos" . $row["product_id"];
                    ?></td>
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
                <td><button class="btn btn-warning">update</button></td>
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
    </div>
</main>
<div class='modal fade' id='addproduct'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Add Product</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form action='../functions/processproduct.php' method='post'>
          <div class='form-group mb-2'>
            <label for='product_brand'>Brand Name</label>
            <input class='form-control' name='product-brand' type='text' placeholder='Enter product brand'id='product_brand' required>
          </div>
          <div class='form-group mb-2'>
            <label for='product_name'>Product Name</label>
            <input class='form-control' name='product-name' type='text' placeholder='Enter product name'id='product_name' required>
          </div>
          <div class='form-group mb-2'>
            <label for='product_desc'>Product Description</label>
            <input class='form-control' name='product-description' type='text' placeholder='Enter product category / description' id='product_desc' required>
          </div>
          <div class='form-group mb-2'>
            <label for='date_of_arrival'>Date of Arrival</label>
            <input class='form-control' name='arrival-date' type='date' id='date_of_arrival' required>
          </div>
          <div class='form-group mb-2'>
            <label for='expiry_date'>Expiry Date</label>
            <input class='form-control' name='expiry-date' type='date' id='expiry_date' required>
          </div>
          <div class='form-group mb-2'>
            <label for='selling_price'>Selling Price</label>
            <input class='form-control' name='selling-price' type='number' placeholder='0.00' id='selling_price' min="1">
          </div>
          <div class='form-group mb-2'>
            <label for='original_price'>Original Price</label>
            <input class='form-control' name='original-price' type='number' placeholder='0.00' id='original_price' min="1" onchange="productProfit(event)">
          </div>
          <div class='form-group mb-2'>
            <label for='profit'>Profit</label>
            <input class='form-control' name='product-profit' type='number' id='profit' placeholder="0.00" readonly>
          </div>
          <div class='form-group mb-2'>
            <label for='supplier'>Supplier</label>
            <select class='form-control' name='supplier' required>
              <option selected disabled>select supplier</option>
              <?php 
                while($row = $suplres->fetch_assoc()){
              ?>
              <option value='<?php echo $row['supplier_name']; ?>'><?php echo $row['supplier_name']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class='form-group mb-2'>
            <label for='product_quantity'>Quantity</label>
            <input class='form-control' name='product-quantity' type='number' id='product_quantity' placeholder="1 item" min="0" required>
          </div>
      </div>
      <div class='modal-footer'>
        <button class='btn btn-outline-danger' type='button' data-bs-dismiss='modal'>Cancel</button>
        <button class='btn btn-outline-secondary' name='submit' type='submit'>Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function productProfit(e){
    e.preventDefault();

    let originalprice = document.querySelector('#original_price').value;
    let sellingprice = document.querySelector('#selling_price').value;
    let profit = sellingprice - originalprice;
    document.querySelector('#profit').value = profit;
  } 
</script>