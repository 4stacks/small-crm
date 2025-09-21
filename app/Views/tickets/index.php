<?php $view->includeView("layouts/header"); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Tickets</h1>
        <a href="/tickets/create" class="btn btn-primary">Create New Ticket</a>
    </div>

    <?php if (isset($data['success'])): ?>
        <div class="alert alert-success">
            <?php echo $data['success']; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($data['tickets']) && !empty($data['tickets'])): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['tickets'] as $ticket): ?>
                        <tr>
                            <td><?php echo $this->escape($ticket['ticket_id']); ?></td>
                            <td><?php echo $this->escape($ticket['subject']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $ticket['status'] === 'open' ? 'success' : ($ticket['status'] === 'closed' ? 'danger' : 'warning'); ?>">
                                    <?php echo ucfirst($ticket['status']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo $ticket['priority'] === 'high' ? 'danger' : ($ticket['priority'] === 'low' ? 'success' : 'warning'); ?>">
                                    <?php echo ucfirst($ticket['priority']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($ticket['created_at'])); ?></td>
                            <td><?php echo date('M j, Y', strtotime($ticket['updated_at'])); ?></td>
                            <td>
                                <a href="/tickets/<?php echo $ticket['id']; ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No tickets found. <a href="/tickets/create">Create your first ticket</a>
        </div>
    <?php endif; ?>
</div>

<?php $view->includeView("layouts/footer"); ?>