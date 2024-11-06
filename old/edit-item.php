<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
    <?php
        if (isset($_GET['id'])) {
            
            $item_id = $_GET['id'];

            $item = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM items WHERE id = '$item_id'"));

            $cat = mysqli_fetch_array(mysqli_query($connection, "SELECT id, name FROM categories WHERE id = '" . $item['category_id'] . "'"));

        }
    ?>

        <section class="dashboard section">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                        <?php include("partials/sidebar.php"); ?>
                    </div>
                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                        <!-- Recently Favorited -->
                        <div class="widget dashboard-container my-adslist">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Update Lost Items</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="my-lost-items.php" class="badge bg-dark text-white py-2 px-3">Go Back</a>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['updateitem'])) {
                                        
                                        $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
                                        $type = mysqli_real_escape_string($connection, $_POST['type']);
                                        $title = mysqli_real_escape_string($connection, $_POST['title']);
                                        $location = mysqli_real_escape_string($connection, $_POST['location']);

                                        if (!empty($_FILES['picture']['name'])) {

                                            $picture         = $_FILES['picture']['name'];
                                            $picture_tmp     = $_FILES['picture']['tmp_name'];
                                            $picture_path = "images/items/" . $picture;
                                            move_uploaded_file($picture_tmp, "images/items/$picture");

                                        } else {
                                            $picture_path = $item['picture'];
                                        }

                                        $description = mysqli_real_escape_string($connection, $_POST['description']);

                                        $updateitem = mysqli_query($connection, "

                                            UPDATE items SET 
                                            category_id = '$category_id', 
                                            title = '$title', 
                                            description = '$description', 
                                            picture = '$picture_path', 
                                            location = '$location', 
                                            type = '$type' 
                                            WHERE id = '$item_id'

                                            ");

                                        if ($updateitem) {
                                            echo "<div class='alert alert-success'>Item Updated Successfully!</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Problem updating item. Please try again!</div>";
                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" id="" class="form-control" required="">
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                        <?php
                                            $categories = mysqli_query($connection, "SELECT * FROM categories");
                                            while ($category = mysqli_fetch_array($categories)) {
                                                ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="type" class="form-control" required="">
                                        <option value="<?php echo $item['type']; ?>"><?php echo $item['type']; ?></option>
                                        <option value="Found">Found</option>
                                        <option value="Lost">Lost</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="<?php echo $item['title']; ?>" placeholder="Enter Title" class="form-control" required=""> 
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Location</label>
                                    <input type="text" name="location" value="<?php echo $item['location']; ?>" placeholder="Enter Location" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Picture</label><br>
                                    <img src="<?php echo $item['picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                    <input type="file" name="picture" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="5" rows="5" placeholder="Write here..." class="form-control" required=""><?php echo $item['description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="updateitem" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Save</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </section>

<?php include("partials/footer.php"); ?>