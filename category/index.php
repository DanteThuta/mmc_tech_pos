<?php
require '../init.php';


if(!isset($_SESSION['user'])){
  go('login.php'); 
  setError("Please Login First!");

}

//(order by id desc)from last records will be shown(limit 2)
$category = getAll('select * from category order by id desc limit 2');
// print_r($category);

if(isset($_GET['action'])){
  $del = $_GET['slug'];
  query('
  delete  from category where slug =?',
  [$del]);
  setMsg("Category Delete Success");
}

if(isset($_GET['page'])){
  paginateCategory(2);
  die();
}

require '../include/header.php';
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
        <a href="create.php" class="btn btn-sm btn-primary">Create</a>
        <div class="mt-3">
        <?php    
            showError();
            showMsg();
        ?>
        </div>
        <table class="table table-stripted text-white mt-2">
            <thead>
                    <tr>
                        <th>Name</th>
                        <th>Option</th>
                    </tr>
            </thead>
            <tbody id="tableData">
                <?php
                  foreach($category as $c){
                  ?>
                <tr>
                    <td><?php echo $c->name; ?></td>
                    <td>
                        <a href="<?php echo $root.'category/edit.php?slug='.$c->slug ?>" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"> </span>
                        </a>
                        <a onclick="return confirm('Are you sure you want to delete this?')" 
                        href="<?php echo $root .'category/index.php?action=delete&slug='.$c->slug ?>" class="btn btn-sm btn-danger">
                            <span class="fas fa-trash"> </span>
                        </a>
                    </td>
                </tr>
                  <?php 
                  }
                ?>
                
            </tbody>

        </table>
        <div class="text-center">
                  <button class="btn btn-warning" id="btnFetch">
                    <span class="fas fa-arrow-down"></span>
                  </button>
        </div>
      </div>
    </div>
  </div>




<?php

require '../include/footer.php';
?>

<script>
  $(function(){
    var page =1;
    var tableData = $('#tableData');
    var btnFetch = $('#btnFetch');
    btnFetch.click(function(){
      page += 1;
      $.get(`index.php?page=${page}`).then(function(data){
        // console.log(data);
        const d = JSON.parse(data);
        var htmlString = "";
        if(!d.length){
          btnFetch.attr('disabled','disable');
        }
        
        d.map(function(d){
          htmlString += `
          <tr>
                    <td>${d.name}</td>
                    <td>
                        <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"> </span>
                        </a>
                        <a onclick="return confirm('Are you sure you want to delete this?')" 
                        href="index.php?slug=${d.slug}" class="btn btn-sm btn-danger">
                            <span class="fas fa-trash"> </span>
                        </a>
                    </td>
                </tr>
          `
        })
        tableData.append(htmlString);
      }) 
    });
  });
</script>


<!-- I need to solve the problems of not disappearing
 the table record at once when i press delete button -->
 <!-- also about die function (revise) -->