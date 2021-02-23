<script>
        $(document).ready(function(){
             $('input[type="radio"]').click(function(){
                var test = $(this).val();
               $("div.desc").hide("slow");
               $("#payment" + test).show("slow");
            });

        });
</script>
<style>
    .cart-error {
        background: red; 
    }
    .error-msg{
        color: red; 
        border: red;
        font-size: 18px;
        padding: 9px;
        margin-left: 58px;
        display: none;
    }
</style>
<!--===========================-->
     <p class="error-msg">**The highlighted item is not available.Please Cancel highlighted order then proceed.</p>
    <div id="product-show-area">
        <h3 class="ur-order">Your Order</h3>
    <div class="container cart-area">
        <!-- content area -->
        <div class="table-container cart-st cart-parent">
            <div class="table-heading">
                <div class="table-head-col" style="width: 15%;"></div>
                <div class="table-head-col" style="width: 38%;">Product</div>
                <div class="table-head-col" style="width: 22%;">Price </div>
                <div class="table-head-col" style="width: 22%;">Total</div>
            </div>
            
            <?php foreach ($all_cart as $cart): ?>
            <div data-cart-id="<?php echo $cart->cart_id;; ?>" class="table-row">
                <div class="table-col">
                    <i class="fa fa-times-circle rmv remove_cart"></i>
                    <input type="hidden" class="cancel_cart" value="<?php echo $cart->cart_id; ?>">
                </div>
                <div class="table-col">
                    <ul class="cart-details">
<!--                        <li>
                            <span><?php //echo $cart->p_title; ?></span>
                        </li>-->
                        <li>
                            <b>Invoice No:</b>
                            <span><?php echo $session_invoice; ?></span>
                        </li>
                        <li>
                            <b>Customer Name:</b>
                            <span><?php echo $session_name; ?></span>
                        </li>
                        <li>
                            <b>Postcode:</b>
                            <span><?php echo $cart->postcode; ?></span>
                        </li>
                        <li>
                            <b>Waste Type:</b>
                            <span><?php echo $cart->p_type; ?></span>
                        </li>
                        <li>
                            <b>Customer Email:</b>
                            <span><?php echo $session_mail; ?></span>
                        </li>
                        <li>
                            <b>Waste Bin Size:</b>
                            <span><?php echo $cart->p_title; ?></span>
                        </li>
                        <li>
                            <b>Delivery Date:</b>
                            <span><?php echo $cart->delivery_date; ?></span>
                        </li>
                        <li>
                            <b>Bin Placement:</b>
                            <span><?php echo $cart->bin_placement; ?></span>
                        </li>
                        <li>
                            <b>Collection Date:</b>
                            <span><?php echo $cart->collection_date; ?></span>
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
            
            <div class="table-row">
                <div class="table-col"></div>
                <div class="table-col"><b style="font-size: 25px;color: gray">Order Total</b></div>
                <div class="table-col"></div>
                <div class="table-col"><b style="font-size: 25px;color: gray"><?php echo '$'.$amount;?></b></div>
            </div>
        </div><!-- end content area -->

    </div>
    
    
</div>
    <!------------------------------->
    <div id="payment">
        <label><input type="radio" name="payment" value="Paypal"> PayPal</label>
        <!--<img style="margin-left: 4px;" src="paypal.gif">-->
        <!--<a style="font-weight: bold;"href="https://www.paypal.com/au/webapps/mpp/paypal-popup">What is PayPal?</a><br/>-->
        <a style="font-weight: bold;"href="JavaScript:newPopup('https://www.paypal.com/au/webapps/mpp/paypal-popup');">What is PayPal?</a><br/>
        <div class="desc" id="paymentPaypal"  style="display: none;">Pay via PayPal. You can pay with your credit card if you don't have a PayPal account</div>
        <label><input type="radio" name="payment" value="Cash" checked> Cash On Delivery</label>

        <div class="desc" id="paymentCash">Pay with cash upon delivery</div>
    </div>
    
    <div class="place-order">
        <input type="checkbox" id="check_terms" name="terms" value=""><a href="<?php echo site_url('condition'); ?>">Agree with Terms & Conditions</a>
            <i class="fa fa-location-arrow"></i>
            <button id="place_order" disabled>Place Order</button>            
   </div>
    <script>
      $('#check_terms').click(function() {
        if ($(this).is(':checked')) {
            $('#place_order').removeAttr('disabled');
            
        } else {
            $('#place_order').attr('disabled', 'true');
        }
    });

    </script>
 <!----------------------------------------------------------->   
    <?php
