<?php include("emp-head.php"); ?>
<div class="container-fluid">
<div class="row" style="padding-top: 10px;">
<div class="col-md-5">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">Activity</h4>

</div>
<div class="panel-body" style="height: 500px;overflow:auto;">
  <?php
  if(!empty($activity)){
    echo "<ul class='list-group' style='height:200px;overflow:auto;'>";
$i=0;
    foreach($activity as $r){
  echo "<li class='list-group-item'><a href='#' data-toggle='modal' data-backdrop='static' data-target='#myModal_a_$i'>You Sent a loan application on ".$r->dtime_posted."</a></li>";
?>
<!-- start =modal-->
<div id="myModal_a_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Loan Application Form</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
          <label class="col-md-3">EPN</label>
          <div class="col-md-6">
          <span class="text-muted"> <?php echo (!empty($r->EPN))? $r->EPN:""; ?></span>
          </div>
          </div>
        <div class="form-group">
        <label class="col-md-3">Names</label>
        <div class="col-md-6">
        <span class='text-muted'><?php echo (!empty($r->fullnames))? $r->fullnames:""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Section</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->section))? $r->section:""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Loan Type</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->loan_type))? $r->loan_type:""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Amount</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->loan_amount))? $r->loan_amount." UGX":""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Reason</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->reason))? $r->reason:""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Basic Salary</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->salary))? $r->salary." UGX":""; ?></span>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-3">Date Applied</label>
        <div class="col-md-6">
        <span class="text-muted"><?php echo (!empty($r->dtime_posted))? $r->dtime_posted:""; ?></span>
        </div>
        </div>

        </form>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end modal-->
<?php
  $i++;  }
    echo "</ul>";
  }else{
    echo "<div class='row alert alert-warning'><center>No pending Loan Applications Sent</center></div>";
  }
  ?>
  <hr />
  <!-- display due loans -->
  <?php
if(isset($loan)){
  if(!empty($loan)){
echo "<ul class='list-group'>";
$x=0;
    foreach($loan as $r){
      $d=date_create($r->dtime_posted);
date_add($d,date_interval_create_from_date_string("$r->loan_period Days"));
  echo "<li class='list-group-item'><a href='#' data-toggle='modal' data-backdrop='static' data-target='#myModal_loan_$x'><b class='text-success'>".$r->loan_type."</b> <i style='padding-left:50px;'></i>is Due in [".$r->loan_period."Days] on"."<span class='pull-right badge'>".date_format($d,"Y-m-d")."</span></a></li>";
?>
<!-- modal to view interest rates nd amount to be paid back [calculations]-->
<div id="myModal_loan_<?php echo $x; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Loan Details
<span class="pull-right"><i class='badge'>Due</i>&nbsp;&nbsp;<?php echo date_format($d,"Y-m-d"); ?></span>
        </h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal">
<div class="form-group">
<label class="col-md-4">Amount Borrowed:</label>
<div class="col-md-6">
<span class="pull-right text-muted"><?php echo $r->loan_amount." UGX"; ?></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4">Interest Rate:</label>
<div class="col-md-6">
<span class="pull-right text-muted"><?php echo $r->loan_interest."%"; ?></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4">Period[Days]:</label>
<div class="col-md-6">
<span class="pull-right text-muted"><?php echo $r->loan_period." Days"; ?></span>
</div>
</div>
<?php
$loan=$r->loan_amount;
$interest=$r->loan_interest;
$total=($interest/100)*$loan;
?>
<div class="form-group">
<label class="col-md-4">Pay Every Month:</label>
<div class="col-md-6">
<span class="pull-right text-muted"><?php //calculation
echo (($loan+$total)/30)." UGX";
  ?></span>
</div>
</div>
<div class="form-group">
<label class="col-md-4">Total Amount:</label>
<div class="col-md-6">
<span class="pull-right text-muted"><?php
//calculation
echo ($loan+$total)." UGX";
 ?>
</span>
</div>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end modal-->
<?php
  $x++;  }
    echo "</ul>";
  }
}
  ?>
</div>
</div>
</div>
<div class="col-md-7">
  <div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
