<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="<?php echo base_url();?>assets/css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .odd >th{
    font-size: 13px;
}
.odd>td{
    font-size: 13px;
}
</style>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php $this->load->view('includes/menu.php');?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 pad">
                        <h1 class="page-header">
                            Admin
                            <small>(Users)</small>
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-warning pull-right">Add Admin/User</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url();?>rest/index">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bars"> </i>  Admin/users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                  <table class="table table-striped table-hover">
                   <tr class="odd">
                       <th>S.No</th>
                       <th>Name</th>
                       <th>Date</th>
                       <th>Time in</th>
                       <th>Time Out</th>
                       <th>Status</th>
                   </tr>
                   <?php
                   $k =1; 
                   foreach ($emp as $result){
                    ?>
                   <tr class="odd">
                       <td><?php echo $k;?></td>
                       <td><?php echo $result->name;?></td>
                       <td><?php echo $result->date;?></td>
                       <td><?php echo $result->time;?></td>
                       <td><?php echo $result->out;?></td>
                       <td><?php  if ($result->status==0) {
                        echo "Online";
                       }else { echo "Offline";}?></td>
                   </tr>
                   <?php $k++; }?>
               </table>  
                </div>
               
                
            </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#FDA018; color:#fff;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Stock</h4>
      </div>
      <div class="modal-body">
                        <?php echo form_open(base_url().'rest/admin_add')?>
                        <div  class="col-md-10 col-md-offset-1">
                            <table class="table table-hover">
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo form_input('username','','class="form-control", placeholder="Username" required')?></td>
                                    </tr> 
                                    <tr>
                                        <td>Password</td>
                                        <td><?php echo form_input('password','','class="form-control", placeholder="Password" required')?></td>
                                    </tr> 
                                </table>
                        </div>
                            <div class="clearfix"></div>
                        </div>
      <div class="modal-footer" style="background:#FDA018; color:#fff;">
        <input type="submit" name="admin" value="Add User" class="btn btn-default">
      </div>
                        <?php echo form_close();?>  
    </div>
  </div>
</div>
    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>

</html>
