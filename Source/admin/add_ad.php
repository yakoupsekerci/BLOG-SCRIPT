<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Ad</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Ad</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Type</label><br />
									<select name="type" class="form-control" required>
									    <option value="Header" selected>Header</option>
                                    </select>
								</p>
								<p>
									<label>Active</label><br />
									<select name="active" class="form-control" required>
									    <option value="Yes" selected>Yes</option>
									    <option value="No">No</option>
                                    </select>
								</p>
								<p>
									<label>Code</label>
									<textarea class="form-control ckeditor" name="code" required></textarea>
								</p>
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $type   = addslashes($_POST['type']);
    $active = addslashes($_POST['active']);
    $code   = htmlspecialchars($_POST['code']);
    
    $add = "INSERT INTO ads (type, active, code) VALUES ('$type', '$active', '$code')";
    $sql = mysqli_query($connect, $add);
    echo '<meta http-equiv="refresh" content="0; url=ads.php">';
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