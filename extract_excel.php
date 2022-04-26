<?php
$subscriptions_table = $_POST['subscriptions_table'];
$file="Subscription_Report.xls";
$test="<table  ><tr><td>Cell 1</td><td>Cell 2</td></tr></table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $subscriptions_table;
?>