<?php
session_start();
include'../core/function.php';
include'../core/validation.php';
$errors =[];
if(checkRequestMethod('POST') && checkPostInput('name')){
    foreach($_POST as $key =>$value){
        $$key = sanitizeInput($value);

    }

    //validation
    if (!reqiredVal($name)){
        $errors[]="name is required";
    }elseif(!minVal($name,3)){
        $errors[]="name must be greater than 3 chars";
    }elseif(!maxVal($name,25)){
        $errors[]="name must be smaller than 25 chars";
    }
    //email
    if (!reqiredVal($email)){
        $errors[]="email is required";
    }elseif(!emailVal($email)){
        $errors[]="please type a valid email";
    }
    //password
    if (!reqiredVal($password)){
        $errors[]="password is required";
    }elseif(!minVal($password,6)){
        $errors[]="password must be greater than 6 chars";
    }elseif(!maxVal($password,20)){
        $errors[]="password  must be smaller than 20 chars";
    }








    if(empty($errors)){
        $users_file =fopen("../data/users.csv","a+");
        $data = [$name,$email,sha1($password)];
        fputcsv($users_file,$data);
        //redirect
        $_SESSION['auth'] = [$name,$email];
        redirect("../indix.php");
        die();
    }else{
        $_SESSION['errors'] = $errors;
        header("location:../register.php");
        redirect("../register.php");
        die;
    }
    var_dump($errors);



}else{
 echo'not supported method';
}