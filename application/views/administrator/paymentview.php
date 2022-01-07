 <!-- jquery file upload Frame work -->
    <link href="<?php echo base_url(); ?>admintemplate/bower_components/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>admintemplate/bower_components/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.min.css">
    

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Payments</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Payments</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">View Payments</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
         
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Product edit card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Payments</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                     <form action="http://[::1]/goodbi/administrator/update_products_data" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                     <input class="form-control" value="1" name="id" type="hidden">
                                        <div class="product-edit">
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Name</i></span>
                                                                    <span><?php echo $usrDet->cuname; ?></spn>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Email</i></span>
                                                                    <span><?php echo $usrDet->email; ?></spn>
                                                                </div>
                                                            </div>


                                                            <?php foreach ($payments as $paymentsdet) { ?>
                                                      
                                                              
                                                            <div class="col-sm-6" style="margin-top:20px; border-top: 2px solid #d8d8d8; padding-top:20px;">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Plan</i></span>
                                                                    <span><?php if ($paymentsdet->paystatus==1) {echo "Paid"; } else {"Failed";} ?></spn>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="margin-top:20px; border-top: 2px solid #d8d8d8; padding-top:20px;">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Status</i></span>
                                                                    <span><?php echo $paymentsdet->plname; ?></spn>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Payment Time</i></span>
                                                                    <span><?php echo date("M d,Y", strtotime($paymentsdet->created)); ?></spn>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Subscription ID</i></span>
                                                                    <span><?php echo $paymentsdet->stripe_subscription_id; ?></spn>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Customer ID</i></span>
                                                                    <span><?php echo $paymentsdet->stripe_customer_id; ?></spn>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Amount</i></span>
                                                                    <span><?php echo $paymentsdet->plan_amount; ?></spn>
                                                                </div>
                                                            </div>


                                                            
                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Start</i></span>
                                                                    <span><?php echo date("M d,Y", strtotime($paymentsdet->plan_period_start)); ?></spn>
                                                                </div>
                                                            </div>


                                                            
                                                            <div class="col-sm-6">
                                                            <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user">Expiry</i></span>
                                                                    <span><?php echo date("M d,Y", strtotime($paymentsdet->plan_period_end)); ?></spn>
                                                                </div>
                                                            </div>
                                                          
                                                            <?php } ?>


                                                        