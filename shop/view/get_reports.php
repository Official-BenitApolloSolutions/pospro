<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
  <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>Reports</h1>
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
    <div class='row'>
      <div class='col-4'>
        <label>From</label>
        <input type='date' class='form-control' id="start_date">
      </div>
      <div class='col-4'>
        <label>To</label>
        <input type='date' class='form-control' id="end_date">
      </div>
      <div class='col-4 mt-4'>
        <button class='btn btn-outline-secondary w-50' type='button' onclick="loadReport(event)">Search</button>
      </div>
    </div>
    <div class='mt-5'>
      <p class='fw-bold text-center'>Sales Report from <span id="start-date">0</span> to <span id="end-date">0</spn></p>
    </div>
    <div class='mt-3 table-responsive small'>
      <table class='table table-striped table-sm' id='report-activity'>
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
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>0.00</td>
            <td>0.00</td>
          </tr>
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