<h4 class="panel-title">Loan Application Forms</h4>
    </div>
    <div class="panel-body">

        <div class='row'>
    <div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">Approved Loan Forms
      <?php
      $count_app=0;
      if(!empty($approved)) foreach($approved as $r) $count_app++;
      echo "<span class='badge'>".$count_app."</span>";
      ?>
    </h4>
    </div>
    <div class="panel-body" style="height:300px;overflow:auto;">
<?php
if(!empty($approved)){
  $app=0;
  foreach($approved as $r){
    $str=$r->reason;
    $arr=str_word_count($str,2);
    echo "<li class='list-group-item'><a data-target='#myModal_rejected_".$app."' data-toggle='modal' data-backdrop='static'>You sent a ".$r->loan_type."&nbsp;&nbsp; application about [".$arr[0]."&nbsp;...] &nbsp;&nbsp;at ".$r->dtime_posted."</a></li>";
?>
<div id="myModal_rejected_<?php echo $app; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Loan Application</h4>
      </div>
      <div class="modal-body">
  <table class="table table-hover">
      <tbody>
          <tr>
            <th>Names</th>
              <td><?php echo $r->fullnames; ?></td>
          </tr>
          <tr>
            <th>Section</th>
              <td><?php echo $r->section; ?></td>
          </tr>
            <tr>
              <th>Loan Type</th>
                <td><?php echo $r->loan_type; ?></td>
            </tr>
          <tr>
            <th>Loan Amount</th>
              <td><?php echo $r->loan_amount." UGX"; ?></td>
          </tr>
          <tr>
            <th>Reason</th>
              <td><?php echo $r->reason; ?></td>
          </tr>
          <tr>
            <th>Date Applied</th>
              <td><?php echo $r->dtime_posted; ?></td>
          </tr>
          <tr>
          <th>Status</th>
           <td><span class='text-muted'><?php echo $r->status; ?></span></td>
          </tr>
      </tbody>
  </table>

      </div>
    </div>
  </div>
</div>
<?php
$app++;
}
}else{
  echo "<div class='row alert alert-warning'><center>No approved Loan Applications yet...</center></div>";
}
?>
    <div>
    </div>
    </div>

    </div>
    <div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">Declined Loan Application Forms
      <?php
      $count_rej=0;
      if(!empty($rejected)) foreach($rejected as $r) $count_rej++;
      echo "<span class='badge'>".$count_rej."</span>";
      ?>
    </h4>
    </div>
    <div class="panel-body" style="height:300px;overflow:auto;">
<!-- start funcs-->
<?php
if(!empty($rejected)){
  $rejec=0;
  foreach($rejected as $r){
    $str=$r->reason;
    $arr=str_word_count($str,2);
    echo "<li class='list-group-item'><a data-target='#myModal_approved_".$rejec."' data-toggle='modal' data-backdrop='static'>You sent a ".$r->loan_type."&nbsp;&nbsp; application about [".$arr[0]."&nbsp;...] &nbsp;&nbsp;at ".$r->dtime_posted."</a></li>";
?>
<div id="myModal_approved_<?php echo $rejec; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Loan Application</h4>
      </div>
      <div class="modal-body">
  <table class="table table-hover">
      <tbody>
          <tr>
            <th>Names</th>
              <td><?php echo $r->fullnames; ?></td>
          </tr>
          <tr>
            <th>Section</th>
              <td><?php echo $r->section; ?></td>
          </tr>
            <tr>
              <th>Loan Type</th>
                <td><?php echo $r->loan_type; ?></td>
            </tr>
          <tr>
            <th>Loan Amount</th>
              <td><?php echo $r->loan_amount." UGX"; ?></td>
          </tr>
          <tr>
            <th>Reason</th>
              <td><?php echo $r->reason; ?></td>
          </tr>
          <tr>
            <th>Date Applied</th>
              <td><?php echo $r->dtime_posted; ?></td>
          </tr>
          <tr>
          <th>Status</th>
           <td><span class='text-muted'><?php echo $r->status; ?></span></td>
          </tr>
      </tbody>
  </table>

      </div>
    </div>
  </div>
</div>
<?php
$rejec++;
}
}else{
  echo "<div class='row alert alert-warning'><center>No Rejected Loan Applications yet...</center></div>";
}
?>
    <div>
    </div>
<!-- end funcs-->
    </div>
    </div>
  </div>


    </div>
  </div>
  </div>
</div>
<?php include("footer.php"); ?>
