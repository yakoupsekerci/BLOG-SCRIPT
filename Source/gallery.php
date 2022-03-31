<?php
include "core.php";
head();
?>
<section id="container">
    <div class="container">
	<div class="col-md-12">
        <div class="title-divider">
            <h3>Gallery</h3>
            <div class="divider-arrow"></div>
        </div>

        <div class="clear"></div>
        <section class="row">
<?php
$run   = mysqli_query($connect, "SELECT * FROM `gallery` WHERE active='Yes' ORDER BY id DESC");
$count = mysqli_num_rows($run);
if ($count <= 0) {
    echo '<br><br><br><center>There are no uploaded images</center><br>';
} else {
    while ($row = mysqli_fetch_assoc($run)) {
        echo '
            <div data-toggle="modal" data-target="#' . $row['id'] . '" class="col-md-4">
			<div class="well">
                <figure>
                    <figcaption><h4>' . $row['title'] . '</h4></figcaption>
                    <img src="' . $row['image'] . '" width="100%" height="210px" />
                </figure>
			</div>
            </div>
			
			<div class="modal fade" id="' . $row['id'] . '" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg">
 			   <div class="modal-content">
 			     <div class="modal-header">
 			       <button type="button" class="close" data-dismiss="modal"><span><i class="fa fa-window-close"></i> </span><span class="sr-only">Close</span></button>
 			       <h4 class="modal-title" id="myModalLabel">' . $row['title'] . '</h4>
 			     </div>
			      <div class="modal-body">
				      <img src="' . $row['image'] . '" width="100%" height="auto" /><br /><br />
				      ' . $row['description'] . '
				  </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			      </div>
			    </div>
			  </div>
			</div>
';
    }
}
?>
        </section>
    </div>
	</div>
</section>

<?php
footer();
?>