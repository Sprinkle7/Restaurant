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
                            Stock
                            <small>(Product)</small>
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-warning pull-right">Add Food Items</a>
                            <a  data-toggle="modal" data-target="#myMo" class="btn btn-default pull-right">Add Miscs</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url();?>rest/index">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bars"> </i>  Stocks
                            </li>
                            
                            <span class="pull-right" id="msg" style="color:#000;"><?php echo $sage?></span>
                        </ol>
                    </div>
                </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Food Items</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                   <tr class="odd">
                       <th>S.No</th>
                       <th>Item Name & Quantity</th>
                       <th>Type</th>
                       <th>Price</th>
                       <th>From</th>
                       <th>By</th>
                       <th>Payed</th>
                       <th>Remaining Amount</th>
                       <th>Exist Quantity</th>
                       <th>Time</th>
                       <th>Date</th>
                   </tr>
                   <?php
                   $k =1; 
                   foreach ($display as $result){ 
                    ?>
                   <tr class="odd">
                       <td><?php echo $k;?></td>
                        <td>
                        <table>
                       <?php
                        $id = $result->sid;
                        $data['product'] = $this->restaurant->mselection('product','sid',$id,'0');
                        if (!empty($data['product'])) {
                        foreach ($data['product'] as $current) {
                        $name = $current->itemname;
                        $data['itemget'] = $this->restaurant->oselection('items','id',$name);
                        if (!empty($data['itemget'])) {
                        foreach ($data['itemget'] as $itemss) { ?>   
                        <tr class="odd">
                          <td><?php  echo $itemss->item_name;?></td>
                          <td> <?php echo '<spann style="padding-left:30px;font-weight:bold; text-align:right">'.$current->itemquantity.'<span/><br>';
                          ?></td>
                        </tr>
                        <?php }
                       $quantities[] = $current->itemquantity;
                       $totalquantities = array_sum($quantities);
                       $query = $this->restaurant->updations('stock','sid',$id,'existing_quantity',$totalquantities); 
                       }}  
                       $quantities = '';
                       $totalquantities = '';
                       }
                       else{
                        $data['product'] = $this->restaurant->mselection('product','sid',$id,'1');
                        if (!empty($data['product'])) {
                          foreach ($data['product'] as $current) {
                          $name = $current->itemname;
                          $data['itemget'] = $this->restaurant->oselection('miscitem','m_id',$name);
                          if (!empty($data['itemget'])) {
                          foreach ($data['itemget'] as $itemss) { ?>   
                          <tr class="odd">
                            <td><?php  echo $itemss->item;?></td>
                            <td> <?php echo '<spann style="padding-left:30px;font-weight:bold; text-align:right">'.$current->itemquantity.'<span/><br>';?></td>
                          </tr>
                       <?php
                       }}
                       $miscs[] = $current->itemquantity;
                       $totalmiscs = array_sum($miscs);
                       $query = $this->restaurant->updations('stock','sid',$id,'existing_quantity',$totalmiscs); 
                       }}  
                       $miscs = '';
                       $totalmiscs = '';
                       }?>
                        </table>
                        </td> 
                       <td><?php 
                           $type=$result->type;
                           if ($type==0) {
                             echo "Not Mentioned";
                           }
                           elseif ($type==1) {
                             echo 'Low';
                           }
                           elseif ($type==2) {
                             echo "Medium";
                           }
                           else
                           {
                            echo "High";
                           }
                       ?>
                       </td>
                       <td><?php echo $result->price;?></td>
                       <td><?php echo $result->from;?></td>
                       <td><?php echo $result->name;?></td>
                       <td><?php echo $result->payed;?></td>
                       <td><?php echo $result->remaining;?></td>
                       <td><?php 
                            $updating_quantity = $result->existing_quantity;
                            if ($updating_quantity<=0) {
                              echo "Out Of Order";
                             } 
                             else{
                              echo $updating_quantity;
                             }
                            ?></td>
                       <td><?php echo $result->time;?></td>
                       <td><?php echo $result->date;?></td>
                   </tr>
                   <?php $k++; }?>
                   </table> 
                </div>
                <!-- end of panel body -->
                <div class="panel-footer">
                  <?php echo $links; ?>
                </div>
                </div>
                   <!-- end of column -->
                </div>
            </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">   
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background:#FDA018; color:#fff;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Food Items</h4>
      </div>
      <div class="modal-body">
  <?php echo form_open(base_url().'rest/addstock')?> 

                        <div  class="col-md-6">
                            <table class="table table-hover">
                                    <tr>
                                        <td>Food Name</td>
                                        <td>
                                        <div id="p_scent">
                                                <p>
                                                <label for="p_scnt">
                                                  <select name="item[]" required="required" id="" class="form-control pull-left" style="width:200px;">
                                                  <option value="">--Select Item--</option>
                                                  <?php
                                                    foreach ($item as $price) {
                                                  ?>
                                                  <option value="<?php echo $price->id?>"><?php echo $price->item_name?></option>
                                                  <?php }?>
                                                    </select>
                                                    <!-- <input type="text" class="form-control pull-left" name="item[]" id="p_scnt" placeholder="Item Name"> -->
                                                    <input type="text" required="required" class="form-control pull-right" style="width:60px;" name="quantity[]" placeholder="00">
                                                </label>
                                                </p>
                                            </div>
                                            <a href="#" id="addScn" class="btn btn-default">Add Food <span class="fa fa-plus fa-sm"></span></a>
                                          </td>
                                         </tr>
                                    
                                </table>
                        </div>
                       
                          <div class="col-md-6">
                            <table class="table table-hover">
                                 
                                    <tr>
                                        <td>Item Type</td>
                                        <?php
                                            $data = array(
                                                    '0' => 'Select Type',
                                                    '1' => 'Low',
                                                    '2' => 'Medium',
                                                    '3' => 'High',
                                                );  
                                        ?>
                                        <td><?php echo form_dropdown('type',$data,'0','class="form-control" required="required"')?></td>
                                    </tr> 
                                    <tr>
                                        <td>Total Price</td>
                                        <td><?php echo form_input('price','','class="form-control", placeholder="Price" required="required"')?></td>
                                    </tr> 
                                    <tr>
                                        <td>By</td>
                                        <td>
                                        <select name="by" class="form-control" required="required">
                                        <?php
                                            foreach ($emp as $row) {
                                              echo '<option value="'.$row->w_id.'">'.$row->name.'</option>';
                                            }
                                        ?></select></td>
                                    </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-hover">
                             <tr>
                                        <td>From</td>
                                        <td><?php echo form_input('from','','class="form-control", placeholder="From" required="required"')?></td>
                                    </tr> 
                              <tr>
                                        <td>Payed</td>
                                        <td><?php echo form_input('payed','','class="form-control", placeholder="Payed" required="required"')?></td>
                                    </tr> 
                                    
                            </table>
                        </div>
                            <div class="clearfix"></div>
                        </div>

      <div class="modal-footer" style="background:#FDA018; color:#fff;">
         <input type="submit" name="stock" value="Add Products" class="btn btn-default">
      </div>
