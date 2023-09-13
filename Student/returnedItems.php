<title>CCP SO System | Returned Items</title>
<?php include 'navbar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Returned Items</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Returned Items</li>
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
                <div class="card-tools mr-1 mt-3 mb-2">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Item Image</th>
                    <th>Item Owner</th>
                    <th>Item name</th>
                    <th>Description</th>
                    <th>Date reported</th>
                    <th>Item Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM lost_found JOIN users ON lost_found.reporterId=users.user_Id WHERE itemStatus = 2 AND lost_found.reporterId='$id'");
                        if(mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td>
                            <img src="../images-item/<?php echo $row['itemImage']; ?>" alt="" width="35" height="35" style="margin-left: auto;margin-right: auto;display: block;border-radius: 50%;">
                        </td>
                        <td>
                          <?php echo $row['itemOwner']; ?> <br>
                          Contact #: <span class="text-muted text-sm"><?php echo $row['contact']; ?></span>
                        </td>
                        <td><?php echo $row['itemName']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['dateReported']; ?></td>
                        <td>
                          <?php if($row['itemStatus'] == 0): ?>
                            <span class="badge badge-danger mt-1">Lost</span>
                          <?php elseif($row['itemStatus'] == 1): ?>
                            <span class="badge badge-warning mt-1">Found</span> <br> <span type="button" class="badge badge-info mt-1" data-toggle="modal" data-target="#return<?php echo $row['Id']; ?>">Click to return item</span>
                          <?php else: ?>
                            <span class="badge badge-success mt-1">Returned</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="returnedItems_view.php?Id=<?php echo $row['Id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-folder"></i></a>
                        </td> 
                    </tr>
                    <?php include 'lostFound_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Item Image</th>
                          <th>Item Owner</th>
                          <th>Item name</th>
                          <th>Description</th>
                          <th>Date reported</th>
                          <th>Item Status</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

<?php include 'footer.php'; ?>
