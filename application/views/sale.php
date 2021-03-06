<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Restaurant</title>
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
    <style>
        .odd >th
        {
            font-size: 13px;
        }
        .odd>td{
            font-size: 13px;
        }
    </style>
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
                            Items
                            <small>(Food Items)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url();?>rest/index">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"> </i> Items & Types
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
            <div class="row">
            <div class="col-md-5">
            <div class="panel panel-default">
                    <div class="panel-heading" style="background:#FDA018; color:#fff;">
                              Today's Sale
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <?php //foreach ($sale as $values) {?>
                                    <tr class="odd">
                                        <td>Date</td>
                                        <td><?php echo $sale->date?></td>
                                    </tr>
                                    <tr class="odd">
                                        <td>Total Sale</td>
                                        <td style="font-weight:bold;"><?php echo 'Rs/- '.$sale->total?></td>
                                    </tr>
                                </table>
                                <?php //}?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading" style="background:#FDA018; color:#fff;">
                        Sale History
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                    <tr class="odd">
                                        <td>S.No</td>
                                        <td>Date</td>
                                        <td>Total Sale</td>
                                    </tr>
                                <?php $k=1; foreach ($sold as $rows) {?>                                    
                                <tr class="odd">
                                        <td><?php echo $k;?></td>
                                        <td><?php echo $sale->date;?></td>
                                        <td style="font-weight:bold;"><?php echo 'Rs/- '.$sale->total?></td>
                                    </tr>
                                </table>
                                <?php $k++; }?>
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
    <script>
    $('#msg').delay(2000).hide(1000);
    </script>

</body>

</html>