<!-- model -->

    </div>
  </div>

                        <?php echo form_close();?>  
</div>
<?php echo form_open(base_url().'rest/addmiscq')?>
<div class="modal fade" id="myMo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background:#FDA018; color:#fff;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Miscs Items</h4>
      </div>
      <div class="modal-body">
        <div  class="col-md-6">
                            <table class="table table-hover">
                                    <tr>
                                        <td>Misc Name</td>
                                        <td>
                                        <div id="p_scents">
                                                <p>
                                                <label for="p_scnts">
                                                  <select name="misc[]" required="required"  id="" class="form-control pull-left" style="width:200px;">
                                                  <option value="">--Select Item--</option>
                                                  <?php
                                                    foreach ($miscitem as $price) {
                                                  ?>
                                                  <option value="<?php echo $price->m_id?>"><?php echo $price->item?></option>
                                                  <?php }?>
                                                    </select>
                                                    <!-- <input type="text" class="form-control pull-left" name="item[]" id="p_scnt" placeholder="Item Name"> -->
                                                    <input type="text" required="required" class="form-control pull-right" style="width:60px;" name="mquantity[]" id="p_scns" placeholder="00">
                                                </label>
                                                </p>
                                            </div>
                                            <a href="#" id="addScnt" class="btn btn-default">Add Misc <span class="fa fa-plus fa-sm"></span></a>
                                          </td>
                                         </tr>
                            </table>
        </div>
        <div class="col-md-6">
                            <table class="table table-hover">
                                 
                                    <tr>
                                        <td>Item Type</td>
                                        <?php
                                            $data = array(
                                                    '0' => 'Select Type',
                                                    '1' => 'Low',
                                                    '2' => 'Medium',
                                                    '3' => 'High',
                                                );  
                                        ?>
                                        <td><?php echo form_dropdown('type',$data,'0','class="form-control" required="required"')?></td>
                                    </tr> 
                                    <tr>
                                        <td>Total Price</td>
                                        <td><?php echo form_input('price','','class="form-control", placeholder="Price" required="required"')?></td>
                                    </tr> 
                                    <tr>
                                        <td>By</td>
                                        <td>
                                        <select name="by" class="form-control" required="required">
                                        <?php
                                            foreach ($emp as $row) {
                                              echo '<option value="'.$row->w_id.'">'.$row->name.'</option>';
                                            }
                                        ?></select></td>
                                    </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-hover">
                             <tr>
                                        <td>From</td>
                                        <td><?php echo form_input('from','','class="form-control", placeholder="From" required="required"')?></td>
                                    </tr> 
                              <tr>
                                        <td>Payed</td>
                                        <td><?php echo form_input('payed','','class="form-control", placeholder="Payed" required="required"')?></td>
                                    </tr> 
                                    
                            </table>
                        </div>
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer" style="background:#FDA018; color:#fff;">
        <input type="submit" name="miscs" value="Add Miscs" class="btn btn-default">
    </div>
      </div>
</div>
<?php echo form_close();?>
    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script>
    $(function() {
        var scntDiv = $('#p_scent');
        var i = $('#p_scent p').size() + 1;
        $('#addScn').click(function() {
                $('<p><label for="p_scnt"><select name="item[]" id="" class="form-control pull-left" style="width:200px;"><option value="">--Select Item--</option><?php foreach ($item as $price) {?><option value="<?php echo $price->id?>"><?php echo $price->item_name?></option><?php }?></select><input type="text" class="form-control pull-right" style="width:60px;" name="quantity[]" id="p_scn" placeholder="00"></label></p>').appendTo(scntDiv);
                i++;
                return false;
        });

        var scntD = $('#p_scents');
        var j = $('#p_scents p').size() + 1;
        $('#addScnt').click(function() {
                $('<p><label for="p_scnts"><select name="misc[]" id="" class="form-control pull-left" style="width:200px;"><option value="">--Select Item--</option><?php foreach ($miscitem as $price) {?><option value="<?php echo $price->m_id?>"><?php echo $price->item?></option><?php }?></select><input type="text" class="form-control pull-right" style="width:60px;" name="mquantity[]" id="p_scns" placeholder="00"></label></p>').appendTo(scntD);
                j++;
                return false;
        });
        });
    $(function () { $('#accordion').collapse({ toggle: true })});

    </script>
    <script>
    $('#msg').delay(2000).hide(1000);
    </script>
</body>

</html>
