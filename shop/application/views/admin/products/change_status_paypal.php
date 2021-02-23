

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

<div class="row-fluid add_show <?php if (!empty($items) && empty($index)) {
    echo 'hidden';
} ?>">
    <div class="span12">
        <div class="box for-form-horizontal">
            <header>
                <div class="icons"><i class="fa fa-truck" style="font-size: 20px; color: #0066cc;"></i></div>
                <h5 style="display: inline-block; font-size: 18px; font-weight: bold;">Change Delivery Status</h5>
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
           <?php // echo $this->ahrform->input(array('name' => 'p_title', 'type' => 'text', 'label' => 'Product Title')); ?>
           <?php echo $this->ahrform->input(array('name' => 'delivery_status', 'type' => 'text', 'label' => 'Delevery Status')); ?>

            <?php // echo $this->ahrform->input(array('name' => 'p_summary', 'id' => 'p_summary', 'type' => 'textarea', 'label' => 'Product Summary')); ?>

            <?php // echo $this->ahrform->input(array('name' => 'p_description', 'id' => 'p_description', 'type' => 'textarea', 'label' => 'Product Description')); ?>

           <?php // echo $this->ahrform->input(array('name' => 'p_price', 'type' => 'text', 'label' => 'Product Price')); ?>

                 
                       

                        </div>
                    </div>



<?php // echo $this->ahrform->input(array('name' => 'sort_order', 'type' => 'text', 'label' => 'Sort Order', 'style'=>'max-width: 80px'));  ?>
                    <div class="form-actions">
                        <button value="" class="btn btn-primary" id="save_btn" name="data[form_acion]" type="submit"><i class="fa fa-floppy-o"></i> SAVE</button>
                        or <a href="<?php echo site_url('/' . CPREFIX . '/products/order_paypal') ?>"><i class="icon-backward"></i> Back to list</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--END TEXT INPUT FIELD
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
                delivery_status: {
                    required: true
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