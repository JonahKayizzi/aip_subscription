<?php
    $submenu = null;
    if(isset($_GET['submenu'])){
        $submenu = $_GET['submenu'];
    }

    require_once('processes/db_connection_local.php');

    $sql = "SELECT count(subscriber_id) as eaip_no from (
                    SELECT subscriber_id, 
                            max(sub_exp_date) as max_date 
                        from subscriptions
                        where sub_type = 'eAIP'
                        group by subscriber_id) as active_sub";

    $query = mysqli_query($conn, $sql);

    while ($result = mysqli_fetch_assoc($query)){
            $eaip_no = $result['eaip_no'];
        }

    $sql = "SELECT count(subscriber_id) as cd_no from (
                    SELECT subscriber_id, 
                            max(sub_exp_date) as max_date 
                        from subscriptions
                        where sub_type = 'CD'
                        group by subscriber_id) as active_sub";

    $query = mysqli_query($conn, $sql);

    while ($result = mysqli_fetch_assoc($query)){
            $cd_no = $result['cd_no'];
        }

    $sql = "SELECT count(subscriber_id) as paper_no from (
                    SELECT subscriber_id, 
                            max(sub_exp_date) as max_date 
                        from subscriptions
                        where sub_type = 'paper'
                        group by subscriber_id) as active_sub";

    $query = mysqli_query($conn, $sql);

    while ($result = mysqli_fetch_assoc($query)){
            $paper_no = $result['paper_no'];
        }


    ?>
                <div class="sidebar-secondary-admin">
                    <ul>
                        <li class="<?php if($submenu == 1){ echo 'active';} ?>">
                            <a href="subscription-dashboard.php?menu=1&submenu=1">
                                <span class="icon"><i class="fa fa-desktop"></i></span>
                                <span class="title">eAIP <span class="notification"><?php echo $eaip_no; ?></span></span>
                                <span class="subtitle"></span>
                            </a>
                        </li>

                        <li class="<?php if($submenu == 2){ echo 'active';} ?>">
                            <a href="cd-subscriptions.php?menu=1&submenu=2">
                                <span class="icon"><i class="fa fa-play-circle"></i></span>
                                <span class="title">CD <span class="notification"><?php echo $cd_no; ?></span> </span>
                                <span class="subtitle"></span>
                            </a>
                        </li>

                        <li class="<?php if($submenu == 3){ echo 'active';} ?>">
                            <a href="paper-subscriptions.php?menu=1&submenu=3">
                                <span class="icon"><i class="fa fa-book"></i></span>
                                <span class="title">Paper <span class="notification"><?php echo $paper_no; ?></span></span>
                                <span class="subtitle"></span>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.sidebar-secondary-admin -->