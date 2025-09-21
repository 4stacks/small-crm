<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
<div class="page-sidebar" id="main-menu">
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
        <div class="user-info-wrapper">
            <?php if (isset($_SESSION['login'])): ?>
                <div class="profile-wrapper">
                    <img src="/public/assets/img/user.png" alt="" width="69" height="69">
                </div>
                <div class="user-info">
                    <div class="greeting">Welcome</div>
                    <div class="username"><?php echo $_SESSION['name']; ?></div>
                </div>
            <?php endif; ?>
        </div>
        <ul>
            <li class="<?php echo $currentPage == 'dashboard.php' ? 'active' : ''; ?>">
                <a href="/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
            </li>
            <li class="<?php echo $currentPage == 'profile.php' ? 'active' : ''; ?>">
                <a href="/profile"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="<?php echo $currentPage == 'view-tickets.php' || $currentPage == 'create-ticket.php' ? 'active' : ''; ?>">
                <a href="javascript:;"><i class="fa fa-ticket"></i> Support Tickets</a>
                <ul class="sub-menu">
                    <li><a href="/tickets/create">Create Ticket</a></li>
                    <li><a href="/tickets">View Tickets</a></li>
                </ul>
            </li>
            <li class="<?php echo $currentPage == 'get-quote.php' ? 'active' : ''; ?>">
                <a href="/quotes/create"><i class="fa fa-money"></i> Request Quote</a>
            </li>
        </ul>
    </div>
</div>