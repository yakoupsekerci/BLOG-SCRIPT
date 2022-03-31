<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Menu</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Menu</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Title</label>
									<input class="form-control" name="page" value="" type="text" required>
								</p>
								<p>
									<label>Path (Link)</label>
									<input class="form-control" name="path" value="" type="text" required>
								</p>
                                <p>
									<label>Font Awesome Icon</label>
									<input class="form-control" name="fa_icon" value="" type="text">
								</p>
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $page    = $_POST['page'];
    $path    = $_POST['path'];
    $fa_icon = $_POST['fa_icon'];
    $add     = "INSERT INTO menu (page, path, fa_icon) VALUES ('$page', '$path', '$fa_icon')";
    $sql     = mysqli_query($connect, $add);
    echo '<meta http-equiv="refresh" content="0;url=menu_editor.php">';
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