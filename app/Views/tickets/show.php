<?php require_once APP_ROOT . '/Views/layouts/header.php'; ?>

<div class="container py-4">
    <?php if (isset($data['ticket'])): ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            Ticket #<?php echo $this->escape($data['ticket']['ticket_id']); ?>
                            <span class="badge bg-<?php echo $data['ticket']['status'] === 'open' ? 'success' : ($data['ticket']['status'] === 'closed' ? 'danger' : 'warning'); ?> ms-2">
                                <?php echo ucfirst($data['ticket']['status']); ?>
                            </span>
                        </h5>
                        <span class="badge bg-<?php echo $data['ticket']['priority'] === 'high' ? 'danger' : ($data['ticket']['priority'] === 'low' ? 'success' : 'warning'); ?>">
                            <?php echo ucfirst($data['ticket']['priority']); ?> Priority
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $this->escape($data['ticket']['subject']); ?></h5>
                        <p class="text-muted small">
                            Created: <?php echo date('M j, Y g:i A', strtotime($data['ticket']['created_at'])); ?>
                            | Last Updated: <?php echo date('M j, Y g:i A', strtotime($data['ticket']['updated_at'])); ?>
                        </p>
                        <div class="card-text mb-4">
                            <?php echo nl2br($this->escape($data['ticket']['description'])); ?>
                        </div>
                        
                        <?php if ($data['ticket']['status'] !== 'closed'): ?>
                            <form method="POST" action="/tickets/<?php echo $data['ticket']['id']; ?>/close" class="d-inline">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to close this ticket?')">
                                    Close Ticket
                                </button>
                            </form>
                        <?php endif; ?>
                        
                        <a href="/tickets" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card">
                    <div class="card-header">
                        Comments
                    </div>
                    <div class="card-body">
                        <?php if (isset($data['comments']) && !empty($data['comments'])): ?>
                            <?php foreach ($data['comments'] as $comment): ?>
                                <div class="comment mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between">
                                        <strong><?php echo $this->escape($comment['user_name']); ?></strong>
                                        <small class="text-muted">
                                            <?php echo date('M j, Y g:i A', strtotime($comment['created_at'])); ?>
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        <?php echo nl2br($this->escape($comment['content'])); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No comments yet.</p>
                        <?php endif; ?>

                        <?php if ($data['ticket']['status'] !== 'closed'): ?>
                            <form method="POST" action="/tickets/<?php echo $data['ticket']['id']; ?>/comments" class="mt-4">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Add Comment</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ticket Details
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <strong>Status:</strong> <?php echo ucfirst($data['ticket']['status']); ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Priority:</strong> <?php echo ucfirst($data['ticket']['priority']); ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Created By:</strong> <?php echo $this->escape($data['ticket']['user_name']); ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Created:</strong> <?php echo date('M j, Y', strtotime($data['ticket']['created_at'])); ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Last Update:</strong> <?php echo date('M j, Y', strtotime($data['ticket']['updated_at'])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            Ticket not found.
            <a href="/tickets" class="alert-link">Return to ticket list</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/Views/layouts/footer.php'; ?>