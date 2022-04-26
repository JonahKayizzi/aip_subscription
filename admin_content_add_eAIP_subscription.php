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
                <h1>New eAIP Subscription</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">
        
        <form action="processes/add_eaip_subscription.php" method="POST" enctype="multipart/form-data">
            <div style="width:500px" class="form-group">
                <label for="exampleInputText1">Subscriber Name</label>
                <select name="subscriber_id" class="form-control" title="Select Subscriber">
                    <?php

                    require_once('processes/db_connection_local.php');

                    $sql = "SELECT sub_id, sub_name from subscribers 
                                    WHERE sub_id NOT IN 
                                (select subscriber_id from subscriptions WHERE sub_type = 'eAIP' AND sub_status != 0)
                                ORDER BY sub_name";

                    $query = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($query) ){
                        ?>
                        <option value='<?php echo $result['sub_id']; ?>' ><?php echo $result['sub_name']; ?></option>

                        <?php
                    }

                    ?>
                </select>
            </div>

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
                <input style="width:500px" name="sub_amount" type="text" class="form-control" id="exampleInputText1" placeholder="USD">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Receipt Number</label>
                <input style="width:500px" name="sub_receipt_no" type="text" class="form-control" id="exampleInputText1" placeholder="Receipt No">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Invoice Number</label>
                <input style="width:500px" name="sub_invoice_no" type="text" class="form-control" id="exampleInputText1" placeholder="Invoice No (If any)">
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

            <div class="form-group">
                <label for="exampleInputText1">eAIP User Name</label>
                <input style="width:500px" name="eaip_user_name" type="text" class="form-control" id="exampleInputText1" placeholder="eAIP User Name">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">eAIP Password</label>
                <input style="width:500px" name="eaip_password" type="text" class="form-control" id="exampleInputText1" placeholder="eAIP Password">
            </div>
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subscription</button>
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