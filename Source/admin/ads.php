<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `ads` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Ads</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Ads</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="add_ad.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Ad</a></center><br />
<?php
$sql    = "SELECT * FROM ads ORDER by id DESC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo 'There are no ads.';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover">
                <thead>
				<tr>
                    <th>ID</th>
                    <th>Type</th>
					<th>Active</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td>' . $row['id'] . '</td>
	                <td>' . $row['type'] . '</td>';
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
    $sql = mysqli_query($connect, "SELECT * FROM `ads` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=ads.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=ads.php">';
    }
?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Ad</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<center><form action="" method="post">
								<label>Ad Position</label><br />
									<select name="type" class="form-control" required>
									    <option value="Header" <?php
    if ($row['type'] == "Header") {
        echo 'selected';
    } else {
        echo '';
    }
?>>Header</option>
                                    </select>
								</p>
								<p>
									<label>Active</label><br />
									<select name="active" class="form-control" required>
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
	<label>Content</label>
	<textarea name="code" class="ckeditor" required><?php
    echo html_entity_decode($row['code']);
?></textarea>
</p>
<div class="form-actions">
    <input type="submit" class="btn btn-primary" name="submit" value="Update" /><br />
</div>
</form>
<?php
    if (isset($_POST['submit'])) {
        $type   = addslashes($_POST['type']);
        $active = addslashes($_POST['active']);
        $code   = htmlspecialchars($_POST['code']);
        $edit   = "UPDATE ads SET code='$code', active='$active', type='$type' WHERE id='$id'";
        $sql    = mysqli_query($connect, $edit);
        echo '<meta http-equiv="refresh" content="0; url=ads.php">';
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