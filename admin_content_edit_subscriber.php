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
                <h1>Edit Subscriber</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">

        <?php

            $sub_to_edit = $_GET['sub_id'];

            include_once("processes/db_connection_local.php");

            $sql = "SELECT * FROM subscribers WHERE sub_id = '$sub_to_edit'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                $sub_name = $result['sub_name'];
                $sub_category = $result['sub_category'];
                $sub_email = $result['sub_email'];
                $phy_address = $result['phy_address'];
                $sub_telephone = $result['sub_telephone'];
                $sub_contact_per = $result['sub_contact_per'];
                $sub_postal = $result['sub_box_number'];
                $sub_other_contact = $result['sub_other_contact_info'];
            }

         ?>
        
        <form action="processes/edit-subscriber.php" method="POST">
            <input name="sub_id" value='<?php echo $sub_to_edit; ?>' type="hidden">
            <div class="form-group">
                <label for="exampleInputText1">Subscriber Name</label>
                <input name="subscriber_name" value='<?php echo $sub_name; ?>' type="text" class="form-control" id="exampleInputText1" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <select name="subscriber_category" class="form-control" title="Select Option">
                    <?php

                    if( strcmp($sub_category,"AIS of States") == 1){
                        ?>
                        <option value='AIS of States' selected>AIS of States</option>
                        <option value='Paying Subscribers'>Paying Subscribers</option>
                        <option value='CAA Staff'>CAA Staff</option>
                        <?php
                    }else if( strcmp($sub_category,"Paying Subscribers") == 1){
                        ?>
                        <option value='AIS of States'>AIS of States</option>
                        <option value='Paying Subscribers' selected>Paying Subscribers</option>
                        <option value='CAA Staff'>CAA Staff</option>
                        <?php
                    }else if( strcmp($sub_category,"CAA Staff") == 1){
                        ?>
                        <option value='AIS of States'>AIS of States</option>
                        <option value='Paying Subscribers'>Paying Subscribers</option>
                        <option value='CAA Staff' selected>CAA Staff</option>
                        <?php
                    }else{
                        ?>
                        <option value='AIS of States'>AIS of States</option>
                        <option value='Paying Subscribers'>Paying Subscribers</option>
                        <option value='CAA Staff'>CAA Staff</option>
                        <?php
                    }

                    ?>
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input name="subscriber_email" value='<?php echo $sub_email; ?>' type="email" class="form-control" id="exampleInputEmail1" placeholder="Your Email">
            </div>


            <div class="form-group">
                <label for="exampleInputText1">Postal Address</label>
                <input name="subscriber_post_add" type="text" value='<?php echo $sub_postal; ?>' class="form-control" id="exampleInputText1" placeholder="Subscriber Postal Address">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Physical Address</label>
                <input name="subscriber_phy_add" value='<?php echo $phy_address; ?>' type="text" class="form-control" id="exampleInputText1" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Telephone Number</label>
                <input name="subscriber_tel" value='<?php echo $sub_telephone; ?>' type="tel" class="form-control" id="exampleInputText1" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Contact Person</label>
                <input name="subscriber_contact_person" value='<?php echo $sub_contact_per; ?>' type="tel" class="form-control" id="exampleInputText1" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Other Contact Information</label>
                <textarea name="subscriber_other_contact" class="form-control" id="exampleInputText1" placeholder="Other Contact Information">
                    <?php echo $sub_other_contact; ?>
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit Subscriber</button>
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
