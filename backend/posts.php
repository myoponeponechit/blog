<?php
    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";

    $sql = "SELECT * FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();

?>

                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;">Post List</span>
                                <button class="btn btn-primary float-end">Post Create</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tital</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>#</th>
                                            <th>Tital</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            foreach($posts as $post){
                                        ?>
                                        <tr>
                                            <td><?php echo $post['id']?></td>
                                            <td><?php echo $post['title']?></td>
                                            <td><?php echo $post['category_id']?></td>
                                            <td><?php echo $post['user_id']?></td>
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


<?php
    include "layouts/footer.php";
?>