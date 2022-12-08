<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    /*
    	$resposta = json_encode(
        	(object)array(            	
            	$row['unique_id'] => array(
                    'iduser' => $row['user_id'],
            	    'unique_id' => $row['unique_id'],
                	'response' => '',
                	'code' => '200',
                	'photo' => "php/images/" . $row['img'],
                	'username' => $row['fname'] . " " . $row['lname'],
                	'message' => $msg,
                	'status' => $row['status']
            	),
        	)
    	);    	*/


    $dados = array(
        'iduser' => $row['user_id'],
        'unique_id' => $row['unique_id'],
        'response' => '',
        'code' => '200',
        'photo' => "php/images/" . $row['img'],
        'username' => $row['fname'] . " " . $row['lname'],
        'message' => $msg,
        'status' => $row['status'],
    );

    $data[]=$dados;
}
//$resposta['status'] = 'success';
//$resposta['data'] = $data;


/*$resposta = json_encode(
    (object)array(
        'status'=>'success',
        'data'=> $data,
    	'text'=>''
    ));

echo ($resposta);*/
$resposta = array(
        'status'=>'success',
        'data'=> $data,
    	'text'=>''
    );
echo json_encode($resposta);
?>