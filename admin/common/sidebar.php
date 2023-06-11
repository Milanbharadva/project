<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Mobile Planet</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php
            include_once("include/config.php");
            $qry = "SELECT name FROM admin";
            $res = mysqli_query($conn, $qry);
            $row = mysqli_fetch_row($res);
            ?>
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="dashboard.php" class="d-block"><?php echo $row[0]; ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?php echo ($_SERVER['SCRIPT_NAME']=='/project/admin/dashboard.php'?"active":'') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php
                include_once('include/config.php');
                $qry = "SELECT ID FROM category";
                $res = mysqli_query($conn, $qry);
                $count = mysqli_num_rows($res);
                ?>
                <li class="nav-item">
                <a href="category.php" class="nav-link <?php echo ($_SERVER['SCRIPT_NAME']=='/project/admin/category.php'?"active":'') ?>">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Category
                            <span class="badge badge-info right"><?php echo $count; ?></span>
                        </p>
                    </a>
                    <?php
                include_once('include/config.php');
                $catqry = "SELECT ID FROM product";
                $catres = mysqli_query($conn, $catqry);
                $catcount = mysqli_num_rows($catres);
                ?>
                </li>
                <li class="nav-item">
                <a href="product.php" class="nav-link <?php echo ($_SERVER['SCRIPT_NAME']=='/project/admin/product.php'?"active":'') ?>">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Product
                            <span class="badge badge-info right"><?php echo $catcount; ?></span>
                        </p>
                    </a>
                </li>
                <?php
                include_once('include/config.php');
                $catqry = "SELECT ID FROM user";
                $catres = mysqli_query($conn, $catqry);
                $catcount = mysqli_num_rows($catres);
                ?>
                <li class="nav-item">
                <a href="user.php" class="nav-link <?php echo ($_SERVER['SCRIPT_NAME']=='/project/admin/user.php'?"active":'') ?>">
                        <i class="nav-icon fa fa-user-alt"></i>
                        <p>
                            Users
                            <span class="badge badge-info right"><?php echo $catcount; ?></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?php echo ($_SERVER['SCRIPT_NAME']=='/project/admin/contact.php'?"active":'') ?>">
                        <i class="nav-icon fas fa-phone-alt"></i>
                        <p>
                            Contact Us
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>