<?php
if (session_status() == PHP_SESSION_NONE) 
{    
	session_start(); 
}
?>
	<h3>Create a post</h3>
		<form action="info.php" method="post" enctype="multipart/form-data">
			<textarea id="post_message" name="post_message" rows="20" cols="40" value=""></textarea>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<p><input type="submit" name="submit" value="Post" /></p>
		</form>
	<?php
		
		$error_msg = "";
		
		function prepare_input($data){
			$data = trim($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$errors = array();
			
			if 	(empty($_POST["post_message"])) {
				array_push($errors, "It seems you forgot to write something in your post.");
			}
			else { 
				$post_message =  prepare_input($_POST["post_message"]);		
			}
			
			$e = $_SESSION['email'];
			$id = $_SESSION['user_id'];
				
			if(empty($errors)){
				require_once ('connect.php'); // Connect to the db
				
				$target_dir = "uploads/";
				$target_name = "$id" . "_" . basename($_FILES["fileToUpload"]["name"]);
				$target_file = $target_dir . $target_name;
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						$uploadOk = 1;
					}
					else {
						array_push($errors, "File is not an image, unable to upload. ");
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					array_push($errors, "Sorry, file already exists - cannot upload. ");
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 2048000) {
					array_push($errors, "Sorry, your file is too large, file must be less than or equal to 2MB. ");
					$uploadOk = 0;
				}	
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ");
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					array_push($errors, "Sorry, your file was not uploaded.");
					// if everything is ok, try to upload file
				}
				else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$q = "SELECT * FROM picture WHERE picture_name='$target_name'";
						$r = @mysqli_query($dbc, $q);
						if (mysqli_num_rows($r) == 0) {
							$q = "INSERT INTO picture (picture_name, picture_address) VALUES ('$target_name', '$target_file')";
							$r = @mysqli_query ($dbc, $q); // Run the query.
								if ($r) { // If it ran OK.
									echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
								}
						}
					}
					else {
						array_push($errors, "Sorry, there was an error uploading your file.");
					}
				}
				$qid = "SELECT picture_id FROM picture WHERE picture_address='$target_file'";
				$result = @mysqli_query($dbc, $qid);
				$row = mysqli_fetch_assoc($result);
				$pic_id = $row['picture_id'];
				$q = "SELECT user_id, post_message FROM post, picture WHERE post.picture_id=picture.picture_id AND picture.picture_id='$pic_id'";
				$r = @mysqli_query($dbc, $q);
					if (mysqli_num_rows($r) == 0) {
						$q = "INSERT INTO post (user_id, comment_id, post_message, like_id, post_date, picture_id) VALUES ('$id', '', '$post_message', '', NOW(), '$pic_id')";
						print_r($q);
						$r = @mysqli_query ($dbc, $q); // Run the query.
						if ($r) { // If it ran OK.
							echo "Your message has been posted.";
						}
					}
			}
			else{
				foreach($errors as $error){
					$error_msg = $error_msg  . $error . "<br />";
				}
			}	
			
		}
	?>