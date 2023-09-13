<?php 

	include 'config.php';

// ****************************************************************LOGIN**********************************************************************************
	
	// USERS LOGIN
	if(isset($_POST['login'])) {
		$idnumber    = $_POST['idnumber'];
		$password = md5($_POST['password']);

		$check = mysqli_query($conn, "SELECT * FROM users WHERE Id_Number='$idnumber' AND password='$password' AND user_type='User'");
		if(mysqli_num_rows($check)===1) {
				// LOGIN USING STUDENT ID NUMBER
				$row = mysqli_fetch_array($check);
				$user_type = $row['user_type'];
				if($user_type == 'User') {
						$_SESSION['student_Id'] = $row['user_Id'];
						header("Location: Student/dashboard.php");
				} else {
						$_SESSION['message'] = "Incorrect password.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: login.php");
				}

		} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE employeeNumber='$idnumber' AND password='$password' AND user_type='Employee'");
				if(mysqli_num_rows($check)===1) {
						// LOGIN USING EMPLOYEE ID NUMBER
						$row = mysqli_fetch_array($check);
						$user_type = $row['user_type'];
						if($user_type == 'Employee') {
								$_SESSION['employee_Id'] = $row['user_Id'];
								header("Location: Employee/dashboard.php");
						} else {
								$_SESSION['message'] = "Incorrect password.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
								header("Location: login.php");
						}

				} else {
						$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$idnumber' AND password='$password' AND user_type='Admin'");
						if(mysqli_num_rows($check)===1) {
								// LOGIN USING EMAIL
								$row = mysqli_fetch_array($check);
								$user_type = $row['user_type'];
								if($user_type == 'Admin') {
										$_SESSION['admin_Id'] = $row['user_Id'];
										header("Location: Admin/dashboard.php");
								} else {
										$_SESSION['message'] = "Incorrect password.";
								    $_SESSION['text'] = "Please try again.";
								    $_SESSION['status'] = "error";
										header("Location: login.php");
								}

						} else {
								$_SESSION['message'] = "Incorrect password.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
								header("Location: login.php");
						}
				}
		}
	}
// ****************************************************************END LOGIN******************************************************************************




	// SAVE USERS
	if(isset($_POST['create_user'])) {
		$idnumber        = mysqli_real_escape_string($conn, $_POST['idnumber']);
		$level           = mysqli_real_escape_string($conn, $_POST['level']);
		$course          = mysqli_real_escape_string($conn, $_POST['course']);
		$firstname       = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename      = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname        = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix          = mysqli_real_escape_string($conn, $_POST['suffix']);
		$gender          = mysqli_real_escape_string($conn, $_POST['gender']);
		$dob             = mysqli_real_escape_string($conn, $_POST['dob']);
		$age             = mysqli_real_escape_string($conn, $_POST['age']);
		$contact         = mysqli_real_escape_string($conn, $_POST['contact']);
		$email           = mysqli_real_escape_string($conn, $_POST['email']);
		$address         = mysqli_real_escape_string($conn, $_POST['address']);
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE Id_Number='$idnumber' || employeeNumber='$idnumber'");
		if(mysqli_num_rows($check_email)>0) {
		      $_SESSION['message'] = "Someone else already owns this ID number.";
		      $_SESSION['text'] = "Please try again.";
		      $_SESSION['status'] = "error";
			header("Location: register_student.php");
		} else {

			$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if(mysqli_num_rows($check) > 0) {
					$_SESSION['message'] = "Email has already been taken.";
				      $_SESSION['text'] = "Please try again.";
				      $_SESSION['status'] = "error";
					header("Location: register_student.php");
			} else {


	  		// Check if image file is a actual image or fake image
        $target_dir = "images-users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: register_student.php");
			    	$uploadOk = 0;
			    } 

				// Check file size // 5MB max size
				elseif ($_FILES["fileToUpload"]["size"] > 5000000) {
				  	$_SESSION['message']  = "File must be up to 5MB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: register_student.php");
			    	$uploadOk = 0;
				}
  
        // Allow certain file formats
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: register_student.php");
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0) {
        $_SESSION['message'] = "Your file was not uploaded.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: register_student.php");
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           	
            	$save = mysqli_query($conn, "INSERT INTO users (Id_Number, course, level, firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$idnumber', '$level', '$course', '$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                  if($save) {
				          	$_SESSION['message'] = "Registration successful. Please login";
				            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
										header("Location: login.php");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
										header("Location: register_student.php");
				          }
            } else {
                  $_SESSION['message'] = "There was an error uploading your file.";
			            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header("Location: register_student.php");
            }
			 }
			}

		}

	}










	// SAVE EMPLOYEE - EMPLOYEE_ADD.PHP
	if(isset($_POST['create_employee'])) {
		$user_type	     = "Employee";
		$employeeNumber  = mysqli_real_escape_string($conn, $_POST['employeeNumber']);
		$firstname       = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename      = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname        = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix          = mysqli_real_escape_string($conn, $_POST['suffix']);
		$gender          = mysqli_real_escape_string($conn, $_POST['gender']);
		$dob             = mysqli_real_escape_string($conn, $_POST['dob']);
		$age             = mysqli_real_escape_string($conn, $_POST['age']);
		$contact         = mysqli_real_escape_string($conn, $_POST['contact']);
		$email           = mysqli_real_escape_string($conn, $_POST['email']);
		$address         = mysqli_real_escape_string($conn, $_POST['address']);
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
      $_SESSION['message'] = "Email is already taken.";
      $_SESSION['text'] = "Please try again.";
      $_SESSION['status'] = "error";
			header("Location: register_employee.php");
		} else {

		$check_ID = mysqli_query($conn, "SELECT * FROM users WHERE employeeNumber='$employeeNumber' || Id_Number='$employeeNumber'");
		if(mysqli_num_rows($check_ID) > 0) {
			$_SESSION['message'] = "Someone has already owned this Employee number";
		      $_SESSION['text'] = "Please try again.";
		      $_SESSION['status'] = "error";
			header("Location: register_employee.php");
		} else {


	  		// Check if image file is a actual image or fake image
        $target_dir = "images-users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: register_employee.php");
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: register_employee.php");
			    	$uploadOk = 0;
				}
  
        // Allow certain file formats
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: register_employee.php");
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0) {
        $_SESSION['message'] = "Your file was not uploaded.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
				header("Location: register_employee.php");
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           	
            	$save = mysqli_query($conn, "INSERT INTO users (employeeNumber, firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, user_type, date_registered) VALUES ('$employeeNumber', '$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file', '$user_type', '$date_registered')");

                  if($save) {
				          	$_SESSION['message'] = "Registration successful. Please login.";
				            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
										header("Location: login.php");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
										header("Location: register_employee.php");
				          }
            } else {
                  $_SESSION['message'] = "There was an error uploading your file.";
			            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
									header("Location: register_employee.php");
            }
			 }
		}

		}

	}




?>