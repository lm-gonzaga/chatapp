<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {            
            //echo "$email - This email already exist!";
            $resposta = json_encode(
                (object)array(
                  'status' => 'Failed',
                  'code' => '500',
                  'response' => $email . ' - Este email já está cadastrado.',
                  'data' => array(
                    array(
                      
                    )
                  )
                ),
                JSON_UNESCAPED_UNICODE
              );
              
              /*echo $resposta;*/
              var_dump($_FILES);


        } else {
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                            $ran_id = rand(time(), 100000000);
                            $status = "Active now";
                            $encrypt_pass = md5($password);
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];                                    
                                    //echo "success";
                                    header('Location: users-mobile.php');
                                } else {                                    
                                    //echo "This email address not Exist!";
                                    $resposta = json_encode(
                                        (object)array(
                                          'status' => 'Failed',
                                          'code' => '404',
                                          'response' => 'Esse email não foi encontrado.',
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
                        }
                    } else {                        
                        //echo "Please upload an image file - jpeg, png, jpg";
                        $resposta = json_encode(
                            (object)array(
                              'status' => 'Failed',
                              'code' => '500',
                              'response' => 'Por favor envie um arquivo de imagem JPEG, JPG ou PNG.',
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
                    /*ALTERAR PARA FORMATO JSON PADRÃO*/
                    //echo "Please upload an image file - jpeg, png, jpg";
                    $resposta = json_encode(
                        (object)array(
                          'status' => 'Failed',
                          'code' => '500',
                          'response' => 'Por favor envie um arquivo de imagem JPEG, JPG ou PNG.',
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
        }
    } else {
        /*ALTERAR PARA FORMATO JSON PADRÃO*/
        //echo "$email is not a valid email!";
        $resposta = json_encode(
            (object)array(
                'status' => 'Failed',
                'code' => '500',
                'response' => $email . ' não é um email válido!',
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
    //echo "All input fields are required";
    $resposta = json_encode(
        (object)array(
            'status' => 'Failed',
            'code' => '500',
            'response' => 'Todos os campos devem ser preenchidos',
            'data' => array(
                array(
                    
                )
            )
        ),
        JSON_UNESCAPED_UNICODE
    );

    echo $resposta;
    
}

$conn->close();
?>
