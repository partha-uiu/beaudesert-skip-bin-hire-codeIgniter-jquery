


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
                    url: '<?php echo site_url(CPREFIX . "/products/delete") ?>',
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
                url: '<?php echo site_url(CPREFIX . "/products/delete") ?>',
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












<div class="row-fluid list_show <?php
if (!empty($index) || empty($order)) {
    echo 'hidden';
}
?>">
    <div class="span12">
        <div class="box">
            <header>
                <div class="icons"><i class="icon-tasks" style="font-size: 20px; color: #0066cc;"></i></div>
                <h5 style="display: inline-block; font-size: 18px; font-weight: bold;">Order List</h5>
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
                    <th>Invoice Number</th>
                    <th>Customer Name</th>                              
                    <th>Product Items </th>                            
                    <th>Waste Type </th>
                    <th>Tyre Removal</th>
                    <th>Mattress Removal</th>
                    <th>LPG Gas Bottle </th>
                    <th>TV's and Monitors</th>                               
                    <th>Delivery date </th>
                    <th>Extra Day Hire</th>
                    <th>Collection Date</th>
                    <th>Bin Placement</th>
                    <th>Total amount</th>
                    <th>Order date</th>  
                    <th width="105">Action</th>   
                </tr>
                        </thead>
                        <tbody>
<?php foreach ($order as $ind => $item) { ?>
                                <tr>
                                  <!--<td class="center"><input class="check list-control-check" type="checkbox" value="<?php // echo $item->id ?>" /></td>-->
                                   <td class="center"><input class="check list-control-check" type="checkbox" value="<?php echo $item->id ?>" /></td>
  
                                       <td><?php echo $item->invoice_no ?></td>
                                        <td><?php echo $item->customer_name; ?></td>                                   
                                        <td><?php echo $item->p_title; ?></td>                                   
                                        <td><?php echo $item->p_type ?></td>
                                        <td><?php echo $item->tyre_removal; ?></td>
                                        <td><?php echo $item->mattress_removal; ?></td>
                                        <td><?php echo $item->gas_bottle ?></td>
                                        <td><?php echo $item->tv_monitor; ?></td>
                                        <td><?php echo $item->delivery_date; ?></td>
                                        <td><?php echo $item->extra_day; ?></td>
                                        <td><?php echo $item->collection_date ?></td>
                                        <td><?php echo $item->bin_placement ?></td>
                                        <td>$<?php echo $item->total_amount ?></td>
                                        <td><?php echo $item->order_date ?></td>
                                     <td class="action">
                                <!--<a href="  <?php // echo site_url(CPREFIX . "/users/user_list/" . $item->id)?>"><i class="icon-pencil"></i> Edit</a>&nbsp;&nbsp;-->
                                <a class="single-delete"><i class="icon-trash"></i> Delete</a>
                                </td>
                                </tr>
                            <?php } ?>
<?php if (empty($order)) { ?>
                                <tr>
                                    <td colspan="3">No record found.</td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
<!--                <button class="btn btn-primary click_show" style="margin: 10px 20px;"><i class="icon-plus"></i> <b>Add</b></button>-->
            </div>
        </div>  
    </div>
</div>