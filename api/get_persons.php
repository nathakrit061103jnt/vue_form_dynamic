  <?php
     //กำหนดค่า Access-Control-Allow-Origin เพื่อให้สิทธิการเข้าถึงข้อมูล
     header("Access-Control-Allow-Origin: *");

     header("Content-Type: application/json; charset=UTF-8");

     header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

     header("Access-Control-Max-Age: 3600");

     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

     include_once "./config/connect_db.php";

     $requestMethod = $_SERVER["REQUEST_METHOD"];

     //ตรวจสอบว่าเป็น Method GET หรือไม่
     if ($requestMethod == 'GET') {

        $sql;
 
        if(isset($_GET['p_id'])){
            $p_id=$_GET['p_id'];
            $sql = "SELECT * FROM persons WHERE p_id=$p_id";
        }else{
            $sql = "SELECT * FROM persons";
        }
 
        $result = mysqli_query($conn, $sql);

        if ($result) {

            if(mysqli_num_rows($result) > 0){
                               //สร้างตัวขึ้นมาเพื่อรอรับข้อมูล
                $arr;
                while ($row = mysqli_fetch_assoc($result)) {
                        // รับข้อมูลเเล้ว Push ใส่ array
                        $arr[] = $row;
                }
            
                echo json_encode($arr,JSON_NUMERIC_CHECK );
            }else{
                echo json_encode([]);
            }


        } else {
            echo json_encode([]);
        }



     }

  