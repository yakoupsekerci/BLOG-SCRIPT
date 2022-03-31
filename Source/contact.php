<?php
include "core.php";
head();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

            <section class="alignleft col-lg-12">
                <div class="title-divider">
                    <h3>Contact</h3>
                    <div class="divider-arrow"></div>
                </div>
                <div class="block-grey">
                    <div class="block-light wrapper">
                            <h3>Social Profiles</h3><br />
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
                            <br /><hr>
                        <h3>Leave Your Message</h3>
						<br />

                        <form id="cform" method="post" action="">
                                    <label for="name"><i class="fa fa-user"></i> Your Name:</label>
                                    <input type="text" name="name" id="name" value="" class="form-control" required />
                                    <br />
									
                                    <label for="email"><i class="fa fa-envelope"></i> Your E-Mail Address:</label>
                                    <input type="email" name="email" id="email" value="" class="form-control" required />
                                    <br />
									
                                    <div style="display:none;">
                                        <label for="dontfill">Do NOT fill:</label>
                                        <input type="text" name="dontfill" id="dontfill" value="" />
                                    </div>

                                    <label for="input-message"><i class="fa fa-file-text-o"></i> Your Message:</label>
                                    <textarea name="text" id="input-message" rows="10" class="form-control" required></textarea>

									<br />
                                    <input type="submit" name="send" class="btn btn-primary btn-block" value="Send" />
                        </form><br />
<?php
if (isset($_POST['send'])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $content = $_POST['text'];
    $spam    = $_POST['dontfill'];
    
    $date = date('d F Y');
    $time = date('H:i');
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger">The entered E-Mail Address is invalid</div>';
    } else {
        if ($spam) { // Honeypot - Stop spam bots
            exit("Spam Detected");
        } else {
            $query = mysqli_query($connect, "INSERT INTO messages (name,email,content,date,time) VALUES('$name','$email','$content','$date','$time')");
            echo '<div class="alert alert-success">Your message has been sent successfully</div>';
        }
    }
}
?>
                    </div>
			    </div>
			</section>

			</div>
<?php
sidebar();
footer();
?>