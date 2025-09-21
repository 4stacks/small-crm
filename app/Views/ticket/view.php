<?php
$title = 'Ticket Details';
?>

<div class="page-title">
    <h3>Ticket Details</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Ticket #<?php echo $ticket['ticket_id']; ?></h4>
                <div class="tools">
                    <a href="/tickets" class="btn btn-default btn-sm">Back to Tickets</a>
                </div>
            </div>
            <div class="grid-body no-border">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <div class="controls">
                                <p class="form-control-static"><?php echo $ticket['subject']; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Task Type</label>
                            <div class="controls">
                                <p class="form-control-static"><?php echo ucfirst($ticket['task_type']); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Priority</label>
                            <div class="controls">
                                <p class="form-control-static"><?php echo ucfirst($ticket['prioprity']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <p class="form-control-static">
                                    <span class="label <?php echo $ticket['status'] == 'Open' ? 'label-success' : 'label-danger'; ?>">
                                        <?php echo $ticket['status']; ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Created Date</label>
                            <div class="controls">
                                <p class="form-control-static"><?php echo date('d-m-Y', strtotime($ticket['posting_date'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div class="controls">
                                <div class="well">
                                    <?php echo nl2br($ticket['ticket']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($ticket['status'] == 'Open'): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/tickets/close/<?php echo $ticket['ticket_id']; ?>" method="post">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to close this ticket?')">
                                    Close Ticket
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>