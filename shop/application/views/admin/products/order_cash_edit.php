<!--Begin Datatables-->
<div class="row-fluid list_show <?php if (!empty($index) || empty($items)) {
    echo 'hidden';
} ?>">
    <div class="span12">
        <div class="box">
            <header>
                <div class="icons"><i class="icon-tasks" style="font-size: 20px; color: #0066cc;"></i></div>
                <h5 style="display: inline-block; font-size: 18px; font-weight: bold;"> List of Bins</h5>
            </header>
            <div id="collapse4" class="body">
                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="width: 70px;" class="center">
                    <div class="btn-group data-list-control" style=" ">
                        <a class="btn"><input class="check_all" type="checkbox" /></a>
                        <button class="btn dropdown-toggle" data-toggle="dropdown"> &nbsp;<span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="bulk-delete" href="javascript:void(0);"><i class="icon-trash"></i> Delete</a></li>
                        </ul>
                    </div>
                    </th>
                    <th>Bin Size</th>
                    <th>Tyre Removal</th>
                    <th> Mattress Removal</th>
                    <th>LPG Gas Bottle</th>
                    <th> TVs & Monitors</th>
                    <th> Extra Day Hire</th>
                    <th> Product Quantity</th>
                    <th> Product Price</th>
                    <th> Product Image</th>

                    <!--<th>Parent</th>-->

                    <th width="105">Action</th>
                    </tr>
                    </thead>
                    <tbody>
<?php foreach ($items as $item) { ?>
                            <tr>
                                <td class="center"><input class="check list-control-check" type="checkbox" value="<?php echo $item->id ?>" /></td>
                                <td><?php echo $item->product_title; ?></td>
                                <td><?php echo $item->tyre_removal; ?></td>
                                <td><?php echo $item->mattress_removal; ?></td>

                                <td><?php echo $item->lpg_gas_bottle; ?></td>
                                <td><?php echo $item->tv_monitors; ?></td>
                                <td><?php echo $item->extra_day_hire; ?></td>

                                <td><?php echo $item->product_quantity; ?></td>
                                <td><?php echo $item->product_price; ?></td>
                                <td><?php if (!empty($item->image)) { ?><img src="<?php echo site_url() . $item->image; ?>" alt="" class="thumbnail" style="max-width: 60px;"><?php } else {
        echo 'No image available!';
    } ?></td>
                                <td class="action">
                                    <a href="  <?php echo site_url(CPREFIX . "/products/products_list/" . $item->id) ?>"><i class="icon-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a href="<?php echo site_url(CPREFIX . "/products/delete/" . $item->id) ?>"class="single-delete"><i class="icon-trash"></i> Delete</a>
                                </td>
                            </tr>
<?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-primary click_show" style="margin: 10px 20px;"><i class="icon-plus"></i> <b>Add</b></button>
            </div>
        </div>
    </div>
</div>
<!--End Datatables-->

<script>
    $(document).ready(function() {
        // Check all checkboxes in table
        $('.check_all').click(function() {
            var pt = $(this).parents('table');
            var ch = pt.find('tbody .check');
            if ($(this).is(':checked')) {
                ch.each(function() {
                    $(this).attr('checked', true);
                });
            } else {
                ch.each(function() {
                    $(this).attr('checked', false);
                });
            }
        });
    });
</script>

<script>
    var dTable = null;
    $(document).ready(function() {
        /*---------- BEGIN datatable CODE -------------------------*/
        dTable = $('#dataTable').dataTable({
            "sDom": "<'pull-right'f>t<'row-fluid datatable-bottombar-add-top-marrgin'<'span4'l><'span4 data-table-info-right'i><'span4'p>>",
            "sPaginationType": "bootstrap",
            "aaSorting": [[ 4, "asc" ]],
            // Disable sorting on the first column
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, ($('#dataTable thead tr').children().length - 1)]
                }],
            "oLanguage": {
                "sLengthMenu": "Show _MENU_ entries"
            }
        });
        /*----------- END datatable CODE -------------------------*/
        
        /*----------- bulk Delete -------------------------*/
        $('#dataTable .bulk-delete').each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                var len = $(this).parents('table').find('tbody .check:checked').length;
                if (!len) {
                    alert('Please select at least 1 item');
                    return;
                }
                if (len && !confirm('Are you sure want to delete?')) {
                    return;
                }
                
                var ids = new Array();
                $(this).parents('table').find('tbody .check:checked').each(function() {
                    ids.push($(this).val());
                    ;
                });
                
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    type: "POST",
                    url: '<?php echo site_url(CPREFIX . "/campaign/delete_campaign_categories") ?>',
                    dataType: 'json',
                    context: $(this).parents('table'),
                    data: jQuery.param({id: ids})
                }).done(function(rt) {
                    var $this = $(this);
                    $.each(ids, function(index, value) {
                        dTable.fnDeleteRow($this.find('input[value="' + value + '"]').parents('tr:first').index());
                        $this.find('input[value="' + value + '"]').parents('tr:first').remove();
                    });
                    
                    $.pnotify.defaults.styling = "bootstrap";
                    var stack_bottomright = {"dir1": "down", "dir2": "left", "push": "bottom", "firstpos1": 25, "firstpos2": 25};
                    var opts = {
                        //title: "Over Here",
                        text: rt.msg,
                        addclass: "stack-topright",
                        stack: stack_bottomright,
                        type: rt.status === true ? "success" : 'error'
                    };
                    $.pnotify(opts);
                    setTimeout(function(){
                        window.location = window.location;
                    },800);
                    
                });
            });
        });
        
        /*----------- single Delete -------------------------*/
        $('body').on('click','#dataTable .single-delete',function(e) {
            e.preventDefault();
            $(this).parents('table').find('tbody .check:checked').prop('checked', false);
            $(this).closest('tr').find('.check').prop('checked', true);
            
            var len = $(this).parents('table').find('tbody .check:checked').length;
            if (!len) {
                alert('Please select at least 1 item');
                return;
            }
            if (len && !confirm('Are you sure want to delete?')) {
                return;
            }
            
            var ids = new Array();
            $(this).parents('table').find('tbody .check:checked').each(function() {
                ids.push($(this).val());
                ;
            });
            
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                type: "POST",
                url: '<?php echo site_url(CPREFIX . "/products/delete_product") ?>',
                dataType: 'json',
                context: $(this).parents('table'),
                data: jQuery.param({id: ids})
            }).done(function(rt) {
                var $this = $(this);
                $.each(ids, function(index, value) {
                    dTable.fnDeleteRow($this.find('input[value="' + value + '"]').parents('tr:first').index());
                    $this.find('input[value="' + value + '"]').parents('tr:first').remove();
                });
                
                $.pnotify.defaults.styling = "bootstrap";
                var stack_bottomright = {"dir1": "down", "dir2": "left", "push": "bottom", "firstpos1": 25, "firstpos2": 25};
                var opts = {
                    //title: "Over Here",
                    text: rt.msg,
                    addclass: "stack-topright",
                    stack: stack_bottomright,
                    type: rt.status === true ? "success" : 'error'
                };
                $.pnotify(opts);
                setTimeout(function(){
                    window.location = window.location;
                },800);
                
            });
        }); 
    });
