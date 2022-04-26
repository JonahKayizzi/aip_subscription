<?php
    $sub_id = $_GET['id'];
    $eaip_sub_status = 0;
    $cd_sub_status = 0;
    $paper_sub_status = 0;
    include_once("processes/db_connection_local.php"); 

            $sql = "SELECT sub_name,
                        phy_address,
                        sub_add_date,
                        sub_category,
                        sub_contact_per,
                        sub_email,
                        sub_telephone,
                        sub_box_number,
                        sub_other_contact_info
                            FROM subscribers
                            where sub_id = '$sub_id'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                    $sub_name = $result['sub_name'];
                    $sub_phy_address = $result['phy_address'];
                    $sub_add_date = $result['sub_add_date'];
                    $sub_category = $result['sub_category'];
                    $sub_contact_per = $result['sub_contact_per'];
                    $sub_email = $result['sub_email'];
                    $sub_telephone = $result['sub_telephone'];
                    $sub_box_number = $result['sub_box_number'];
                    $sub_other_contact_info = $result['sub_other_contact_info'];
                }

            $sql = "SELECT id,
                        sub_status,
                        sub_start_date, 
                        sub_exp_date, 
                        sub_date,
                        eaip_user_name,
                        eaip_password
                        FROM subscriptions
                            where subscriber_id = '$sub_id'
                            and sub_type = 'eAip'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                    $eaip_sup_id = $result['id'];
                    $eaip_sub_date = $result['sub_date'];
                    $eaip_sub_start_date = $result['sub_start_date']; 
                    $eaip_sub_exp_date = $result['sub_exp_date']; 
                    $eaip_sub_status = $result['sub_status'] ;
                    $eaip_user_name = $result['eaip_user_name']; 
                    $eaip_password = $result['eaip_password'];
                }

            $sql = "SELECT id,
                        sub_status,
                        sub_start_date, 
                        sub_exp_date, 
                        sub_date
                        FROM subscriptions
                            where subscriber_id = '$sub_id'
                            and sub_type = 'CD'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                    $cd_sup_id = $result['id'];
                    $cd_sub_date = $result['sub_date'];
                    $cd_sub_start_date = $result['sub_start_date']; 
                    $cd_sub_exp_date = $result['sub_exp_date']; 
                    $cd_sub_status = $result['sub_status'] ;
                }

            $sql = "SELECT id, 
                        sub_status,
                        sub_start_date, 
                        sub_exp_date, 
                        sub_date
                        FROM subscriptions
                            where subscriber_id = '$sub_id'
                            and sub_type = 'paper'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                    $paper_sup_id = $result['id'];
                    $paper_sub_date = $result['sub_date'];
                    $paper_sub_start_date = $result['sub_start_date']; 
                    $paper_sub_exp_date = $result['sub_exp_date']; 
                    $paper_sub_status = $result['sub_status'] ;
                }

            $sql = "SELECT count(subscriber_id) as no_eaip FROM subscriptions
                        WHERE subscriber_id = '$sub_id'
                        and sub_type = 'eAIP'";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($query)){
                    $no_eaip = $result['no_eaip'];
                }

            $sql = "SELECT count(subscriber_id) as no_cd FROM subscriptions
                        WHERE subscriber_id = '$sub_id'
                        and sub_type = 'CD'";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($query)){
                    $no_cd = $result['no_cd'];
                }

            $sql = "SELECT count(subscriber_id) as no_paper FROM subscriptions
                        WHERE subscriber_id = '$sub_id'
                        and sub_type = 'paper'";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($query)){
                    $no_paper = $result['no_paper'];
                }

                ?>
