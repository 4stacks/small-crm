<?php require_once APP_ROOT . '/Views/layouts/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Ticket</div>
                <div class="card-body">
                    <?php if (isset($data['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $data['error']; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/tickets">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required 
                                   value="<?php echo isset($data['ticket']['subject']) ? $this->escape($data['ticket']['subject']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required><?php 
                                echo isset($data['ticket']['description']) ? $this->escape($data['ticket']['description']) : ''; 
                            ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" id="priority" name="priority" required>
                                    <option value="">Select Priority</option>
                                    <option value="low"<?php echo (isset($data['ticket']['priority']) && $data['ticket']['priority'] === 'low') ? ' selected' : ''; ?>>Low</option>
                                    <option value="medium"<?php echo (isset($data['ticket']['priority']) && $data['ticket']['priority'] === 'medium') ? ' selected' : ''; ?>>Medium</option>
                                    <option value="high"<?php echo (isset($data['ticket']['priority']) && $data['ticket']['priority'] === 'high') ? ' selected' : ''; ?>>High</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create Ticket</button>
                            <a href="/tickets" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/Views/layouts/footer.php'; ?>