<?php
// $_SESSION['productid']

 function getProducts(){
	require_once '../settings/config.php';
 	$id = 1;
 	$sql = "SELECT DISTINCT product_id, gen_name, product_name FROM products";
	$rows = $dbc->query($sql);
	$sqlcount = "SELECT SQL_CALC_FOUND_ROWS * FROM products";
	$st = $dbc->prepare($sqlcount);
	// $st->bindValue(":id", $id, PDO::PARAM_INT );
	// $st->bindValue(":numRows", $numRows, PDO::PARAM_INT ); 
	$st->execute(); 
	$st = $dbc->query("SELECT found_rows() AS totalRows");
 	$totalrow = $st->fetch();

 	foreach ($rows as $row) {
 	  $productid = $row["product_id"];
	  $productgen = $row["gen_name"];
	  $productname = $row["product_name"];
	  // $id++;
 	}
    $totalrows = $totalrow["totalRows"];
    // $products = "";
 		echo "<form>
            <div class='mt-5 table-responsive small'>
              <table class='table table-striped table-sm' id='sales-activity'>
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
                <tbody>";
          print $totalrows;

                	while($totalrows>0){
	                    echo "<tr>
	                    <td>pos$productid</td>
	                    <td>$productgen</td>
	                    <td>$productname</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>0.00</td>
	                    <td>0.00</td>
	                    <td>0</td>
	                    <td>0</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                  </tr>";
                  		$totalrows--;
              		}
                echo "</tbody>
              </table>
            </div>
          </form>";
 	// return $products;
 }

?>