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
                            Order
                            <small>(Clients)</small>
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-warning pull-right">Add Order</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url();?>rest/index">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bars"> </i>  Order
                            </li>
                            
                            <span class="pull-right" id="msg" style="color:#000;"><?php echo $sage?></span>
                        </ol>
                    </div>
                </div>

                <!-- kjdshkfjhd -->

           <div class="col-lg-12">
          <?php
              $k =1; 
              if (!empty($order)) {
              foreach ($order as $result){
           ?>
           <div class="panel-group col-lg-4" id="accordion">
           <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title"> 
              Table No <?php echo $result->table_no;?>&nbsp; <?php echo $result->cname;?>
                <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $k;?>">
                 <span class="badge pull-right" style="border-radius:100px; padding:0.4em;"><span class="fa fa-chevron-down"></span></span>
                </a> 
              </h4> 
            </div> 
            <div id="<?php echo $k;?>" class="panel-collapse collapse in"> 
                  <div class="panel-body"> 
                  <div class="col-sm-8" style="padding:5px;">Time in</div><div class="col-sm-3" style="padding:5px;"><?php echo $result->order_time;?></div>
                  <div class="col-sm-12" style="padding:5px;">
                  <!--  -->
                  <table class="table table-condensed table-striped">
                  <tr class="odd">
                    <th>Item Name</th>
                    <th>Quantity</th>
                  </tr>
                  <?php
                      $id = $result->cid;
                      $data['mine'] = $this->restaurant->mselection('order','cid',$id,'0');
                      if (!empty($data['mine'])) {
                      foreach ($data['mine'] as $current) { ?>
                      <tr class="odd">
                      <?php
                          $name = $current->items;
                          $data['name'] = $this->restaurant->oselection('items','id',$name);
                          if (!empty($data['name'])) {
                         
                          foreach ($data['name'] as $item) { ?>   
                        <td>
                        <?php  echo $item->item_name;?>
                        <?php  echo $item->item_price;?>
                        </td> 
                       <?php  }}?>
                        <td class="text-center"><?php echo $current->quantity;?></td>
                      </tr>  
                  <?php }}
                      $data['mine'] = $this->restaurant->mselection('order','cid',$id,'1');
                      if (!empty($data['mine'])) {
                      foreach ($data['mine'] as $current) { ?>
                      <tr class="odd">
                      <?php
                          $name = $current->items;
                          $data['rate'] = $this->restaurant->oselection('miscitem','m_id',$name);
                          foreach ($data['rate'] as $itemd) { ?>   
                        <td>
                        <?php  echo $itemd->item;?>
                        <?php  echo $itemd->price;?>
                        </td> 
                       <?php }?>
                        <td class="text-center"><?php echo $current->quantity;?></td>
                      </tr>  
                  <?php }} ?>                
                  </table>
                  </div>
              <div class="col-sm-12" style="padding:5px;">
                <a href="" data-toggle="modal" data-target="#a<?php echo $result->cid;?>" class="btn btn-warning pull-right">Add Miscs</a>
                <a href="" data-toggle="modal" data-target="#<?php echo $result->cid;?>"  class="btn btn-link pull-right">Add Another Item</a>
              </div>
                  <div class="col-sm-12"><hr></div>
                  <div class="col-sm-8" style="padding:5px; font-weight:bold;">Total</div>
                    <div class="col-sm-3" style="padding:5px;">
                      <?php echo $result->total_payment;?>
                    </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-8" style="padding:5px;">Recieved</div><div class="col-sm-3" style="padding:5px;">
                    <a href="<?php echo base_url()?>rest/paid?ID=<?php echo $result->cid?>" class="btn btn-warning btn-xs">
                      <?php 
                        if($result->recieved==0){
                          echo "Not Recieved";
                      }
                      else
                      {
                        echo "Received";
                      }
                      ?>
                    </a>
                    </div>
                 </div> 
             </div> 
           </div>
          </div>
        <div class="modal fade" id="<?php echo $result->cid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background:#FDA018; color:#fff;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Another Item</h4>
              </div>
              <div class="modal-body">
                  <?php echo form_open(base_url().'rest/eorder')?>
                      <div  class="col-md-10 col-md-offset-1">
                          <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>
                                     <select name="it" id="" class="form-control pull-left" style="width:240px;">
                                      <option value="">--Select Item--</option>
                                      <?php
                                        if (!empty($rates)) {
                                        foreach ($rates as $price) {
                                      ?>
                                      <option value="<?php echo $price->id?>"><?php echo $price->item_name?></option>
                                      <?php }}?>
                                        </select>
                                         <!-- <input type="text" class="form-control pull-left" name="item[]" id="p_scnt" placeholder="Item Name"> -->
                                        <input type="text" class="form-control pull-right" style="width:60px;" name="quant" id="p_scnt" placeholder="00">
                                        </td>
                                        </tr> 
                                        <tr>
                                          <td><input type="hidden" id="coid" value="<?php echo $result->cid ?>" name="oid"></td>
                                        </tr>
                                    </table>
                                </div>
                                    <div class="clearfix"></div>
                                  </div>
                              <div class="modal-footer" style="background:#FDA018; color:#fff;">
                                <input type="submit" name="details" value="Add Item" class="btn btn-default">
                              </div>
                              <?php echo form_close();?>  
                            </div>
                        </div>
        </div> 
        <div class="modal fade" id="a<?php echo $result->cid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background:#FDA018; color:#fff;">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Miscs</h4>
                </div>
                <div class="modal-body">
                                  <?php echo form_open(base_url().'rest/addordermisc')?>
                                  <div  class="col-md-10 ">
                                      <table class="table table-hover">
                                        <tr>
                                            <td>Item Name</td>
                                            <td>
                                                <div id="p_scent">
                                                    <p>
                                                    <label for="p_scnt">
                                                      <select name="mitem[]" id="" class="form-control pull-left" style="width:220px;">
                                                      <option value="">--Select Item--</option>
                                                      <?php foreach ($miscitem as $misc) {?>
                                                      <option value="<?php echo $misc->m_id?>"><?php echo $misc->item?></option>
                                                      <?php }?>
                                                        </select>
                                                        <input type="text" class="form-control pull-right" style="width:60px;" name="mquantity[]" id="p_sc" placeholder="00">
                                                    </label>
                                                    </p>
                                                </div>
                                                <a href="#" id="addSct" class="btn btn-default">Add Item <span class="fa fa-plus fa-sm"></span></a>
                                            </td> 
                                        </tr> 
                                          <tr>
                                         <td><input type="hidden" id="cid" value="<?php echo $result->cid;?>" name="ssid"></td>
                                        </tr>
                                      </table>
                                  </div>
                      <div class="clearfix"></div>
                </div>
                <div class="modal-footer" style="background:#FDA018; color:#fff;">
                <input type="submit" name="reorder" value="Add To Order" class="btn btn-default">
                </div>
                  <?php echo form_close();?>  
              </div>
            </div>
          </div>   
          <?php $k++; }}?>
          </div>
            </div>
            <!-- /.container-fluid -->
  
        </div>


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
                        <?php echo form_open(base_url().'rest/addorder')?>
                        <div  class="col-md-10 ">
                            <table class="table table-hover">
                                    <tr>
                                        <td>Table No:</td>
                                        <?php 
                                            $counter =0;
                                           while ($counter <= 20) {
                                               $wel[] = $counter; 
                                               $counter++;
                                           }
                                        ?>
                                        <td><?php echo form_dropdown('table',$wel,'','class="form-control"')?></td>
                                    </tr>
                                     <tr>
                                        <td>Name</td>
                                        <td><?php echo form_input('name','','class="form-control", placeholder="Name"')?></td>
                                    </tr> 
                                     <tr>
                                        <td>Serve By</td>
                                       
                                        <td>
                                        <select name="serve" id="" class="form-control">
                                            <option value="">--Select--</option> 
                                            <?php 
                                            foreach ($emp as $key) {
                                           ?>
                                            <option value="<?php echo $key->w_id;?>"><?php echo $key->name;?></option>
                                            <?php }?>
                                        </select>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Item Name</td>
                                        <td>
                                            <div id="p_scents">
                                                <p>
                                                <label for="p_scnts">
                                                  <select name="item[]" id="" class="form-control pull-left" style="width:220px;">
                                                  <option value="">--Select Item--</option>
                                                  <?php
                                                    foreach ($rates as $price) {
                                                  ?>
                                                  <option value="<?php echo $price->id?>"><?php echo $price->item_name?></option>
                                                  <?php }?>
                                                    </select>
                                                    <!-- <input type="text" class="form-control pull-left" name="item[]" id="p_scnt" placeholder="Item Name"> -->
                                                    <input type="text"  class="form-control pull-right" style="width:60px;" name="quantity[]" id="p_scnt" placeholder="00">
                                                </label>
                                                </p>
                                            </div>
                                            <a href="#" id="addScnt" class="btn btn-default">Add Item <span class="fa fa-plus fa-sm"></span></a>
                                        </td> 

                                    </tr> 
                                    <tr>
                                        <td colspan="2" style="line-height:26px;">Payment Recieved &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"value="1" name="recieved"></td>
                                    </tr>
                                </table>
                        </div>
                        
            <div class="clearfix"></div>
      </div>
      <div class="modal-footer" style="background:#FDA018; color:#fff;">
      <input type="submit" name="order" value="Add Order" class="btn btn-default">
      </div>
        <?php echo form_close();?>  
    </div>
  </div>
</div>

  <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/jquery-ui.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script>
    $(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
        $('#addScnt').click(function() {
                $('<p><label for="p_scnts"><select name="item[]" id="" class="form-control pull-left" style="width:220px;"><option value="">--Select Item--</option><?php foreach ($rates as $price) {?><option value="<?php echo $price->id?>"><?php echo $price->item_name?></option><?php }?></select><input type="text" class="form-control pull-right" style="width:60px;" name="quantity[]"  id="p_scn" placeholder="00"></label></p>').appendTo(scntDiv);
                i++;
                return false;
    });
        var scntDi = $('#p_scent');
        var i = $('#p_scent p').size() + 1;
        $('#addSct').click(function() {
                $('<p><label for="p_scnt"><select name="mitem[]" id="" class="form-control pull-left" style="width:220px;"><option value="">--Select Item--</option><?php foreach ($miscitem as $misc) {?><option value="<?php echo $misc->m_id?>"><?php echo $misc->item?></option><?php }?></select><input type="text" class="form-control pull-right" style="width:60px;" name="mquantity[]"  id="p_sc" placeholder="00"></label></p>').appendTo(scntDi);
                i++;
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
