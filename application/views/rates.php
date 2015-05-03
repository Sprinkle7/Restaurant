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
                            Users
                            <small>(Employees)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url();?>rest/index">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"> </i> Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
            <div class="row">
            <div class="col-md-5">
            <div class="panel panel-default">
                    <div class="panel-heading" style="background:#FDA018; color:#fff;">
                              Add Employees
                        </div>
                        <div class="panel-body">
                        <?php echo form_open(base_url().'rest/add_rates')?>
                            <table class="table table-hover">
                                    <tr>
                                        <td>Item Name</td>
                                        <td><?php echo form_input('name','','class="form-control" required="required"')?></td>
                                    </tr>
                                     <tr>
                                        <td>Quantity</td>
                                        <td><?php echo form_input('quantity','','class="form-control" required="required"')?></td>
                                    </tr>
                                     <tr>
                                        <td>Price</td>
                                        <td><?php echo form_input('price','','class="form-control" required="required"')?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="Rates" value="Add Employee" class="btn btn-warning"></td>
                                    </tr>
                                </table>
                        <?php echo form_close();?>  
                        </div>
                        </div>
                </div>
                <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#FDA018; color:#fff;">
                        List Of Employees
                    </div>
                    <div class="panel-body">
                    <?php  if (!empty($rate)) {
                             ?>
                         <table class="table table-hover table-bordered table-condensed">
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $k =1;
                           foreach ($rate as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row->rname;?></td>
                            <td><?php echo $row->rquantity;?></td>
                            <td><?php echo 'Rs/-'.$row->rprice;?></td>
                            <td>
                            <a href="<?php base_url()?>euser/<?php echo $row->r_id;?>"><span class="fa fa-pencil"> </span> </a>&nbsp;
                            <a href="<?php base_url()?>udel/<?php echo $row->r_id;?>"><span class="glyphicon glyphicon-trash"> </span> </a>
                            </td>
                        </tr>
                        <?php $k++;  }}else{ echo "No Rates Availible<br/>";}?>
                    </table>
                    </div>
                </div>
            </div>    
            </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</body>

</html>