$data = array(
    'merchant_email' => 'dk@beaudesertareaskipbinhire.com',
    'product_name' => 'Product',
    'amount' =>  $amount,
    'custom' => '' ,
    'currency_code' => 'AUD',
    'thanks_page' => '',
    'notify_url' =>  site_url('checkout/ipn_response'),
    'cancel_url' => "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
    'paypal_mode' => false
);


function infotutsPaypal($data) {

    define('SSL_URL', 'https://www.paypal.com/cgi-bin/webscr');
    define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');

    $action = '';
    //Is this a test transaction? 
    $action = ($data['paypal_mode']) ? SSL_SAND_URL : SSL_URL;

    $form = '';

    $form .= '<form name="frm_payment_method" action="' . $action . '" method="post">';
    $form .= '<input type="hidden" name="business" value="' . $data['merchant_email'] . '" />';
    // Instant Payment Notification & Return Page Details /
    $form .= '<input type="hidden" name="notify_url" value="' . $data['notify_url'] . '" />';
    $form .= '<input type="hidden" name="cancel_return" value="' . $data['cancel_url'] . '" />';
    $form .= '<input type="hidden" name="return" value="' . $data['thanks_page'] . '" />';
    $form .= '<input type="hidden" name="rm" value="2" />';
    // Configures Basic Checkout Fields -->
    $form .= '<input type="hidden" name="lc" value="" />';
    $form .= '<input type="hidden" name="no_shipping" value="1" />';
    $form .= '<input type="hidden" name="no_note" value="1" />';
    // <input type="hidden" name="custom" value="localhost" />-->
    $form .= '<input type="hidden" name="custom" value="" />';
    $form .= '<input type="hidden" name="currency_code" value="' . $data['currency_code'] . '" />';
    $form .= '<input type="hidden" name="page_style" value="paypal" />';
    $form .= '<input type="hidden" name="charset" value="utf-8" />';
    $form .= '<input type="hidden" name="item_name" value="' . $data['product_name'] . '" />';
    $form .= '<input type="hidden" value="_xclick" name="cmd"/>';
    $form .= '<input type="hidden" name="amount" value="' . $data['amount'] . '" />';

    $form .= '</form>';
    $form .= '<script>';
    $form .= '//setTimeout("document.frm_payment_method.submit()", 0);';
    $form .= '</script>';
    return $form;
}

echo infotutsPaypal($data);
?> 
    
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>
    
    <script>
         jQuery(document).ready(function() { 
             
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
         
        $('#place_order').on('click', function(){
	    var transaction_type = $("input:radio[name=payment]:checked").val();

            $.ajax({
                type: "POST",
                dataType: 'json', 
                url: '<?php echo site_url('checkout/place_order'); ?>',
                // context: $(this).parents('form'),
                data: {transaction_type: transaction_type },
                success: function(response) {
                    console.log(response.status);
                    //check error
                    if(response.status == false){
                        if(response.cart_error ){
                            $('.error-msg').show();
                           console.log(response.cart_error);
                           $.each(response.cart_error, function( er_cart_id, value ) {                            
                                $('[data-cart-id="'+er_cart_id+'"]').addClass('cart-error');
                                console.log(er_cart_id);
                            return false;
                            });
                        }
                    }
                    
                 else{
                     $('.error-msg').hide();
                     
                    var cartCookie = response.cart_cookie;
                    var t_type = response.transaction_type;
                    console.log(cartCookie); 
                    
                    var t_id= response.transaction_id;
                    
                    
                    var invoice_id = response.invoice_id;
                    $('[name="custom"]').val(t_id);
                    
                    var redirect_link = '<?php echo site_url('checkout/print_order'); ?>/'+invoice_id;
                    $('[name="return"]').val(redirect_link);
                    
                    $.removeCookie("cart_cookie" , { path: '/' });
                    if (t_type == 'Paypal') {
                    setTimeout(function() {
//                        $('.pay').trigger('click');
                        $('[name="frm_payment_method"]').trigger('submit');
                    }, 000);
                }
                else {
                    window.location= '<?php echo site_url('checkout/print_order'); ?>/'+invoice_id;
                    //$.removeCookie("cart_cookie" , { path: '/' });  
                }
                }
                                                     
                },
                error: function() {
                    //  alert("Something went wrong");
                }
            });
        });
  });
    </script>