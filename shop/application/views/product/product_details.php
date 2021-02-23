<?php 
    echo $this->theme->css('assets/jquery-ui/css/smoothness/jquery-ui-1.10.1.custom.min.css');
    echo $this->theme->js('assets/jquery-ui/js/jquery-ui-1.10.1.custom.min.js');
?>
<!-- Content
======================================= -->  
<div id="product-show-area">
    <div class="container">

        <!-- content area -->
        <div class="row res-view">
            <form id="myform">
            <?php foreach ($product_details as $p): ?>
            
          <div class="form-horizontal res-view">
                <div class="col-md-6">
                    <img style="margin-top: 10px;" src="<?php echo $p->p_image_url; ?>" alt="Beaudeser" />

                    <div class=" product-description">
                        <div style="background-color: #939393;color: #fff;padding: 15px;">
                            <h3 style="color: #fff;">Product Description</h3>
                            <p><?php echo $p->p_description; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="booked" style="color: red;font-size: 20px;display: none;">
                        <span>** Sorry, This Bin is already booked.Please try <a href="<?php echo site_url('product');?>">another bin</a></span>
                    </div>
                    <input type="hidden" id="p_id" name="p_id" value="<?php echo $p->id; ?>">
                    <h3><?php echo $p->p_title; ?></h3>
                    <p><?php echo $p->p_summary; ?></p>

<!--                    <form class="form-horizontal">                      -->
                        <div class="form-group">
                            <label for="tyreRemoval" class="col-sm-3 control-label">Select Postcode</label>
                            <div class="col-sm-8">
                                <select class="form-control d1" id="postcode" name="postcode">
                                    <option value="">Please Select</option>  
                                    <?php foreach ($all_postcodes as $post): ?>
                                         <option value="<?php echo $post->product_zone; ?>"><?php echo $post->postcode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="wasteType" class="col-sm-3 control-label">Waste Type</label>
                            <div class="col-sm-8">
                                <select disabled class="form-control d2" name="waste" id="wasteType">
                                    <option value="">Please Select</option>
                                    <?php foreach ($product_type as $t): ?>
                                        <!--<input type="hidden" name="p_type_id" value="<?php echo $t->id; ?>">-->
                                        <option data-zone="<?php echo $t->product_zone; ?>" data-id="<?php echo $t->product_type_id; ?>" value="<?php echo $t->price; ?>"><?php echo $t->product_type; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div id="ajax_comments">

                        </div>

                        <div class="form-group">
                            <label for="tyreRemoval" class="col-sm-3 control-label">Tyre Removal</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="tyreRemoval" name="tyre_removal">
                                    <option value="0">Please Select</option>  
                                    <?php foreach ($common_settings as $c): ?>
                                        <?php if ($c->title == 'Tyre Removal'): ?>
                                            <?php if ($c->quantity < 2): ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Tyre'; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Tyres'; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?> 
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="mattress" class="col-sm-3 control-label">Mattress Removal</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="mattress" name="mattress_removal">
                                    <option value="0">Please Select</option> 
                                    <?php foreach ($common_settings as $c): ?>
                                        <?php if ($c->title == 'Mattress Removal'): ?>
                                            <?php if ($c->quantity < 2): ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Mattress'; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Mattresses'; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?> 
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="gasBottle" class="col-sm-3 control-label">LPG Gas Bottle</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="gasBottle" name="gas_bottle">
                                    <option value="0">Please Select</option> 
                                    <?php foreach ($common_settings as $c): ?>
                                        <?php if ($c->title == 'LPG Gas Bottle'): ?>
                                            <?php if ($c->quantity < 2): ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Bottle'; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Bottles'; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?> 
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="tvMonitor" class="col-sm-3 control-label">TV's & Monitors</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="tvMonitor" name="tv_monitor">
                                    <option value="0">Please Select</option> 
                                    <?php foreach ($common_settings as $c): ?>
                                        <?php if ($c->title == 'Tv&Monitor'): ?>
                                            <?php if ($c->quantity < 2): ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Tv'; ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Tvs'; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">Delivery Date</label>
                            <div class="col-sm-8">
                               <input data-provide="delivery_date" name="delivery_date" type="text" class="form-control" id="date" value="">
                           </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="extraDay" class="col-sm-3 control-label">Extra Day Hire</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="extraDay" name="extra_day">
                                    <option data-date="0"  value="0">Please Select</option>
                                    <?php foreach ($common_settings as $c): ?>
                                        <?php if ($c->title == 'Extra Day'): ?>
                                            <?php if ($c->quantity < 2): ?>
                                                <option data-date="<?php echo $c->quantity; ?>" value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Extra Day'; ?></option>
                                            <?php else: ?>
                                                <option data-date="<?php echo $c->quantity; ?>" value="<?php echo $c->price; ?>"><?php echo $c->quantity . ' ' . 'Extra Days'; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  


                        <div class="form-group">
                            <label for="c_date" class="col-sm-3 control-label">Collection Date</label>
                            <div style="width: 308px;margin-left: 18px;" class="col-sm-8 form-control" id="c_date">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="b_placement" class="col-sm-3 control-label">Bin Placement</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="bin_placement" name="bin_placement">
                                    <option  value="">Please Select</option>
                                    <option  value="On Driveway">On Driveway</option>
                                    <option  value="On Front Lawn">On Front Lawn</option>
                                    <option  value="other">Other(Specify)</option>
                                </select>
                            </div>
                        </div>

