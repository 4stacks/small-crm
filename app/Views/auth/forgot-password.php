<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($message)): ?>
                        <div class="alert alert-success">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/forgot-password">
                        <div class="mb-3">
                            <label for="reset-email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="reset-email" name="email" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <a href="/login">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>