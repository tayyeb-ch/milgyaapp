<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>

        <?php
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];

                $category = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '$category_id'"));

                $categorywise = mysqli_query($connection, "SELECT * FROM  items WHERE category_id = '$category_id'");

                $countItems = mysqli_num_rows($categorywise);

            }
        ?>

        <section class="section-sm">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="search-result bg-gray">
                            <h2>Results For "<?php echo $category['name']; ?>"</h2>
                            <p><?php echo $countItems; ?> Results</p>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="category-sidebar">

                            <div class="widget category-list">
                                <h4 class="widget-header">All Category</h4>
                                <ul class="category-list">
                                    <?php
                                        $categories = mysqli_query($connection, "SELECT * FROM categories");

                                        while ($cat = mysqli_fetch_array($categories)) {
                                            ?>
                                            <li><a href="category.php?category_id=<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="product-grid-list">
                            <div class="row mt-30">
                                <?php
                                    
                                    if (mysqli_num_rows($categorywise) > 0) {
                                    
                                        while ($item = mysqli_fetch_array($categorywise)) {
                                            ?>
                                            <div class="col-sm-12 col-lg-4">
                                                <!-- product card -->
                                                <div class="product-item bg-light">
                                                    <div class="card">
                                                        <div class="thumb-content">
                                                            <?php
                                                                if (!empty($item['picture'])) {
                                                                    $itempicturepath = $item['picture'];
                                                                } else {
                                                                    $itempicturepath = "images/placeholder.png";
                                                                }
                                                            ?>
                                                            <a href="item.php?id=<?php echo $item['id']; ?>">
                                                                <img class="card-img-top img-fluid" src="<?php echo $itempicturepath; ?>" alt="<?php echo $item['title']; ?>" style="width: 350px;height: 260px;">
                                                            </a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="card-title"><a href="item.php?id=<?php echo $item['id']; ?>"><?php echo $item['type'] . " : " . $item['title']; ?></a></h4>
                                                            <ul class="list-inline product-meta">
                                                                <li class="list-inline-item">
                                                                    <a href="item.php?id=<?php echo $item['id']; ?>">
                                                                        <i class="fa fa-folder-open-o"></i>
                                                                        <?php
                                                                            $category = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM categories WHERE id = '" . $item['category_id'] . "'"));
                                                                            echo $category['name'];
                                                                        ?>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <a href="item.php?id=<?php echo $item['id']; ?>"><i class="fa fa-calendar"></i><?php echo date('d-M-Y',strtotime($item['created_at'])); ?></a>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <a><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $item['views']; ?></a>
                                                                </li>
                                                            </ul>
                                                            <p class="card-text">
                                                                <?php
                                                                    echo substr($item['description'], 0,60);
                                                                ?>...
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    } else {
                                        ?>
                                        <div class="col-md-12 text-center">
                                            <h4>No Items Found!</h4>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                        
                    </div>

                </div>

            </div>

        </section>

<?php include("partials/footer.php"); ?>