<?php


function setError($message){
    $_SESSION['errors']= [];
    $_SESSION['errors'][]= $message;
}

function showError(){
    $errors = $_SESSION['errors'];
    $_SESSION['errors']=[];
    if(count($errors)){
        foreach($errors as $e){
            echo "<div class='alert alert-danger'>$e</div>";
        }
    }
}

function setMsg($message){
    $_SESSION['msg']= [];
    $_SESSION['msg'][]= $message;
}

function showMsg(){
    $msg = $_SESSION['msg'];
    $_SESSION['msg' ]=[];
    if(isset($_SESSION['msg']) and count($msg)){
        foreach($msg as $e){
            echo "<div class='alert alert-success'>$e</div>";
        }
    }
}

function hasError(){
    $errors = $_SESSION['errors'];
    if(count($errors)){
        return true;
    }
    return false;
}

function go($path){
    header("Location:$path");
}

function slug($str){
    return uniqid().'-'.str_replace(' ','-',$str);
}

function paginateCategory($record_per_page=2){
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
        // else{
    //     $page =2;
    // }
    if($page<= 0){
        $page =2;
    }
    $temp = ($page-1)*$record_per_page;
    $limit = "$temp,$record_per_page";
    $sql = "select * from category order by id desc limit $limit";
    // echo $sql;
    $data = getAll($sql);

    echo json_encode($data);
    // 1 -> 0,2;
    // 2 -> 2,2;

}