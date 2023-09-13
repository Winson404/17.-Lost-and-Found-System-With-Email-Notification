<title>CCP SO System | Update lost item</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['Id'])) {
      $id = $_GET['Id'];
      $select = mysqli_query($conn, "SELECT * FROM lost_found WHERE Id='$id'");
      $row = mysqli_fetch_array($select);
?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update lost item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Update lost item</li>
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
                    <input type="hidden" class="form-control"  placeholder="Name of the Owner" name="itemId" required value="<?php echo $row['Id']; ?>">   
                    <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-dark"><b>Name of the Owner</b></span>
                          <input type="text" class="form-control"  placeholder="Name of the Owner" name="ownername" required value="<?php echo $row['itemOwner']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <span class="text-dark"><b>Ownder contact details(Contact no./ Email)</b></span>
                          <input type="text" class="form-control"  placeholder="Ownder contact details" name="contact" required value="<?php echo $row['ownerContact']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                          <span class="text-dark"><b>Date lost</b></span>
                          <input type="date" class="form-control"  placeholder="Date lost" name="datelost" required value="<?php echo $row['dateLost']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                          <span class="text-dark"><b>Item name</b></span>
                          <input type="text" class="form-control"  placeholder="First name" name="itemname" required value="<?php echo $row['itemName']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                          <span class="text-dark"><b>Description of the item</b></span>
                          <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Description of the item"><?php echo $row['description']; ?></textarea>
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
                <a href="lostFound.php" class="btn btn-secondary"><i class="fa-solid fa-circle-left"></i> Back to List</a>
                <button type="submit" class="btn bg-gradient-primary" name="update_item"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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