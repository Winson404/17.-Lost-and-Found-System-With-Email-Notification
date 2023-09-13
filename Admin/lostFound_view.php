<title>CCP SO System | Lost item details</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['Id'])) {
      $id = $_GET['Id'];
      $select = mysqli_query($conn, "SELECT * FROM lost_found  JOIN users ON lost_found.reporterId=users.user_Id WHERE Id='$id'");
      $row = mysqli_fetch_array($select);
?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lost item details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Lost item details</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="card-tools mr-1 p-2">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                <form action="process_update.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12 mb-5 d-flex justify-content-center">
                      <img src="../images-item/<?php echo $row['itemImage']; ?>" alt="" width="500">
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-dark"><b>Name of the Owner</b></span>
                          <input type="text" class="form-control"  placeholder="Name of the Owner" name="ownername" required value="<?php echo $row['itemOwner']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-dark"><b>Ownder contact details(Contact no./ Email)</b></span>
                          <input type="text" class="form-control"  placeholder="Ownder contact details" name="contact" required value="<?php echo $row['ownerContact']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <span class="text-dark"><b>Date lost</b></span>
                          <input type="date" class="form-control"  placeholder="Date lost" name="datelost" required value="<?php echo $row['dateLost']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                          <span class="text-dark"><b>Item name</b></span>
                          <input type="text" class="form-control"  placeholder="First name" name="itemname" required value="<?php echo $row['itemName']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                          <span class="text-dark"><b>Description of the item</b></span>
                          <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Description of the item" readonly><?php echo $row['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-dark"><b>Reported by</b></span>
                          <h5><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?>
                          <br>
                          <span class="text-sm"><?php echo $row['dateReported']; ?></span></h5>

                        </div>
                    </div>
                   
                    
                  </div>    
              </div>
              <div class="modal-footer alert-light">
                <a href="lostFound.php" class="btn btn-secondary"><i class="fa-solid fa-circle-left"></i> Back to List</a>
                <a href="lostFound_update.php?Id=<?php echo $row['Id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Edit</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  <?php } else { include '404.php'; } ?>

  </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php include 'footer.php'; ?>
