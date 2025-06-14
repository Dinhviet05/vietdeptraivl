
<!-- header -->
<?php include './views/layouts/header.php'; ?>
  <!-- Navbar -->
  <?php include './views/layouts/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include './views/layouts/siderbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý danh sách sản phẩm</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham' ?>">
                  <button class="btn btn-success">Thêm Sản Phẩm Mới</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Giá Tiền</th>
                    <th>Số Lượng</th>
                    <th>Danh Mục</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listSanPham as $key=>$sanPham): ?>
                  <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $sanPham['ten_san_pham'] ?></td>
                    <td>
                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width:100px" alt="" onerror="this.onerror=null; this.src='https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/04/anh-con-cho-1.jpg'">
                    </td>
                    <td><?= $sanPham['gia_san_pham'] ?></td>
                    <td><?= $sanPham['so_luong'] ?></td>
                    <td><?= $sanPham['ten_danh_muc'] ?></td>
                    <td><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán'; ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                        <button class="btn btn-primary"><i class="far fa-eye"></i></button>

                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                          <button class="btn btn-warning"><i class="fas fa-cogs"></i></button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-san-pham&id_san_pham=' . $sanPham['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa hay không?')">
                          <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </a>
                      </div>
                    </td>
                  </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Giá Tiền</th>
                    <th>Số Lượng</th>
                    <th>Danh Mục</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>
</html>
