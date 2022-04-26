<?php
    $menu = null;
    if(isset($_GET['menu'])){
        $menu = $_GET['menu'];
    }
?>
				<div class="sidebar-admin">
                    <ul>
						<li class=""><span>Subscriptions</span></a></li>
                        <li class="<?php if($menu == 1){ echo 'active';} ?>"><a href="subscription-dashboard.php?menu=1&submenu=1"><i class="fa fa-cart-plus"></i></i><span>Paying</span></a></li>
                        <li class="<?php if($menu == 4){ echo 'active';} ?>"><a href="non-paying.php?menu=4"><i class="fa fa-gift"></i><span>Non-Paying</span></a></li>
						<li class=""><span> </span></a></li>
						<li class="<?php if($menu == 2){ echo 'active';} ?>"><a href="subscribers.php?menu=2"><i class="fa fa-users"></i><span>Subscribers</span></a></li>
                        <li class="<?php if($menu == 3){ echo 'active';} ?>"><a href="reports.php?menu=3&submenu=1"><i class="fa fa-bar-chart"></i><span>Reports</span></a></li>
						
                    </ul>
                </div><!-- /.sidebar-admin-->