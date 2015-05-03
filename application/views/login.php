<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url()?>assets/css/sb-admin.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url()?>assets/font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url(img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                    <div class="panel-heading" style="background:#FDA018; color:#fff;">
                              Login To Your Account
                        </div>
                        <div class="panel-body">
                        <?php echo form_open(base_url().'login/signin')?>
                            <table class="table table-hover">
                                    <tr>
                                        <td>Username</td>
                                        <td><input type="text" class="form-control" placeholder="Username" name="username"></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td><input type="password" class="form-control" placeholder="Password" name="password"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                        <input type="submit" name="employee" style="background:#FDA018; color:#fff;" value="Login" class="btn btn-default">
										<input type="reset" value="Reset" class="btn btn-default" style="background:#FDA018; color:#fff;">
                                        </td>
                                    </tr>
                                </table>
                        <?php echo form_close();?>  
                        </div>
                       
                        </div>
                </div>
	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="<?php echo base_url()?>assets/js/jquery-1.11.1.min.js"></script>

	
		<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
	
	<!-- end: JavaScript-->
	
</body>
</html>
