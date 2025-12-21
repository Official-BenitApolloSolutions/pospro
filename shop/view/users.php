<?php
  include '../functions/get_users.php';
  if (isset($_SESSION['user_role'])) {
      $user_role = $_SESSION['user_role']; 
  }
?>
<main class='col-md-9 ms-sm-auto col-lg-10 px-md-4'>
  <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
    <h1 class='h2'>
      <nav aria-label='breadcrumb'>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'><a href='./settings.php?user_role=<?php echo $user_role; ?>' class='text-decoration-none text-muted'>Settings</a></li>
          <li class='breadcrumb-item'>User Management</li>
        </ol>
      </nav>
      <a class='btn btn-outline-secondary' href='./settings.php?user_role=<?php echo $user_role; ?>&id=cash&invoice=<?php echo $invoice; ?>'>Back to settings</a>
    </h1>
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
  <?php echo $session_mes ?>
  <div class='container'>
    <div class='row'>
      <div class='col-6'>
        <p>Total Number of Users: 
          <?php
            if ($rownum['totalRows'] > 1) {
              $totalnum = $rownum['totalRows'];
              echo "<span class='text-success'>$totalnum</span>";
            }else{
              echo "<span class='text-success'>0</span>";
            }
           ?></p>
      </div>
      <div class='col-6'>
        <button class='btn btn-outline-secondary w-50' type='button' data-bs-toggle='modal' data-bs-target='#add-user'>Add User</button>
      </div>
    </div>
    <form action="../functions/process.php" method="post">
      <div class='table-responsive small'>
        <table class='table table-striped table-sm' id='dash-activity'>
          <thead>
            <tr>
              <th scope='col'>#</th>
              <th scope='col'>Fullname</th>
              <th scope='col'>Address</th>
              <th scope='col'>Contact Number</th>
              <th scope='col'>Position</th>
              <th scope='col'>Username</th>
              <th scope='col'>Note</th>
              <th scope='col'>Assigned Date</th>
              <th scope='col'>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                while($row=$user_res->fetch_assoc()){
            ?>
            <tr>
              <td><?php echo $row['user_id']; ?></td>
              <td><?php echo $row['fullname']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td><?php echo $row['contact_info']; ?></td>
              <td><?php echo $row['position']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['note']; ?></td>
              <td><?php echo $row['assigned_date']; ?></td>
              <td>
                <a class="btn btn-outline-warning text-capitalize" href="editusers_view.php?user_role=<?php echo $user_role; ?>&userid=<?php echo $row['user_id']; ?>">edit</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</main>

<!-- add user -->
<div class='modal fade' id='add-user'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Add User</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <form action='../functions/processuser.php' method='post'>
        <div class='modal-body'>
            <div class="form-group mb-2">
              <label for='user_fullname'>Full Name</label>
              <input class='form-control' name='fullname' type='text' placeholder='Enter full name' id='user_fullname'>
            </div>
            <div class="form-group mb-2">
              <label for='address'>Address</label>
              <input class='form-control' name='address' type='text' placeholder='Enter address'id='address'>
            </div>
            <div class="form-group mb-2">
              <label for='contact_info'>Contact</label>
              <input class='form-control' name='contact' type='tel' placeholder='Enter contact' id='contact_info'>
            </div>
            <div class="form-group mb-2">
              <label for='position'>Position</label>
              <input type="text" class='form-control' name='position' type='text' id='position' list="positions">
              <datalist id="positions">
                <option value="admin">Admin</option>
                <option value="cashier">Cashier</option>
              </datalist>
            </div>
            <div class="form-group mb-2">
              <label for='username'>Username</label>
              <input class='form-control' name='username' type='text' autocomplete="off" placeholder='Enter username' id='username'>
            </div>
            <div class="form-group mb-2">
              <label for='password'>Password</label>
              <input class='form-control' name='password' type='password' autocomplete="off" placeholder='Enter password' id='password'>
            </div>
            <div class="form-group mb-2">
              <label for='notes'>Notes</label>
              <textarea class='form-control' name='note' type='text' placeholder='Enter a note' id='notes'></textarea>
            </div>
            <div class="form-group mb-2">
              <label for='assigned_date'>Assigned Date</label>
              <input class='form-control' name='assigned_date' type='date' id='assigned_date'>
            </div>
        </div>
        <div class='modal-footer d-flex justify-content-center'>
          <div class="m-3">
            <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
            <button class='btn btn-outline-secondary' name='submit_user' type='submit'>Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>