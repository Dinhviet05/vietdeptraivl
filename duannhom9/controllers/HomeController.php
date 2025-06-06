<?php 

class HomeController
{
    public $modelSanPham;

    public $modelTaiKhoan;

    public $modelGioHang;

    public $modelDonHang;
    
    public $modelDanhMuc;


    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new ClientTaiKhoan();

        $this->modelDanhMuc = new DanhMuc();
    }

    public function home() {
        $listSanPham = $this->modelSanPham->getAllProduct();
        // $chiTietGioHang = $this->modelGioHang->getDetailGioHang();
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // var_dump($mail['id']); die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);     
                $gioHang = ['id'=>$gioHangId];      
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']); 

            } else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        }
        require_once './views/home.php';

    }

    public function danhSachSanPham() {
        $listSanPham = $this->modelSanPham->getAllProduct();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        // var_dump($listSanPham);die();
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // var_dump($mail['id']); die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);     
                $gioHang = ['id'=>$gioHangId];      
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']); 

            } else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        }
        require_once './views/trangSanPham.php';
    }
    public function chiTietSanPham(){
        
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailtSanPham($id);
        
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamCungDanhMuc($sanPham['danh_muc_id']);
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // var_dump($mail['id']); die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);     
                $gioHang = ['id'=>$gioHangId];      
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']); 

            } else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        }
        if ($sanPham){

            require_once './views/detailSanPham.php';
            
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

  
    public function contact(){
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // var_dump($mail['id']); die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);     
                $gioHang = ['id'=>$gioHangId];      
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']); 

            } else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        }
        require_once('./views/Contact.php');
    }
    public function gioiThieu(){
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // var_dump($mail['id']); die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);     
                $gioHang = ['id'=>$gioHangId];      
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']); 

            } else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
        }
        require_once('./views/gioiThieu.php');
    }



}
