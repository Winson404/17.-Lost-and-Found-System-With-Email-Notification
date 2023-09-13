<?php 
		include '../config.php';

	  use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require '../vendor/PHPMailer/src/Exception.php';
		require '../vendor/PHPMailer/src/PHPMailer.php';
		require '../vendor/PHPMailer/src/SMTP.php';

	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if(isset($_POST['update_profile'])) {

		$user_Id    = $_POST['user_Id'];
		$course			= mysqli_real_escape_string($conn, $_POST['course']);
		$firstname  = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname   = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix     = mysqli_real_escape_string($conn, $_POST['suffix']);
		$gender     = mysqli_real_escape_string($conn, $_POST['gender']);
		$dob        = mysqli_real_escape_string($conn, $_POST['dob']);
		$age        = mysqli_real_escape_string($conn, $_POST['age']);
		$contact    = mysqli_real_escape_string($conn, $_POST['contact']);
		$email      = mysqli_real_escape_string($conn, $_POST['email']);
		$address    = mysqli_real_escape_string($conn, $_POST['address']);

		$fetch        = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id' ");
		$row          = mysqli_fetch_array($fetch);
		$get_email    = $row['email'];

		if($email == $get_email) {
				$save = mysqli_query($conn, "UPDATE users SET course='$course', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE user_Id='$user_Id'");
		    if($save) {
		          $_SESSION['message']  = "Your information has been updated!";
		          $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
							header("Location: profile.php");                          
		    } else {
		          $_SESSION['message'] = "Something went wrong while saving the information.";
		          $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
							header("Location: profile.php");
		    }
		} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
							$_SESSION['message'] = "Email is already taken.";
	            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
							header("Location: profile.php"); 
				} else {
					  $save = mysqli_query($conn, "UPDATE users SET course='$course', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE user_Id='$user_Id'");
				    if($save) {
				          $_SESSION['message']  = "Your information has been updated!";
				          $_SESSION['text'] = "Updated successfully!";
					        $_SESSION['status'] = "success";
									header("Location: profile.php");                          
				    } else {
				          $_SESSION['message'] = "Something went wrong while saving the information.";
				          $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header("Location: profile.php");
				    }
				}
		}
	}


	// CHANGE ADMIN PASSWORD - PROFILE.PHP
	if(isset($_POST['update_password_admin'])) {

    	$user_Id    = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['message']  = "Password does not matched. Please try again";
		            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
								header("Location: profile.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");

			    			if($update_password) {
                	$_SESSION['message'] = "Password has been changed.";
			            $_SESSION['text'] = "Updated successfully!";
					        $_SESSION['status'] = "success";
									header("Location: profile.php");
                } else {
                  $_SESSION['message'] = "Something went wrong while changing the password.";
			            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header("Location: profile.php");
                }
		    		}
    	} else {
    				$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
						header("Location: profile.php");
    	}

    }




  // UPDATE ADMIN PROFILE - PROFILE.PHP
	if(isset($_POST['update_profile_admin'])) {

		$user_Id    = $_POST['user_Id'];
		$file       = basename($_FILES["fileToUpload"]["name"]);

		  // Check if image file is a actual image or fake image
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		  if($check == false) {
		    $_SESSION['message']  = "Selected file is not an image.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: profile.php");
	    	$uploadOk = 0;
	    } 

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			  	$_SESSION['message']  = "File must be up to 500KB in size.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
					header("Location: profile.php");
		    	$uploadOk = 0;
			}

	    // Allow certain file formats
	    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		    $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: profile.php");
	    	$uploadOk = 0;
	    }

	    // Check if $uploadOk is set to 0 by an error
	    elseif ($uploadOk == 0) {
		    $_SESSION['message']  = "Your file was not uploaded.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: profile.php");

	    // if everything is ok, try to upload file
	    } else {

	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	          	$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	     
	            if($save) {
	            	$_SESSION['message'] = "Profile picture has been updated!";
		            $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
								header("Location: profile.php");
	            } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
								header("Location: profile.php");
	            }
	        } else {
	            $_SESSION['message'] = "There was an error uploading your file.";
	            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
							header("Location: profile.php");
	        }

		}
	}



	// UPDATE LOST ITEM - LOSTFOUND_UPDATE.PHP
	if(isset($_POST['update_item'])) {

		$itemId        = mysqli_real_escape_string($conn, $_POST['itemId']);
		$ownername     = mysqli_real_escape_string($conn, $_POST['ownername']);
		$contact       = mysqli_real_escape_string($conn, $_POST['contact']);
		$datelost      = mysqli_real_escape_string($conn, $_POST['datelost']);
		$itemname      = mysqli_real_escape_string($conn, $_POST['itemname']);
		$description   = mysqli_real_escape_string($conn, $_POST['description']);
		$file          = basename($_FILES["fileToUpload"]["name"]);
		$date_registered = date('Y-m-d');

	  		
	  if(empty($file)) {
	  	$save = mysqli_query($conn, "UPDATE lost_found SET itemName='$itemname', description='$description', itemOwner='$ownername', ownerContact='$contact', dateLost='$datelost' WHERE Id='$itemId' ");

                  if($save) {
				          	$_SESSION['message'] = "Item lost has been updated!";
				            $_SESSION['text'] = "Updated successfully!";
						        $_SESSION['status'] = "success";
										header('Location: lostFound_update.php?Id='.$itemId.'');
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
										header('Location: lostFound_update.php?Id='.$itemId.'');
				          }
	  } else {
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
						header('Location: lostFound_update.php?Id='.$itemId.'');
			    	 $uploadOk = 0;
   	 		} 

	// Check file size // 500KB max size
	// elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	//   	$_SESSION['message']  = "File must be up to 500KB in size.";
	//     $_SESSION['text'] = "Please try again.";
	//     $_SESSION['status'] = "error";
	// 		header('Location: lostFound_update.php?Id='.$itemId.'');
    	// $uploadOk = 0;
	// }

        // Allow certain file formats
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header('Location: lostFound_update.php?Id='.$itemId.'');
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0) {
        $_SESSION['message'] = "Your file was not uploaded.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header('Location: lostFound_update.php?Id='.$itemId.'');
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           	

            	$save = mysqli_query($conn, "UPDATE lost_found SET itemName='$itemname', description='$description', itemImage='$file', itemOwner='$ownername', ownerContact='$contact', dateLost='$datelost' WHERE Id='$itemId' ");

                  if($save) {
				          	$_SESSION['message'] = "Item lost has been updated!";
				            $_SESSION['text'] = "Updated successfully!";
						        $_SESSION['status'] = "success";
										header('Location: lostFound_update.php?Id='.$itemId.'');
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
										header('Location: lostFound_update.php?Id='.$itemId.'');
				          }
            } else {
                  $_SESSION['message'] = "There was an error uploading your file.";
			            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header('Location: lostFound_update.php?Id='.$itemId.'');
            }
			 }
	  }

	}




	// FOUND ITEM - LOSTFOUND_DELETE.PHP
	if(isset($_POST['found_item'])) {
		$Id = $_POST['Id'];

		$delete = mysqli_query($conn, "UPDATE lost_found SET itemStatus=1 WHERE Id='$Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Item lost has been set to found status!";
	        $_SESSION['text'] = "Updated successfully!";
	        $_SESSION['status'] = "success";
			header("Location: lostFound.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: lostFound.php");
	      }
	}



