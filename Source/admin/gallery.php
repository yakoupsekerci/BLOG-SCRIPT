<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `gallery` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Gallery</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Gallery</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="add_image.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Image</a></center><br />
<?php
$sql    = "SELECT * FROM gallery ORDER by id DESC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo 'There are no images.';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover" id="dt-basic">
                <thead>
				<tr>
                    <th>Image</th>
                    <th>Title</th>
					<th>Active</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td><center><img src="' . $row['image'] . '" width="45px" height="45px" /></center></td>
	                <td>' . $row['title'] . '</td>';
        if ($row['active'] == "Yes") {
            echo '<td>Yes</td>';
        } else {
            echo '<td>No</td>';
        }
        echo '
					<td>
					    <a href="?edit-id=' . $row['id'] . '" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
						<a href="?delete-id=' . $row['id'] . '" title="Delete" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</a>
					</td>
                </tr>
';
    }
    echo '
            </table>
';
}
?></center>
                  </div>
              </div>
            </div>
        </div>
      </div>
 
<?php
if (isset($_GET['edit-id'])) {
    $id  = (int) $_GET["edit-id"];
    $sql = mysqli_query($connect, "SELECT * FROM `gallery` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=gallery.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=gallery.php">';
    }
?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Image</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<center><form action="" method="post">
								<p>
									<label>Title</label>
									<input class="form-control" class="form-control" name="title" type="text" value="<?php
    echo $row['title'];
?>" required>
								</p>
								<p>
									<label>Image</label><br />
									<img src="<?php
    echo $row['image'];
?>" width="50px" height="50px" /><br />
									<input class="form-control" class="form-control" name="image" type="text" value="<?php
    echo $row['image'];
?>" required>
								</p>
								<p>
									<label>Active
                                    </label><br />
									<select name="active" class="form-control">
									    <option value="Yes" <?php
    if ($row['active'] == "Yes") {
        echo 'selected';
    } else {
        echo '';
    }
?>>Yes</option>
									    <option value="No" <?php
    if ($row['active'] == "No") {
        echo 'selected';
    } else {
        echo '';
    }
?>>No</option>
                                    </select>
								</p>
								<p>
									<label>Description</label>
									<textarea class="form-control" name="description"><?php
    echo $row['description'];
?></textarea>
								</p>
<div class="form-actions">
    <input type="submit" class="btn btn-primary" name="submit" value="Save" /><br />
</div>
</form>
<?php
    if (isset($_POST['submit'])) {
        $title       = $_POST['title'];
        $image       = $_POST['image'];
        $active      = $_POST['active'];
        $description = $_POST['description'];
        
        $edit = "UPDATE gallery SET title='$title', image='$image', active='$active', description='$description' WHERE id='$id'";
        $sql  = mysqli_query($connect, $edit);
        echo '<meta http-equiv="refresh" content="0; url=gallery.php">';
    }
?></center>
                  </div>
              </div>
            </div>
        </div>
     </div>
<?php
}
?>
    </div>
  </div>

<?php
include "footer.php";
?>