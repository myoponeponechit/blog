<?php
    include "layouts/nav_sidebar.php";
    include "../dbconnect.php";
?>

                        <div class="card mb-4 m-3">
                            <div class="card-header">
                                <span style="font-size:20px;font-weight:bold;">Post Create</span>
                                <button class="btn btn-danger float-end">Cancel</button>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" class="form-control" id="photo">
                                        </div>
                                        <div class="mb-3">
                                        <label for="categorySelect" class="form-label">Category</label>
                                        <select id="categorySelect" class="form-select">
                                            <option value="">Select Category</option>
                                        </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>


<?php
    include "layouts/footer.php";
?>