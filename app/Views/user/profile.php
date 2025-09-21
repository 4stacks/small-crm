<?php
$title = 'Profile';
?>

<div class="page-title">
    <h3><?php echo $user['name']; ?>'s Profile</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Personal Information</h4>
            </div>
            <div class="grid-body no-border">
                <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">×</button>
                        <?php echo $_SESSION['msg']; ?>
                    </div>
                <?php endif; ?>
                
                <form action="/profile/update" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>" maxlength="10" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gender</label>
                        <div class="col-md-6">
                            <select name="gender" class="form-control" required>
                                <option value="m" <?php echo $user['gender'] == 'm' ? 'selected' : ''; ?>>Male</option>
                                <option value="f" <?php echo $user['gender'] == 'f' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>