<div class="form-group" class="placement_location">
    <label for="b_placement" class="col-sm-3 control-label placement_level">Specify Delivery Location</label>
  <div class="col-sm-8">
    <textarea style="background-color: lightgray;"  id="input_14_10" class="textarea small placement_text" cols="70" rows="4" tabindex="10" name="input_10"></textarea>
    <span class="bin-error" style="color: red;display: none;">** Please give a specific delivery location</span>
  </div>
    

</div>

                        <div class="form-group">
                            <label for="total" class="col-sm-3 control-label">Total</label>
                            <div class="col-sm-8">
                                <input style="border: none;font-size: 23px;color: green;" disabled name="price" type="text" class="form-control" id="total" value="<?php echo $p->p_price; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button  id="addCart" class="btn btn-default">Add to Cart</button>
                            </div>
                        </div>
<!--                    </form>-->
                </div>
                </div>
                <?php endforeach; ?>
                </form>

            </div><!-- end content area -->
        

    </div>
</div>


<script>

    jQuery(document).ready(function($) {
              
        
         $('.placement_level').hide();
         $('.placement_text').hide();

//-----------Price Modification--------------

        var total_fdb = <?php echo (empty($p->p_price) ? 0 : $p->p_price); ?>;
        function calcPrice() {
            total_fdb;
            var wastTypr = $.trim($('#wasteType').val());
            if(!wastTypr){
                wastTypr = 0;
            }
            var tyreRemoval = $.trim($('#tyreRemoval').val());
            if(!tyreRemoval){
                tyreRemoval = 0;
            }
            var mattress = $.trim($('#mattress').val());
            if(!mattress){
                mattress = 0;
            }
            var gasBottle = $.trim($('#gasBottle').val());
            if(!gasBottle){
                gasBottle = 0;
            }
            var tvMonitor = $.trim($('#tvMonitor').val());
            if(!tvMonitor){
                tvMonitor = 0;
            }
            var extraDay = $.trim($('#extraDay').val());
            if(!extraDay){
                extraDay = 0;
            }
            

            if(wastTypr!=0){
               	total_main= wastTypr;             
		}
	else {
		
		total_main=total_fdb;	
		}

 	$('#total').val(eval(total_main) +  eval(tyreRemoval) + eval(mattress) + eval(gasBottle) + eval(tvMonitor) + eval(extraDay));

            /* $('#total').val(eval(total_fdb) + eval(wastTypr) +  eval(tyreRemoval) + eval(mattress) + eval(gasBottle) + eval(tvMonitor) + eval(extraDay)); */
            
        }
       //=======change a second select list based on the first select list option========== 
         $(".d1").change(function() {
            if($(this).data('options') == undefined){
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                    $(this).data('options',$('.d2 option').clone());
                }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-zone=' + id + ']');
            $('.d2').html(options);
            $('.d2').prop('disabled', false);
             calcPrice(); 
        });
        
//       ======================================== 
        $('#wasteType').on('change', function() {
            calcPrice();
            
            var waste_type_id= $("#wasteType option:selected").attr('data-id');
            
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('product/waste_type_details'); ?>',
                // context: $(this).parents('form'),
                data: {id: waste_type_id},
                success: function(response) {
                    console.log(response);
                    $("#ajax_comments").html(response);
                    //$('#com_description').val('');
                },
                error: function() {
                    //  alert("Something went wrong");
                }
            });

        });

        $('#tyreRemoval').on('change', function() {          
            calcPrice();       
        });
        $('#mattress').on('change', function() {          
            calcPrice();       
        });
        $('#gasBottle').on('change', function() {          
            calcPrice();       
        });
        $('#tvMonitor').on('change', function() {          
            calcPrice(); 
        });
        
        $('#extraDay').on('change', function() {          
            calcPrice();       
        });
        
        $('#bin_placement').on('change', function() {          
            calcPrice(); 
           var place_value=  $(this).val();
           if(place_value=='other'){
               $('.placement_level').toggle();
               $('.placement_text').toggle();
               
               //alert('sdfsdf'); 
           }
           else{
        $('.placement_level').hide();
        $('.placement_text').hide();
           }
           
        });
        
