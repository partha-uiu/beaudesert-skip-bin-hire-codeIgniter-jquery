<div class="content campaign-page-bg-banner-section">
                <div class="col-sm-10 campaign-page-banner-section">
                    <p class="campaign-page-banner-section-line-1">Sign in</p>
                    <p class="campaign-page-banner-section-line-2">  
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis blandit ipsum.</span>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
<div class="campaign-page-banner-bottom-section text-center"><img src="<?php echo $this->theme->url('assets/img/campaign-page-icon.png')?>" alt=""></div>    
<div class="home-bg-banner-bottom-section-line"></div>

<div class="content-campaign-section">
    <div class="col-sm-5 col-centered text-center custom-border content-signin-section-main-area">                   
        <div class="content-signin-section-inner">
                <div class="content-signin-section-row-1">
                    <!--<img src="<?php echo $this->theme->url('assets/img/.png')?>" alt="">-->
                </div>
                <!--<div class="signin-page-line-shadow"></div>-->
                <div class="content-signin-section-row-2">
                    <div class="content-signin-section-row-2-col-1 fb_login_div">
                        <!--<input type="button" onclick="Login();" class="fb_login" value=""/>-->
                        <button type="button" onclick="Login();" class="fb_login"><img src="<?php echo $this->theme->url('assets/img/fb_4.png')?>" alt=""></button>
                    </div>                   
                    <div class="content-signin-section-row-2-col-2">
                        <p class="content-signin-section-row-2-col-2-p-1"><span>Or, use your email</span></p>
                        <p class="content-signin-section-row-2-col-2-p-2"></p>
                        <div>
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            } elseif (isset($_SESSION['error'])) {
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            ?>
                        </div>
                        <form name="" id="email_signin" action="<?php echo site_url('login/login_email');?>">
                            <div class="input-field-1">
                                <input type="email" name="email" value="" required="" placeholder="Your Email Address"/>
                            </div>
                            <div class="input-field-2">
                                <input type="password" name="password" value="" required="" placeholder="Your Password"/>
                            </div>
                            <div class="content-signin-section-row-2-col-3">
                                <button type="submit" class="signin_email_button"><img src="<?php echo $this->theme->url('assets/img/signup_email.png') ?>" alt=""></button>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="signin-page-footer-bg">
                    <img src="<?php echo $this->theme->url('assets/img/signin-forgot-logo.png')?>" alt="">
                    <p><a href="<?php echo site_url('login/forgot_password'); ?>">Forgot your password?</a></p>
                </div>           
        </div>    
    </div>
</div>

<script>
        /* <![CDATA[ */
        (function($) {
            $(function() {
                $('.process').addClass('hidden');
                jQuery.extend(jQuery.validator.messages, {
                     remote: jQuery.format("{0} Not Found. Please check your Email Address.")
                    });
                var email_signin = $('#email_signin');

                email_signin.validate({
                    ignore:[],
                    rules:{
                        email:{
                            required:true,
                            email: true,
                            remote: {
                                url: "<?php echo site_url('login/check_email') ?>",
                                type: "post",
                                data: {
                                    requestby: 'jquery_validator',
                                    email: function() {
                                        return email_signin.find('[name="email"]').val();
                                    }
                                }
                            }
                        },
                        password:{
                            required : true
                        }
                    },
                    message: {
                        email: {
                                remote: jQuery.format("{0} not found..!!!")
                            } 
                    },
                    errorElement: 'p',
                    errorPlacement: function(error, element) {
                        $(element).tooltip('destroy').tooltip({
                            html: true,
                            trigger: 'manual',
                            //                    container: 'body',
                            title: error,
                            //template: '<div class="tooltip for-error"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                            template: '<div class="tooltip top for-error"><div class="tooltip-inner"></div><div class="tooltip-arrow"></div></div>'
                        }).tooltip('show');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).tooltip('destroy');
                    }
                });

                var email_signin_ajaxform_options = {
                    dataType: "json",
                    url: $(this).attr('url'),
                    beforeSubmit: function showRequest(formData, jqForm, options) {
                        var valid = $(jqForm).valid();
                        if (valid) {
                            
                        }
                        return $(jqForm).valid();
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                    },
                    success: function showResponse(statusText, responseText, xhr, jqForm) {
                        if (statusText.status) {
                            $('.fb_login_div').before('<div class="alert alert-success alert-dismissible fade in signin_error" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><strong>'+statusText.msg+'</strong></div>');
                            //$('.custom_error').append('<div class="alert alert-success">' + statusText.msg + '</div>');
                            window.location = statusText.redirect_to;
                        } else {
                            $('.fb_login_div').before('<div class="alert alert-danger alert-dismissible fade in signin_error" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><strong>'+statusText.msg+'</strong></div>');
                            //$('.custom_error').append('<div class="alert alert-error">' + statusText.msg + responseText + '</div>');
                        }
                    }
                };

                email_signin.ajaxForm(email_signin_ajaxform_options);
            })
        })(jQuery)
        /* ]]> */

    </script>