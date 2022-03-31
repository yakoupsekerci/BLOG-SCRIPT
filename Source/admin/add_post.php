<?php
include "header.php";
?>

	<div class="col-md-9">
      <div>
        <ol class="breadcrumb">
          <li>
            <a href="dashboard.php">Home</a>
          </li>
          <li class="active">Add Post</li>
        </ol>
      </div>  

      <div class="row">
        
        <div class="col-md-12 column">
            <div class="box">
              <h4 class="box-header round-top">Add Post</h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                                <center><form action="" method="post">
								<p>
									<label>Title</label>
									<input class="form-control" name="title" value="" type="text" required>
								</p><br />
								<p>
									<label>Image</label>
									<input class="form-control" name="image" value="" type="url" required>
								</p><br />
								<p>
									<label>Active</label><br />
									<select name="active" class="form-control" required>
									    <option value="Yes" selected>Yes</option>
									    <option value="No">No</option>
                                    </select>
								</p><br />
								<p>
									<label>Category</label><br />
									<select name="category_id" class="form-control" required>
									<?php
$crun = mysqli_query($connect, "SELECT * FROM `categories`");
while ($rw = mysqli_fetch_assoc($crun)) {
    echo '
                                    <option value="' . $rw['id'] . '">' . $rw['category'] . '</option>
									';
}
?>
                                    </select>
								</p><br />
								<p>
									<label>Content</label>
									<textarea class="form-control" name="content" required></textarea>
								</p><br />
								<div class="form-actions">
                                    <input type="submit" name="add" class="btn btn-primary" value="Add" />
									<input type="reset" class="btn" value="Reset" />
                                </div>
								</form>

<?php
if (isset($_POST['add'])) {
    $title       = addslashes($_POST['title']);
    $image       = addslashes($_POST['image']);
    $active      = addslashes($_POST['active']);
    $category_id = addslashes($_POST['category_id']);
    $content     = htmlspecialchars($_POST['content']);
    $date        = date('d F Y');
    $time        = date('H:i');
    
    $add = "INSERT INTO `posts` (category_id, title, image, content, date, time, active) VALUES ('$category_id', '$title', '$image', '$content', '$date', '$time', '$active')";
    $sql = mysqli_query($connect, $add);
    
    $run      = mysqli_query($connect, "SELECT * FROM `settings`");
    $site     = mysqli_fetch_assoc($run);
    $from     = $site['email'];
    $sitename = $site['sitename'];
    
    $run3 = mysqli_query($connect, "SELECT * FROM `posts` WHERE title='$title'");
    $row3 = mysqli_fetch_assoc($run3);
    $id3  = $row3['id'];
    
    $run2 = mysqli_query($connect, "SELECT * FROM `newsletter`");
    while ($row = mysqli_fetch_assoc($run2)) {
        $emails = $row['email'];
        
        $to = $emails;
        
        $subject = $title;
        
        $message = '
<html>
<head>
  <title>' . $title . '</title>
</head>
<body>
  <center><a href="' . $site_url . '/post.php?id=' . $id3 . '" title="Read more"><h2>' . $title . '</h2></a></center><br />
  <center><img src="' . $image . '" width="600px" height="350px"/></center><br />
  ' . html_entity_decode($content) . '
</body>
</html>
';
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        
        $headers .= 'To: ' . $emails . ' <' . $emails . '>' . "\r\n";
        $headers .= 'From: ' . $sitename . ' <' . $from . '>' . "\r\n";
        
        @mail($to, $subject, $message, $headers);
    }
    
    echo '<meta http-equiv="refresh" content="0;url=posts.php">';
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