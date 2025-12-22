<?php
    include '../functions/viewreport.php';
    if (isset($_GET['search_report'])) {
      if (isset($_GET['start_date'])) {
        $startdate = $_GET['start_date'];
      }
      if (isset($_GET['end_date'])) {
        $enddate = $_GET['end_date'];
      }
    }
    if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role'];
    }
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
  <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>Reports</h1>
    <div class='btn-toolbar mb-2 mb-md-0'>
      <div class='btn-group me-2'>
        <button type='button' class='btn btn-sm btn-outline-secondary'>Share</button>
        <button type='button' class='btn btn-sm btn-outline-secondary'>Export</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
      </div>
      <button type='button' class='btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1'>
        <svg class='bi' aria-hidden='true'><use xlink:href='#calendar3'></use></svg>
        This week
      </button>
    </div>
  </div>
  <div class='container'>
    <form action="reports.php" method="get">
      <div class='row'>
        <div class='col-4'>
          <label>From</label>
          <input type='date' name="start_date" class='form-control' id="start_date">
        </div>
        <div class='col-4'>
          <label>To</label>
          <input type='date' name="end_date" class='form-control' id="end_date">
        </div>
        <div class='col-4 mt-4'>
          <button name="search_report" class='btn btn-outline-secondary w-50' type='submit'>Search</button>
        </div>
      </div>
    </form>
    <div class='mt-5'>
      <p class='fw-bold text-center'>
        Sales Report from <span id="start-date"><?php if (isset($startdate)) {
          echo $startdate;
        }else{ echo "0"; } ?></span> to <span id="end-date"><?php if (isset($enddate)) {
          echo $enddate;
        }else{ echo "0"; } ?></span>
      </p>
    </div>
    <div class='mt-3 table-responsive small'>
        <table class='table table-striped table-sm' id='dash-activity'>
          <thead>
            <tr>
              <th scope='col'>#</th>
              <th scope='col'>Transaction Date</th>
              <th scope='col'>Customer Name</th>
              <th scope='col'>Invoice Number</th>
              <th scope='col'>Amount</th>
              <th scope='col'>Profit</th>
            </tr>
          </thead>
          <tbody>
            <?php
               if (isset($_GET['search_report'])) {
                if (isset($_GET['start_date'])) {
                  $reporta = getData($_GET['start_date']);
                }
                if (isset($_GET['end_date'])) {
                  $reportb = getData($_GET['end_date']);
                }
                $sal_report_query = "SELECT * FROM sales WHERE date_ordered BETWEEN :reporta AND :reportb ORDER by transaction_id DESC";
                $sal_report = $dbc->prepare($sal_report_query);
                $sal_report->bindValue(":reporta", $reporta,PDO::PARAM_STR);
                $sal_report->bindValue(":reportb", $reportb, PDO::PARAM_STR);
                $sal_report->execute();
                for ($i=0; $row = $sal_report->fetch(); $i++) {
            ?>
              <tr>
                <td><?php if(isset($row['transaction_id'])){ echo $row['transaction_id']; } ?></td>
                <td><?php if(isset($row['date_ordered'])){ echo $row['date_ordered']; } ?></td>
                <td><?php if(isset($row['name'])){ echo $row['name']; } ?></td>
                <td><?php if(isset($row['invoice_number'])){ echo $row['invoice_number']; } ?></td>
                <td><?php if(isset($row['amount'])){ echo $row['amount']; } ?></td>
                <td><?php if(isset($row['profit'])){ echo $row['profit']; } ?></td>
              </tr>
            <?php
                }
              } 
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan='4'>Total</th>
              <td>0.00</td>
              <td>0.00</td>
            </tr>
          </tfoot>
        </table>
    </div>
  </div>
</main>
<script type="text/javascript">
  function loadReport(event) {
    event.preventDefault();
    
    let startdate = document.getElementById("start-date");
    let enddate = document.getElementById("end-date");
    let startdate_ = document.getElementById("start_date").value;
    let enddate_ = document.getElementById("end_date").value;
    startdate.textContent = startdate_;
    enddate.textContent = enddate_;
  }
</script>