<?php
include "core.php";
head();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                    <section class="alignleft col-md-12">
                                <div class="title-divider">
                                    <h3>Latest posts</h3>
                                    <div class="divider-arrow"></div>
                                </div>
<?php
$run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT 10");
$count = mysqli_num_rows($run);
if ($count <= 0) {
    echo '<br><center>There are no published posts</center><br>';
} else {
    while ($row = mysqli_fetch_assoc($run)) {
        $post_id = $row['id'];
        $runq3   = mysqli_query($connect, "SELECT * FROM `comments` WHERE post_id='$post_id' AND approved='Yes'");
        $uNum    = mysqli_num_rows($runq3);
        echo '
                            <post class="blog-post col-md-6">
                                <div class="block-grey">
                                    <div class="block-light">
                                        <a href="post.php?id=' . $row['id'] . '"><img src="' . $row['image'] . '" height="200" width="100%" /></a>
                                        <div class="wrapper">
                                            <h2 class="post-title"><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>
                                            <a href="post.php?id=' . $row['id'] . '#comments" class="blog-comments"><i class="fa fa-comments"></i> ' . $uNum . '</a>
                                            <p><i class="fa fa-clock-o"></i> ' . $row['date'] . ' at ' . $row['time'] . '</p>
										</div>
                                    </div>
                                </div>
                            </post>
';
    }
}
?>
						
                    </section>

					<section class="alignleft col-md-12">
					    <a href="blog.php" class="btn btn-primary btn-block"><i class="fa fa-arrow-circle-o-right"></i> See All</a>
					</section>
					
			</div>
<?php
sidebar();
footer();
?>