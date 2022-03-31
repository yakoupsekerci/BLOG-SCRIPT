<?php
include "core.php";
head();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                    <section class="alignleft col-md-12">
                        <div class="title-divider">
                            <h3>Blog</h3>
                            <div class="divider-arrow"></div>
                        </div>
<?php
$postsperpage = 6;

$pageNum = 1;
if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}
if (!is_numeric($pageNum)) {
    echo '<meta http-equiv="refresh" content="0; url=blog.php">';
    exit();
}
$rows  = ($pageNum - 1) * $postsperpage;

$run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT $rows, $postsperpage");
$count = mysqli_num_rows($run);
if ($count <= 0) {
    echo '<br><br><br><center>There are no published posts</center><br>';
} else {
    while ($row = mysqli_fetch_assoc($run)) {
        $post_id = $row['id'];
        $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
        $uNum    = mysqli_num_rows($runq3);
        echo '
                    <article class="blog-post">
                        <div class="block-grey">
                            <div class="block-light">
                                <div class="wrapper-img">
                                    <center><a href="post.php?id=' . $row['id'] . '">
									<img src="' . $row['image'] . '" width="100%" height="260" /></a></center>
                                </div>
                                <div class="wrapper">
                                    <h2 class="post-title"><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2><hr />
                                    <p>' . html_entity_decode(short_text($row['content'], 800)) . '</p><hr />
                                    <p>
                                        <i class="fa fa-calendar"></i> Date: ' . $row['date'] . '&nbsp;&nbsp;&nbsp;
										<i class="fa fa-comments-o"></i> Comments: <a href="post.php?id=' . $row['id'] . '#comments">' . $uNum . '
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
';
    }
    
    $query   = "SELECT COUNT(id) AS numrows FROM posts WHERE active='Yes'";
    $result  = mysqli_query($connect, $query);
    $row     = mysqli_fetch_array($result);
    $numrows = $row['numrows'];
    $maxPage = ceil($numrows / $postsperpage);
    
    $pagenums = '';
    
    echo '<center>';
    
    for ($page = 1; $page <= $maxPage; $page++) {
        if ($page == $pageNum) {
            $pagenums .= "<a href='?page=$page' class='btn btn-primary'>$page</a> ";
        } else {
            $pagenums .= "<a href=\"?page=$page\" class='btn btn-default'>$page</a> ";
        }
    }
    
    if ($pageNum > 1) {
        $page     = $pageNum - 1;
        $previous = "<a href=\"?page=$page\" class='btn btn-default'><i class='fa fa-arrow-left'></i> Previous</a> ";
        
        $first = "<a href=\"?page=1\" class='btn btn-default'><i class='fa fa-arrow-left'\></i> <i class='fa fa-arrow-left'></i> First</a> ";
    } else {
        $previous = ' ';
        $first    = ' ';
    }
    
    if ($pageNum < $maxPage) {
        $page = $pageNum + 1;
        $next = "<a href=\"?page=$page\" class='btn btn-default'><i class='fa fa-arrow-right'></i> Next</a> ";
        
        $last = "<a href=\"?page=$maxPage\" class='btn btn-default'><i class='fa fa-arrow-right'></i>  <i class='fa fa-arrow-r'></i> Last</a> ";
    } else {
        $next = ' ';
        $last = ' ';
    }
    
    echo $first . $previous . $pagenums . $next . $last;
    
    echo '</center>';
    
}
?>
            </section>
					
			</div>
<?php
sidebar();
footer();
?>