</script>

<!--Add Category-->
<?php echo $this->theme->js('assets/js/jquery.imagepreview.js'); ?>
<script>
    jQuery(document).ready(function() {
        $('#image').imagePreview({ selector : '#bannerpic'
        });
    }); 
    
    jQuery(document).ready(function() {
        $("#name").on('keyup keypress change', function(e) {
            if ($("#slug").attr('data-changed') != 'changed') {
                var value = $(this).val().toString();
                $("#slug").val(value.toSlug());
            }
        });
    });
</script>

<script>

 jQuery(document).ready(function() {
$("#availabe_bin").one('focus',function(){
  var bla = $('#bin_quantity').val();
$('#availabe_bin').val(bla);
   
});
$("#availabe_bin").blur(function(){
       $(this).css("background-color", "#ffffff");
   });
});
</script>














<div class="row-fluid add_show <?php if (!empty($invoice) && empty($index)) {
    echo 'hidden';
} ?>">
    <div class="span12">
        <div class="box for-form-horizontal">
            <header>
                <div class="icons"><i class="icon-plus-sign" style="font-size: 20px; color: #0066cc;"></i></div>
                <h5 style="display: inline-block; font-size: 18px; font-weight: bold;">Edit Orders in Cash</h5>
                <div class="toolbar">
                    <ul class="nav">
                        <li>
                            <div class="btn-group">
                                <a class="accordion-toggle btn minimize-box" data-toggle="collapse" href="#collapse3"><i class="icon-chevron-up"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <div id="collapse3" class="accordion-body collapse in body">
                <?php
                $template = '<div class="control-group">
                        {label}
                        <div class="controls">{input}</div>                        
                        </div>';
                echo $this->ahrform->set_template($template);
                echo $this->ahrform->set_input_default(array('label' => array('class' => 'control-label'), 'input' => array('class' => 'input-xlarge')));
                ?>
                <form action="" method="post" class="form-horizontal" id="inline-validate" enctype="multipart/form-data" >
                    <?php echo $this->ahrform->input(array('name' => 'id', 'type' => 'hidden', 'label' => false, 'template' => false)); ?>             
                    <?php
