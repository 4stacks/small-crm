<?php
$title = 'Dashboard';
?>

<div class="page-title">
    <h3>Dashboard</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="tiles blue weather-widget">
                    <div class="tiles-body">
                        <div class="heading">
                            <div class="pull-left">Total Tickets</div>
                        </div>
                        <div class="big-icon">
                            <i class="fa fa-ticket"></i>
                        </div>
                        <div class="count"><?php echo $totalTickets; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles green weather-widget">
                    <div class="tiles-body">
                        <div class="heading">
                            <div class="pull-left">Open Tickets</div>
                        </div>
                        <div class="big-icon">
                            <i class="fa fa-folder-open"></i>
                        </div>
                        <div class="count"><?php echo $openTickets; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles red weather-widget">
                    <div class="tiles-body">
                        <div class="heading">
                            <div class="pull-left">Closed Tickets</div>
                        </div>
                        <div class="big-icon">
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <div class="count"><?php echo $closedTickets; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles purple weather-widget">
                    <div class="tiles-body">
                        <div class="heading">
                            <div class="pull-left">Quotes Requested</div>
                        </div>
                        <div class="big-icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="count"><?php echo $totalQuotes; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>