
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
                <h1>Subscription Reports</h1><br>

                <form action='reports.php?menu=3&submenu=1' method='POST'>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> From Date</label>
                        <input name="from_date" style="width:155px" type="date" class="form-control" id="exampleInputDate" value='<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; }?>' placeholder="Start Date">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputText1">To Date</label>
                        <input name="to_date" style="width:155px" type="date" class="form-control" id="exampleInputText1" value='<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; }?>' placeholder="End Date">
                    </div>

                    <div style="width:500px" class="form-group">
                        <label for="">Subscription Type</label>
                        <select name="subscription_type" class="form-control" title="Select Option">
                            <option value='eAIP'>eAIP</option>
                            <option value='CD'>CD</option>
                            <option value='Paper'>Paper</option>
                            <option value='All'>All</option>
                        </select>
                    </div><!-- /.form-group -->

                    <button type="submit" class="btn btn-primary"></i>Generate</button>
                </form>

            </div><!-- /.message -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->

    <?php

        if(isset($_POST['subscription_type'])){

            $subscription_type = $_POST['subscription_type'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];

            include_once("processes/db_connection_local.php");

            if($subscription_type == 'eAIP'){

                $sql = "SELECT sub.sub_id,
                            sub.sub_name,
                            sup.sub_type,
                            sup.sub_date,
                            sup.sub_start_date,
                            sup.sub_exp_date, 
                            sup.sub_amount,
                            sup.receipt_no,
                            sup.invoice_no
                                FROM subscribers sub, subscriptions sup
                                where sup.subscriber_id = sub.sub_id
                                    and sup.sub_type = 'eAIP'
                                    and sup.sub_start_date >= '$from_date' 
                                    and sup.sub_start_date <= '$to_date'";
            }else if($subscription_type == 'CD'){

                $sql = "SELECT sub.sub_id,
                            sub.sub_name,
                            sup.sub_type,
                            sup.sub_date,
                            sup.sub_start_date,
                            sup.sub_exp_date, 
                            sup.sub_amount,
                            sup.receipt_no,
                            sup.invoice_no
                                FROM subscribers sub, subscriptions sup
                                where sup.subscriber_id = sub.sub_id
                                    and sup.sub_type = 'CD'
                                    and sup.sub_start_date >= '$from_date' 
                                    and sup.sub_start_date <= '$to_date'";

            }else if($subscription_type == 'Paper'){

                $sql = "SELECT sub.sub_id,
                            sub.sub_name,
                            sup.sub_type,
                            sup.sub_date,
                            sup.sub_start_date,
                            sup.sub_exp_date, 
                            sup.sub_amount,
                            sup.receipt_no,
                            sup.invoice_no
                                FROM subscribers sub, subscriptions sup
                                where sup.subscriber_id = sub.sub_id
                                    and sup.sub_type = 'paper'
                                    and sup.sub_start_date >= '$from_date' 
                                    and sup.sub_start_date <= '$to_date'";

            }else{

                $sql = "SELECT sub.sub_id,
                            sub.sub_name,
                            sup.sub_type,
                            sup.sub_date,
                            sup.sub_start_date,
                            sup.sub_exp_date, 
                            sup.sub_amount,
                            sup.receipt_no,
                            sup.invoice_no
                                FROM subscribers sub, subscriptions sup
                                where sup.subscriber_id = sub.sub_id
                                    and sup.sub_start_date >= '$from_date' 
                                    and sup.sub_start_date <= '$to_date'";

            }

            ?>
            
            
            <div id="subscriptions" class="row">

            <?php
                
            $subscriptions_table = '<table class="table table-hover mb0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subscriber</th>
                        <th>Subscription Type</th>
                        <th>Subscription Date</th>
                        <th>Subscription Start Date</th>
                        <th>Expiration Date</th>
                        <th>Subscription Amount</th>
                        <th>Receipt Number</th>
                        <th>Invoice Number</th>
                    </tr>
                </thead>
                <tbody>';

                    $query = mysqli_query($conn, $sql);

                    $counter = 1;

                    while ($result = mysqli_fetch_assoc($query)){

                        
                        $subscriptions_table .= '<tr>
                            <th scope="row">'.$counter.'</th>
                                <td>'.$result['sub_name'].'</td>
                                <td>'.$result['sub_type'].'</td>
                                <td>'.date('Y-m-d', strtotime($result['sub_date'] )).'</td>
                                <td>'.date('Y-m-d', strtotime($result['sub_start_date']) ).'</td>
                                <td>'.date('Y-m-d', strtotime($result['sub_exp_date']) ).'</td>
                                <td>'.$result['sub_amount'].'</td>
                                <td>'.$result['receipt_no'].'</td>
                                <td>'.$result['invoice_no'].'</td>
                        </tr>';

                        
                        $counter = $counter + 1;
                    }


                   $subscriptions_table .='</tbody>
                </table>';

                echo $subscriptions_table;

                ?>

            </div><!-- /.row -->
            <button onclick="javascript:demoFromHTML()">Download PDF</button>
            <form action = "extract_excel.php" method = "POST">
                <input name='subscriptions_table' type="hidden" value = '<?php echo $subscriptions_table ?>'>
                <input type="submit" value = "Download EXCEL"> 
            </form>
            <?php
        }
     ?>

    
</div><!-- /.col-* -->

                                    </div>
                                </div><!-- /.container-fluid -->
                            </div><!-- /.content-admin-main-inner -->
                        </div><!-- /.content-admin-main -->

                        <?php require_once('admin_footer.php') ?>
                        
                    </div><!-- /.content-admin-wrapper -->
                </div><!-- /.content-admin -->


<script type="text/javascript">
        function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#subscriptions')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Subscription_Report.pdf');
            }
            , margins);
        }
    </script>