<?php
    session_start();
    if(isset($_SESSION['user_id'])){
    include "../dbconnect.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        //var_dump($id);

        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        header("location:categories.php");
    
    }else{

        include "layouts/nav_sidebar.php";
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();

?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-list-ul"></i>&nbsp;Category List</span>
                                <a href="category_create.php"><button class="btn btn-primary float-end">Category Create</button></a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            foreach($categories as $category){
                                        ?>
                                        <tr>
                                            <td><?php echo $category['id']?></td>
                                            <td><?php echo $category['name']?></td>
                                            <td>
                                                <a href="category_edit.php?id=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                                                <button type="button" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $category['id'] ?>">Delete</button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </main>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Deleting.....</h1>
                            <input type="hidden" name="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <h3>Are you sure delete?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <form action="" method="post">
                                <input type="hidden" name="id" id="del_id">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>


<?php

    include "layouts/footer.php";

    }
}else{
    header("location:login.php");
}

?>