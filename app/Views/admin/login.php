<?php
$title = 'Admin Login';
$bodyClass = 'error-body no-top lazy';
?>

<div class="container">
    <div class="row login-container">
        <div class="col-md-5">
            <h2>Admin Sign in</h2>
            <p>Use your administrator credentials to sign in.</p>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php endif; ?>
            <form action="/admin/login" method="post" class="validate">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="text" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <span class="help"></span>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <button class="btn btn-primary btn-cons pull-right" name="login" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>