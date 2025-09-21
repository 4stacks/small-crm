<?php $view->includeView("layouts/header"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    <?php if (isset($data['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $data['error']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($data['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $data['success']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/forgot-password">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
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

<?php $view->includeView("layouts/footer"); ?>