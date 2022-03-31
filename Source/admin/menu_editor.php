<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `menu` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Menu</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Menu Editor</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="add_menu.php" class="btn btn-default"><i class="fa fa-edit"></i> Add Menu</a></center><br />
<?php
$sql    = "SELECT * FROM menu ORDER by id ASC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo 'There are no menus.';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover">
                <thead>
				<tr>
                    <th>ID</th>
                    <th>Page</th>
					<th>Path</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td>' . $row['id'] . '</td>
	                <td><i class="fa ' . $row['fa_icon'] . '"></i> ' . $row['page'] . '</td>
					<td>' . $row['path'] . '</td>
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
    $sql = mysqli_query($connect, "SELECT * FROM `menu` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=menu_editor.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=menu_editor.php">';
    }
?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Menu</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<center><form action="" method="post">
<p>
	<label>Page</label>
	<input name="page" class="form-control" type="text" value="<?php
    echo $row['page'];
?>" required>
</p>
<p>
	<label>Path (Link)</label>
	<input name="path" class="form-control" type="text" value="<?php
    echo $row['path'];
?>" required>
</p>
<p>
	<label>Font Awesome Icon</label>
	<input name="fa_icon" class="form-control" type="text" value="<?php
    echo $row['fa_icon'];
?>">
</p>
<br /><input type="submit" class="btn btn-primary" name="submit" value="Save" /><br />
</form>
<?php
    if (isset($_POST['submit'])) {
        $page    = $_POST['page'];
        $path    = $_POST['path'];
        $fa_icon = $_POST['fa_icon'];
        $update  = "UPDATE menu SET page='$page', path='$path', fa_icon='$fa_icon' WHERE id='$id'";
        $sql     = mysqli_query($connect, $update);
        echo '<meta http-equiv="refresh" content="0;url=menu_editor.php">';
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