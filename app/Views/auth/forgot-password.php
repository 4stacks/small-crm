<?php
$title = 'Forgot Password';
$bodyClass = 'error-body no-top';
?>

<div class="container">
    <div class="row login-container">
        <div class="col-md-5">
            <h2>Forgot Password</h2>
            <p>Enter your email address to reset your password.</p>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $_SESSION['success']; ?>
                </div>
            <?php endif; ?>
            <form action="/forgot-password" method="post" class="validate">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <button class="btn btn-primary btn-cons pull-right" name="submit" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-10">
                    <a href="/login">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>