<?php
if (session_status() == PHP_SESSION_NONE) 
{    
	session_start(); 
}


	require_once ('connect.php'); // Connect to the db
		
	$e = $_SESSION['email'];
	$id = $_SESSION['user_id'];
	
	$q = "SELECT * FROM user_info WHERE user_id=$id";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_assoc($r);
	$pic_id = $row['picture_id'];
	$nickname = $row['nickname'];
	
	if($pic_id == NULL){
		echo '<img class="profilePic" src="profilePictures/default.jpg" alt="profilePic">';
		echo "<h3>$nickname</h3>";
	}
	else{
		$q = "SELECT * FROM picture WHERE picture_id=$pic_id";
		$r = @mysqli_query($dbc, $q);
		$row = mysqli_fetch_assoc($r);
		$imageFileType = pathinfo(($row['picture_address']),PATHINFO_EXTENSION);
		$target = $row['picture_address'] . $imageFileType;
		echo '<img class="profilePic" src="'.$target.'" alt="profilePic">';
		echo "<h3>$nickname</h3>";
	}
	/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
		if(empty($errors)){
			
			$target_dir = "uploads/";
			$target_name = "$id" . "_" . basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . $target_name;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			// Check if image file is a actual image or fake image
			if(isset($_POST["fileToUpload"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				}
				else {
					array_push($errors, "File is not an image, unable to upload. ");
					$uploadOk = 0;
				}
			}
			
			// Check if file already exists -- if it exists, update picture_id in user_info table
			if (file_exists($target_file)) {
				$q = "SELECT * FROM picture WHERE picture_name='$target_name'";
				$r = @mysqli_query($dbc, $q);
				if($r){
					$q = "SELECT picture_id FROM picture WHERE picture_address='$target_file'";
					$r = @mysqli_query($dbc, $q);
					$row = mysqli_fetch_assoc($r);
					$pic_id = $row['picture_id'];
					$q = "UPDATE user_info SET picture_id='$pic_id'";
					$r = @mysqli_query($dbc, $q);
					if($r){
						echo "Your profile picture was updated";
					}
				}
			}
			
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 2048000) {
				array_push($errors, "Sorry, your picture is too large, picture must be less than or equal to 2MB. ");
				$uploadOk = 0;
			}	
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ");
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				array_push($errors, "Sorry, your picture was not uploaded.");
			
				// If everything is ok and file does not exist in folder, try to upload file
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
							$q = "SELECT picture_id FROM picture WHERE picture_address='$target_file'";
							$r = @mysqli_query($dbc, $q);
							$row = mysqli_fetch_assoc($r);
							$pic_id = $row['picture_id'];
							$q = "SELECT user_id FROM user_info, picture WHERE user_info.picture_id=picture.picture_id AND picture.picture_id='$pic_id'";
							$r = @mysqli_query($dbc, $q);
							if (mysqli_num_rows($r) == 0) {
								$q = "INSERT INTO user_info (picture_id) VALUES ('$pic_id') WHERE user_id=$id";
								$r = @mysqli_query ($dbc, $q); // Run the query.
								if ($r) { // If it ran OK.
									echo "Your picture has been uploaded.";
								}
							}
						}
					}
				}
				else {
					array_push($errors, "Sorry, there was an error uploading your picture.");
				}
			
			
			} 
		}
		else{
			foreach($errors as $error){
				$error_msg = $error_msg  . $error . "<br />";
			}
		}	
		
	}*/
	
	
?>