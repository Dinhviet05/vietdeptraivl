<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/AdminDanhMucController.php';
require_once 'controllers/AdminSanPhamController.php';

require_once 'controllers/AdminBaoCaoThongKeController.php';
require_once 'controllers/AdminTaiKhoanController.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';

require_once './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

$allowAccessWithoutLogin = ['login-admin', 'check-login-admin'];


match($act){
    //Trang chủ - báo cáo thống kê

    '/'=>(new AdminBaoCaoThongKeController())->home(),

    // route danh mục
    'danh-muc'=> (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc'=> (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc'=> (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc'=> (new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc'=> (new AdminDanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc'=> (new AdminDanhMucController())->deleteDanhMuc(),
    // route sản phẩm
    'san-pham'=> (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham'=> (new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham'=> (new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham'=> (new AdminSanPhamController())->formEditSanPham(),
    'sua-san-pham'=> (new AdminSanPhamController())->postEditSanPham(),
    'sua-album-anh-san-pham'=> (new AdminSanPhamController())->postEditAnhSanPham(),
    'xoa-san-pham'=> (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham'=> (new AdminSanPhamController())->detailSanPham(),

  

    // route quẩn lí tài khoản
        // quản trị
        'tai-khoan-quan-tri'=>(new AdminTaiKhoanController())->danhSachQuanTri(),
        'form-them-quan-tri'=>(new  AdminTaiKhoanController())->formAddQuanTri(),
        'them-quan-tri'=>(new  AdminTaiKhoanController())->postAddQuanTri(),
        'form-sua-quan-tri'=>(new  AdminTaiKhoanController())->formEditQuanTri(),
        'sua-quan-tri'=>(new  AdminTaiKhoanController())->postEditQuanTri(),

        'reset-password' =>(new AdminTaiKhoanController())->resetPassword(),

        'tai-khoan-khach-hang'=>(new AdminTaiKhoanController())->danhSachKhachHang(),
        'form-sua-khach-hang'=>(new  AdminTaiKhoanController())->formEditKhachHang(),
        'sua-khach-hang'=>(new  AdminTaiKhoanController())->postEditKhachHang(),
        'chi-tiet-khach-hang'=>(new  AdminTaiKhoanController())->detailKhachHang(),
        // 'chi-tiet-khach-hang'=>(new  AdminTaiKhoanController())->deltailKhachHang(),
        
        'login-admin'=>(new  AdminTaiKhoanController())->formLogin(),
        'check-login-admin'=>(new  AdminTaiKhoanController())->login(),
       
};