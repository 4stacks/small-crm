<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<div class="page-sidebar" id="main-menu">
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
        <div class="user-info-wrapper">
            <div class="profile-wrapper">
                <img src="/public/assets/img/admin.png" alt="" width="69" height="69">
            </div>
            <div class="user-info">
                <div class="greeting">Welcome</div>
                <div class="username">Administrator</div>
            </div>
        </div>
        <ul>
            <li class="<?php echo $currentPage == 'home.php' ? 'active' : ''; ?>">
                <a href="/admin/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
            </li>
            <li class="<?php echo $currentPage == 'manage-users.php' ? 'active' : ''; ?>">
                <a href="/admin/users"><i class="fa fa-users"></i> Manage Users</a>
            </li>
            <li class="<?php echo $currentPage == 'manage-tickets.php' ? 'active' : ''; ?>">
                <a href="/admin/tickets"><i class="fa fa-ticket"></i> Manage Tickets</a>
            </li>
            <li class="<?php echo $currentPage == 'manage-quotes.php' ? 'active' : ''; ?>">
                <a href="/admin/quotes"><i class="fa fa-money"></i> Manage Quotes</a>
            </li>
            <li class="<?php echo $currentPage == 'user-access-log.php' ? 'active' : ''; ?>">
                <a href="/admin/access-logs"><i class="fa fa-clock-o"></i> User Access Logs</a>
            </li>
        </ul>
    </div>
</div>