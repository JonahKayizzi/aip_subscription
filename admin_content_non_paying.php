
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
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
                <h1>Non Paying Subscriptions</h1><br>

                <form action='non-paying.php?menu=4' method='POST'>
					
					<div class="col-sm-4">
						<div class="form-group">
							<label for="exampleInputText1">Subscriber Type</label>
							<select name="subscription_type" class="form-control" title="Select Option">
								<option value='CD'>AIS of States</option>
								<option value='Paper'>CAA Staff</option>
								<option value='All'>All</option>
							</select>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="form-group">
							<label for="exampleInputEmail1"> Subscription Type</label>
							<select name="subscription_type" class="form-control" title="Select Option">
								<option value='eAIP'>eAIP</option>
								<option value='CD'>CD</option>
								<option value='Paper'>Paper</option>
								<option value='All'>All</option>
							</select>
						</div>
					</div>

					
					<div class="col-sm-4">
						<div class="form-group">
							<label for="exampleInputText1">Subscriber Name</label>
							<input class="form-control" list="browsers" name="browser" id="browser">
							<datalist id="browsers">
							<?php
							include_once("processes/db_connection_local.php"); 

							$sql = "select sub_id, sub_name from subscribers where sub_category != 'Paying Subscribers'";

							$query = mysqli_query($conn, $sql);

							while ($result = mysqli_fetch_assoc($query)){
								?>
								<option value="<?php echo $result['sub_name'] ?>">
								<?php
							}
							?>

							</datalist>
						</div>
					</div>
					
					
						<button type="submit" class="btn btn-primary"></i>Filter</button>
					
                </form>

            </div><!-- /.message -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->

 <div class="row">
        <table class="table table-hover mb0">
            <thead>
            <tr>
                <th>#</th>
                <th>Subscriber</th>
				<th>Category</th>
				<th>Type</th>
				<th>Copies</th>
                <th>Subscription Date</th>
                <th>Expiration</th>
                <th>eAIP User Name</th>
                <th>eAIP Password</th>
                <th>Status</th>
            </tr>
            </thead>



            <tbody>

            <?php

            include_once("processes/db_connection_local.php"); 

            $sql = "SELECT sub.sub_id,
							sub.sub_category,
                        sub.sub_name,
                        supp.sub_status,
                        supp.sub_type,
						supp.sub_copies,
                        supp.sub_exp_date, 
                        supp.sub_start_date,
                        supp.eaip_user_name, 
                        supp.eaip_password from subscribers as sub,
                                                (select sup.sub_status, 
                                                        sup.subscriber_id,
                                                        sup.sub_type,
														sup.sub_copies,
                                                        sup.sub_exp_date, 
                                                        sup.sub_start_date,
                                                        sup.eaip_user_name, 
                                                        sup.eaip_password
                                                        from subscriptions as sup,
                                                            (select subscriber_id, 
                                                                    max(sub_exp_date) as max_date 
                                                                    from subscriptions
                                                                    where sub_type = 'eAIP'
                                                                    group by subscriber_id) as maxx

                                                         where sup.subscriber_id = maxx.subscriber_id
                                                                and sup.sub_exp_date = maxx.max_date) as supp
                                            where supp.subscriber_id = sub.sub_id
													and sub_category != 'Paying Subscribers'";

            $query = mysqli_query($conn, $sql);

            $counter = 1;

            while ($result = mysqli_fetch_assoc($query)){

                ?>

                <tr>
                    <th scope="row"><?php echo $counter; ?></th>
                    <td><a href="subscriber-profile.php?menu=1&submenu=1&id=<?php echo $result['sub_id']; ?>"><?php echo $result['sub_name']; ?></a></td>
                    <td><?php echo $result['sub_category']; ?></td>
					<td><?php echo $result['sub_type']; ?></td>
					<td><?php echo $result['sub_copies']; ?></td>
					<td><?php echo date('Y-m-d', strtotime($result['sub_start_date'] )); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($result['sub_exp_date']) ); ?></td>
                    <td><?php echo $result['eaip_user_name']; ?></td>
                    <td><?php echo $result['eaip_password']; ?></td>
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
                                <td><a href="subscriber-profile.php?menu=1&submenu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-primary"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td>
                                <?php
                            }else if($number_of_months > 1 && $number_of_months <= 3){
                                ?>
                                <td><a href="subscriber-profile.php?menu=1&submenu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-secondary btn-xs"> <?php echo round(($num_of_days_to/30),0)." months to go"; ?> </a></td>
                                <?php
                            } else{
                                ?>
                                <td><a href="subscriber-profile.php?menu=1&submenu=1&id=<?php echo $result['sub_id']; ?>" class="btn btn-xs btn-danger"><?php echo $num_of_days_to." day(s) to go"; ?></a></td>
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


