<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}

session_start();
include "config.php";

//Data Sanitization
$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

function short_text($text, $length)
{
    $maxTextLenght = $length;
    $aspace        = " ";
    if (strlen($text) > $maxTextLenght) {
        $text = substr(trim($text), 0, $maxTextLenght);
        $text = substr($text, 0, strlen($text) - strpos(strrev($text), $aspace));
        $text = $text . '...';
    }
    return $text;
}

function head()
{
    include "config.php";
?>
<!DOCTYPE html>
<html>

<head>
<?php
    $run  = mysqli_query($connect, "SELECT * FROM `settings`");
    $site = mysqli_fetch_assoc($run);
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
        <title><?php
    echo $site['sitename'];
?></title>
        <meta name="description" content="<?php
    echo $site['description'];
?>" />
        <meta name="keywords" content="<?php
    echo $site['keywords'];
?>" />
        <meta name="author" content="Antonov_WEB" />
      
        <meta name="robots" content="index, follow, all" />
		
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
	<link href="https://bootswatch.com/flatly/bootstrap.min.css" type="text/css" rel="stylesheet"/>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet"/>
	
</head>

<body>

<section id="top-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span style="position: absolute; top: 50%;"><b><i class="fa fa-calendar-o"></i>&nbsp; <?php
    echo date('l');
?>, <?php
    echo date('d F Y');
?></b> &nbsp; |</span>
            </div>
			<div class="col-md-4">
                
            </div>
			<div class="col-md-4" align="right">
                <a href="<?php
    echo $site['facebook'];
?>" target="_blank"><i class="fa fa-facebook-official fa-2x"></i></a>
				<a href="<?php
    echo $site['twitter'];
?>" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
				<a href="<?php
    echo $site['youtube'];
?>" target="_blank"><i class="fa fa-youtube-square fa-2x"></i></a>
            </div>
        </div>
    </div>
</section>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 logo">
                    <a href="index.php"><h1 style="font-size: 50px; vertical-align: middle;"><?php
    echo $site['sitename'];
?></h1></a><br />
            </div>
			<div class="col-md-6">
<?php
    $query = mysqli_query($connect, "SELECT * FROM `ads` WHERE type='Header' and active='Yes' ORDER BY RAND() LIMIT 1");
    while ($row = mysqli_fetch_array($query)) {
        echo html_entity_decode($row['code']);
    }
?>
            </div>
        </div>
		
		<br />
		
		<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
<?php
    $runq = mysqli_query($connect, "SELECT * FROM `menu`");
    while ($row = mysqli_fetch_assoc($runq)) {
        if ($row['path'] == 'blog.php') {
            echo '<li class="dropdown';
            if (basename($_SERVER['SCRIPT_NAME']) == 'blog.php' || basename($_SERVER['SCRIPT_NAME']) == 'category.php') {
                echo ' active';
            }
            echo '">
                <a href="blog.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa ' . $row['fa_icon'] . '"></i> ' . $row['page'] . ' <span class="caret"></span></a>
                <ul class="dropdown-menu">';
            $run2 = mysqli_query($connect, "SELECT * FROM `categories`");
            while ($row2 = mysqli_fetch_array($run2)) {
                echo '<li><a href="category.php?id=' . $row2['id'] . '">' . $row2['category'] . '</a></li>';
            }
            echo '</ul></li>';
        } else {
            echo '<li ';
            if (basename($_SERVER['SCRIPT_NAME']) == $row['path']) {
                echo 'class="active"';
            }
            echo '><a href="' . $row['path'] . '"><i class="fa ' . $row['fa_icon'] . '"></i> ' . $row['page'] . '</a></li>';
        }
    }
?>
            </ul>
          </div>
        </div>
      </nav>
		
    </div>
</header>

<?php
}

