<?php include("header.php"); ?>
<?php include("admin-nav.php"); ?>
<?php if(isset($msg)) echo $msg; ?>
<div class="container">
	<div class="reg_loan_form">
	<h4 class='text-warning' >ADD LOAN CATEGORY</h4>
	<form class="form-horizontal" method="POST" action=<?php echo $assets['base_url'].'loan/register_loan/'.$id.'/'.$uname; ?>>
		<div class="form-group">
			<select name="type" class="form-control" id="in_r" require>
				<option selected disabled >--choose--</option>
				<option>Quick loan</option>
				<option>School Fees loan</option>
				<option>Salary loan</option>
			</select>
		</div>	
		<div class="form-group">
			<label class="col-md-5">Interest Percentage</label>
			<div class="col-md-6">
			<input type="number" name="interest" value="10" >
			</div>
		</div>
		<div class="form-group">
			<input type="text" name="loan_range" placeholder="e.g Loan Range 10000-500000" id="in_r">
		</div>
		<div class="form-group">
			<input type="number" name="period" placeholder="Period(Days) e.g 30 days" id="in_r" require>
		</div>
		<div class="form-group">
			<input type="submit" value="Add Loan" class="btn btn-success" id="reg_emp_btn">
		</div>
	</form>
	</div>
</div>
<?php include("footer.php"); ?>