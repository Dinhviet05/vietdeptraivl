

<?php include './views/layouts/header.php'; ?>
  
  <?php include './views/layouts/navbar.php'; ?>
 

 
  <?php include './views/layouts/siderbar.php'; ?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý tài khoản </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title <?= $quanTri['ho_ten'];?>" >Sửa tàikhoản quản trị viên : </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN .'?act=sua-quan-tri' ?>" method="post">
                <input type="hidden" name="id_quan_tri" value="<?= $quanTri['id'] ?>">

                
                <div class="form-group col-12">
                    <label>Họ & Tên</label>
                    <input type="text" class="form-control " name="ho_ten" value="<?= $quanTri['ho_ten'];?>" placeholder="Nhập họ tên">
                    <?php if(isset($_SESSION['error']['ho_ten'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                    <?php } ?>
                  </div>
                  <div class="form-group col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $quanTri['email'];?> " placeholder="Nhập Email">
                    <?php if(isset($_SESSION['error']['email'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                    <?php } ?>
                  </div>
                  <div class="form-group col-12">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" name="so_dien_thoai" value="<?= $quanTri['so_dien_thoai'];?> " placeholder="Số điện thoại">
                    <?php if(isset($_SESSION['error']['so_dien_thoai'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                    <?php } ?>
                  </div>

                  <div class="form-group col-12">
                                    <label for="inputStatus">Trạng thái tài khoản</label>
                                    <select id="inputStatus" name="trang_thai" class="form-control custom-select">
                                        <option <?= $quanTri['trang_thai'] == 1 ? 'selected':'' ;?> value="1">Active</option>
                                        <option <?= $quanTri['trang_thai'] !== 1 ? 'selected':'' ;?> value="2">Inactive</option>
                                    </select>
                                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- Footer -->
<?php include './views/layouts/footer.php'; ?>
<!-- End Footer -->

</body>
</html>
