<?php
class AdminSanPhamController {

    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham(){

        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham/listSanPham.php';
    }
    public function formAddSanPham(){
        // hàm này dùng để hiển thị form nhập
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/addSanPham.php';

        // Xóa Session sau khi load trang
        deleteSessionError();
    }
    public function postAddSanPham(){
        // Hàm này dùng để xử lý thêm dữ liệu
        // var_dump($_POST);
        //Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;

            //Lưu hình ảnh vào
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            //mảng hình ảnh
            $img_array = $_FILES['img_array'];

            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }

            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }

            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
            }

            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
            }

            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
            }

            $_SESSION['error'] = $errors;

            // Nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                //Nếu ko có lỗi thì tiến hành thêm sản phẩm
                $san_pham_id = $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai , $mo_ta, $file_thumb);
                // var_dump($san_pham_id);die();

                //Xử lý thêm album ảnh sản phẩm img_array 
                if (!empty($img_array['name'])){
                    foreach ($img_array['name'] as $key=>$value){
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]
                        ];

                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }

                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();

            } else {
                //Trả về form và lỗi
                //Đặt lại chỉ thị xóa session sau khi hiển thị forrm 
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham(){
        // hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin của sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailtSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        // var_dump($sanPham);
        // die();
        if ($sanPham){
            require_once './views/sanpham/editSanPham.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        
    }

    public function postEditSanPham(){
        // Hàm này dùng để xử lý thêm dữ liệu
        // var_dump($_POST);
        //Kiểm tra xem dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            //Lấy ra dữ liệu cũ của sản phẩm
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            //Truy vấn
            $sanPhamOld = $this->modelSanPham->getDetailtSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; // Lấy ảnh cũ để phục vụ cho sửa ảnh

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;



            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }

            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }

            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
            }

            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }

            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }

            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
            }


            $_SESSION['error'] = $errors;

            // Logic sửa ảnh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK){
                // upload ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');

                if (!empty($old_file)) { // Nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            } else{
                $new_file = $old_file;
            }

            // Nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                //Nếu ko có lỗi thì tiến hành thêm sản phẩm
                $san_pham_id = $this->modelSanPham->updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai , $mo_ta, $new_file);
                // var_dump($san_pham_id);die();

                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();

            } else {
                //Trả về form và lỗi
                //Đặt lại chỉ thị xóa session sau khi hiển thị forrm 
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }

    // //Sửa album ảnh
    // - Sửa ảnh cũ
    // + Thêm ảnh mới
    // + Không thêm ảnh mới
    // - Không sửa ảnh cũ
    // + Thêm ảnh mới
    // + Không thêm ảnh mới
    // -Xóa ảnh cũ
    // + Thêm ảnh mới
    // + Không thêm ảnh mới

    public function postEditAnhSanPham() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            //Lấy danh mục ảnh hiện tai của sản phảm
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

            //  Xử lý các ảnh được gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            // Khai báo mảng để lưu ảnh thêm mới hoặc thay thế ảnh cũ
            $upload_file = [];

            //Upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key=>$value){
                if ($img_array['error'][$key] == UPLOAD_ERR_OK){
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if ($new_file) {
                        $upload_file[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }

            // Lưu ảnh mới vào DB và xóa ảnh cũ nếu có
            foreach($upload_file as $file_info){
                if($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailtAnhSanPham($file_info['id'])['link_hinh_anh'];

                    //Cập nhật ảnh cũ
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // Xóa ảnh cũ
                    deleteFile($old_file);
                } else{
                    //Thêm ảnh mới
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            // Xử lý xóa ảnh
            foreach($listAnhSanPhamCurrent as $anhSP){
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    // Xóa ảnh trong DB
                    $this->modelSanPham->destroyAnhSanPham($anh_id);

                    // Xóa File
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }

    public function deleteSanPham(){
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailtSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        

        if ($sanPham) {
            deleteFile($sanPham['hinh_anh']);
            $this->modelSanPham->destroySanPham($id);
            
        }
        if ($listAnhSanPham) {
            foreach($listAnhSanPham as $key=>$anhSP){
                deleteFile($anhSP['link_hinh_anh']);
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }

        header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }

    public function detailSanPham(){
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailtSanPham($id);
        
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        
        if ($sanPham){
            require_once './views/sanpham/detailSanPham.php';
            
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        
    }
}