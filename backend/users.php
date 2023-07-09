<?php 
 
 
 include "../dbconnect.php";
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $id = $_POST['id'];
    //var_dump($id);

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location:users.php");
    

 }else{
    include "layouts/nav_sidebar.php";
 
    $sql="SELECT * FROM users";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $users=$stmt->fetchAll();

    //  var_dump($users);

?>
                 <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="post.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-folder-open"></i>&nbsp;User List</span>
                                <a href="user_create.php"><button class="btn btn-primary float-end">User Create</button></a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($users as $user){
                                        ?>
                                        <tr>
                                            <!-- <td></td> -->
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['email']?></td>
                                            <td><?= $user['password']?></td>
                                            <td><?= $user['profile']?></td>
                                            <td><a href="user_edit.php?id=<?=$user['id']?>" class="btn btn-warning mx-3">Edit</a>
                                            <button type="button" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $user['id'] ?>">Delete</button>
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
?>