<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

// Đường dẫn vào đến phần client
define('BASE_URL'   , 'http://localhost/duannhom9/');
 
//Đường dẫn vào phần admin
define('BASE_URL_ADMIN'   , 'http://localhost/duannhom9/admin/'); 

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_NAME'    , 'da');  // Tên database
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

define('PATH_ROOT'    , __DIR__ . '/../');
