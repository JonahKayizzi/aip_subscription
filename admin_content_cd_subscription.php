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
                <h1>CD Subscriptions</h1>

                <div class="header-action">
                    <span>New CD Subscription</span>
                    <a href="add-cd-subscription.php?menu=1&submenu=2" class="header-action-inner" title="Add CD Subscription" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa fa-plus"></i>
                    </a><!-- /.header-action-inner -->
                </div><!-- /.header-action -->

            </div><!-- /.message -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->

    <div class="row">
        <table class="table table-hover mb0">
            <thead>
            <tr>
                <th>#</th>
                <th>Subscriber</th>
                <th>Subscription Date</th>
                <th>Expiration</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            <?php

            include_once("processes/db_connection_local.php"); 

            $sql = "SELECT sub.sub_id,
                        sub.sub_name,
                        supp.sub_status,
                        supp.sub_type,
                        supp.sub_exp_date, 
                        supp.sub_start_date,
                        supp.eaip_user_name, 
                        supp.eaip_password from subscribers as sub,
                                                (select sup.sub_status, 
                                                        sup.subscriber_id,
                                                        sup.sub_type,
                                                        sup.sub_exp_date, 
                                                        sup.sub_start_date,
                                                        sup.eaip_user_name, 
                                                        sup.eaip_password
                                                        from subscriptions as sup,
                                                            (select subscriber_id, 
                                                                    max(sub_exp_date) as max_date 
                                                                    from subscriptions
                                                                    where sub_type = 'CD'
                                                                    group by subscriber_id) as maxx

                                                         where sup.subscriber_id = maxx.subscriber_id
                                                                and sup.sub_exp_date = maxx.max_date) as supp
                                            where supp.subscriber_id = sub.sub_id";

            $query = mysqli_query($conn, $sql);

            $counter = 1;

            while ($result = mysqli_fetch_assoc($query)){

                ?>

                <tr>
                    <th scope="row"><?php echo $counter; ?></th>
                    <td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>"><?php echo $result['sub_name']; ?></a></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_start_date'] )); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_exp_date']) ); ?></td>
                    <?php
                        if($result['sub_status'] != 1){
                            ?>
                            <td><a href="#" class="btn btn-xs btn-danger">Expired</a></td>
                            <?php
                        }else{
                            $num_of_days_to = strtotime($result['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

                            $num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

                            $number_of_months = round(($num_of_days_to/30),0);

                            if($number_of_months > 3){
                                ?>
                                <td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-primary"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td>
                                <?php
                            }else if($number_of_months > 1 && $number_of_months <= 3){
                                ?>
                                <td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-secondary btn-xs"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td>
                                <?php
                            } else{
                                ?>
                                <td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-danger"><?php echo $num_of_days_to." day(s) to go"; ?></a></td>
                                <?php
                            }
                        
                        }
                     ?>
                </tr>

                <?php
                $counter = $counter + 1;
            }

            ?>

            </tbody>
        </table>
    </div><!-- /.row -->

    

    
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->

                        <?php require_once('admin_footer.php') ?>
                        
                    </div><!-- /.content-admin-wrapper -->
                </div><!-- /.content-admin -->
