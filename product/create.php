<?php
require '../init.php';
require '../include/header.php';

if(!isset($_SESSION['user'])){
  go('login.php'); 
  setError("Please Login First!");
}

if($_SERVER['REQUEST_METHOD'] =='POST'){

  // print_r($_REQUEST);
  $file = $_FILES['image'];
  if(empty($file['name'])){
    setError("Please Choose Image");
    // print_r($file);
  }else{
      //Check Image Size
    

    $file_limit_size = 1024*1024*1;
    $file_size = $file['size'];

    if($file_size>$file_limit_size){
      setError("Please Choose Image below 1MB");
    }
  }


    

}

$category = getAll("select * from category");

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
        <a href="index.php" class="btn btn-sm btn-primary">All</a>
           <?php
            showError();
            showMsg();
           ?>
            <form action="" method="POST" class="mt-3 row" enctype="multipart/form-data">
                <div class="col-6">
                    <h4 class="text-white">Product Info</h4>
                    <!-- for Category -->
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="" class="form-control">
                          <?php
                          foreach($category as $c){
                            echo "
                            <option value='{$c->id}'>{$c->name}</option>
                            ";
                          }
                          ?>
                        </select>
                    </div>
                    <!-- for Name -->
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" class="form-control"  name="name">
                    </div>
                    <!-- for image -->
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" class="form-control"  name="image">
                    </div>

                    <!-- for description -->
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description" class="form-control"  name="description" ></textarea>
                    </div>
                </div>
                    <!-- PRODUCT INVENTORY -->
                <div class="col-6">
                     <h4 class="text-white">Inventory</h4>

                     <span class="text-primary">
                      <span class="fas fa-info-circle text-primary"></span>
                      Buy Info
                    </span>
                      <!-- for total quantity -->
                     <div class="form-group">
                        <label for="">Enter Total Quantity</label>
                        <input type="number" class="form-control"  name="total_quantity">
                    </div>
                          <!-- for sale price -->
                    <div class="form-group">
                        <label for="">Enter Sale Price</label>
                        <input type="number" class="form-control"  name="sale_price">
                    </div>

                    <span class="text-primary">
                      <span class="fas fa-info-circle text-primary"></span>
                      Sales Info
                    </span>
                      <!-- for buy price -->
                    <div class="form-group">
                        <label for="">Buy Price</label>
                        <input type="number" class="form-control"  name="buy_price">
                    </div>
                          <!-- buy date -->
                    <div class="form-group">
                        <label for=""></label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="date">
                    </div>
                </div>
                <div class="col-12">
                        <input type="submit" value="Create" class="btn btn-warning">
                </div>
                
            </form>
      </div>
    </div>
  </div>




<?php

require '../include/footer.php';
?>