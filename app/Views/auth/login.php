<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="login-email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login-password" name="password" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="login-remember" name="remember">
                            <label class="form-check-label" for="login-remember">Remember Me</label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <a href="/forgot-password">Forgot Password?</a>
                        <span class="mx-2">|</span>
                        <a href="/register">Need an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