function sidebar()
{
    include "config.php";
?>
                    <aside id="sidebar" class="col-md-4">
						
					<div class="title-divider">
                        <h3>Search</h3>
                        <div class="divider-arrow"></div>
                    </div>
					<section class="block-grey">
                        <div class="block-light">
						    <form action="search.php" method="GET">
					        <div class="input-group">
            		            <input type="text" class="form-control" placeholder="Type here to search..." name="q" required>
            		            <span class="input-group-btn">
            		              <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            		            </span>
            		        </div>
							</form>
					    </div>
					</section>

                    <div class="title-divider">
                        <h3>Categories</h3>
                        <div class="divider-arrow"></div>
                    </div>
                    <section class="block-grey">
                        <div class="block-light wrap15"><br />
                            <ul class="list-group">
<?php
    $runq = mysqli_query($connect, "SELECT * FROM `categories`");
    while ($row = mysqli_fetch_assoc($runq)) {
        $category_id = $row['id'];
        $queryac     = mysqli_query($connect, "SELECT * FROM `posts` WHERE category_id = '$category_id' and active='Yes'");
        $countac     = mysqli_num_rows($queryac);
        echo '
            <li class="list-group-item"><span class="badge">' . $countac . '</span><a href="category.php?id=' . $row['id'] . '"><i class="fa fa-arrow-right""></i>&nbsp; ' . $row['category'] . '</a></li>
		';
    }
?>
                            </ul>
							
							
							  
							</ul>
                        </div>
                    </section>
					
<?php
    $run  = mysqli_query($connect, "SELECT * FROM `settings`");
    $site = mysqli_fetch_assoc($run);
?>
					<div class="title-divider">
                        <h3>Subscribe to Newsletter</h3>
                        <div class="divider-arrow"></div>
                    </div>
					<section class="block-grey">
                        <div class="block-light wrap15">
						    <p>Subscribe to <?php
    echo $site['sitename'];
?>'s newsletter to receive the latest news and exclusive offers.</p>
						    <form action="" method="POST">
					        <div class="input-group">
            		            <input type="email" class="form-control" placeholder="Enter your E-Mail Address" name="email" required>
            		            <span class="input-group-btn">
            		              <button class="btn btn-primary" type="submit" name="subscribe">Subscribe</button>
            		            </span>
            		        </div>
							</form>
<?php
    if (isset($_POST['subscribe'])) {
        echo '<br />';
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger">The entered E-Mail Address is invalid</div>';
        } else {
            $queryvalid = mysqli_query($connect, "SELECT * FROM `newsletter` WHERE email='$email' LIMIT 1");
            $validator  = mysqli_num_rows($queryvalid);
            if ($validator > 0) {
                echo '<div class="alert alert-warning">This E-Mail Address is already subscribed</div>';
            } else {
                $run = mysqli_query($connect, "INSERT INTO `newsletter` (email) VALUES ('$email')");
                echo '<div class="alert alert-success">You have successfully subscribed to our newsletter</div>';
            }
        }
    }
?>
					    </div>
					</section>

                    <section class="block-grey">

                            <ul class="nav nav-tabs nav-justified">
							    <li class="active"><a href="#popular" data-toggle="tab"><i class="fa fa-fire"></i> Popular</a></li>
                                <li><a href="#recent" data-toggle="tab"><i class="fa fa-clock-o"></i> Recent</a></li>
                                <li><a href="#comments" data-toggle="tab"><i class="fa fa-comments"></i> Comments</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="popular" class="tab-pane fade in active">
<?php
    $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY views DESC LIMIT 4");
    $count = mysqli_num_rows($run);
    if ($count <= 0) {
        echo '<br><center>There are no published posts</center><br>';
    } else {
        while ($row = mysqli_fetch_assoc($run)) {
            $post_id = $row['id'];
            $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
            $uNum    = mysqli_num_rows($runq3);
            echo '
                                            <div class="media">
                                                <div class="media-left">
                                            	    <a href="post.php?id=' . $row['id'] . '"><img class="media-object" src="' . $row['image'] . '" style="width: 64px; height: 64px;"></a>
                                            	</div>
                                                <div class="media-body">
                                                    <a href="post.php?id=' . $row['id'] . '"><h4 class="media-heading">' . $row['title'] . '</h4></a><br />
                                            		<i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '<br />
													<i class="fa fa-comments"></i> Comments: ' . $uNum . '
                                                </div>
                                            </div><hr />
';
        }
    }
?>
								</div>
								<div id="recent" class="tab-pane fade">
<?php
    $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT 4");
    $count = mysqli_num_rows($run);
    if ($count <= 0) {
        echo '<br><center>There are no published posts</center><br>';
    } else {
        while ($row = mysqli_fetch_assoc($run)) {
            $post_id = $row['id'];
            $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
            $uNum    = mysqli_num_rows($runq3);
            echo '
                                            <div class="media">
                                                <div class="media-left">
                                            	    <a href="post.php?id=' . $row['id'] . '"><img class="media-object" src="' . $row['image'] . '" style="width: 64px; height: 64px;"></a>
                                            	</div>
                                                <div class="media-body">
                                                    <a href="post.php?id=' . $row['id'] . '"><h4 class="media-heading">' . $row['title'] . '</h4></a><br />
                                            		<i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '<br />
													<i class="fa fa-comments"></i> Comments: ' . $uNum . '
                                                </div>
                                            </div><hr />
';
        }
    }
