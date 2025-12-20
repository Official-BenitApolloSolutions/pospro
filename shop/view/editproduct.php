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
          <li class='breadcrumb-item'><a href='./products.php?user_role=<?php echo $user_role; ?>' class='text-decoration-none text-muted'>Product</a></li>
          <li class='breadcrumb-item'>Edit Product</li>
        </ol>
      </nav>
      <a class='btn btn-outline-secondary' href='./products.php?user_role=<?php echo $user_role; ?>'>Back</a>
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
              <tr class="p-5">
                <td>
                  <?php 
                    if (isset($uprow["product_id"])) {
                       $productid = $uprow["product_id"];
                       echo "pos" . $productid;
                    }
                  ?>
                </td>
                <td><?php if(isset($uprow["product_name"])){ echo $uprow["product_name"];} ?></td>
                <td><?php if(isset($uprow["gen_name"])){ echo $uprow["gen_name"]; } ?></td>
                <td><?php if(isset($uprow["product_code"])){ echo $uprow["product_code"];} ?></td>
                <td><?php if(isset($uprow["supplier"])){ echo $uprow["supplier"];} ?></td>
                <td><?php if(isset($uprow["date_arrival"])){ echo $uprow["date_arrival"];} ?></td>
                <td><?php if(isset($uprow["expiry_date"])){ echo $uprow["expiry_date"];} ?></td>
                <td><?php if(isset($uprow["o_price"])){ echo $uprow["o_price"];} ?></td>
                <td><?php if(isset($uprow["price"])){ echo $uprow["price"];} ?></td>
                <td><?php if(isset($uprow["qty"])){ echo $uprow["qty"];} ?></td>
                <td><?php if(isset($uprow["onhand_qty"])){ echo $uprow["onhand_qty"];} ?></td>
                <td>&nbsp;</td>
                <td>
                  <?php if (isset($uprow["product_id"])): ?>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#update-product" class="btn btn-outline-warning m-2">Update</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete-product" class="btn btn-outline-danger m-2">Delete</button>
                  <?php endif ?>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>0</td>
                <td>0</td>
                <td>0.00</td>
                <td>&nbsp;</td>             
              </tr>
            </tfoot>
          </table>
        </div> 
  </div>
</main>

<!-- update product -->
<div class='modal fade' id='update-product'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Update Product</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body'>
        <form name="editproductsform" action='../functions/updateproduct.php' method='post'>
          <input type="hidden" name="updateproduct_id" value="<?php if(isset($_GET['product_id'])){ echo $_GET['product_id']; } ?>">
          <div class='form-group mb-2'>
            <label for='product_brand'>Brand Name</label>
            <input class='form-control' name='updateproduct_brand' type='text' placeholder='Enter product brand' id='upproduct_brand' value="<?php if(isset($uprow["gen_name"])){ echo $uprow['gen_name']; } ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='product_name'>Product Name</label>
            <input class='form-control' name='updateproduct_name' type='text' placeholder='Enter product name' id='upproduct_name' value='<?php if(isset($uprow["product_name"])){ echo $uprow['product_name']; } ?>' required>
          </div>
          <div class='form-group mb-2'>
            <label for='product_desc'>Product Description</label>
            <input class='form-control' name='updateproduct_description' type='text' placeholder='Enter product category / description' id='upproduct_desc' value='<?php if(isset($uprow["product_code"])){ echo $uprow["product_code"]; } ?>' required>
          </div>
          <div class='form-group mb-2'>
            <label for='date_of_arrival'>Date of Arrival</label>
            <input class='form-control' name='updatearrival_date' type='date' id='dateup_of_arrival' value='<?php if(isset($uprow["date_arrival"])){ echo $uprow["date_arrival"]; } ?>' required>
          </div>
          <div class='form-group mb-2'>
            <label for='expiry_date'>Expiry Date</label>
            <input class='form-control' name='updateexpiry_date' type='date' id='expiry_dateup' value='<?php if(isset($uprow["expiry_date"])){ echo $uprow["expiry_date"]; } ?>' required>
          </div>
          <div class='form-group mb-2'>
            <label for='up_price'>Selling Price</label>
            <input class='form-control' name='updateselling_price' type='number' placeholder='0.00' id='up_price' min="1" onchange="productProfitUpdate(event)" value="<?php if(isset($uprow["price"])){ echo $uprow["price"]; } ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='up_cost'>Original Price</label>
            <input class='form-control' name='updateoriginal_price' type='number' placeholder='0.00' id='up_cost' min="1" onchange="productProfitUpdate(event)" value="<?php if(isset($uprow["o_price"])){ echo $uprow["o_price"];}  ?>" required>
          </div>
          <div class='form-group mb-2'>
            <label for='profit'>Profit</label>
            <input class='form-control' name='updateproduct_profit' type='number' id='upprofit' placeholder="0.00" value="<?php if(isset($uprow["profit"])){ echo $uprow["profit"];}  ?>" readonly>
          </div>
          <div class='form-group mb-2'>
            <label for='supplier'>Supplier</label>
            <select class='form-control' name='updatesupplier' required>
              <option selected disabled>select supplier</option>
              <?php 
                while($upsrow = $suplres->fetch_assoc()){
              ?>
              <option value='<?php echo $upsrow['supplier_name']; ?>'><?php echo $upsrow['supplier_name']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class='form-group mb-2'>
            <label for='product_quantity'>Quantity</label>
            <input class='form-control' name='updateproduct_quantity' type='number' id='product_quantity' placeholder="1 item" min="0" value="<?php if(isset($uprow["qty"])){ echo $uprow["qty"]; } ?>" required>
          </div>
          <div class="form-group p-3 d-flex justify-content-center">
            <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
            <button class='btn btn-outline-secondary' name='update_product' type='submit' id="update_btn">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- confirm delete product -->
<div class="modal fade" id="delete-product">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Delete product</h3>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-center fs-5">Are you sure you want to delete product</p>
        <a class="btn btn-outline-danger m-3 d-flex justify-content-center" href="../functions/process.php?user_role=<?php echo $user_role; ?>&id=<?php echo $uprow['product_id']; ?>">remove product</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"> 

  function productProfitUpdate(e){
    e.preventDefault();

    let originalprice = document.querySelector('#up_cost').value;
    let sellingprice = document.querySelector('#up_price').value;
    let profit = sellingprice - originalprice;
    document.querySelector('#upprofit').value = profit;
  }

</script>