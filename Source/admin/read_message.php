<?php
include "header.php";

$id   = (int) $_GET['id'];
$runq = mysqli_query($connect, "SELECT * FROM `messages` WHERE id='$id'");
mysqli_query($connect, "UPDATE `messages` set viewed='Yes' WHERE id='$id'");
$row = mysqli_fetch_assoc($runq);

if (empty($id)) {
    echo '<meta http-equiv="refresh" content="0; url=messages.php">';
}
if (mysqli_num_rows($runq) == 0) {
    echo '<meta http-equiv="refresh" content="0; url=messages.php">';
}
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Message</li>
        </ol>
      </div>  

      <div class="row">
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Message</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
				  <center>
<?php
echo '
                                        <div class="form-actions">
											<a href="messages.php?id=' . $row['id'] . '" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a><br />
								        </div><br>
                                        <i class="fa fa-user"></i> Sender: <b>' . $row['name'] . '</b><br>
										<i class="fa fa-envelope-o"></i> E-Mail Address: <b>' . $row['email'] . '</b><br>
										<i class="fa fa-calendar-o"></i> Date: <b>' . $row['date'] . ' at ' . $row['time'] . '</b><br><hr>
										<i class="fa fa-file-text-o"></i> Message:<br><b>' . $row['content'] . '</b><br><hr>
                                        <h2>Reply to the message</h2>
                                        <a href="mailto:' . $row['email'] . '" class="btn btn-primary btn-block" target="_blank"><i class="fa fa-reply"></i> Reply</a>';
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