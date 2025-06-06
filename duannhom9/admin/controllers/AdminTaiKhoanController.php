<?php
class AdminTaiKhoanController{
    public $modelTaiKhoan;
    public function __construct(){
        $this->modelTaiKhoan =new AdminTaiKhoan();
    }
    public function danhSachQuanTri(){
        $listQuanTri = $this ->modelTaiKhoan->getAllTaiKhoan(1);
        
        require_once './views/taikhoan/quantri/listQuanTri.php';

    }
    
    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }
    public function postAddQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            $_SESSION['error'] = $errors;
            // Nếu ko có lỗi thì tiến hành thêm danh mục
            if (empty($errors)) {
                //Nếu ko có lỗi thì tiến hành thêm danh mục
                // đặt pass mặc định
                $password = password_hash('123@123', PASSWORD_BCRYPT);
                $chuc_vu_id = 1;
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten,$email,$password,$chuc_vu_id);
                header("Location: " . BASE_URL_ADMIN . '?act=tai-khoan-quan-tri');
                exit();

            } else {
                //Trả về form và lỗi
                $_SESSION['flash']=true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }
    public function formEditQuanTri(){
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri=$this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }


    public function postEditQuanTri(){
        // Hàm này dùng để xử lý thêm dữ liệu
       
        //Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $quan_tri_id = $_POST['id_quan_tri'] ?? '';
        //    var_dump($quan_tri_id); die;
            
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
           
           // var_dump($trang_thai); die;
            
            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại người dùng không được để trống';
            }

            


            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái ';
            }


            $_SESSION['error'] = $errors;

            // Nếu ko có lỗi thì tiến hành sửa
            if (empty($errors)) {
                //Nếu ko có lỗi thì tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai);
                // var_dump($san_pham_id);die();

                header("Location: " . BASE_URL_ADMIN . '?act=tai-khoan-quan-tri');
                exit();

            } else {
                //Trả về form và lỗi
                //Đặt lại chỉ thị xóa session sau khi hiển thị forrm 
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan-tri' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetPassword()
    {
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_Khoan= $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        //đặt password mặc định - 123@123
        //password_hash là hàm mật khẩu mã hóa và password_verify là hàm giải mã
        $password = password_hash('123@123', PASSWORD_BCRYPT);
        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
        if ($status && $tai_Khoan['chuc_vu_id']==1) {
            header("Location: " . BASE_URL_ADMIN . '?act=tai-khoan-quan-tri');
            exit();
        }elseif($status && $tai_Khoan['chuc_vu_id'] == 2) {
            header("Location: " . BASE_URL_ADMIN . '?act=tai-khoan-khach-hang');
            exit();
        }
        else{
            var_dump('Lỗi khi reset tài khoản');die;
        }
    }
    public function danhSachKhachHang(){
        $listKhachHang = $this ->modelTaiKhoan->getAllTaiKhoan(2);
        
        require_once './views/taikhoan/khachhang/listKhachHang.php';

    }
    public function formEditKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang=$this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }
    public function postEditKhachHang()
    {
        // Hàm này dùng để xử lý thêm dữ liệu

        //Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // var_dump($trang_thai); die;

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại người dùng không được để trống';
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh người dùng không được để trống';
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống';
            }

            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ người dùng không được để trống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
            }


            $_SESSION['error'] = $errors;

            // Nếu ko có lỗi thì tiến hành sửa
            if (empty($errors)) {
                //Nếu ko có lỗi thì tiến hành thêm sản phẩm
                $this->modelTaiKhoan->updateKhachHang($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $trang_thai);
                // var_dump($san_pham_id);die();

                header("Location: " . BASE_URL_ADMIN . '?act=tai-khoan-khach-hang');
                exit();
            } else {
                //Trả về form và lỗi
                //Đặt lại chỉ thị xóa session sau khi hiển thị forrm 
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function detailKhachHang(){
                $id_khach_hang = $_GET['id_khach_hang'];
                $khachHang = $this ->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
                require_once './views/taikhoan/khachhang/detailKhachHang.php';

    }
    public function formLogin() {
        require_once './views/auth/formLogin.php';
        deleteSessionError() ;
        
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           
            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($password);die;
            $user = $this->modelTaiKhoan->checkLogin($email,$password);
           
            //var_dump( $user); die;
            if($user == $email){
                $_SESSION['user_admin'] = $user;
                header("Location: " .BASE_URL_ADMIN);
                exit();

            }else{
                //Lỗi thì lưu lỗi vào ss
                $_SESSION['erroe'] = $user;

                $_SESSION['flash'] = true;

                header("Location :" .BASE_URL_ADMIN.'?act=login-admin');
                exit();
            }
        }
    }
    public function logout(){
        if(isset($_SESSION['user_admin'])){
            unset($_SESSION['user_admin']);
            header("Location :" .BASE_URL_ADMIN.'?act=login-admin');
        }
    }
    
}

