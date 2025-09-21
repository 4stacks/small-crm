<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <?php if (isset($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/register">
                        <div class="mb-3">
                            <label for="register-name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="register-name" name="name" required value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="register-email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="register-email" name="email" required value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="register-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="register-password" name="password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="register-confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="register-confirm-password" name="confirm_password" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <span>Already have an account?</span>
                        <a href="/login">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $view->includeView("layouts/footer"); ?>