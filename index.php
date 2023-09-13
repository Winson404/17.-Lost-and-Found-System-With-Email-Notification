<title>CCP SO System | Login</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row d-flex justify-content-center">





          <!-- /.col -->
          <div class="col-md-12 mt-4">
            <div class="ds">
             
              <div class="card-body p-4">
                  <h1 class="text-center">List of Lost Items</h1>
                  <hr>
                </style>
                 <div class="row d-flex justify-content-start">
                   <?php 
                    $fetch = mysqli_query($conn, "SELECT * FROM lost_found WHERE itemStatus = 0 ORDER BY Id DESC");
                    if(mysqli_num_rows($fetch) > 0) {
                    while ($row = mysqli_fetch_array($fetch)) {
                  ?>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill  p-0">
                      <div class="card-header text-muted border-bottom-0">
                        <h4 class="text-center"><?php echo $row['itemName']; ?></h4>
                      </div>
                      <div class="card-body pt-0">
                        <img src="images-item/<?php echo $row['itemImage']; ?>" alt="" style="width: 100%; height: 100%; object-fit: contain;" >

                      </div>
                      <div class="card-body pt-0">
                        <small><?php echo $row['description']; ?></small><br>
                        <small><b>Item Owner:</b> <?php echo $row['itemOwner']; ?></small><br>
                        <small><b>Contact details:</b> <?php echo $row['ownerContact']; ?></small>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <a href="login.php" class="btn btn-sm bg-danger"><i class="fa-solid fa-thumbs-up"></i> Found?</a>
                        </div>
                      </div>
                    </div>
                  </div>
              


                  <?php 
                     } } else {
                  ?>

                  <h2>No record found</h2>
                  
                <?php } ?>
                 </div>

              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->







        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
<br>
<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>

<script>

  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


  function validation() {
    var email = document.getElementById("email").value;
    var pattern =/.+@(gmail)\.com$/;
    // var pattern =/.+@(gmail|yahoo)\.com$/;
    if(email.match(pattern)) {
        document.getElementById('text').style.color = 'green';
        document.getElementById('text').innerHTML = '';
        document.getElementById('login').disabled = false;
        document.getElementById('login').style.opacity = (1);
    } 
    else {
        document.getElementById('text').style.color = 'red';
        document.getElementById('text').innerHTML = 'Domain must be @gmail.com';
        document.getElementById('login').disabled = true;
        document.getElementById('login').style.opacity = (0.4);
        
    }
  }
</script>