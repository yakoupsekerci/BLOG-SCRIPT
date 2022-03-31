<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Image</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Image</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Title</label>
									<input class="form-control" name="title" value="" type="text" required>
								</p>
								<p>
									<label>Image</label>
									<input class="form-control" name="image" value="" type="url" required>
								</p>
								<p>
									<label>Active</label><br />
									<select name="active" class="form-control" required>
									    <option value="Yes" selected>Yes</option>
									    <option value="No">No</option>
                                    </select>
								</p>
								<p>
									<label>Description</label>
									<textarea class="form-control" name="description"></textarea>
								</p>
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $title       = $_POST['title'];
    $image       = $_POST['image'];
    $active      = $_POST['active'];
    $description = $_POST['description'];
    
    $add = "INSERT INTO `gallery` (title, image, description, active) VALUES ('$title', '$image', '$description', '$active')";
    $sql = mysqli_query($connect, $add);
    echo '<meta http-equiv="refresh" content="0; url=gallery.php">';
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