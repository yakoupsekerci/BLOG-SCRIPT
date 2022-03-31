<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id     = (int) $_GET["delete-id"];
    $query2 = mysqli_query($connect, "SELECT * FROM `files` WHERE id='$id'");
    $row2   = mysqli_fetch_assoc($query2);
    $path   = $row2['path'];
    unlink($path);
    $query = mysqli_query($connect, "DELETE FROM `files` WHERE id='$id'");
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Files</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Files</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center><a href="upload_file.php" class="btn btn-default"><i class="fa fa-edit"></i> Upload File</a></center><br />
<?php
$sql    = "SELECT * FROM files ORDER by id DESC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo '<center>There are no files.</center>';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover" id="dt-basic">
                <thead>
				<tr>
                    <th>ID</th>
                    <th>File Name</th>
					<th>Type</th>
					<th>Size</th>
					<th>Uploaded</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td>' . $row['id'] . '</td>
	                <td>' . $row['filename'] . '</td>
					<td>' . filetype($row['path']) . '</td>
					<td>' . byte_convert(filesize($row['path'])) . '</td>
					<td>' . $row['date'] . '</td>
					<td>
					    <a href="' . $row['path'] . '" target="_blank" title="View" class="btn btn-success"><i class="fa fa-eye"></i> View</a>
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

    </div>
  </div>

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fa fa-angle-left"></i>',
			  "next": '<i class="fa fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
include "footer.php";
?>