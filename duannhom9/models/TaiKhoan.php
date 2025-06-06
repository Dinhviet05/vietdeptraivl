<?php 
class ClientTaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau){
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(['email' => $email]);

            $user = $stmt->fetch();
           
            if($user && $mat_khau == $user['mat_khau']) {
                if($user['chuc_vu_id'] == 2) {
                    if($user['trang_thai'] == 1){
                        return $user['email'];
                    }else{
                        return "Tài khoản bị cấm";
                    }
                }else{
                    return "Tài khoản của bạn không có quyền đăng nhập";
                }
            }else{
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoan";
            }
        } catch (\Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }

    public function getTaiKhoanFromEmail($email){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getAllTaiKhoan(){
        try {
            $sql ='SELECT tai_khoans.*, chuc_vus.ten_chuc_vu
            FROM tai_khoans
            INNER JOIN chuc_vus ON tai_khoans.chuc_vu_id = chuc_vus.id   ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch(Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    
    public function addUser($ho_ten,$email,$mat_khau,$chuc_vu_id){
        try{
            $sql = 'INSERT INTO `tai_khoans` (`ho_ten`,`email`,`mat_khau`, `chuc_vu_id`)
                    VALUES (:ho_ten,:email,:mat_khau,:chuc_vu_id) ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':ho_ten'=> $ho_ten,
                            ':email'=> $email, 
                            ':mat_khau'=> $mat_khau,
                            ':chuc_vu_id'=> $chuc_vu_id
                        ]);
                        
            return true;
        } catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
}
?>