?>
								</div>
                                <div id="comments" class="tab-pane fade">
<?php
    $query = mysqli_query($connect, "SELECT * FROM `comments` WHERE approved='Yes' ORDER BY `id` DESC LIMIT 4");
    $cmnts = mysqli_num_rows($query);
    if ($cmnts == "0") {
        echo "There are no comments";
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $query2 = mysqli_query($connect, "SELECT * FROM `posts` WHERE id='$row[post_id]'");
            while ($row2 = mysqli_fetch_array($query2)) {
                echo '
				
				                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object" src="' . $row['avatar'] . '" style="width: 64px; height: 64px;">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">' . $row['author'] . '</h4></a><br />
                                                <i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '<br />
											    <i class="fa fa-comments"></i> Post: <a href="post.php?id=' . $row['post_id'] . '#comments">' . $row2['title'] . '</a>
                                            </div>
                                        </div><hr />
';
            }
        }
    }
?>
                                </div>
                            </div>
                        </section>

<?php
    $run = mysqli_query($connect, "SELECT * FROM `widgets` ORDER BY id ASC");
    while ($row = mysqli_fetch_assoc($run)) {
        echo '
                    <div class="title-divider">
                        <h3>' . $row['title'] . '</h3>
                        <div class="divider-arrow"></div>
                    </div>
                    <section class="block-grey">
                        <div class="block-light wrap15">
                            ' . html_entity_decode($row['content']) . '
                        </div>
                    </section>
';
    }
?>
                    </aside>
					
                </div>
            </div><br />
<?php
}
function footer()
{
    include "config.php";
?>
<footer id="footer">
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3>About</h3>
<?php
    $runq = mysqli_query($connect, "SELECT * FROM `settings`");
    while ($row = mysqli_fetch_assoc($runq)) {
        echo $row['description'];
    }
?>
        </div>
        <div class="col-md-4">
            <h3>Recent Posts</h3>
            
<?php
    $run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT 2");
    $count = mysqli_num_rows($run);
    if ($count <= 0) {
        echo '<br><center>There are no published posts</center><br>';
    } else {
        while ($row = mysqli_fetch_assoc($run)) {
            $post_id = $row['id'];
            $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
            $uNum    = mysqli_num_rows($runq3);
            echo '
                                            <div class="media well">
                                                <div class="media-left">
                                            	    <a href="post.php?id=' . $row['id'] . '"><img class="media-object" src="' . $row['image'] . '" style="width: 64px; height: 64px;"></a>
                                            	</div>
                                                <div class="media-body">
                                                    <a href="post.php?id=' . $row['id'] . '"><h4 class="media-heading">' . $row['title'] . '</h4></a><br />
                                            		<i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '
                                                </div>
                                            </div>
';
        }
    }
?>
        </div>
        <div class="col-md-4">
            <h3>Contact</h3>
			<ul>
<?php
    $run  = mysqli_query($connect, "SELECT * FROM `settings`");
    $site = mysqli_fetch_assoc($run);
?>
                    <li><a href="mailto:<?php
    echo $site['email'];
?>" target="_blank"><strong><i class="fa fa-envelope fa-2x"></i></strong><span>&nbsp; <?php
    echo $site['email'];
?></span></a></li>
                    <li><a href="<?php
    echo $site['facebook'];
?>" target="_blank"><strong><i class="fa fa-facebook-official fa-2x"></i>&nbsp; Facebook</strong></a></li>
                    <li><a href="<?php
    echo $site['twitter'];
?>" target="_blank"><strong><i class="fa fa-twitter-square fa-2x"></i>&nbsp; Twitter</strong></a></li>
					<li><a href="<?php
    echo $site['youtube'];
?>" target="_blank"><strong><i class="fa fa-youtube-square fa-2x"></i>&nbsp; YouTube</strong></a></li>
		    </ul>
        </div>
    </div>
    </div>
</footer>

<section id="footer-menu">
    <div class="container">
        <div class="row">
            <p><span>&copy; <?php
    echo date("Y");
?> <span class="color2"><?php
    echo $site['sitename'];
?></span></span></p>
        </div>
    </div>
</section>
</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>
<?php
}
?>