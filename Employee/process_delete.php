<?php 
	include '../config.php';

	// DELETE ITEM - LOSTFOUND_DELETE.PHP
	if(isset($_POST['delete_item'])) {
		$Id = $_POST['Id'];

		$delete = mysqli_query($conn, "DELETE FROM lost_found WHERE Id='$Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Item lost record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: lostFound.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: lostFound.php");
	      }
	}


?>
