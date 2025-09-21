<nav class="header navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/dashboard">
                <img src="/public/assets/img/logo.png" class="logo" alt="logo">
                <img src="/public/assets/img/logo-white.png" class="logo-white" alt="logo">
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['login'])): ?>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> 
                            <?php echo $_SESSION['name']; ?> 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="/change-password"><i class="fa fa-lock"></i> Change Password</a></li>
                            <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>