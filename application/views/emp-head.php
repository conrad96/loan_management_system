<?php include("header.php"); ?>
<ul class="nav nav-tabs">
<li class="active"><a href=<?php echo $assets['base_url'].'loan/employee/'.$id.'/'.$uname; ?>><span class="glyphicon glyphicon-home"></span><?php echo $uname; ?></a></li>
<li><a href=<?php echo $assets['base_url'].'loan/employee_forms/'.$id.'/'.$uname; ?>><span class="glyphicon glyphicon-folder"></span>Forms</a></li>
<li class='pull-right'><a href=<?php echo $assets['base_url'].'loan/logout'; ?>><span class='fa fa-sign-out'></span>Logout</a></li>
</ul><?php if(isset($msg)) echo $msg; ?>
