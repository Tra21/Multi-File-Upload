<?php
    define('UPLOAD_DIR', 'uploads/');
    $imgs =$_POST['arr_img'];
    $json_response =[];
    for ($i=0; $i < count($imgs) ; $i++) { 
        $image = $imgs[$i];
        $explode_comma = explode(',',$image);
        $img= $explode_comma[1];
        $data = base64_decode($img);

        $explode_semicol  = explode(';',$explode_comma[0]);
        $explode_forward_slash = explode('/',$explode_semicol[0]);
        $extension = $explode_forward_slash[1];
        $file = UPLOAD_DIR . uniqid() . '.'.$extension.'';
        $success = file_put_contents($file, $data);
        array_push($json_response, $success ? $file : 0);
    }
    echo json_encode($json_response);
    // print $success ? $file : 'Unable to save the file.';
?>