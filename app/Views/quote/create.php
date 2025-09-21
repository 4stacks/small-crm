<?php
$title = 'Request Quote';
?>

<div class="page-title">
    <h3>Request a Quote</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title no-border">
                <h4>Service Requirements</h4>
            </div>
            <div class="grid-body no-border">
                <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">×</button>
                        <?php echo $_SESSION['msg']; ?>
                    </div>
                <?php endif; ?>
                
                <form action="/quotes/create" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" readonly>
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
                            <input type="text" name="contact" value="<?php echo $user['mobile']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Company Name</label>
                        <div class="col-md-6">
                            <input type="text" name="company" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Services Required</label>
                        <div class="col-md-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="Website Design & Development"> Website Design & Development
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="CMS"> Content Management System
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="SEO"> Search Engine Optimization
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="Social Media"> Social Media Marketing
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="Mobile Development"> Mobile App Development
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="E-commerce"> E-commerce Solutions
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Additional Requirements</label>
                        <div class="col-md-9">
                            <textarea name="query" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="submit" class="btn btn-primary">Submit Quote Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>