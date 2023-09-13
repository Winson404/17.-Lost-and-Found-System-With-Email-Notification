<title>CCP SO System | Employee Info</title>
<?php 

    include 'navbar.php';
    if(isset($_GET['user_Id'])) {
    $id = $_GET['user_Id'];
    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($fetch);

?>


  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Employee Info</li>
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
                <div class="row d-flex justify-content-center mb-3">
                  <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="150" height="150" class="img-circle">
                </div>
                  <div class="row">
                       
                    <div class="col-lg-6">
                       <div class="form-group">
                          <span class="text-dark"><b>Employee Number</b></span>
                          <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['employeeNumber']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>

                    <div class="col-lg-3">
                        <div class="form-group">
                          <span class="text-dark"><b>First name</b></span>
                          <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['firstname']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                          <span class="text-dark"><b>Middle name</b></span>
                          <input type="text" class="form-control"  placeholder="Middle name" name="middlename" required onkeyup="lettersOnly(this)" value="<?php echo $row['middlename']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                          <span class="text-dark"><b>Last name</b></span>
                          <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lastname']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <span class="text-dark"><b>Suffix name</b></span>
                        <input type="text" class="form-control"  placeholder="Jr./Sr." name="suffix" value="<?php echo $row['suffix']; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <span class="text-dark"><b>Gender</b></span>
                        <select class="form-control" name="gender" required disabled>
                          <option selected disabled value="">Select gender</option>
                          <option value="Male"   <?php if($row['gender'] == 'Male') { echo 'selected'; } ?>>Male</option>
                          <option value="Female" <?php if($row['gender'] == 'Female') { echo 'selected'; } ?>>Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <span class="text-dark"><b>Date of Birth</b></span>
                          <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="txtbirthdate" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);" onchange="getAgeVal(0);" value="<?php echo $row['dob']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                          <span class="text-dark"><b>Age</b></span>
                          <input type="text" class="form-control" placeholder="Select DOB first" required id="txtage" readonly value="<?php echo $row['age']; ?>" readonly>
                          <input type="hidden" class="form-control" name="age" placeholder="Age" required id="agestatus" value="<?php echo $row['age']; ?>">
                        </div>
                    </div>
                    <div class="col-auto form-group col-lg-3">
                        <span class="text-dark"><b>Contact number</b></span>
                        <div class="input-group">
                          <div class="input-group-text">+63</div>
                          <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10" value="<?php echo $row['contact']; ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group">
                            <span class="text-dark"><b>Email address</b></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder = "email@gmail.com" required onkeydown="validation()" onkeyup="validation()" value="<?php echo $row['email']; ?>" readonly>
                            <small id="text" style="font-style: italic;"></small>
                          </div>
                      </div>

                    <div class="col-lg-8">
                        <div class="form-group">
                          <span class="text-dark"><b>Address</b></span>
                          <input type="text" class="form-control"  placeholder="Address" name="address" required value="<?php echo $row['address']; ?>" readonly>
                        </div>
                    </div>
                    
                  </div>    
              </div>
              <div class="modal-footer alert-light">
                <a href="employee.php" class="btn btn-secondary"><i class="fa-solid fa-circle-left"></i> Back to List</a>
                <a href="employee_update.php?user_Id=<?php echo $row['user_Id']; ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
              </div>

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
