<?php

    include "../dbconnect.php";
    $id=$_GET['id'];
    //print($id);

    $sql="SELECT * FROM categories WHERE categories.id=:id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $category=$stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($category);

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id=$_POST['id'];
        $name=$_POST['name'];

        $sql="UPDATE categories SET name=:name WHERE id=:id";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        $stmt->execute();

        header('location:categories.php');
        exit();

    }else{
     
        include "layouts/nav_sidebar.php";

?>

<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-list-check"></i>&nbsp;Category Update</span>
            <a href="categories.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$category['id']?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=$category['name']?>">
                
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Update</button>
            </form>
        </div>
    </div>
  
</div>


<?php 

    include "layouts/footer.php";

    }
?>