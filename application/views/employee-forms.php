<?php include("emp-head.php"); ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Available Loans</h3>
</div>
<div class="panel-body">
<ul class="list-group">
<?php
if(isset($loans)){
  if(!empty($loans)){
    $i=0;
    foreach($loans as $r){
      echo "<li class='list-group-item'><a data-toggle='modal' data-backdrop='static' data-target='#myModal_l_$i'>".$r->type."<span class='pull-right'><b>".$r->loan_range."</b></span></a></li>";
//modals to view loan dets
?>
<!-- Start Modals-->
<div id="myModal_l_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Loan Details</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
<div class="form-group">
<label class="col-md-3">Loan Type</label>
<div class="col-md-6">
<span class="text-muted"><?php echo $r->type; ?></span>
</div>
</div>
  <div class="form-group">
  <label class="col-md-3">Loan Range</label>
  <div class="col-md-6">
<span class="text-muted"><?php echo $r->loan_range; ?></span>
  </div>
</div>
    <div class="form-group">
    <label class="col-md-3">Loan Interest</label>
    <div class="col-md-6">
<span class="text-muted"><?php echo $r->loan_interest; ?></span>
    </div>
  </div>
      <div class="form-group">
      <label class="col-md-3">Loan Period</label>
      <div class="col-md-6">
<span class="text-muted"><?php echo $r->loan_period."(Days)"; ?></span>
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

<?php
  $i++;  }
  }
}
?>
</ul>
</div>
</div>
</div>
<div class="col-md-7">
  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title"><i class="fa fa-file"></i>&nbsp;&nbsp;Fill Application forms</h3>
  </div>
  <div class="panel-body">
    <?php
    $reg_names="";
    $epn=0;
    $sec="";
    $sal=0;
  if(isset($profile)){
  if(!empty($profile)){
    foreach($profile as $r){
      $reg_names=$r->fullnames;
      $epn=$r->EPN;
      $sec=$r->section;
      $sal=$r->salary;
    }
  }
  }
    ?>
  <form action=<?php echo $assets['base_url'].'loan/loan_applications/'.$id.'/'.$uname; ?> method="POST" class="form-horizontal">
    <div class="form-group">
    <label class="col-md-3">EPN<em class='text-danger'>*</em></label>
    <div class="col-md-6">
    <input type="text" name="epn"  value='<?php echo (!empty($epn))? $epn:""; ?>' class="form-control" />
    </div>
    </div>
  <div class="form-group">
  <label class="col-md-3">Names<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <input type="text" name="names"  value='<?php echo (!empty($reg_names))? $reg_names:""; ?>' class="form-control" />
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">Section<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <input type="text" name="section"  value='<?php echo (!empty($sec))? $sec:""; ?>' class="form-control" />
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">Loan Type<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <select class="form-control" name="type">
<option selected disabled>--Choose--</option>
<?php
if(!empty($loans)){
  foreach($loans as $r){
    echo "<option>".$r->type."</option>";
  }
}else{
  echo "<option disabled>No Loan type Available</option>";
}
?>
  </select>
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">Amount<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <input type="number" name="loan_amount" placeholder="Type Loan Amount" class="form-control" />
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">Reason<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <textarea name="reason" placeholder="Fill in Reason for Application" class="form-control" style="width:354px;height:180px;"></textarea>
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">Basic Salary<em class='text-danger'>*</em></label>
  <div class="col-md-6">
  <input type="text"  value='<?php echo (!empty($sal))? $sal:""; ?>' class="form-control" name="sal"/>
  </div>
  </div>
  <div class="form-group">
  <label class="col-md-3">&nbsp;</label>
  <div class="col-md-6">
  <input type="submit" value="Submit" class="btn btn-success" style="width:345px;"  />
  </div>
  </div>
  </form>
  </div>
  </div>
</div>
</div>
</div>
<?php include("footer.php"); ?>
