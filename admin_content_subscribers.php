<style>

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  width:33%
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

</style>
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
                <h1>Subscribers</h1>
                <div class="header-action">
                    <span>New Subscriber</span>
                    <a href="add-subscriber.php?menu=2" class="header-action-inner" title="Add Subscriber" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa fa-plus"></i>
                    </a><!-- /.header-action-inner -->
                </div><!-- /.header-action -->
            </div><!-- /.message -->
			
			<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'London')">Paying Subscribers</button>
			  <button class="tablinks" onclick="openCity(event, 'Paris')">AIS of States</button>
			  <button class="tablinks" onclick="openCity(event, 'Tokyo')">CAA Staff</button>
			</div>

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->
	
		<div class="row">
		
			<div id="London" class="tabcontent">
        
				<table class="table table-hover mb0">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>online</th>
					<th>CD</th>
					<th>paper</th>
				<th>Category</th>
					<th>Email</th>
					<th>Postal Address</th>
					<th>Physical Address</th>
					<th>Tel Contact</th>
					<th>Other Contacts</th>
					<th>Contact Person</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
				</thead>

				<tbody>

				<?php

				include_once("processes/db_connection_local.php"); 

				$sql = "SELECT * from subscribers
								where sub_category = 'Paying Subscribers' 
								order by sub_name";
								

				$query = mysqli_query($conn, $sql);

				$counter = 1;
				

				while ($result = mysqli_fetch_assoc($query)){

					?>

					<tr>
						<th scope="row"><?php echo $counter; ?></th>
						<td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>"><?php echo $result['sub_name']; ?></a></td>
						<?php
						$sub_status_id = $result['sub_id'];
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'eAIP'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
						
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-eaip-subscription.php?menu=1&submenu=1" class="header-action-inner" title="Add eAIP Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'CD'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						$sub_present = mysqli_num_rows($query_sub_status);
				
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-cd-subscription.php?menu=1&submenu=2" class="header-action-inner" title="Add CD Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i></a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'paper'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom" href="add-paper-subscription.php?menu=1&submenu=3" class="header-action-inner" title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
							
						?>

						<td><?php echo $result['sub_category']; ?></td>
						<td><?php echo $result['sub_email']; ?></td>
						<td><?php echo $result['sub_box_number']; ?></td>
						<td><?php echo $result['phy_address']; ?></td>
						<td><?php echo $result['sub_telephone']; ?></td>
						<td><?php echo $result['sub_other_contact_info']; ?></td>
						<td><?php echo $result['sub_contact_per']; ?></td>
						<td><?php echo date('Y-m-d',strtotime($result['sub_add_date'])); ?></td>
						<td><a href="edit-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-secondary btn-xs"> Edit </a>
							<a href="processes/delete-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-danger"> Delete </a>
						</td>
					</tr>

					<?php
					$counter = $counter + 1;
				}

				?>
				
				</tbody>
			</table>
		</div>
		<div id="Paris" class="tabcontent" style="display:none">
			
			<table class="table table-hover mb0">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>online</th>
					<th>CD</th>
					<th>paper</th>
				<th>Category</th>
					<th>Email</th>
					<th>Postal Address</th>
					<th>Physical Address</th>
					<th>Tel Contact</th>
					<th>Other Contacts</th>
					<th>Contact Person</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
				</thead>

				<tbody>

				<?php

				include_once("processes/db_connection_local.php"); 

				$sql = "SELECT * from subscribers
								where sub_category = 'AIS of States' 
								order by sub_name";
								

				$query = mysqli_query($conn, $sql);

				$counter = 1;
				

				while ($result = mysqli_fetch_assoc($query)){

					?>

					<tr>
						<th scope="row"><?php echo $counter; ?></th>
						<td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>"><?php echo $result['sub_name']; ?></a></td>
						<?php
						$sub_status_id = $result['sub_id'];
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'eAIP'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
						
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-eaip-subscription.php?menu=1&submenu=1" class="header-action-inner" title="Add eAIP Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'CD'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						$sub_present = mysqli_num_rows($query_sub_status);
				
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-cd-subscription.php?menu=1&submenu=2" class="header-action-inner" title="Add CD Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i></a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'paper'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom" href="add-paper-subscription.php?menu=1&submenu=3" class="header-action-inner" title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
							
						?>

						<td><?php echo $result['sub_category']; ?></td>
						<td><?php echo $result['sub_email']; ?></td>
						<td><?php echo $result['sub_box_number']; ?></td>
						<td><?php echo $result['phy_address']; ?></td>
						<td><?php echo $result['sub_telephone']; ?></td>
						<td><?php echo $result['sub_other_contact_info']; ?></td>
						<td><?php echo $result['sub_contact_per']; ?></td>
						<td><?php echo date('Y-m-d',strtotime($result['sub_add_date'])); ?></td>
						<td><a href="edit-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-secondary btn-xs"> Edit </a>
							<a href="processes/delete-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-danger"> Delete </a>
						</td>
					</tr>

					<?php
					$counter = $counter + 1;
				}

				?>
				
				</tbody>
			</table>
			
		</div>

		<div id="Tokyo" class="tabcontent" style="display:none">
		  
		  <table class="table table-hover mb0">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>online</th>
					<th>CD</th>
					<th>paper</th>
				<th>Category</th>
					<th>Email</th>
					<th>Postal Address</th>
					<th>Physical Address</th>
					<th>Tel Contact</th>
					<th>Other Contacts</th>
					<th>Contact Person</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
				</thead>

				<tbody>

				<?php

				include_once("processes/db_connection_local.php"); 

				$sql = "SELECT * from subscribers
								where sub_category = 'CAA Staff' 
								order by sub_name";
								

				$query = mysqli_query($conn, $sql);

				$counter = 1;
				

				while ($result = mysqli_fetch_assoc($query)){

					?>

					<tr>
						<th scope="row"><?php echo $counter; ?></th>
						<td><a href="subscriber-profile.php?menu=1&id=<?php echo $result['sub_id']; ?>"><?php echo $result['sub_name']; ?></a></td>
						<?php
						$sub_status_id = $result['sub_id'];
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'eAIP'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
						
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-eaip-subscription.php?menu=1&submenu=1" class="header-action-inner" title="Add eAIP Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'CD'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						$sub_present = mysqli_num_rows($query_sub_status);
				
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a href="add-cd-subscription.php?menu=1&submenu=2" class="header-action-inner" title="Add CD Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"> <i class="fa fa-exclamation"></i></a></td>
									<?php
								}
				
							}
						}
						
						
						$sql_sub_status = "select subscriber_id, 
													sub_status,
													max(sub_exp_date) as sub_exp_date 
												from subscriptions
												where subscriber_id = $sub_status_id
												and sub_type = 'paper'";
												
						$query_sub_status = mysqli_query($conn, $sql_sub_status);
							
							
						while ($result_sub_status = mysqli_fetch_assoc($query_sub_status)){
							
							if($result_sub_status['sub_status'] == null){
								?>
								<td><a title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom" href="add-paper-subscription.php?menu=1&submenu=3" class="header-action-inner" title="Add Paper Subscription" data-toggle="tooltip" data-placement="bottom">
										<i class="fa fa-plus"></i>
									</a>
								</td>

								<?php
							}else if($result_sub_status['sub_status'] != 1){
								?>
								<td><a title="expired" data-toggle="tooltip" data-placement="bottom" href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
								<?php
							}else{
								$num_of_days_to = strtotime($result_sub_status['sub_exp_date']) - strtotime(date('Y-m-d H:i:s'));

								$num_of_days_to = round ($num_of_days_to / (60 * 60 * 24));

								$number_of_months = round(($num_of_days_to/30),0);

								if($number_of_months > 3){
									?>
									<td><a title="active" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-primary"> <i class="fa fa-thumbs-up"></i> </a></td>
									<?php
								}else if($number_of_months > 1 && $number_of_months <= 3){
									?>
									<td><a title="warning" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-secondary btn-xs"> <i class="fa fa-bell"></i> </a></td>
									<?php
								} else{
									?>
									<td><a title="attention" data-toggle="tooltip" data-placement="bottom" href="subscriber-profile.php?menu=1&id=<?php echo $result_sub_status['subscriber_id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-exclamation"></i> </a></td>
									<?php
								}
				
							}
						}
							
						?>

						<td><?php echo $result['sub_category']; ?></td>
						<td><?php echo $result['sub_email']; ?></td>
						<td><?php echo $result['sub_box_number']; ?></td>
						<td><?php echo $result['phy_address']; ?></td>
						<td><?php echo $result['sub_telephone']; ?></td>
						<td><?php echo $result['sub_other_contact_info']; ?></td>
						<td><?php echo $result['sub_contact_per']; ?></td>
						<td><?php echo date('Y-m-d',strtotime($result['sub_add_date'])); ?></td>
						<td><a href="edit-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-secondary btn-xs"> Edit </a>
							<a href="processes/delete-subscriber.php?menu=2&sub_id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-danger"> Delete </a>
						</td>
					</tr>

					<?php
					$counter = $counter + 1;
				}

				?>
				
				</tbody>
			</table>
		  
		</div>
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
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>