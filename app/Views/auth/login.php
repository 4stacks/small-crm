<?php
$title = 'Login';
$bodyClass = 'error-body no-top';
?>

<div class="container">
    <div class="row login-container">
        <div class="col-md-5">
            <h2>Sign in to CRM</h2>
            <p>Use your registered email address and password to sign in.</p>
            <?php if (isset($_SESSION['action1'])): ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $_SESSION['action1']; ?>
                </div>
            <?php endif; ?>
            <form action="/login" method="post" class="validate">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Email</label>
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
            <div class="row">
                <div class="col-md-10">
                    <a href="/forgot-password">Forgot Password?</a> | <a href="/register">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>