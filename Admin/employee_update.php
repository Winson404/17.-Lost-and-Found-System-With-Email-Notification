<title>CCP SO System | Update Employee</title>
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
            <h1>Update Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Update Employee</li>
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
                  <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="user_Id">
                  <div class="row">
                    <div class="col-lg-6 mb-3">
                      <div class="form-group">
                          <span class="text-dark"><b>Employee number</b></span>
                          <?php if($row['employeeNumber'] != ''): ?>
                          <input type="number" class="form-control"  placeholder="Employee number" name="employeeNumber" required value="<?php echo $row['employeeNumber']; ?>" readonly>
                          <?php else: ?>
                            <input type="number" class="form-control"  placeholder="Employee number" name="employeeNumber" required value="<?php echo $row['employeeNumber']; ?>">
                          <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                          <span class="text-dark"><b>First name</b></span>
                          <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['firstname']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                          <span class="text-dark"><b>Middle name</b></span>
                          <input type="text" class="form-control"  placeholder="Middle name" name="middlename" required onkeyup="lettersOnly(this)" value="<?php echo $row['middlename']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                          <span class="text-dark"><b>Last name</b></span>
                          <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lastname']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <span class="text-dark"><b>Suffix name</b></span>
                        <input type="text" class="form-control"  placeholder="Jr./Sr." name="suffix" value="<?php echo $row['suffix']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <span class="text-dark"><b>Gender</b></span>
                        <select class="form-control" name="gender" required>
                          <option selected disabled value="">Select gender</option>
                          <option value="Male"   <?php if($row['gender'] == 'Male') { echo 'selected'; } ?>>Male</option>
                          <option value="Female" <?php if($row['gender'] == 'Female') { echo 'selected'; } ?>>Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <span class="text-dark"><b>Date of Birth</b></span>
                          <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="txtbirthdate" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);" onchange="getAgeVal(0);" value="<?php echo $row['dob']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                          <span class="text-dark"><b>Age</b></span>
                          <input type="text" class="form-control bg-white" placeholder="Select DOB first" required id="txtage" readonly value="<?php echo $row['age']; ?>">
                          <input type="hidden" class="form-control" name="age" placeholder="Age" required id="agestatus" value="<?php echo $row['age']; ?>">
                        </div>
                    </div>
                    <div class="col-auto form-group col-lg-3">
                        <span class="text-dark"><b>Contact number</b></span>
                        <div class="input-group">
                          <div class="input-group-text">+63</div>
                          <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10" value="<?php echo $row['contact']; ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group">
                            <span class="text-dark"><b>Email address</b></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder = "email@gmail.com" required onkeydown="validation()" onkeyup="validation()" value="<?php echo $row['email']; ?>">
                            <small id="text" style="font-style: italic;"></small>
                          </div>
                      </div>

                    <div class="col-lg-8">
                        <div class="form-group">
                          <span class="text-dark"><b>Address</b></span>
                          <input type="text" class="form-control"  placeholder="Address" name="address" required value="<?php echo $row['address']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-8">
                          <div class="form-group">
                            <span class="text-dark"><b>Image</b></span>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>

                            </div>
                            <!-- <p class="help-block text-danger">Max. 500KB</p> -->
                          </div>
                      </div>
                      <!-- LOAD IMAGE PREVIEW -->
                      <div class="col-lg-4">
                          <div class="form-group" id="preview" required>
                          </div>
                      </div>
                  </div>    
              </div>
              <div class="modal-footer alert-light">
                <a href="employee.php" class="btn btn-secondary"><i class="fa-solid fa-circle-left"></i> Back to List</a>
                <button type="submit" class="btn bg-gradient-primary" name="update_employee"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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
<script>
   function getImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
  }

    function validate_password() {

      var pass = document.getElementById('password').value;
      var confirm_pass = document.getElementById('cpassword').value;
      if (pass != confirm_pass) {
        document.getElementById('wrong_pass_alert').style.color = 'red';
        document.getElementById('wrong_pass_alert').innerHTML = 'X Password did not matched!';
        document.getElementById('create_admin').disabled = true;
        document.getElementById('create_admin').style.opacity = (0.4);
      } else {
        document.getElementById('wrong_pass_alert').style.color = 'green';
        document.getElementById('wrong_pass_alert').innerHTML = '✓ Password matched!';
        document.getElementById('create_admin').disabled = false;
        document.getElementById('create_admin').style.opacity = (1);
      }
    }

    function lettersOnly(input) {
      var regex = /[^a-z ]/gi;
      input.value = input.value.replace(regex, "");
    }


  function validation() {
    var email = document.getElementById("email").value;
    var pattern =/.+@(gmail)\.com$/;
    // var pattern =/.+@(gmail|yahoo)\.com$/;
    var form = document.getElementById("form");

    if(email.match(pattern)) {
        document.getElementById('text').style.color = 'green';
        document.getElementById('text').innerHTML = '';
        document.getElementById('create_admin').disabled = false;
        document.getElementById('create_admin').style.opacity = (1);
    } 
    else {
        document.getElementById('text').style.color = 'red';
        document.getElementById('text').innerHTML = 'Domain must be @gmail.com';
        document.getElementById('create_admin').disabled = true;
        document.getElementById('create_admin').style.opacity = (0.4);
        
    }
  }


// GET AGE AUTOMATICALLY FROM SETTINGS DOB

    function formatDate(date){
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');

    }

    function getAge(dateString){
      var birthdate = new Date().getTime();
      if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
      // variable is undefined or null value
      birthdate = new Date().getTime();
      }
      birthdate = new Date(dateString).getTime();
      var now = new Date().getTime();
      // now find the difference between now and the birthdate
      var n = (now - birthdate)/1000;
      if (n < 604800){ // less than a week
      var day_n = Math.floor(n/86400);
      if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
      // variable is undefined or null
      return '';
      }else{
      return day_n + ' day' + (day_n > 1 ? 's' : '') + ' old';
      }
      } else if (n < 2629743){ // less than a month
      var week_n = Math.floor(n/604800);
      if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
      return '';
      }else{
      return week_n + ' week' + (week_n > 1 ? 's' : '') + ' old';
      }
      } else if (n < 31562417){ // less than 24 months
      var month_n = Math.floor(n/2629743);
      if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
      return '';
      }else{
      return month_n + ' month' + (month_n > 1 ? 's' : '') + ' old';
      }
      }else{
      var year_n = Math.floor(n/31556926);
      if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
      return year_n = '';
      }else{
      return year_n + ' year' + (year_n > 1 ? 's' : '') + ' old';
      }
      }
    }

    function getAgeVal(pid){
      var birthdate = formatDate(document.getElementById("txtbirthdate").value);
      var count = document.getElementById("txtbirthdate").value.length;
      if (count=='10'){
      var age = getAge(birthdate);
      var str = age;
      var res = str.substring(0, 1);
      if (res =='-' || res =='0'){
      document.getElementById("txtbirthdate").value = "";
      document.getElementById("txtage").value = "";
      document.getElementById("agestatus").value = "";
      $('#txtbirthdate').focus();
      return false;
      }else{
      document.getElementById("txtage").value = age;
      document.getElementById("agestatus").value = age;
      }
      }else{
      document.getElementById("txtage").value = "";
      document.getElementById("agestatus").value = "";
      return false;
      }
    }
</script>