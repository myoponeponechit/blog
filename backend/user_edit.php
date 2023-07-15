<?php 
session_start();
if(isset($_SESSION['user_id'])){
  include "../dbconnect.php";

$id=$_GET['id'];

// var_dump($id);

  $sql="SELECT * FROM users WHERE users.id=:id";
 $stmt=$conn->prepare($sql);
 $stmt->bindParam(':id',$id);
 $stmt->execute();
 $user=$stmt->fetch(PDO::FETCH_ASSOC);

//  var_dump($user);

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $photo_arr = $_FILES['new_photo'];
   // $profile = $_POST['profile'];
    $photo_arr = $_FILES['new_photo'];
    $old_photo = $_POST['profile'];


    // echo "$title and $category_id and $user_id and $description";
    // print_r($photo_arr);

    if(isset($photo_arr) && $photo_arr['size'] > 0){
        $dir = 'images/';
        $profile = $dir.$photo_arr['name']; // images/photo_name.png
        
        $tmp_name = $photo_arr['tmp_name'];
        move_uploaded_file($tmp_name,$profile);
    }else {
        $profile = $old_photo;
    } 

    $sql="UPDATE users SET name=:name,email=:email,password=:password,profile=:profile WHERE id=:id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':profile',$profile);
    $stmt->execute();

    header('location:users.php');
    exit();

  }else{
    include "layouts/nav_sidebar.php";

  }

?>

<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-user-pen"></i>&nbsp;User Update</span>
            <a href="users.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$user['id']?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=$user['name']?>">
                </div>
                 <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?=$user['email']?>">
                 </div>
                <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input class="form-control" type="password" id="password" name="password" value="<?=$user['password']?>">
                </div>
                <div class="mb-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photo-tab-pane" type="button" role="tab" aria-controls="photo-tab-pane" aria-selected="true">Photo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="new_photo-tab" data-bs-toggle="tab" data-bs-target="#new_photo-tab-pane" type="button" role="tab" aria-controls="new_photo-tab-pane" aria-selected="false">New Photo</button>
                                </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="photo-tab-pane" role="tabpanel" aria-labelledby="photo-tab" tabindex="0">
                                    <img src="<?= $user['profile'] ?>" alt="" srcset="" class="img-fluid w-50 h-50 py-5">
                                    <input type="hidden" value="<?= $user['profile'] ?>" name="profile">
                                </div>
                                <div class="tab-pane fade" id="new_photo-tab-pane" role="tabpanel" aria-labelledby="new_photo-tab" tabindex="0">
                                    <input type="file" class="form-control my-5" id="photo" name="new_photo">
                                </div>
                                </div>

                        </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Update</button>
            </form>
        </div>
    </div>
  
</div>


<?php 
include "layouts/footer.php";

}else{
    header("location:login.php");
}

?>