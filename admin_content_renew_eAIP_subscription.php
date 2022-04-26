<?php
$subscriber_id = $_GET['sub_id'];
$Subscription_id = $_GET['sup_id'];

include_once("processes/db_connection_local.php");

$sql = "SELECT sub.sub_name,
                sup.sub_type, 
                sup.eaip_user_name,
                sup.eaip_password
                    FROM subscriptions sup, subscribers sub
                    where sup.subscriber_id = '$subscriber_id'
                    and sup.subscriber_id = sub.sub_id
                    and sup.id = '$Subscription_id'";

$query = mysqli_query($conn, $sql);

while ($result = mysqli_fetch_assoc($query)){
        $sub_name = $result['sub_name'];
        $sub_type = $result['sub_type'];
        $eaip_user_name = $result['eaip_user_name'];
        $eaip_password = $result['eaip_password'];
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
                <h1>Renew Subscription</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">
        
        <form action="processes/renew_aip_subscription.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputText1">Subscriber Name</label>
                <input name="sub_name" type="text" value="<?php echo $sub_name; ?>" class="form-control" id="exampleInputText1"  disabled>
            </div>

            <input type="hidden" name="sub_id" value="<?php echo $subscriber_id; ?>">
            <input type="hidden" name="sub_type" value="<?php echo $sub_type; ?>">

            <?php
                if($sub_type == 'eAIP'){

                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Subscription Type</label>
                    <input name="" type="text" class="form-control" value="eAIP" id="exampleInputText1" disabled>
                </div>

                <div class="form-group">
                    <label for="exampleInputText1">eAIP User Name</label>
                    <input name="eaip_user_name" type="text" class="form-control" id="exampleInputText1" value="<?php echo $eaip_user_name; ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputText1">eAIP Password</label>
                    <input name="eaip_password" type="text" class="form-control" id="exampleInputText1" value="<?php echo $eaip_password; ?>">
                </div>
                <?php

                }else if($sub_type == 'CD'){
                    ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subscription Type</label>
                        <input name="" type="text" class="form-control" value="CD" id="exampleInputText1" disabled>
                    </div>
                    <?php

                }else if($sub_type == 'paper'){
                    ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subscription Type</label>
                        <input name="" type="text" class="form-control" value="Paper" id="exampleInputText1" disabled>
                    </div>
                    <?php

                }
             ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Subscription Start Date</label>
                <input style="width:155px" name="start_date" type="date" class="form-control" id="exampleInputEmail1" placeholder="Start Date">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Subscription End Date</label>
                <input style="width:155px" name="end_date" type="date" class="form-control" id="exampleInputText1" placeholder="End Date">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Subscription Amount</label>
                <input name="sub_amount" type="text" class="form-control" id="exampleInputText1" placeholder="USD">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Receipt Number</label>
                <input name="sub_receipt_no" type="text" class="form-control" id="exampleInputText1" placeholder="Receipt No">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Invoice Number</label>
                <input name="sub_invoice_no" type="text" class="form-control" id="exampleInputText1" placeholder="Invoice No (If any)">
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
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Renew Subscription</button>
        </form>

    </div><!-- /.row -->

    

    
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->

                        <?php require_once('admin_footer.php') ?>
                        
                    </div><!-- /.content-admin-wrapper -->
                </div><!-- /.content-admin -->