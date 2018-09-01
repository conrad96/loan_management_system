<?php include("header.php"); ?>
<?php include("admin-nav.php"); ?>
<?php if(isset($msg)) echo $msg; ?>
<div class="container">

	<div class="reg_emp_form">
	<h4 class='text-warning' >REGISTER EMPLOYEE</h4>
	<form class="form-horizontal" method="POST" action=<?php echo $assets['base_url'].'loan/register_employee/'.$id.'/'.$uname; ?>>
		<div class="form-group">
			<input type="text" name="fullnames" id="in_r" placeholder="fullnames">
		</div>
		<div class="form-group">
			<input type="email" name="email" id="in_r" placeholder="email">
		</div>
		<div class="form-group">
			<input type="text" name="contact" id="in_r" placeholder="contact">
		</div>
		<div class="form-group">
			<input type="text" name="salary" id="in_r" placeholder="salary">
		</div>
		<div class="form-group">
			<input type="text" name="section" id="in_r" placeholder="Section or Department" />
		</div>
		<div class="form-group">
			<input type="text" name="username" id="in_r" placeholder="username">
		</div>
		<div class="form-group">
			<input type="password" name="password" id="in_r" placeholder="password">
		</div>
		<div class="form-group">
			<input type="password" name="cpassword" id="in_r" placeholder="Confirm password">
		</div>
		<div class="form-group">
			<input type="submit" value="Register Employee" class="btn btn-success" id="reg_emp_btn">
		</div>

	</form>
	</div>
</div>
<?php include("footer.php"); ?>
