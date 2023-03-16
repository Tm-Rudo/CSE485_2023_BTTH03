<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // var_dump($_SERVER);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user   = $_POST['txtUser'];
            $mail   = $_POST['txtMail'];
            $pass1  = $_POST['txtPass1'];
            $pass2  = $_POST['txtPass2'];
            // Kiểm tra Mật khẩu có khớp ko
            if($pass1 != $pass2){
                echo "<p style='color:red'>Mật khẩu không khớp</p>";
                // header("Location:register.php");
            }else{
                // Kiểm tra Tài khoản nó đã TỒN TẠI CHƯA
                try{
                    $conn = mysqli_connect('localhost','root','','demo');
                }catch(Exception $e){
                    echo $e->getMessage();
                }
                $select_sql = "SELECT * FROM users WHERE username = '$user' OR email='$mail'";
                $result_sql = mysqli_query($conn,$select_sql);
                if(mysqli_num_rows($result_sql) > 0){
                    echo "<p style='color:red'>Tên đăng nhập hoặc Email đã được sử dụng</p>";
                }else{
                    // Lưu lại bản đăng kí vào CSDL
                    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $code_hash = md5(random_bytes(20));
                    $insert_sql = "INSERT INTO users (username, email, password, activation_code)
                    VALUES ('$user', '$mail', '$pass_hash', '$code_hash')";
                    if(mysqli_query($conn,$insert_sql)){
                        echo "<p style='color:green'>Đăng kí thành công, vui lòng check Email để kích hoạt tài khoản</p>";
                        // Gửi Email chứa liên kết để kích hoạt
                        // Kích hoạt là gì?
                    }

                    
                }
            }
        }
    ?>
    <form action="register.php" method="post">
        Username: <input type="text" name="txtUser" id="">
        Email: <input type="email" name="txtMail" id="">
        Password: <input type="password" name="txtPass1" id="">
        Re-type Password: <input type="password" name="txtPass2" id="">
        <button type="submit">Register</button>
    </form>
</body>
</html>