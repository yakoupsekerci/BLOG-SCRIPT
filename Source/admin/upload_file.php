<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Upload File</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Upload File</h4>
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post" enctype="multipart/form-data">
								<p>
									<label><i class="fa fa-file-text-o"></i> <b>File</b></label>
									<input type="file" name="file" class="form-control" required />
								</p>
								<div class="form-actions">
                                    <input type="submit" name="upload" class="btn btn-primary" value="Upload" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>
<?php
if (isset($_POST['upload'])) {
    $file     = $_FILES['file'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $name     = $_FILES['file']['name'];
    
    $date = date('d F Y');
    $time = date('H:i');
    
    @$format = end(explode(".", $name));
    if ($format != "png" && $format != "gif" && $format != "jpeg" && $format != "jpg" && $format != "JPG" && $format != "PNG" && $format != "bmp" && $format != "GIF" && $format != "doc" && $format != "pdf" && $format != "txt" && $format != "rar" && $format != "html" && $format != "zip") {
        echo "<br />The selected file is with unallowed extension!<br />
		Allowed file types:<br /><b>.zip</b>, <b>.html</b>, <b>.doc</b>, <b>.pdf</b>, <b>.txt</b>, <b>.png</b>, <b>.gif</b>, <b>.bmp</b>, <b>.jpg/jpeg</b> and <b>.rar</b>";
    } else {
        $string     = "0123456789wsderfgtyhjuk";
        $new_string = str_shuffle($string);
        $location   = "../uploads/file_$new_string.$format";
        move_uploaded_file($tmp_name, $location);
        $run_q = mysqli_query($connect, "INSERT INTO files VALUES ('', '$name', '$date', '$time', '$location')");
        echo '<meta http-equiv="refresh" content="0; url=files.php">';
    }
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