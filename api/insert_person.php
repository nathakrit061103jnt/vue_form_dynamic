  <?php
        //กำหนดค่า Access-Control-Allow-Origin เพื่อให้สิทธิการเข้าถึงข้อมูล
        header("Access-Control-Allow-Origin: *");

        header("Content-Type: application/json; charset=UTF-8");

        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

        header("Access-Control-Max-Age: 3600");

        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        //เชื่อมต่อฐานข้อมูล
        include_once "./config/connect_db.php";

        //อ่านข้อมูลที่ส่งมาแล้วเก็บไว้ที่ตัวแปร data
        $data = file_get_contents("php://input");

        //แปลงข้อมูลที่อ่านได้ เป็น array แล้วเก็บไว้ที่ตัวแปร result
        $result = json_decode($data, true);
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        //ตรวจสอบว่าเป็น Method  POST หรือไม่
        if ($requestMethod == 'POST') {
  
                        $p_name = mysqli_real_escape_string($conn, $result['p_name']);

                        //คำสั่ง SQL สำหรับเพิ่มข้อมูลใน Database
                        $sql = "INSERT INTO persons (p_id,p_name) VALUES (NULL, '$p_name')";

                        if (mysqli_query($conn, $sql)) {
                                echo json_encode([
                                        'status' => 200,
                                        'message' => 'New record created successfully',
                                        'error' => false,
                                ]);
                        } else {
                                $mes = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                echo json_encode([
                                        'status' => 404,
                                        'message' => $mes,
                                        'error' => true,
                                ]);

                        }

                        mysqli_close($conn);

        }
        ?>