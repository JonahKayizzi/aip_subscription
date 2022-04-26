<?php
    $submenu = null;
    if(isset($_GET['submenu'])){
        $submenu = $_GET['submenu'];
    }
?>
                <div class="sidebar-secondary-admin">
                    <ul>
                        <li class="<?php if($submenu == 1){ echo 'active';} ?>">
                            <a href="reports.php?menu=3&submenu=1">
                                <span class="title">Subscription </span>
                            </a>
                        </li>

                        <li class="<?php if($submenu == 2){ echo 'active';} ?>">
                            <a href="dispatch_list.php?menu=3&submenu=2">  
                                <span class="title">Dispatch List </span>
                            </a>
                        </li>
						
						<li class="<?php if($submenu == 3){ echo 'active';} ?>">
                            <a href="subscribers_report.php?menu=3&submenu=3">  
                                <span class="title">Subscribers </span>
                            </a>
                        </li>

                    </ul>
                </div><!-- /.sidebar-secondary-admin -->