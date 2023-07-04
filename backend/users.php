<?php

    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();

?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;"><i class="fa-solid fa-users"></i>&nbsp;User List</span>
                                <a href="user_create.php"><button class="btn btn-primary float-end">User Create</button></a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            foreach($users as $user){
                                        ?>
                                        <tr>
                                            <td><?php echo $user['id']?></td>
                                            <td><?php echo $user['name']?></td>
                                            <td><?php echo $user['email']?></td>
                                            <td><?php echo $user['password']?></td>
                                            <td><?php echo $user['profile']?></td>
                                            <td>
                                                <button class="btn btn-warning">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
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


<?php

    include "layouts/footer.php";

?>