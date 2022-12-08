<?php
session_start();


if (isset($_GET['email']) && isset($_GET['password'])) {    
    return webget();
    exit();
}else{
    return mobile();
    exit();
}


function webget(){
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $password = mysqli_real_escape_string($conn, $_GET['password']);

    if (!empty($email) && !empty($password)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if ($user_pass === $enc_pass) {
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    //echo "success";
                    include_once 'users-mobile.php';
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is Incorrect!";
            }
        } else {
            echo "$email - This email not Exist!";
        }
    } else {
        echo "All input fields are required!";
    }   

}


function mobile()
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);
    $tempEmail = $obj['email'];    
	$tempPassword = $obj['password'];

    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $tempEmail);
    $password = mysqli_real_escape_string($conn, $tempPassword);

    if (!empty($email) && !empty($password)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if ($user_pass === $enc_pass) {
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    //echo "success";
                    include_once 'users-mobile.php';
                } else {
                    //echo "Something went wrong. Please try again!";
                    $resposta = json_encode(
                        (object)array(
                          'status' => 'Failed',
                          'code' => '500',
                          'response' => 'Algo saiu errado. Tente novamente.',
                          'data' => array(
                            array(
                              
                            )
                          )
                        ),
                        JSON_UNESCAPED_UNICODE
                      );
                      
                      echo $resposta;
                }
            } else {
                //echo "Email or Password is Incorrect!";
                $resposta = json_encode(
                    (object)array(
                      'status' => 'Unauthorized',
                      'code' => '401',
                      'response' => 'Email ou Senha incorreto!',
                      'data' => array(
                        array(
                          
                        )
                      )
                    ),
                    JSON_UNESCAPED_UNICODE
                  );
                  
                  echo $resposta;
            }
        } else {
            //echo "$email - This email not Exist!";
            $resposta = json_encode(
                (object)array(
                    'status' => 'Not Found',
                    'code' => '404',
                    'response' => $email . ' não cadastrado.',
                    'data' => array(
                        array(
                            
                        )
                    )
                ),
                JSON_UNESCAPED_UNICODE
            );
    
            echo $resposta;
        }
    } else {
        //echo "All input fields are required!";
        $resposta = json_encode(
            (object)array(
                'status' => 'Failed',
                'code' => '500',
                'response' => 'Sem informações de usuário ou senha.',
                'data' => array(
                    array(
                        
                    )
                )
            ),
            JSON_UNESCAPED_UNICODE
        );
    
        echo $resposta;
    }       

}
?>