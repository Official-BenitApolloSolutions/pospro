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
          <li class='breadcrumb-item'><a href='./user_management.php?user_role=<?php echo $user_role; ?>' class='text-decoration-none text-muted'>User Management</a></li>
          <li class='breadcrumb-item'>Edit User</li>
        </ol>
      </nav>
      <a class='btn btn-outline-secondary' href='./user_management.php?user_role=<?php echo $user_role; ?>'>Back to user management</a>
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
            <tr class="p-3">
              <td><?php if(isset($uprow['user_id'])){ echo $uprow['user_id']; } ?></td>
              <td><?php if(isset($uprow['fullname'])){ echo $uprow['fullname']; } ?></td>
              <td><?php if(isset($uprow['address'])){ echo $uprow['address']; } ?></td>
              <td><?php if(isset($uprow['contact_info'])){ echo $uprow['contact_info']; } ?></td>
              <td><?php if(isset($uprow['position'])){ echo $uprow['position']; } ?></td>
              <td><?php if(isset($uprow['username'])){ echo $uprow['username']; } ?></td>
              <td><?php if(isset($uprow['note'])){ echo $uprow['note']; } ?></td>
              <td><?php if(isset($uprow['assigned_date'])){ echo $uprow['assigned_date']; } ?></td>
              <td>
                <?php if(isset($uprow['user_id'])): ?>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#update-user" class="btn btn-outline-warning m-2 text-capitalize">update user</button>
                  <button type="button" class="btn btn-outline-danger text-capitalize m-2" data-bs-toggle="modal" data-bs-target="#delete-user">delete user</button>
              <?php endif ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</main>

<!-- update user -->
<div class='modal fade' id='update-user'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title'>Update User</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>
      <form action='../functions/processuser.php' method='post'>
        <div class='modal-body'>
            <input type="hidden" name="userid" value="<?php if(isset($uprow['user_id'])){ echo $uprow['user_id']; } ?>">
            <div class="form-group mb-2">
              <label for='user_fullname'>Full Name</label>
              <input class='form-control' name='upfullname' type='text' placeholder='Enter full name' id='user_fullname' value="<?php if(isset($uprow['fullname'])){ echo $uprow['fullname']; } ?>" required>
            </div>
            <div class="form-group mb-2">
              <label for='address'>Address</label>
              <input class='form-control' name='upaddress' type='text' placeholder='Enter address'id='address' value="<?php if(isset($uprow['address'])){ echo $uprow['address']; } ?>" required>
            </div>
            <div class="form-group mb-2">
              <label for='contact_info'>Contact</label>
              <input class='form-control' name='upcontact' type='tel' placeholder='Enter contact' id='contact_info' value="<?php if(isset($uprow['contact_info'])){ echo $uprow['contact_info']; } ?>">
            </div>
            <div class="form-group mb-2">
              <label for='position'>Position</label>
              <input type="text" class='form-control' name='upposition' type='text' id='position' list="positions" value="<?php if(isset($uprow['position'])){ echo $uprow['position']; } ?>">
              <datalist id="positions">
                <option value="admin">Admin</option>
                <option value="cashier">Cashier</option>
              </datalist>
            </div>
            <div class="form-group mb-2">
              <label for='username'>Username</label>
              <input class='form-control' name='upusername' type='text' autocomplete="off" placeholder='Enter username' id='username' value="<?php if(isset($uprow['username'])){ echo $uprow['username']; } ?>">
            </div>
            <div class="form-group mb-2">
              <label for='password'>Password</label>
              <input class='form-control' name='uppassword' type='password' autocomplete="off" placeholder='Enter password' id='password' value="<?php if(isset($uprow['password'])){ echo $uprow['password']; } ?>">
            </div>
            <div class="form-group mb-2">
              <label for='notes'>Notes</label>
              <textarea class='form-control' name='upnote' type='text' placeholder='Enter a note' id='notes'><?php if(isset($uprow['note'])){ echo $uprow['note']; } ?></textarea>
            </div>
            <div class="form-group mb-2">
              <label for='assigned_date'>Assigned Date</label>
              <input class='form-control' name='upassigned_date' type='date' id='assigned_date' value="<?php if(isset($uprow['assigned_date'])){ echo $uprow['assigned_date']; } ?>">
            </div>
            <div class="form-group p-3 d-flex justify-content-center">
              <button class='btn btn-outline-danger me-5' type='button' data-bs-dismiss='modal'>Cancel</button>
              <button type="submit" class='btn btn-outline-secondary' name="updatedata">Update</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- delete user -->
<div class="modal fade" id="delete-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-capitalize">remove user</h3>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-center fs-5">Are you sure you want to remove user</p>
        <a class="btn btn-outline-danger m-3 d-flex justify-content-center" href="../functions/process.php?user_role=<?php echo $user_role; ?>&userid=<?php echo $uprow['user_id']; ?>">remove user</a>
      </div>
    </div>
  </div>
</div>