//                    echo $this->ahrform->input(array(
//                        'name' => 'p_title',
//                        'label' => 'Product',
//                        'type' => 'select',
////                        'value' => 30,
//                        'empty' => 'Select product type...',
//                        'options' => array('2-Meter Cubic Bin' => '2-Meter Cubic Bin',
//                            '4-Meter Cubic Bin' => '4-Meter Cubic Bin',
//                            '6-Meter Cubic Bin' => '6-Meter Cubic Bin',
//                            '9-Meter Cubic Bin' => '9-Meter Cubic Bin'
//                        )
//
//
//                    ));

                    ?>
                                   
                    
           <?php echo $this->ahrform->input(array('name' => 'invoice_no', 'type' => 'text', 'label' => ' Invoice Number')); ?>
           <?php echo $this->ahrform->input(array('name' => 'customer_name', 'type' => 'text','id'=>'customer_name' ,'label' => 'Customer Name')); ?>
           <?php echo $this->ahrform->input(array('name' => 'delivery_date', 'type' => 'text' ,'label' => 'Delivery Date')); ?>

     
               
           <?php echo $this->ahrform->input(array('name' => 'collection_date', 'type' => 'text', 'label' => ' Collection Date')); ?>
           <?php echo $this->ahrform->input(array('name' => 'bin_placement', 'type' => 'text','id'=>'bin_quantity' ,'label' => ' Bin Placement')); ?>
           <?php echo $this->ahrform->input(array('name' => 'total_amount', 'type' => 'text' ,'label' => 'Total Amount')); ?>

               
           <?php echo $this->ahrform->input(array('name' => 'order_date', 'type' => 'text', 'label' => 'Order Date')); ?>
           <?php // echo $this->ahrform->input(array('name' => 'delivery_status', 'type' => 'text','id'=>'delivery' ,'label' => 'Delivery Status       ')); ?>

       <?php 
 
  echo $this->ahrform->input(array(
                        'name' => 'delivery_status',
                        'label' => 'Delivery Status',
                        'type' => 'select',

                        
                        'options' => array('1' => 'Delivered',
                            '0' => 'Not Delivered'
                            
                             )
                           
                      
                    ));
 
 ?>
    
     
     
     

               



<?php // echo $this->ahrform->input(array('name' => 'sort_order', 'type' => 'text', 'label' => 'Sort Order', 'style'=>'max-width: 80px'));  ?>
                    <div class="form-actions">
                        <button value="" class="btn btn-primary" id="save_btn" name="data[form_acion]" type="submit"><i class="fa fa-floppy-o"></i> SAVE</button>
                        or <a href="<?php echo site_url('/' . CPREFIX . '/products/order_cash') ?>"><i class="icon-backward"></i> Back to list</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--END TEXT INPUT FIELD-->
<!--<script>
    jQuery(document).ready(function() {
        tinymce.get('p_summary').save();
        tinymce.get('p_description').save();
    });
</script>-->
<script>
    
    jQuery(document).ready(function() {
        $(document).on('click', '.click_show', function(e) {
            e.preventDefault();
            $('.list_show').hide();
            $('.add_show').removeClass('hidden');
            $('.add_show').show();
        });
        $("#save_btn").on('click', function(e){
            tinymce.get('p_summary').save();
            tinymce.get('p_description').save();
        });
        /*----------- BEGIN validate CODE -------------------------*/
            
        var sdform = $('#inline-validate');
        //        
        sdform.validate({
            ignore: "", //validate hidden field
            rules: {
                p_title: {
                    required: true
                },
                p_summary: {
                    required: true
                },
                p_description: {
                    required: true
                },
                lpg_gas_bottle: {
                    required: true
                },
                tv_monitors: {
                    required: true
                },
                extra_day_hire: {
                    required: true
                },
                product_quantity: {
                    required: true
                },
                p_price: {
                    required: true,
                    number:true
                },
                
                 
                     
<?php if ($this->ahrform->get('id') == null) { ?>
                                    image: {
                                        required: true
                                    },
<?php } ?>
                                //                sort_order: {
                                //                    required: true
                                //                }
                                sort_order: {
                                    required: true,
<?php if ($this->ahrform->get('id') == null) { ?>
                                            remote: {
                                                url: '<?php echo site_url(CPREFIX . "/products/products_list"); ?>',
                                                type: "post",
                                                data: {
                                                    requestby: 'jquery_validator',
                                                    id: function() {
                                                        return sdform.find('[name="id"]').val();
                                                    },
                                                    sort_order: function() {
                                                        return sdform.find('[name="product_list"]').val();
                                                    }
                                                }
                                            }
<?php } ?>
                                    }
                                },
                                messages: {
                                    sort_order: {
                                        remote: 'This product is  already exist!!'
                                    }
                                },
                                errorClass: 'help-inline',
                                errorElement: 'span',
                                highlight: function(element, errorClass, validClass) {
                                    $(element).parents('.control-group').removeClass('success').addClass('error');
                                },
                                unhighlight: function(element, errorClass, validClass) {
                                    $(element).parents('.control-group').removeClass('error');//.addClass('success');
                                }
                            });
                            
                            
                            
                        });
                        
</script>