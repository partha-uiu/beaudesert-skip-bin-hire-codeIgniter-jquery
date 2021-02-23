<script>
        $(document).ready(function(){         
            $(".showlogin").click(function(e){
                e.preventDefault();
                $(".content2").slideToggle("slow");
            });
        });
</script>
<style>
    #myform .error {
        color: red;
    }
    #order_form .error {
        color: red;
    }
</style>
    <div class="returning">
        <span><b>Returning Customer?</b></span>
        <a href="#" class="showlogin"><span>Click Here to Login</span></a><br>
        <span><b>Don't have any account?</b></span>
        <a href="<?php echo site_url('signup'); ?>"><span>Click Here to Sign Up</span></a>
    </div>
    <div class="content2">
        <p><b>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</b></p>
        <form id="myform">
            <div style="width:48%; float: left;">
                <label for="">Email</label><span style="color: red"> *</span><br/>
                <input style="width: 100%;" type="email" id="l_mail" name="l_email">
            </div>

            <div style="width:48%; float: left; margin-left: 4%;">
                <label for="">Password</label><span style="color: red">*</span><br/>
                <input style="width: 100%;"type="password" id="pass_word" name="pass_word">
            </div>
            <div class="invalid-login" style="color: red;display: none;">
                <span>**Invalid Email and Password</span>
            </div>

            <input style="margin-top: 15px;" type="submit" class="button" id="login" name="login" value="Login">
        </form>
        
    </div>

    <div style=" margin:1% 10% 1% 10%;">
    <h3 >Billing Details</h3><br/>
    <label>Country</label><br />
   <label>Australia</label>
    </div>
    <div id="content1" class="content_area">
        <form id="order_form">
            <div>
                <div style="width:48%; float: left;">
                    <label for="">First Name</label><span style="color: red"> *</span><br/>
                    <input style="width: 100%;" type="text" name="fname" placeholder="First Name"  >
                </div>
                    
                <div style="width:48%; float: left; margin-left: 4%;">
                    <label for="">Last Name</label><span style="color: red">*</span><br/>
                    <input style="width: 100%;"type="text" class="lname" name="lname" placeholder="Last Name" >
                </div>
            </div>
            <div style="display:inline-block;  margin-top:2%;"> <label >Company Name</label><span style="color: red">*</span><br/>
                <input style="width:100%;" type="text"  name="company_name" placeholder="Company Name" size="170" >
            </div>
            <div style=" margin-top:2%;"> <label >Address</label><span style="color: red"> *</span><br/>
                <input style=" width: 100%;" type="text" name="address" placeholder="Street Address" >
                <!--<input style="margin-top:10px; width: 100%"type="email"   placeholder="Apartment,suit,unit etc.(optional)">-->
            </div>
            <div style=" margin-top:2%;"> <label >Suburb/Town</label><span style="color: red"> *</span><br/>
                <input style=" width: 100%;" type="text" name="suburb" placeholder="Suburb/Town" >
            </div>
            <div>                    
                <div style="float:left ; width:48%;  margin-top: 2%; margin-right:5%;">
                    <label for="">Post Code</label><span style="color: red"> *</span>
                    <input style="width: 100%;" type="text" name="postcode" value="<?php echo $postcode; ?>" >
                </div>
                <div style="float:left ;width:47%; margin-top: 2%; ">
                    <label for="">Email Address</label><span style="color: red"> *</span><br/>
                    <input style="width: 100%;" type="email" name="email" placeholder="Your E-mail"  >
                </div>
                    
                <div style="float:left; width:48%;; margin-top: 2%;">
                    <label for="">Phone</label><span style="color: red"> *</span><br/>
                    <input style="width: 100%;" type="tel" name="phone"  placeholder="Your Phone" >
                </div>
                    
            </div>
        </form>
            
    </div>
    <!------------------------------->
       
    <div class="place-order">
            <i class="fa fa-location-arrow"></i>
            <button id="billing_order">Submit</button>
            
   </div>
    
    <script>
         $('#order_form').validate({
            rules:{
                fname: {required: true},
                lname: {required: true},
                company_name: {required: true},
                address: {required: true},
                suburb: {required: true},
                postcode: {required: true},
                email: {required: true},
                phone: {required: true}
            }
        
        });
        $('#billing_order').on('click', function(e){
            e.preventDefault();
            if($('#order_form').valid()){
                var fname= $("[name=fname]").val();      
                var lname = $(".lname").val();
                var company_name = $("[name=company_name]").val();
                var address = $("[name=address]").val();
                var suburb = $("[name=suburb]").val();
                var postcode = $("[name=postcode]").val();
                var email = $("[name=email]").val();
                var phone = $("[name=phone]").val();

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?php echo site_url('billing_info/billing_order'); ?>',
                    // context: $(this).parents('form'),
                    data: {fname: fname,
                           lname: lname,
                           company_name: company_name,
                           address: address,
                           suburb: suburb,
                           postcode: postcode,
                           email: email,
                           phone: phone },
                    success: function(response) {
                        console.log(response.status);
                        window.location= '<?php echo site_url('checkout'); ?>';

                    },
                    error: function() {
                        //  alert("Something went wrong");
                    }
                });
            }
        });
        
        
        $('#myform').validate({
            rules:{
                l_email: {required: true},
                pass_word: {required: true}
            }
        
        });
        
        $('#login').on('click', function(e){
        e.preventDefault();
         
        if($('#myform').valid()){       
            var e_mail = $("[name=l_email]").val();
	    var pass_word  = $("[name=pass_word]").val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '<?php echo site_url('login/check_login'); ?>',
                // context: $(this).parents('form'),
                data: {e_mail: e_mail,
                       pass_word: pass_word},
                success: function(response) {
                    console.log(response.status);
                    if(response.status == true){
                       window.location= '<?php echo site_url('checkout'); ?>'; 
                    }
                    else{
                        $(".invalid-login").show();
                    }
                                                        
                },
                error: function() {
//                      alert("Something went wrong");
                }
            });
            }
           
        });

    </script>
