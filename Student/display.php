<title>BMS | Lost and Found Items</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Lost and Found Items</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Lost and Found Items</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2 bg-info">
                <button class="bg-transparent btn text-white">Items below are all <b>Lost</b> in status. <b>Found and Returned</b> Items cannot be seen here.</button>
                <div class="card-tools mr-1 mt-3 mb-2">
                  <button type="button" class="btn btn-tool text-light" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-4">
                <style>
                  .setActive:hover{
                    opacity: .8;
                    transition: .3s;
                  }
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
                        <img src="../images-item/<?php echo $row['itemImage']; ?>" alt="" style="width: 100%; height: 100%; object-fit: contain;" >

                      </div>
                      <div class="card-body pt-0">
                        <small><?php echo $row['description']; ?></small><br>
                        <small><b>Item Owner:</b> <?php echo $row['itemOwner']; ?></small><br>
                        <small><b>Contact details:</b> <?php echo $row['ownerContact']; ?></small>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <button class="btn btn-sm bg-danger" data-toggle="modal" data-target="#found<?php echo $row['Id']; ?>"><i class="fa-solid fa-thumbs-up"></i> Found?</button>
                        </div>
                      </div>
                    </div>
                  </div>
              


                  <?php 
                     include 'display_found.php'; } } else {
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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

<?php include 'footer.php'; ?>