// STILL NOT FOUND ITEM - LOSTFOUND_DELETE.PHP
	if(isset($_POST['lost_item'])) {
		$Id = $_POST['Id'];

		$delete = mysqli_query($conn, "UPDATE lost_found SET itemStatus=0 WHERE Id='$Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Item lost has been set back to lost status!";
	        $_SESSION['text'] = "Updated successfully!";
	        $_SESSION['status'] = "success";
			header("Location: lostFound.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: lostFound.php");
	      }
	}



	// STILL NOT FOUND ITEM - LOSTFOUND_DELETE.PHP
	if(isset($_POST['return_item'])) {
		$Id = $_POST['Id'];

		$delete = mysqli_query($conn, "UPDATE lost_found SET itemStatus=2 WHERE Id='$Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Item lost has been set to returned status!";
	        $_SESSION['text'] = "Returned successfully!";
	        $_SESSION['status'] = "success";
			header("Location: lostFound.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: lostFound.php");
	      }
	}




	// FOUND ITEM - DISPLAY_FOUND.PHP
	if(isset($_POST['display_found'])) {
		$found_Id = $_POST['found_Id'];

		$delete = mysqli_query($conn, "UPDATE lost_found SET itemStatus=1 WHERE Id='$found_Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Item lost has been set to found status!";
	        $_SESSION['text'] = "Updated successfully!";
	        $_SESSION['status'] = "success";
			header("Location: display.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: display.php");
	      }
	}


?>