//------------------   datepicker ------------------
        $(function() {
		$( "#date" ).datepicker({
//			dateFormat: 'yy-mm-dd',
			dateFormat: 'dd-mm-yy',
			minDate: 0
		});
		
		$('#ui-datepicker-div').addClass('datezindex');
	});
        
        
//------------Calculate collection date ---------

        function getCollectionDate() {
            var get_date = $('#date').val();
            var splt = get_date.split('-');
            //dd-mm-yy => yy-mm-dd
            get_date = splt[2] + '-' + splt[1] + '-' + splt[0];
            
            var get_c_date = parseInt($("#extraDay option:selected").attr('data-date'));
            var extra_day_h = 0; //value in milisecond
                  
            console.log(get_c_date);
                  
            if(get_c_date){
                extra_day_h = get_c_date * 86400000;
            }
                                   
            console.log(get_date);
            var delivery_dtos = new Date(get_date).getTime();
            //86400*1000 = 86400000; //1 day 
                                  
            //delivery_date + 4 days + [,extra date]
            collection_date_ms = delivery_dtos + (86400000 * 7) + extra_day_h;  
            //                  
            var coll_date_obj  = new Date(collection_date_ms);            
            
//            var collection_date = coll_date_obj.getFullYear()+'-'+ (coll_date_obj.getMonth() + 1)+'-'+  coll_date_obj.getDate();
            var collection_date = coll_date_obj.getDate() +'-'+ (coll_date_obj.getMonth() + 1) +'-'+ coll_date_obj.getFullYear();
            collect_date = collection_date.replace(/\b(\d{1})\b/g, '0$1');
            //                  
            $("#c_date").html(collect_date);
        }
        
        $('#date').on('change', function() {          
            getCollectionDate();
        });
        $('#extraDay').on('change', function() {         
                           
            getCollectionDate();
        });
        
        $('#myform').validate({
            rules:{
                waste: {required: true},
                postcode: {required: true},
                delivery_date: {required: true},
                bin_placement: {required: true}
            }
        
        });
           
//        --------------add to cart------------------------
        $('#addCart').on('click', function(e) {
            e.preventDefault();
            if($('#myform').valid()){
            var product_id= $("#p_id").val();
	    var postcode = $("#postcode option:selected").text();
	    var waste_type = $("#wasteType option:selected").text();
	    var tyre_removal = $("#tyreRemoval option:selected").text();
	    var mattress_removal = $("#mattress option:selected").text();
	    var gas_bottle= $("#gasBottle option:selected").text();
	    var tv_monitor = $("#tvMonitor option:selected").text();
            var delivery_date = $("#date").val();
	    var extra_day = $("#extraDay option:selected").text();
	    var collection_date = $("#c_date").text();
	    var bin_placement = $("#bin_placement").val();
            
             if(bin_placement=='other'){
               bin_placement=$(".placement_text").val();
               if(bin_placement == ""){
                   $(".bin-error").show();
                   return false;
               }
           }
           
	    var total = $("#total").val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo site_url('product/add_to_cart'); ?>',
                // context: $(this).parents('form'),
                data: {p_id: product_id,
                       postcode: postcode,
                       waste_type: waste_type,
                       t_removal: tyre_removal,
                       m_removal: mattress_removal,
                       g_bottle: gas_bottle,
                       t_monitor: tv_monitor,
                       d_date: delivery_date,
                       xtra_day: extra_day,
                       c_date: collection_date,
                       b_placement: bin_placement,
                       total: total },
                success: function(response) {
                    console.log(response.status);
                    if(response.status == true){
                        var cartId = response.cart_id;
                        var cartCookie = response.cart_cookie;
                        $.cookie("cart_cookie", cartCookie, {path: '/'}, { expires : 1 });

                        console.debug($.cookie("cart_cookie"));
                        setTimeout(function(){ window.location= '<?php echo site_url('cart'); ?>'; }, 1000);
                    }
                    else{
                        $(".booked").show();
                    }
                                                        
                },
                error: function() {
                    //  alert("Something went wrong");
                }
            });
            }
            
    });
    
    });
    

</script>


<style>
        .datezindex
        {
          z-index:9999 !important;
        }
    #myform .error {
        color: red;
    }

</style>

