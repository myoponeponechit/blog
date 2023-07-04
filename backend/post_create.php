<?php
    
    include "../dbconnect.php";

    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $user_id = 2;
    $description = $_POST['description'];
    $photo_arr = $_FILES['photo'];

    // echo "$title,$category_id,$description";
    // print_r($photo_arr);

    if(isset($photo_arr) && $photo_arr['size'] > 0){
        $dir = 'images/';
        $photo = $dir.$photo_arr['name'];    // images/photo_name.png
        
        $tmp_name = $photo_arr['tmp_name'];
        move_uploaded_file($tmp_name,$photo);
    };


        $sql = "INSERT INTO posts (title,category_id,user_id,photo,description) VALUES(:title, :category, :user, :photo, :description)";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':title',$title);
         $stmt->bindParam(':category',$category_id);
         $stmt->bindParam(':user',$user_id);
         $stmt->bindParam(':photo',$photo);
         $stmt->bindParam(':description',$description);
         $stmt->execute();

          header("location: post_create.php");
          exit;

    }else{

        include "layouts/nav_sidebar.php";

?>

                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-regular fa-square-plus"></i>&nbsp;Post Create</span>
                                <button class="btn btn-danger float-end">Cancel</button>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div>
                                        <div class="mb-3">
                                        <label for="categorySelect" class="form-label">Category</label>
                                        <select id="categorySelect" class="form-select" name="category_id">
                                            <?php
                                                foreach($categories as $category){
                                            ?>
                                            <option value="<?= $category['id']?>"><?php echo $category['name']?></option>

                                            <?php
                                                }
                                            ?>
                                        </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>


<?php
    include "layouts/footer.php";

    }
?>