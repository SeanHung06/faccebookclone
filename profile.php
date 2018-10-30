<?php require_once "functions.php"; ?>
<?php include "header.php" ?>
<?php 
	check_auth();
	db_connect();

	$sql = "SELECT id, username, status, profile_image_url, location FROM users WHERE username = 'asd'";
	$statement = $conn->query($sql);
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
			<?php
				if ($statement->num_rows > 0) {	
				while($users = $statement->fetch_assoc()) {

				?>
       <div class="media-body">
          <h2 class="media-heading">User:<?php echo $users['username']; ?></h2>
					<p>
					<p> 
          <p>Status:<?php echo $users['status']; ?>, Location: <?php echo $users['location']; 


				}
			}
?></p>
        </div>
      </div>
		  <!-- user profile -->
      <hr>

      <!-- timeline -->
      <div>
        <!-- post -->
				<?php 
					$post_sql = "SELECT * FROM posts WHERE user_id = 12";
					$result1 = $conn->query($post_sql);
					echo $users['id']; 			
					if($result1->num_rows > 0){
						while($post = $result1->fetch_assoc()){
						?>	
					
        		<div class="panel panel-default">
          		<div class="panel-body">
            		<p><?php echo $post['content']; ?></p>
          		</div>
          		<div class="panel-footer">
							<?php 
/*								$sql = "SELECT username FROM users WHERE id = ? LIMIT 1";
								$statement1 = $conn->prepare($sql);
								$statement1->bind_param('i',$post['user_id']);
								$statement1->execute();
								$statement1->store_result();
								$statement1->bind_result($post_author);
								$statement1->fetch();
	*/	
							
						//		while($users = $statement->fetch_assoc()) {
								?>
						<span>posted <?php echo $post['create_at']; ?> by <?php echo $username; ?></span> 
						<span class="pull-right"><a class="text-danger" href="php/delete-post.php?id=<?php echo $post['id']; ?>">[delete]</a></span>
					</div>
        </div>
				
			<?php 
					} 
			}
			else{
			echo "E";
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











	 
