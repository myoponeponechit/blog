<?php
    session_start();
    if(isset($_SESSION['user_id'])){
    include "../dbconnect.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_POST['name'];

        $sql = "INSERT INTO categories (name) VALUES(:name)";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(':name',$name);
         $stmt->execute();

        header("location: categories.php");
        exit;

    }else{

        include "layouts/nav_sidebar.php";

?>

                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-list-ol"></i>&nbsp;Category Create</span>
                                <a href="categories.php"><button class="btn btn-danger float-end">Cancel</button></a>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Category Name</label>
                                            <input type="text" id="name" class="form-control"name="name">
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
}else{
    header("location:login.php");
}

?>