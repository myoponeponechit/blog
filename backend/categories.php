<?php

    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";

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