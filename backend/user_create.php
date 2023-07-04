<?php
    
    include "../dbconnect.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile_arr = $_FILES['profile'];

        if(isset($profile_arr) && $profile_arr['size'] > 0){
            $dir = 'images/';
            $profile = $dir.$profile_arr['name'];    // images/photo_name.png
            
            $tmp_name = $profile_arr['tmp_name'];
            move_uploaded_file($tmp_name,$profile);
        };

        $sql = "INSERT INTO users (name,email,password,profile) VALUES(:name, :email, :password, :profile)";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':name',$name);
         $stmt->bindParam(':email',$email);
         $stmt->bindParam(':password',$password);
         $stmt->bindParam(':profile',$profile);
         $stmt->execute();

        header("location: user_create.php");
        exit;

    }else{

        include "layouts/nav_sidebar.php";

?>

                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-user-plus"></i>&nbsp;User Create</span>
                                <a href="users.php"><button class="btn btn-danger float-end">Cancel</button></a>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" class="form-control"name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password" name="confirm_password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="profile" class="form-label">Profile Photo</label>
                                            <input type="file" class="form-control" id="profile" name="profile">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            
                        </script>



<?php

    include "layouts/footer.php";

    }

?>