<?php
require '../init.php';
require '../include/header.php';

if(!isset($_SESSION['user'])){
  go('login.php'); 
  setError("Please Login First!");

}

//(order by id desc)from last records will be shown
$category = getAll('select * from category order by id desc');
// print_r($category);

if(isset($_GET['action'])){
  $del = $_GET['slug'];
  query('
  delete  from category where slug =?',
  [$del]);
  setMsg("Category Delete Success");
}


//checking Category Existed or Not
if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
    $category = getOne("select * from category where slug=?",
    [($slug)]);  
    if(!$category){
        setError("Category Not Found");
        go('index.php');
        die();
    }
}else{
    setError("Category Not Found");
    go('index.php');
    die();
    
}

//updating Category Name
if($_SERVER['REQUEST_METHOD']=='POST'){
    $slug = $_GET['slug'];
    $name = $_REQUEST['name'];
    query('update category set name=?,slug=? where slug=?',
    [$name,slug($name),$slug]);

    go('index.php');
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
                    <label for="">Update Product Name</label>
                    <input type="text" name="name" value="<?php echo $category->name;  ?>">
                </div>
                <input type="submit" value="Update" class="btn btn-sm btn-warning">
            </form>
      </div>
    </div>
  </div>




<?php

require '../include/footer.php';
?>

<!-- I still need to solve the problems of not disappearing
 the table record at once when i press delete button -->