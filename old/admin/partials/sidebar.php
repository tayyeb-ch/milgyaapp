<?php
    if (!isset($_SESSION['admin_email'])) {
        header("Location: login.php");
    }
?>
<div class="nav-left-sidebar sidebar-dark">

    <div class="menu-list">

        <nav class="navbar navbar-expand-lg navbar-light">

            <a class="d-xl-none d-lg-none" href="index.php">Dashboard</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav flex-column">

                    <li class="nav-item ">
                        <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="categories.php"><i class="fas fa-tachometer-alt"></i>Categories</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="items.php"><i class="fas fa-tachometer-alt"></i>Items</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="users.php"><i class="fas fa-tachometer-alt"></i>Users</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="contact-form.php"><i class="fas fa-tachometer-alt"></i>Contact Form</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a>
                    </li>

                </ul>

            </div>

        </nav>

    </div>

</div>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    