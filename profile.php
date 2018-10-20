<?php require_once "functions.php"; ?>
<?php include "header.php" ?>
<?php 
	check_auth();
	db_connect();

	$sql = "SELECT id, username,status,profile_image_url,location FROM users WHERE username = ?";
	$statement = $conn->prepare($sql);
	$statement->bind_param('s',$_GET['username']);
 	$statement->execute();
	$statement->store_result();
	$statement->bind_result($id,$username,$status,$profile_image_url,$location);
	$statement->fetch();

?>
<!-- main -->
<main class="container">
  <div class="row">
    <div class="col-md-3">
      <!-- edit profile -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>Edit profile</h4>
          <form method="post" action="php/edit-profile.php">
            <div class="form-group">
              <input class="form-control" type="text" name="status" placeholder="Status" value="">
            </div>

            <div class="form-group">
              <input class="form-control" type="text" name="location" placeholder="Location" value="">
            </div>

            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="update_profile" value="Save">
            </div>
          </form>
        </div>
      </div>
      <!-- ./edit profile -->
    </div>
    <div class="col-md-6">
      <!-- user profile -->
      <div class="media">
        <div class="media-left">
          <img src="img/my_avatar.png" class="media-object" style="width: 128px; height: 128px;">
        </div>

       <div class="media-body">
          <h2 class="media-heading"><?php echo $username; ?></h2>
          <p>Status:<?php echo $status; ?>, Location: <?php echo $location; ?></p>
        </div>
      </div>
		  <!-- user profile -->
      <hr>

      <!-- timeline -->
      <div>
        <!-- post -->
				<?php 
					$post_sql = "SELECT * FROM posts";
					$result = $conn->query($post_sql);
					echo "EE" ; 					
					if($result->num_rows > 0){
						while($post = $result->fetch_assoc()){
						?>	
					
        		<div class="panel panel-default">
          		<div class="panel-body">
            		<p><?php echo $post['content']; ?></p>
          		</div>
          		<div class="panel-footer">
							<?php 
								$sql = "SELECT * FROM posts ";

								
								$statement = $conn->prepare($sql);
								$statement->bind_param('i',$post['user_id']);
								$statement->execute();
								$statement->store_result();
								$statement->bind_result($post_author);
								$statement->fetch();
							?>
						<span>posted <?php echo $post['create_at']; ?> by <?php echo $username; ?></span> 
						<span class="pull-right"><a class="text-danger" href="php/delete-post.php?id=<?php echo $post['id']; ?>">[delete]</a></span>
					</div>
        </div>
				
			<?php } 
			}
			?>
			
        <!-- ./post -->
      </div>
      <!-- ./timeline -->
    </div>
    <div class="col-md-3">
      <!-- friends -->
      <div class="panel panel-default">
        <div class="panel-body">
          <h4>Friends</h4>
          <ul>
            <li>
              <a href="#">peterpan</a> 
              <a class="text-danger" href="#">[unfriend]</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- ./friends -->
    </div>
  </div>
</main>

	<?php include "footer.php" ?>











	 
