<?php 
	include '../config.php';


	// SAVE LOST ITEM - LOSTFOUND_ADD.PHP
	if(isset($_POST['create_item'])) {

		$reporterId    = mysqli_real_escape_string($conn, $_POST['reporterId']);
		$ownername     = mysqli_real_escape_string($conn, $_POST['ownername']);
		$contact       = mysqli_real_escape_string($conn, $_POST['contact']);
		$datelost      = mysqli_real_escape_string($conn, $_POST['datelost']);
		$itemname      = mysqli_real_escape_string($conn, $_POST['itemname']);
		$description   = mysqli_real_escape_string($conn, $_POST['description']);
		$file          = basename($_FILES["fileToUpload"]["name"]);
		$date_registered = date('F d, Y');

	  		// Check if image file is a actual image or fake image
        $target_dir = "../images-item/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check == false) {
	    $_SESSION['message']  = "File is not an image.";
	    $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: lostFound_add.php");
    	 $uploadOk = 0;
   	 } 

	// Check file size // 500KB max size
	// elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	//   	$_SESSION['message']  = "File must be up to 500KB in size.";
	//     $_SESSION['text'] = "Please try again.";
	//     $_SESSION['status'] = "error";
	// 		header("Location: lostFound_add.php");
    	// $uploadOk = 0;
	// }

        // Allow certain file formats
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: lostFound_add.php");
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0) {
        $_SESSION['message'] = "Your file was not uploaded.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: lostFound_add.php");
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           	

            	$save = mysqli_query($conn, "INSERT INTO lost_found (itemName, description, itemImage, itemOwner, ownerContact, dateLost, dateReported, reporterId) VALUES ('$itemname', '$description', '$file', '$ownername', '$contact', '$datelost', '$date_registered', '$reporterId')");

                  if($save) {
				          	$_SESSION['message'] = "New Item lost has been saved!";
				            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
										header("Location: lostFound_add.php");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
										header("Location: lostFound_add.php");
				          }
            } else {
                  $_SESSION['message'] = "There was an error uploading your file.";
			            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header("Location: lostFound_add.php");
            }
			 }

	}
?>