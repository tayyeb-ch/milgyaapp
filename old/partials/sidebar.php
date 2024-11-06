<?php
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    $user = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'"));
?>
<div class="sidebar">

    <div class="widget user-dashboard-profile">
        
        <h5 class="text-center"><?php echo $user['fullname']; ?></h5>
        <p>Joined <?php echo date('d-M-Y',strtotime($user['created_at'])); ?></p>
        <a href="edit-profile.php" class="btn btn-main-sm">Edit Profile</a>
    </div>
    
    <div class="widget user-dashboard-menu">
        <ul>
            <li><a href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
            <li><a href="my-lost-items.php"><i class="fa fa-file-archive-o"></i> My Lost Items</a></li>
            <li><a href="edit-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
            <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-power-off"></i>Logout</a>
            </li>
        </ul>
    </div>
    
</div>