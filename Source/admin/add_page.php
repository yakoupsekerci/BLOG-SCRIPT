<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Page</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Page</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Title</label>
									<input class="form-control" name="title" value="" type="text" required>
								</p>
								<p>
									<label>Content</label>
									<textarea class="form-control" name="content" required></textarea>
								</p>
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $title   = addslashes($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    
    $add = "INSERT INTO pages (title, content) VALUES ('$title', '$content')";
    $sql = mysqli_query($connect, $add);
    
    $sql2    = "SELECT * FROM pages WHERE title='$title'";
    $result2 = mysqli_query($connect, $sql2);
    $row     = mysqli_fetch_assoc($result2);
    $id      = $row['id'];
    $add2    = "INSERT INTO menu (page, path) VALUES ('$title', 'page.php?id=$id')";
    $sql2    = mysqli_query($connect, $add2);
    echo '<meta http-equiv="refresh" content="0; url=pages.php">';
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
    CKEDITOR.replace( 'content' );
</script>
<?php
include "footer.php";
?>