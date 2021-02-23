<!-- Content
======================================= -->  
<div id="product-show-area">
    <div class="container cart-area">
<!--        <div class="continue_shop">
            <i class="fa fa-share"></i>
            <a href="<?php //echo site_url('product');?>"><button>Continue Shopping</button></a>           
        </div>-->
        <!-- content area -->
        <div class="table-container cart-st cart-parent">
            <div class="table-heading">
                <div class="table-head-col" style="width: 15%;"></div>
                <div class="table-head-col" style="width: 38%;">Product</div>
                <div class="table-head-col" style="width: 22%;">Price </div>
                <div class="table-head-col" style="width: 22%;">Total</div>
            </div>
            
            <?php foreach ($all_cart as $cart): ?>
            <div class="table-row">
                <div class="table-col">
                    <i class="fa fa-times-circle rmv remove_cart"></i>
                    <input type="hidden" class="cancel_cart" value="<?php echo $cart->cart_id; ?>">
                </div>
                <div class="table-col">
                    <ul class="cart-details">
                        <li>
                            <a href="<?php echo site_url('product/product_details/'.$cart->p_id); ?>"><b><?php echo $cart->p_title; ?></b></a>
                        </li>
                        <li>
                            <b>Waste Type:</b>
                            <span><?php echo $cart->p_type; ?></span>
                        </li>
                        <li>
                            <b>Tyre Removal:</b>
                            <span><?php echo $cart->tyre_removal; ?></span>
                        </li>
                        <li>
                            <b>Mattress Removal:</b>
                            <span><?php echo $cart->mattress_removal; ?></span>
                        </li>
                        <li>
                            <b>LPG Gas Bottle:</b>
                            <span><?php echo $cart->gas_bottle; ?></span>
                        </li>
                        <li>
                            <b>Tv's & Monitors:</b>
                            <span><?php echo $cart->tv_monitor; ?></span>
                        </li>
                        <li>
                            <b>Delivery Date:</b>
                            <span><?php echo $cart->delivery_date; ?></span>
                        </li>
                        <li>
                            <b>Extra Day Hire:</b>
                            <span><?php echo $cart->extra_day; ?></span>
                        </li>
                        <li>
                            <b>Collection Date:</b>
                            <span><?php echo $cart->collection_date; ?></span>
                        </li>
                        <li>
                            <b>Bin Placement:</b>
                            <span><?php echo $cart->bin_placement; ?></span>
                        </li>
                    </ul>
                </div>
                <div class="table-col">
                    <p class="cart-align-price"><?php echo '$'.$cart->price; ?></p>
                </div>
                <div class="table-col">
                    <p class="cart-align-price"><?php echo '$'.$cart->price; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- end content area -->

    </div>
    <div class="form-group" style="margin-top: 20px;padding-bottom: 50px;">
            <label for="cart_total" class="col-sm-1 control-label">Cart Total</label>
            <div class="col-sm-3">
                <input style="font-size: 24px;color: green;" name="price" disabled type="text" class="form-control" id="cart_total" value="<?php echo '$'.$amount;?>">
            </div>
    </div>
    
    <div class="continue_shop">
            <i class="fa fa-sign-out"></i>
            <button class="p_checkout">Proceed CheckOut</button>
   </div>
    
</div>

<script>
    
        $('.cart-parent .remove_cart').on('click', function() {
             if(confirm("Are you sure to delete this item ?"))
         {
            
            var cart_id= $(this).parents('.table-row:first').find(".cancel_cart:first").val();
//            alert(cart_id);

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo site_url('cart/cancel_cart'); ?>',
                // context: $(this).parents('form'),
                data: {cart_id: cart_id },
                success: function(response) {
                    console.log(response.status);
//                    $("#ajax_comments").html(response);
                    //$('#com_description').val('');
                    location.reload();
                    
                },
                error: function() {
                    //  alert("Something went wrong");
                }
            });
          }
        });
        $('.p_checkout').on('click', function() {

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo site_url('cart/check_log_in'); ?>',
                // context: $(this).parents('form'),
                success: function(response) {
                    console.log(response.status);
                    if(response.status== true){
                        window.location= '<?php echo site_url('checkout'); ?>';
                    }
                    else{
                        window.location= '<?php echo site_url('billing_info'); ?>';
                    }
                    
                },
                error: function() {
                    //  alert("Something went wrong");
                }
            });

        });

</script>


