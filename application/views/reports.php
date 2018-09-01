<?php include("header.php"); ?>
<?php include("admin-nav.php"); ?>
<div class="container-fluid">
<form class="form-horizontal">
  <div><center><h2>REPORT AS OF <?php echo date("Y-m-d"); ?></h2></center>
<span class="pull-right"><button class='btn btn-primary' id="print"><i class='fa fa-print'></i>Print</button></span>
  </div>
  <table class="table table-hover">
      <tbody>
          <tr>
            <th>Submitted reports as of <?php echo date("Y-m-d"); ?></th>
              <?php
if(!empty($applications)){
  foreach($applications as $r){
    echo "<td>
    <table>
<tbody>
<tr>
<th>Names:</th>
<td>".$r->fullnames."</td>
</tr>
<tr>
<th>Section:</th>
<td>".$r->section."</td>
</tr>
<tr>
<th>Loan Type:</th>
<td>".$r->loan_type."</td>
</tr>
<tr>
<th>Loan Amount:</th>
<td>".$r->loan_amount."</td>
</tr>
<tr>
<th>Reason:</th>
<td>".$r->reason."</td>
</tr>
<tr>
<th>Status:</th>
<td>".$r->status."</td>
</tr>
<tr>
<th>Applied:</th>
<td>".$r->dtime_posted."</td>
</tr>
</tr>
</tbody>
    </table>
    </td>";
  }
}else{
  echo "<td><span class='text-muted text-danger'>No Applications sent as of ".date("Y-m-d")."</span></td>";
}
              ?>
          </tr>
          <tr>
            <th>Approved Loan Applications</th>
              <td>
<?php
if(!empty($approved)){
  foreach($approved as $app){
    echo "<td>
    <table>
<tbody>
<tr>
<th>Names:</th>
<td>".$app->fullnames."</td>
</tr>
<tr>
<th>Section:</th>
<td>".$app->section."</td>
</tr>
<tr>
<th>Loan Type:</th>
<td>".$app->loan_type."</td>
</tr>
<tr>
<th>Loan Amount:</th>
<td>".$app->loan_amount."</td>
</tr>
<tr>
<th>Reason:</th>
<td>".$app->reason."</td>
</tr>
<tr>
<th>Status:</th>
<td>".$app->status."</td>
</tr>
<tr>
<th>Applied:</th>
<td>".$app->dtime_posted."</td>
</tr>
</tr>
</tbody>
    </table>
    </td>";
  }
}else{
  echo "<td><span class='text-muted text-danger'>No Applications sent as of ".date("Y-m-d")."</span></td>";
}
?>
              </td>
          </tr>
<tr>
<th>Rejected Loan Applications as of <?php echo date("Y-m-d"); ?></th>
<td>
  <?php
  if(!empty($rejected)){
    foreach($rejected as $rej){
      echo "<td>
      <table>
  <tbody>
  <tr>
  <th>Names:</th>
  <td>".$rej->fullnames."</td>
  </tr>
  <tr>
  <th>Section:</th>
  <td>".$rej->section."</td>
  </tr>
  <tr>
  <th>Loan Type:</th>
  <td>".$rej->loan_type."</td>
  </tr>
  <tr>
  <th>Loan Amount:</th>
  <td>".$rej->loan_amount."</td>
  </tr>
  <tr>
  <th>Reason:</th>
  <td>".$rej->reason."</td>
  </tr>
  <tr>
  <th>Status:</th>
  <td>".$rej->status."</td>
  </tr>
  <tr>
  <th>Applied:</th>
  <td>".$rej->dtime_posted."</td>
  </tr>
  </tr>
  </tbody>
      </table>
      </td>";
    }
  }else{
    echo "<td><span class='text-muted text-danger'>No Applications sent as of ".date("Y-m-d")."</span></td>";
  }
  ?>

</td>
</tr>

      </tbody>
  </table>
</form>
</div>
<?php include("footer.php"); ?>
