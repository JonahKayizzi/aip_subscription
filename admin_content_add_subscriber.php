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
                <h1>New Subscriber</h1>
                
            </div><!-- /.message -->

        </div><!-- /.col-* -->
        
    </div><!-- /.row -->

    <div class="row">

        <?php
            if(isset($_GET['exists'])){

                $subscriber_exists = $_GET['exists'];

                if ($subscriber_exists == 1) {
                    
                    ?>
                    <div class="alert alert-icon alert-dismissible alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <strong>Note!</strong> Subscriber already exists.
                    </div>
                    <?php
                }
            }
        ?>
        
        <form action="processes/add_subscriber.php" method="POST">
            <div class="form-group">
                <label for="exampleInputText1">Subscriber Name</label>
                <input type="text" name="subscriber_name" class="form-control" id="exampleInputText1" placeholder="Subscriber Name">
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <select name="subscriber_category" class="form-control" title="Select Option">
                    <option value='AIS of States'>AIS of States</option>
                    <option value='Paying Subscribers'>Paying Subscribers</option>
                    <option value='CAA Staff'>CAA Staff</option>
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="email" name="subscriber_email" class="form-control" id="exampleInputEmail1" placeholder="Subscriber Email">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Postal Address</label>
                <input name="subscriber_post_add" type="text" class="form-control" id="exampleInputText1" placeholder="Subscriber Postal Address">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Physical Address</label>
                <input name="subscriber_phy_add" type="text" class="form-control" id="exampleInputText1" placeholder="Subscriber Physical Address">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Telephone Number</label>
                <input name="subscriber_tel" type="tel" class="form-control" id="exampleInputText1" placeholder="Subscriber Telephone Number">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Contact Person</label>
                <input name="subscriber_contact_person" type="tel" class="form-control" id="exampleInputText1" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="exampleInputText1">Other Contact Information</label>
                <textarea name="subscriber_other_contact" class="form-control" id="exampleInputText1" placeholder="Other Contact Information">
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subscriber</button>
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