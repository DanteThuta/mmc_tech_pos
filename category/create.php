<?php
require '../init.php';
require '../include/header.php';

if(!isset($_SESSION['user'])){
  go('login.php'); 
  setError("Please Login First!");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $name = $_REQUEST['name'];
    if(empty($name)){
        setError('Please Enter Name');
    }
    if(!hasError()){
     
       $res = query(
            "insert into category (slug,name) values (?,?)",
            [slug($name),$name]);
            if($res){
                setMsg("Category Success");
            }
    }
}
?>




  <!-- Breadcamp -->
  <div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
      <div class="col-12">
        <span class="text-white">
          <h4 class="d-inline text-white">Category</h4>
          > All
        </span>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
      <div class="card-body">
        <a href="create.php" class="btn btn-sm btn-primary">All List</a>
            <?php 
            showError(); 
            showMsg();
            ?>
            <form action="" method="POST" class="mt-3">
                <div class="form-group">
                    <label for="">Enter Product Name</label>
                    <input type="text" name="name">
                </div>
                <input type="submit" value="Create" class="btn btn-sm btn-warning">
            </form>
      </div>
    </div>
  </div>




<?php

require '../include/footer.php';
?>