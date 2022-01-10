<?php
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    echo $email;
    $host="localhost";
    $dbusername="root";
    $password="";
    $dbname="test";
    $conn = new mysqli($host,$dbusername,$password,$dbname);
   if (mysqli_connect_error()){
        echo "unable";
        die('Connect Error('. mysqli_connect_errno().') '.mysqli_connect_error() );
    }
    else{
        $SELECT="SELECT email FROM  user_details WHERE email=? Limit 1 ";
        $INSERT="INSERT INTO  user_details (email, phone) VALUES(?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param('si',$email,$phone);
            $stmt->execute();
            echo "new record entered successfully";
             
        }
        else{
            echo "email already existed";
        }
        $stmt->close();
        $conn->close();
        }


   //die();

?>