<?php include("header.php"); ?>
<?php include("admin-nav.php"); ?>
<?php if(isset($msg)) echo $msg; ?>
<div class="container-fluid" style="padding-top: 10px;">
	<div class="row">
		<div class="col-md-5">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Registered Employees</h4>
					</div>
					<div class="panel-body" style="height:300px;overflow:auto;">
						<?php
if(isset($emps)){
	$i=0;
	if(!empty($emps)){
		echo "<ul class='list-group'>";
		//href='".$assets['base_url']."load/edit/".$id."/".$uname."/".$r->EPN."'
		foreach($emps as $r){
			echo "<li class='list-group-item'>".$r->fullnames."<span class='pull-right'><button type='button' data-toggle='modal' data-target='#myModal_v_".$i."' data-backdrop='static' onClick='$('#myModal_v').modal()' >View</button>&nbsp;<button type='button' data-toggle='modal' data-backdrop='static' data-target='#myModal_".$i."' onClick='$('#myModal').modal()' >Edit</button>&nbsp;&nbsp;&nbsp;<a href='".$assets['base_url']."loan/delete/".$id."/".$uname."/".$r->EPN."'>Delete</a></span></li>";
			//start modal ?>
			<!-- ?data-toggle="modal" data-target="#myModal" -->
						<!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Employee Record</h4><p />
        <?php echo $r->fullnames; ?>
      </div>
      <form action=<?php echo $assets['base_url']."loan/edit/".$id."/".$uname."/".$r->EPN; ?> method="POST">
      <div class="modal-body">

        	<div class="form-group">
        		<input type="text" name="edit_names" placeholder="Edit Employee Names" id="in_r">
        	</div>
        	<div class="form-group">
        		<input type="text" name="edit_salary" placeholder="Edit Employee Salary" id="in_r">
        	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" >Edit</button>
      </div>
	  </form>
    </div>

  </div>
</div>
<!-- view modal-->
<div id="myModal_v_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Employee Record</h4><p />
        <?php echo $r->fullnames; ?>
      </div>
      <form class="form-horizontal">
      <div class="modal-body">
        	<div class="form-group">
        		<label class="col-md-3">Names:</label>
						<div class="col-md-5">
							<span><?php echo $r->fullnames; ?></span>
						</div>
        	</div>
					<div class="form-group">
						<label class="col-md-3">Username</label>
						<div class="col-md-5">
							<span><?php echo $r->username; ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3">Contact</label>
						<div class="col-md-5">
							<span><?php echo "0".$r->contact; ?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3">Salary:</label>
						<div class="col-md-5">
							<span><?php echo $r->salary; ?></span>
						</div>
					</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>

  </div>
</div>
<!-- end view niodal-->
	<?php 		//end modal
	$i++;	}
		echo "</ul>";
	}
}
						?>
					</div>
				</div>
				<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="panel-title">Rejected Loan Applications
					<?php
					$count_rej=0;
					if(!empty($rejected)) foreach($rejected as $r) $count_rej++;
					echo "<span class='badge'>".$count_rej."</span>";
					?>
				</h3>
				</div>
				<div class="panel-body" style="height:300px;overflow:auto;">
					<?php
					if(!empty($rejected)){
						echo "<ul class='list-group'>";
						$rej=0;
						foreach($rejected as $r){
					echo "<li class='list-group-item'><a data-target='#myModal_rejected_".$rej."' data-toggle='modal' data-backdrop='static'>".$r->fullnames." sent a Loan application at ".$r->dtime_posted."</a></li>";
					?>
					<!-- loan approval modal-->
					<div id="myModal_rejected_<?php echo $rej; ?>" class="modal fade" role="dialog" >
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
					<!-- end -->
					<?php
					$rej++;
					}
						echo "</ul>";
					}else{
						echo "<div class='row alert alert-warning'><center>No Rejected Loan Applications yet</center></div>";
					}
					?>
				</div>

				</div>
			</div><!-- row-->

		</div>
		<div class="col-md-7">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Pending Loan Applications
<?php
$count_p=0;
if(!empty($pending)) foreach($pending as $r) $count_p++;
echo "<span class='badge'>".$count_p."</span>";
?>
						</h4>
					</div>
					<div class="panel-body" style="height:300px;overflow:auto;">
<?php
if(!empty($pending)){
echo "<ul class='list-group'>";
$lm=0;
	foreach($pending as $r){
echo "<li class='list-group-item'><a data-target='#myModal_loan_".$lm."' data-toggle='modal' data-backdrop='static'>".$r->fullnames." sent a Loan Application at ".$r->dtime_posted."</a></li>";
?>
<!-- loan details form approval-->
<div id="myModal_loan_<?php echo $lm; ?>" class="modal fade" role="dialog" >
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
						<input type="hidden" id="url" value=<?php echo $assets['base_url']."loan/approve_loan_btn"; ?> />
						<input type="hidden" id="name" value="<?php echo $uname; ?>" />
						<input type="hidden" id="id" value="<?php echo $id; ?>" />
						<input type="hidden" id="loan_id" value="<?php echo $r->id; ?>" />
						<th><button id="approve" class="btn btn-success">Approve</button></th>
						<td><button id="reject" class="btn btn-success">Reject</button></td>
					</tr>
	    </tbody>
	</table>

			</div>
    </div>
  </div>
</div>
<?php
$lm++;
	}
	echo "</ul>";
}else{
	echo "<div class='row alert alert-warning'>No pending Loan Applications ...</div>";
}
?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Approved Loan Applications
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
	echo "<ul class='list-group'>";
	$app=0;
	foreach($approved as $r){
echo "<li class='list-group-item'><a data-target='#myModal_approval_".$app."' data-toggle='modal' data-backdrop='static'>".$r->fullnames." sent a Loan application at ".$r->dtime_posted."</a></li>";
?>
<!-- loan approval modal-->
<div id="myModal_approval_<?php echo $app; ?>" class="modal fade" role="dialog" >
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
<!-- end -->
<?php
$app++;
}
	echo "</ul>";
}else{
	echo "<div class='row alert alert-warning'><center>No Approved Loan Applications yet</center></div>";
}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
