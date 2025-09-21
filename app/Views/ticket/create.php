<?php
$title = 'Create Ticket';
?>

<div class="page-title">
    <h3>Create Support Ticket</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>New Ticket</h4>
            </div>
            <div class="grid-body no-border">
                <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">×</button>
                        <?php echo $_SESSION['msg']; ?>
                    </div>
                <?php endif; ?>
                
                <form action="/tickets/create" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Subject</label>
                        <div class="col-md-9">
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Task Type</label>
                        <div class="col-md-9">
                            <select name="tasktype" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="billing">Billing</option>
                                <option value="technical">Technical</option>
                                <option value="general">General Query</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Priority</label>
                        <div class="col-md-9">
                            <select name="priority" class="form-control" required>
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="submit" class="btn btn-primary">Create Ticket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>