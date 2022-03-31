<?php
include "header.php";

if (isset($_POST['save'])) {
    $sitename    = $_POST['sitename'];
    $description = $_POST['description'];
    $keywords    = $_POST['keywords'];
    $email       = $_POST['email'];
    $facebook    = $_POST['facebook'];
    $twitter     = $_POST['twitter'];
    $youtube     = $_POST['youtube'];
    $edit        = "UPDATE settings SET sitename='$sitename', description='$description', keywords='$keywords', email='$email', facebook='$facebook', twitter='$twitter', youtube='$youtube'";
    $sql         = mysqli_query($connect, $edit);
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li><a href="dashboard.php">Home</a></li>
          <li class="active">Settings</li>
        </ol>
      </div>

      <div class="row">
         
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Settings</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<?php
$sql    = "SELECT * FROM settings";
$result = mysqli_query($connect, $sql);
while ($s = mysqli_fetch_assoc($result)) {
?>
                                <center><form action="" method="post">
								<p>
									<label>Site Name</label>
									<input class="form-control" name="sitename" value="<?php
    echo $s['sitename'];
?>" type="text" required>
								</p><br />
								<p>
									<label>Description</label>
									<textarea class="form-control" name="description" required><?php
    echo $s['description'];
?></textarea>
								</p><br />
								<p>
									<label>Keywords</label>
									<input class="form-control" name="keywords" value="<?php
    echo $s['keywords'];
?>" type="text" required>
								</p><br />
								<p>
									<label>Website's E-Mail Address</label>
									<input class="form-control" name="email" value="<?php
    echo $s['email'];
?>" type="email" required>
								</p><br />
								<p>
									<label>Facebook Profile</label>
									<input class="form-control" name="facebook" value="<?php
    echo $s['facebook'];
?>" type="text">
								</p><br />
								<p>
									<label>Twitter Profile</label>
									<input class="form-control" name="twitter" value="<?php
    echo $s['twitter'];
?>" type="text">
								</p><br />
								<p>
									<label>Youtube Profile</label>
									<input class="form-control" name="youtube" value="<?php
    echo $s['youtube'];
?>" type="text">
								</p><br />
								<div class="form-actions">
                                    <input type="submit" name="save" class="btn btn-primary btn-block" value="Save Changes" />
                                </div>
								</form>

<?php
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