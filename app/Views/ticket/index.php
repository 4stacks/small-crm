<?php
$title = 'View Tickets';
?>

<div class="page-title">
    <h3>Support Tickets</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Your Tickets</h4>
                <div class="tools">
                    <a href="/tickets/create" class="btn btn-primary btn-sm">Create New Ticket</a>
                </div>
            </div>
            <div class="grid-body no-border">
                <table class="table table-hover no-more-tables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Task Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $index => $ticket): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $ticket['ticket_id']; ?></td>
                                <td><?php echo $ticket['subject']; ?></td>
                                <td><?php echo ucfirst($ticket['task_type']); ?></td>
                                <td><?php echo ucfirst($ticket['prioprity']); ?></td>
                                <td>
                                    <span class="label <?php echo $ticket['status'] == 'Open' ? 'label-success' : 'label-danger'; ?>">
                                        <?php echo $ticket['status']; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d-m-Y', strtotime($ticket['posting_date'])); ?></td>
                                <td>
                                    <a href="/tickets/view/<?php echo $ticket['ticket_id']; ?>" class="btn btn-primary btn-xs">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($tickets)): ?>
                            <tr>
                                <td colspan="8" class="text-center">No tickets found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>