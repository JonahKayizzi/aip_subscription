<?php

$subscriber_id = $_GET['sub_id'];
$Subscription_id = $_GET['sup_id'];

include_once("processes/db_connection_local.php");

$sql = "SELECT sub.sub_name,
                sub.sub_email,
                sup.sub_type, 
                sup.sub_start_date,
                sup.sub_exp_date, 
                sup.sub_date,
                sup.sub_amount,
                sup.receipt_no,
                sup.invoice_no,
                sup.subscription_form,
                sup.subscription_receipt,
                sup.subscription_invoice
                    FROM subscriptions sup, subscribers sub
                    where sup.subscriber_id = '$subscriber_id'
                    and sup.subscriber_id = sub.sub_id
                    and sup.id = '$Subscription_id'";

$query = mysqli_query($conn, $sql);

while ($result = mysqli_fetch_assoc($query)){
        $sub_name = $result['sub_name'];
        $sub_type = $result['sub_type'];
        $sub_start_date = $result['sub_start_date'];
        $sub_exp_date = $result['sub_exp_date'];
        $sub_date = $result['sub_date'];
        $sub_amount = $result['sub_amount'];
        $receipt_no = $result['receipt_no'];
        $invoice_no = $result['invoice_no'];
        $subscription_form = $result['subscription_form'];
        $subscription_receipt = $result['subscription_receipt'];
        $subscription_invoice = $result['subscription_invoice'];
        $sub_email = $result['sub_email'];
    }

?>      
<div class="content-admin">
                    <div class="content-admin-wrapper">
                        <div class="content-admin-main">
                            <div class="content-admin-main-inner">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="message">
                <h1>Manage Subscription</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">

        <div class="col-md-9">

                <h2 class="page-title">Edit Current Subscription</h2>
        
        <form action = "processes/edit_paper_subscription.php" method = "POST" enctype="multipart/form-data">

            <input type="hidden" name="sub_id" value="<?php echo $subscriber_id ?>">

            <input type="hidden" name="sup_id" value="<?php echo $Subscription_id ?>">
            
            <div class="form-group">
                <label for="exampleInputEmail1">Subscription Start Date</label>
                <input name="start_date" value="<?php echo date('Y-m-d', strtotime($sub_start_date));?>" type="date" class="form-control" id="exampleInputEmail1">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Subscription End Date</label>
                <input name="end_date" value='<?php echo date('Y-m-d', strtotime($sub_exp_date));?>' type="date" class="form-control" id="exampleInputText1" >
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Subscription Amount</label>
                <input name="sub_amount" value='<?php echo $sub_amount;?>' type="text" class="form-control" id="exampleInputText1" >
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Receipt Number</label>
                <input name="sub_receipt_no" value='<?php echo $receipt_no;?>' type="text" class="form-control" id="exampleInputText1" >
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Invoice Number</label>
                <input name="sub_invoice_no" value='<?php echo $invoice_no;?>' type="text" class="form-control" id="exampleInputText1" >
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Attach Subscription Form (Max 5MB)</label>
                <input name="sub_form" type="file" id="exampleInputFile">
            </div>

              <div class="form-group">
                <label for="exampleInputFile">Attach Receipt (Max 5MB)</label>
                <input name="sub_receipt" type="file" id="exampleInputFile">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Attach Invoice (Max 5MB)</label>
                <input name="sub_invoice" type="file" id="exampleInputFile">
            </div>
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit Subscription</button>
        </form>

    </div>


        <div class="col-md-3">

            <p>
                <strong>For: </strong><?php echo $sub_name; ?>
            </p>

            <p>
                <strong>Type: </strong><?php echo $sub_type; ?>
            </p>

            <p>
                <strong>Subscription Date: </strong><?php echo date('Y-m-d', strtotime($sub_date));?>
            </p>

            <?php

            $num_of_days_to = strtotime($sub_exp_date) - strtotime(date('Y-m-d H:i:s'));

            $num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

            $number_of_months = round(($num_of_days_to/30),0);

            if($number_of_months > 3){
                ?>
                <p><td><a class="btn btn-xs btn-primary"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td></p>
                <?php
            }else if($number_of_months > 1 && $number_of_months <= 3){
                ?>
                <p><td><a class="btn btn-secondary btn-xs"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td></p>
                <?php
            } else{
                ?>
                <p><td><a class="btn btn-xs btn-danger"><?php echo $num_of_days_to." day(s) to go"; ?></a></td></p>

            <p>
                <a href="subscriber_alert.php?id=<?php echo $subscriber_id?>&nm=<?php echo $sub_name?>&ty=Paper&ed=<?php echo date('Y-m-d', strtotime($sub_exp_date))?>&em=<?php echo $sub_email?>"><span class="label label-info"><span class="icon"><i class="fa fa-envelope"></i></span> Send Reminder to Subscriber</span></a>
            </p>
                <?php
            }

            ?>

            <p>
                <strong>Subscription Form: </strong><a href='uploads/<?php echo $subscription_form; ?>'> <?php echo $subscription_form; ?></a>
            </p>
            
            <p>
                <strong>Subscription Receipt: </strong><a href='uploads/<?php echo $subscription_receipt; ?>'> <?php echo $subscription_receipt; ?></a>
            </p>

            <p>
                <strong>Subscription Inovice: </strong><a href='uploads/<?php echo $subscription_invoice; ?>'> <?php echo $subscription_invoice; ?></a>
            </p>    

            <p>
                <a href="end_subscription.php?sup_id=<?php echo $Subscription_id; ?>&sub_id=<?php echo $subscriber_id; ?>">
                    <button class="btn btn-lg btn-warning" type="button">
                        End Subscription
                    </button>
                </a>
            </p>

            <p>
                <a href="renew_subscription.php?menu=1&sup_id=<?php echo $Subscription_id; ?>&sub_id=<?php echo $subscriber_id; ?>">
                    <button class="btn btn-lg btn-info" type="button">
                        Renew Subscription
                    </button>
                </a>
            </p>
        </div>
    </div>

    

    
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->

                        <?php require_once('admin_footer.php') ?>
                        
                    </div><!-- /.content-admin-wrapper -->
                </div><!-- /.content-admin -->