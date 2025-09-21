<?php
$title = 'Register';
$bodyClass = 'error-body no-top';
?>

<div class="container">
    <div class="row login-container">
        <div class="col-md-5">
            <h2>Register</h2>
            <p>Create your account for CRM access.</p>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php endif; ?>
            <form action="/register" method="post" class="validate">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                        </div>
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
                            <label class="form-label">Password</label>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <div class="controls">
                                <div class="input-with-icon right">
                                    <i class=""></i>
                                    <input type="text" name="phone" class="form-control" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <div class="controls">
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <button class="btn btn-primary btn-cons pull-right" name="submit" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-10">
                    Already have an account? <a href="/login">Login here</a>
                </div>
            </div>
        </div>
    </div>
</div>