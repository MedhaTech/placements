<!-- SIDEBAR -->
<aside class="site-sidebar clearfix">
    <div class="container-fluid">
        <nav class="sidebar-nav">
            <ul class="nav in side-menu">

                <!-- Dashboard -->
                <li>
                    <a href="dashboard.php">
                        <i class="list-icon material-icons">home</i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- Company -->
                <li>
                    <a href="company.php">
                        <i class="list-icon material-icons">business</i>
                        <span class="hide-menu">Company</span>
                    </a>
                </li>

                <!-- Student (with dropdown) -->
                <li class="menu-item-has-children">
                    <a href="javascript:void(0);">
                        <i class="list-icon material-icons">school</i>
                        <span class="hide-menu">Student</span>
                    </a>
                    <ul class="list-unstyled sub-menu">
                     <li><a href="<?= base_url('admin/uploadExcel') ?>">Bulk Upload</a></li>
                    </ul>
                </li>

                <!-- Reports -->
                <li>
                    <a href="reports.php">
                        <i class="list-icon material-icons">insert_chart</i>
                        <span class="hide-menu">Reports</span>
                    </a>
                </li>

            </ul>
            <!-- /.side-menu -->
        </nav>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.container -->
</aside>