<div id="individual-report" class="content-admin">
                    <div class="content-admin-wrapper">
                        <div class="content-admin-main">
                            <div class="content-admin-main-inner">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
    <div class="row">
        <div class="invoice-wrapper">
    <div class="invoice">
        <div class="invoice-header clearfix">
            <div class="invoice-logo">
                <i class="fa fa-rocket"></i> <?php echo $sub_name; ?>
            </div><!-- /.invoice-logo -->

            <div class="invoice-description">
                <strong><?php echo $sub_telephone; ?></strong>
                <span><?php echo $sub_email; ?></span>
            </div>
        </div><!-- /.invoice-header -->

        <div class="invoice-info">
            <div class="row">
                <div class="col-sm-4">
                    <h4>More Contanct Info</h4>

                    <strong>Physical Address: </strong><?php echo $sub_phy_address; ?><br>
                    <strong>Postal Address: </strong><?php echo $sub_box_number; ?><br>
                    <strong>Contact Person: </strong><?php echo $sub_contact_per; ?><br>
                    <strong>Other Contact Information: </strong><?php echo $sub_other_contact_info; ?><br>
               
                </div>

                <div class="col-sm-4">
                    <h4>Category</h4>

                    <?php echo $sub_category; ?><br>
                    
                </div>

                <div class="col-sm-4">
                    <h4>Added on</h4>

                     <?php echo date('Y-m-d', strtotime($sub_add_date)); ?><br>
                     <a href="edit-subscriber.php?menu=2&sub_id=<?php echo $sub_id; ?>" class="btn btn-xs btn-primary">Edit Subscriber Info</a><br>
                    
                </div>

                <div class="col-sm-4">
                    
                     <!--<a id="print_button" class="btn btn-xs btn-primary">Print Page</a><br>-->
                     <button onclick="myFunction()">Print Page</button>
                    
                </div>


            </div><br><br>

            <div class="row">
                <h3 class="page-title">Current Subscriptions</h3>
                <div class="col-sm-4">
                    <?php
                    if($eaip_sub_status != 1){
                            ?>
                            <div class="header-action">
                                <span>New eAIP Subscription</span>
                                <a href="add-eaip-subscription.php?menu=1&submenu=1" class="header-action-inner" title="Add eAIP Subscription" data-toggle="tooltip" data-placement="bottom">
                                    <i class="fa fa-plus"></i>
                                </a><!-- /.header-action-inner -->
                            </div><!-- /.header-action -->
                            <?php
                        }else{
                            $num_of_days_to = strtotime($eaip_sub_exp_date) - strtotime(date('Y-m-d H:i:s'));

                            $expiry_date = date('Y-m-d', strtotime($eaip_sub_exp_date ));

                            $num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

                            $number_of_months = round(($num_of_days_to/30),0);

                            if($number_of_months > 3){
                                ?>
                                <button class="btn btn-sm btn-primary" type="button">
                                    eAIP Subscription  <span class="badge"><i class="fa fa-play-circle"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-eaip-subscription.php?menu=1&submenu=1&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $eaip_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            }else if($number_of_months > 1 && $number_of_months <= 3){
                                ?>
                                <button class="btn btn-sm btn-secondary" type="button">
                                    eAIP subscription  <span class="badge"><i class="fa fa-desktop"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-eaip-subscription.php?menu=1&submenu=1&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $eaip_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            } else{
                                ?>
                                <button class="btn btn-sm btn-danger" type="button">
                                    eAIP Subscription <span class="badge"><i class="fa fa-book"></i></span>
                                </button><br>
                                <?php echo $num_of_days_to." day(s) to go"; ?><br>
                                <a href="manage-eaip-subscription.php?menu=1&submenu=1&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $eaip_sup_id;?>">Manage Subscription</a><br>
                                <a href="subscriber_alert.php?id=<?php echo $sub_id?>&nm=<?php echo $sub_name?>&ty=online&ed=<?php echo $expiry_date?>&em=<?php echo $sub_email?>"><span class="label label-info">Send Reminder to Subscriber</span></a>
                                <?php
                            }
                        
                        }
                        ?>
                    
               
                </div>

                <div class="col-sm-4">
                     <?php
                    if($cd_sub_status != 1){
                            ?>
                            <div class="header-action">
                                <span>New CD Subscription</span>
                                <a href="add-cd-subscription.php?menu=1&submenu=2" class="header-action-inner" title="Add CD Subscription" data-toggle="tooltip" data-placement="bottom">
                                    <i class="fa fa-plus"></i>
                                </a><!-- /.header-action-inner -->
                            </div><!-- /.header-action -->
                            <?php
                        }else{
                            $num_of_days_to = strtotime($cd_sub_exp_date) - strtotime(date('Y-m-d H:i:s'));

                            $expiry_date = date('Y-m-d', strtotime($cd_sub_exp_date ));

                            $num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

                            $number_of_months = round(($num_of_days_to/30),0);

                            if($number_of_months > 3){
                                ?>
                                <button class="btn btn-sm btn-primary" type="button">
                                    CD Subscription <span class="badge"><i class="fa fa-play-circle"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-cd-subscription.php?menu=1&submenu=2&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $cd_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            }else if($number_of_months > 1 && $number_of_months <= 3){
                                ?>
                                <button class="btn btn-sm btn-secondary" type="button">
                                    CD subscription  <span class="badge"><i class="fa fa-desktop"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-cd-subscription.php?menu=1&submenu=2&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $cd_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            } else{
                                ?>
                                <button class="btn btn-sm btn-danger" type="button">
                                    CD Subscription <span class="badge"><i class="fa fa-book"></i></span>
                                </button><br>
                                <?php echo $num_of_days_to." day(s) to go"; ?><br>
                                <a href="manage-cd-subscription.php?menu=1&submenu=2&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $cd_sup_id;?>">Manage Subscription</a><br>
                                <a href="subscriber_alert.php?id=<?php echo $sub_id?>&nm=<?php echo $sub_name?>&ty=CD&ed=<?php echo $expiry_date?>&em=<?php echo $sub_email?>"><span class="label label-info">Send Reminder to Subscriber</span></a>
                                <?php
                            }
                        
                        }
                        ?>
                    
                </div>

                <div class="col-sm-4">
                     <?php
                    if($paper_sub_status != 1){
                            ?>
                            <div class="header-action">
                                <span>New Paper Subscription</span>
                                <a href="add-paper-subscription.php?menu=1&submenu=3" class="header-action-inner" title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom">
                                    <i class="fa fa-plus"></i>
                                </a><!-- /.header-action-inner -->
                            </div><!-- /.header-action -->
                            <?php
                        }else{
                            $num_of_days_to = strtotime($paper_sub_exp_date) - strtotime(date('Y-m-d H:i:s'));

                            $expiry_date = date('Y-m-d', strtotime($paper_sub_exp_date));

                            $num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

                            $number_of_months = round(($num_of_days_to/30),0);

                            if($number_of_months > 3){
                                ?>
                                <button class="btn btn-sm btn-primary" type="button">
                                    Paper Subscription <span class="badge"><i class="fa fa-play-circle"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-paper-subscription.php?menu=1&submenu=3&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $paper_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            }else if($number_of_months > 1 && $number_of_months <= 3){
                                ?>
                                <button class="btn btn-sm btn-secondary" type="button">
                                    Paper subscription  <span class="badge"><i class="fa fa-desktop"></i></span>
                                </button><br>
                                <?php echo round(($num_of_days_to/30),0)." months to go"; ?><br>
                                <a href="manage-paper-subscription.php?menu=1&submenu=3&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $paper_sup_id;?>">Manage Subscription</a><br>
                                <?php
                            } else{
                                ?>
                                <button class="btn btn-sm btn-danger" type="button">
                                    Paper Subscription <span class="badge"><i class="fa fa-book"></i></span>
                                </button><br>
                                <?php echo $num_of_days_to." day(s) to go"; ?><br>
                                <a href="manage-paper-subscription.php?menu=1&submenu=3&sub_id=<?php echo $sub_id;?>&sup_id=<?php echo $paper_sup_id;?>">Manage Subscription</a><br>
                                <a href="subscriber_alert.php?id=<?php echo $sub_id?>&nm=<?php echo $sub_name?>&ty=Paper&ed=<?php echo $expiry_date?>&em=<?php echo $sub_email?>"><span class="label label-info"><span class="icon"><i class="fa fa-envelope"></i></span> Send Reminder to Subscriber</span></a>
                                <?php
                            }
                        
                        }
                        ?>
                    
                </div>

            </div>
        </div><!-- /.invoice-info -->

        <h3 class="page-title">Subscription History</h3>
        <table class="invoice-table table">
            <thead>
            <tr>
                <th>Subscription Status</th>
                <th>Subscription Type</th>
                <th>Subscription Date</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Suscription Amount</th>
                <th>Receipt Number</th>
                <th>Invoice Number</th>
                <th>Subscription Form</th>
                <th>Subscription Receipt</th>
                <th>Subscription Invoice</th>
            </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT sub_status,
                        sub_type, 
                        sub_start_date,
                        sub_exp_date, 
                        sub_date,
                        sub_amount,
                        receipt_no,
                        invoice_no,
                        subscription_form,
                        subscription_receipt,
                        subscription_invoice
                            FROM subscriptions
                            where subscriber_id = '$sub_id'
                            order by sub_exp_date";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <?php
                    if($result['sub_status'] == 1){
                        ?>
                        <td><span class="label label-success">active</span></td>
                        <?php
                    }else{
                        ?>
                        <td><span class="label label-danger">expired</span></td>
                        <?php
                    }
                    ?>
                    <td><?php echo $result['sub_type']; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_date'])); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_start_date'])); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_exp_date'])); ?></td>
                    <td><?php echo $result['sub_amount']; ?></td>
                    <td><?php echo $result['receipt_no']; ?></td>
                    <td><?php echo $result['invoice_no']; ?></td>
                    <td><a href='uploads/<?php echo $result['subscription_form']; ?>'> <?php echo $result['subscription_form']; ?></a></td>
                    <td><a href='uploads/<?php echo $result['subscription_receipt']; ?>'><?php echo $result['subscription_receipt']; ?></a></td>
                    <td><a href='uploads/<?php echo $result['subscription_invoice']; ?>'><?php echo $result['subscription_invoice']; ?></a></td>
                </tr>
                <?php
                }

                ?>
            
            </tbody>
        </table>

        <div class="invoice-summary clearfix">
            <dl class="dl-horizontal pull-right">
                <dt>eAIP subscriptions:</dt>
                <dd><?php echo $no_eaip; ?></dd>
                <dt>CD Subscriptions:</dt>
                <dd><?php echo $no_cd; ?></dd>
                <dt>Paper Subscriptions :</dt>
                <dd><?php echo $no_paper; ?></dd>
            </dl>
        </div><!-- /.invoice-summary -->
    </div><!-- /.invoice -->
</div><!-- /.invoice-wrapper -->
    </div><!-- /.row -->


    
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->

                        <?php require_once('admin_footer.php') ?>
                        
                    </div><!-- /.content-admin-wrapper -->
                </div><!-- /.content-admin -->







<script>
function myFunction() {
    var prtContent = document.getElementById("individual-report");
    var WinPrint = window.open('', '', 'left=0,top=0,width=1200,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('<link rel="stylesheet" href="assets/css/superlist.css">');
    WinPrint.document.write('<link rel="stylesheet" href="assets/libraries/colorbox/example1/colorbox.css">');
    WinPrint.document.write('<link rel="stylesheet" href="assets/libraries/font-awesome/css/font-awesome.min.css">');
    WinPrint.document.write('<link rel="stylesheet" href="assets/libraries/owl.carousel/assets/owl.carousel.css">');
    WinPrint.document.write('<link rel="stylesheet" href="assets/libraries/bootstrap-select/bootstrap-select.min.css">');
    WinPrint.document.write('<link rel="stylesheet" href="assets/libraries/bootstrap-fileinput/fileinput.min.css">');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>
