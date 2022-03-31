<?php
include "header.php";

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `comments` WHERE id='$id'");
}
?>
     
	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Comments</li>
        </ol>
      </div>
	  
	  <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Comments</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<?php
$sql    = "SELECT * FROM comments ORDER by id DESC";
$result = mysqli_query($connect, $sql);
$count  = mysqli_num_rows($result);
if ($count <= 0) {
    echo 'There are no comments.';
} else {
    echo '
            <table class="table table-bordered table-striped table-hover" id="dt-basic">
                <thead>
				<tr>
                    <th>Avatar</th>
                    <th>Author</th>
                    <th>Date</th>
					<th>Approved</th>
					<th>In Response To</th>
					<th>Actions</th>
                </tr>
				</thead>
';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
	                <td><center><img src="../' . $row['avatar'] . '" width="45px" height="45px" /></center></td>
	                <td>' . $row['author'] . '</td>
	                <td>' . $row['date'] . '</td>';
        if ($row['approved'] == "Yes") {
            echo '<td>Yes</td>';
        } else {
            echo '<td>No</td>';
        }
        $post_id = $row['post_id'];
        $runq2   = mysqli_query($connect, "SELECT * FROM `posts` WHERE id='$post_id'");
        $sql2    = mysqli_fetch_assoc($runq2);
        echo '              <td>' . $sql2['title'] . '</td>
					<td>
					    <a href="?edit-id=' . $row['id'] . '" title="View / Edit" class="btn btn-primary"><i class="fa fa-edit"></i> View / Edit</a>
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
    $sql = mysqli_query($connect, "SELECT * FROM `comments` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=comments.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=comments.php">';
    }
?>
    <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Edit Comment</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
<center><form action="" method="post">
								<p>
									<label>Avatar</label><br />
									<img src="../<?php
    echo $row['avatar'];
?>" width="50px" height="50px" /><br />
								</p>
								<p>
									<label>Author</label><br />
									<input class="form-control" class="form-control" name="author" type="text" value="<?php
    echo $row['author'];
?>" disabled>
								</p>
								<p>
									<label>Approved: 
<?php
    if ($row['approved'] == "Yes") {
        echo 'Yes';
    } else {
        echo 'No';
    }
?>
                                    </label><br />
									<select class="form-control" name="approved" required>
									    <option value="Yes" <?php
    if ($row['approved'] == "Yes") {
        echo 'selected';
    } else {
        echo '';
    }
?>>Yes</option>
									    <option value="No" <?php
    if ($row['approved'] == "No") {
        echo 'selected';
    } else {
        echo '';
    }
?>>No</option>
                                    </select>
								</p>
								<p>
									<label>Comment</label>
									<textarea name="comment" class="form-control" rows="6" disabled><?php
    echo $row['comment'];
?></textarea>
								</p>
<div class="form-actions">
    <input type="submit" class="btn btn-primary" name="submit" value="Update" /><br />
</div>
</form>
<?php
    if (isset($_POST['submit'])) {
        $approved = $_POST['approved'];
        $edit     = "UPDATE comments SET approved='$approved' WHERE id='$id'";
        $sql      = mysqli_query($connect, $edit);
        echo '<meta http-equiv="refresh" content="0; url=comments.php">';
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