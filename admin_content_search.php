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
                <h1>SEARCH</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">
        
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

    $button = filter_input(INPUT_GET, 'submit');
    $search = filter_input(INPUT_GET, 'search');
	
    include_once("processes/db_connection_local.php");
	
    if( strlen( $search ) <= 1 ){ 
        echo "Search term too short."; 
    }else { 

        //echo "You searched for <b> $search </b> <hr size='1' > </ br > "; 
 
        		
		$sql = "SELECT * FROM subscribers WHERE sub_name LIKE '%$search%'
											OR sub_email LIKE '%$search%'
											OR phy_address LIKE '%$search%'";
        	
		$results = mysqli_query($conn, $sql);
		
        $rows = mysqli_num_rows($results);

        if($rows != 0){
            echo $rows.' result(s) of <b>'.$search.'</b> found.<br><br/>';
            $display = mysqli_fetch_all($results);
            
            display_results($display);
         
        }else{
           
			echo 'No results found.';
			echo "Sorry, there are no matching results for <b> $search </b>. </br> </br> "
					. "1. Please check your spelling </br> "
					. "2. Try another name (Subscriber) </br> ";
        }

    }

    
    
    function display_results($display){
        		
		//while ($result = mysqli_fetch_assoc($query)){
		//include_once("processes/db_connection_local.php");	
		$counter = 1;
		foreach($display as $result){

                ?>

                <tr>
                    <th scope="row"><?php echo $counter; ?></th>
                    <td><a href="subscriber-profile.php?menu=1&id=<?php echo $result[0]; ?>"><?php echo $result[1]; ?></a></td>
                    <?php
					$sub_status_id = $result[0];
					
					$sql_sub_status = "select subscriber_id, 
												sub_status,
												max(sub_exp_date) as sub_exp_date 
											from subscriptions
											where subscriber_id = $sub_status_id
											and sub_type = 'eAIP'";
					
					$servername = "localhost";
    $username = "root";
    //$password = "Aim@fps321";  //dev 2
	$password = "";  //dev 2
    $dbname = "aip_sub";
            
    //Create connection
    $conn = new mysqli ($servername, $username, $password, $dbname);
	
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

					<td><?php echo $result[2]; ?></td>
                    <td><?php echo $result[3]; ?></td>
                    <td><?php echo $result[6]; ?></td>
                    <td><?php echo $result[4]; ?></td>
                    <td><?php echo $result[5]; ?></td>
                    <td><?php echo $result[7]; ?></td>
                    <td><?php echo $result[8]; ?></td>
                    <td><?php echo date('Y-m-d',strtotime($result[9])); ?></td>
                    <td><a href="edit-subscriber.php?menu=2&sub_id=<?php echo $result[0]; ?>" class="btn btn-secondary btn-xs"> Edit </a>
                        <a href="processes/delete-subscriber.php?menu=2&sub_id=<?php echo $result[0]; ?>" class="btn btn-xs btn-danger"> Delete </a>
                    </td>
                </tr>

                <?php
                $counter = $counter + 1;
            }
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
