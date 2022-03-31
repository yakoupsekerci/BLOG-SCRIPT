<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Admin</li>
        </ol>
      </div>  

      <div class="row">
         
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add User</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Username</label>
									<input class="form-control" name="username" value="" type="text" required>
								</p>
								<p>
									<label>Password</label>
									<input class="form-control" name="password" value="" type="password" required>
								</p>
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);
    $add      = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $sql      = mysqli_query($connect, $add);
    echo '<meta http-equiv="refresh" content="0;url=users.php">';
}
?></center>                               
                  </div>
              </div>
            </div>
        </div>
      </div>

 
    </div>
  </div>

<?php
include "footer.php";
?>