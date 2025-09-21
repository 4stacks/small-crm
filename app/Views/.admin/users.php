<?php
$title = 'Manage Users';
?>

<div class="page-title">
    <h3>Manage Users</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>User List</h4>
            </div>
            <div class="grid-body no-border">
                <table class="table table-hover no-more-tables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['mobile']; ?></td>
                                <td><?php echo $user['gender'] == 'm' ? 'Male' : 'Female'; ?></td>
                                <td>
                                    <a href="/admin/users/edit/<?php echo $user['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="/admin/users/delete/<?php echo $user['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>