<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $title_for_layout; ?> | Beaudesert Area Skip Bin Hire </title>
        <script type="text/javascript">
            window.location.base_url = '<?php echo site_url() ?>';
            window.location.header_nav = {
                active: '<?php echo @$active_header_nav ?>'
            }
        </script><script type="text/javascript" src="<?php echo site_url() . "assets/tinymce/tinymce.min.js"; ?>"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea"
            });
        </script>
        <?php
        echo $this->theme->css('assets/bootstrap/css/bootstrap.css');
        echo $this->theme->css('assets/bootstrap/css/bootstrap-responsive.css');
        echo $this->theme->css('assets/font-awesome/css/font-awesome.min.css');
        echo $this->theme->js('assets/js/common/jquery-1.9.1.min.js');
        echo $this->theme->js('assets/js/common/jquery.validate.js');

        echo $this->theme->css('assets/jquery-ui/css/smoothness/jquery-ui-1.10.1.custom.min.css');
        echo $this->theme->js('assets/jquery-ui/js/jquery-ui-1.10.1.custom.min.js');

        echo $this->theme->js('assets/bootstrap/js/bootstrap.min.js');
        ?>
        <?php
        echo $this->theme->js('assets/pnotify/jquery.pnotify.min.js');
        echo $this->theme->css('assets/pnotify/jquery.pnotify.default.css');
        echo $this->theme->css('assets/pnotify/jquery.pnotify.default.icons.css');
        ?>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]-->
        <?php echo $this->theme->js('assets/js/general.js'); ?>
        <?php echo $this->theme->js('assets/js/common/jquery.sd.common.js'); ?>
        <!--datatable initializing-->
        <?php echo $this->theme->css('assets/datatable/DT_bootstrap.css'); ?>
        <?php echo $this->theme->js('assets/datatable/jquery.dataTables.min.js'); ?>
        <?php echo $this->theme->js('assets/datatable/jquery.dataTables.Bootstrap.Pagination.js'); ?>
        <?php
//        echo $this->theme->js('assets/colorpicker/bootstrap-colorpicker.js');
//        echo $this->theme->css('assets/colorpicker/colorpicker.css');
//        echo $this->theme->js('assets/datepicker/bootstrap-datepicker.js');
//        echo $this->theme->css('assets/datepicker/datepicker.css');
        ?>
        <?php echo $this->theme->css('assets/css/styles.css'); ?>
    </head>

    <body>
        <div class="container-fluid nopadding">
            <div class="row-fluid">
                <div class="span12">
                    <div id="header">
                        <div class="hleft">
                            <div class="column">
                                <a href="<?php echo site_url('/') ?>">
                                    <h1>Beaudesert Area Skip Bin Hire <h3>Admin Panel</h3></h1>
                                </a>
                              </div>
                            </div>
                           <div class="hright">
                            <a class="header-logout" style="color: #FFF; float: right;" href="<?php echo site_url(CPREFIX . "/logout"); ?>"><span class="ico"><i class="icon-off icon-white"></i></span> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="container">
            <div class="row-fluid">
                <div class="span3 leftmenu" >
                    <ul class="nav">                        
                        <li class="active"><a href="<?php echo site_url(CPREFIX . '/dashboard'); ?>"><span class="ico"><i class="icon-home"></i></span><span class="text">Dashboard</span></a></li>                        
<!--                        <li> <a href="#"  data-ref-child="<?php // echo site_url(CPREFIX . '/users');  ?>" ><span class="ico"><i class="icon-user"></i></span><span class="text">Users</span><span class="indicator"></span></a>                            
                            <ul>                                
                                <li><a href="<?php // echo site_url(CPREFIX . '/users/administrators');  ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Administrators </span></a></li>                                
                                <li><a href="<?php // echo site_url(CPREFIX . '/users/user_list');  ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Users List</span></a></li>                            
                            </ul>                        
                        </li>                        -->
                        <!--<li> <a href="#"  data-ref-child="<?php echo site_url(CPREFIX . '/products'); ?>" ><span class="ico"><i class="icon-th-large"></i></span><span class="text">Products</span><span class="indicator"></span></a>-->                            

                        <li><a href="<?php echo site_url(CPREFIX . '/users/user_list_all'); ?>"><span class="ico"><i class="icon-user"></i></span><span class="text">Customers</span></a></li>
                        
                        <li><a href="#"><span class="ico"><i class="fa fa-cube"></i></span><span class="text">Bins</span></a>                                                             
                            <ul>                                
                        <li><a href="<?php echo site_url(CPREFIX . '/products/products_add'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Add Bin</span></a></li>
                                    
                        <li><a href="<?php echo site_url(CPREFIX . '/products/product_list'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text"> List of Bins</span></a></li>
                        <li><a href="<?php echo site_url(CPREFIX . '/products/available_bins'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text"> Bins Available</span></a></li>
 
                            
                            
                            
                            </ul>   </li>  
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <li><a href="#"><span class="ico"><i class="fa fa-recycle"></i></span><span class="text"> Waste</span></a>                                                             
                            <ul>                                
                        <li><a href="<?php echo site_url(CPREFIX . '/products/product_type'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Add  Waste Type</span></a></li>                                
                                    
                        <li><a href="<?php echo site_url(CPREFIX . '/products/product_type_list'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text"> Waste Type List</span></a></li>
                            </ul>   </li>  
                        
                         <li><a href="#"><span class="ico"><i class="fa fa-wrench"></i></span><span class="text">Extra Product Settings </span></a>                                                             
                            <ul>                                
                        <li><a href="<?php echo site_url(CPREFIX . '/products/product_settings'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Add Extra Product Settings</span></a></li>                                
                        <li><a href="<?php echo site_url(CPREFIX . '/products/product_settings_list'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Extra Product Settings List</span></a></li>                                
                          <li><a href="<?php echo site_url(CPREFIX . '/products/bin_price'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Zone/Price </span></a></li>                                
                                    
                        <li><a href="<?php echo site_url(CPREFIX . '/products/bin_price_list'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text"> Zone List</span></a></li>    
                            
                            
                            
                            </ul>   </li> 
                        
              <li><a href="#"><span class="ico"><i class="icon-cog"></i></span><span class="text">Zone/Postcode Settings</span></a>                                                             
          
                      <ul>                                
                         <li><a href="<?php echo site_url(CPREFIX . '/products/zone_postcode'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Add Zone/Postcode</span></a></li>                                
                         <li><a href="<?php echo site_url(CPREFIX . '/products/zone_postcode_list'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text"> Zone/Postcode List</span></a></li>                                

                                 <!--<li><a href="<?php // echo site_url(CPREFIX . '/products/bin_price'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Add Bin Price</span></a></li>-->                                
                            </ul>      
                         
                         </li> 
                         


<!--                        <li><a href="<?php // echo site_url(CPREFIX . '/products/products_add'); ?>"><span class="ico"><i class="icon-plus-sign"></i></span><span class="text">Add Products</span></a></li>-->
<!--                        <li><a href="<?php //  echo site_url(CPREFIX . '/products/product_list'); ?>"><span class="ico"><i class="icon-list"></i></span><span class="text">Products List</span></a></li>-->
                        <!--<li><a href="<?php // echo site_url(CPREFIX . '/products/product_type'); ?>"><span class="ico"><i class="fa fa-archive"></i></span><span class="text">Add Product Waste Type</span></a></li>-->                                
                        <!--<li><a href="<?php //  echo site_url(CPREFIX . '/products/product_type_list'); ?>"><span class="ico"><i class="icon-list"></i></span><span class="text">Product Waste Type List</span></a></li>-->

                        <!--<li><a href="<?php // echo site_url(CPREFIX . '/products/product_settings'); ?>"><span class="ico"><i class="icon-wrench"></i></span><span class="text">Add Product Settings</span></a></li>-->                                
<!--                        <li><a href="<?php // echo site_url(CPREFIX . '/products/product_settings_list'); ?>"><span class="ico"><i class="icon-list"></i></span><span class="text">Product Settings List</span></a></li>                                -->


                        <!--<li><a href="<?php // echo site_url(CPREFIX . '/products/order'); ?>"><span class="ico"><i class="fa fa-shopping-cart"></i></span><span class="text">Order</span></a></li>-->                                
                                                     <li><a href="<?php echo site_url(CPREFIX . '/products/order'); ?>"><span class="ico"><i class="fa fa-shopping-cart"></i></span><span class="text">Order</span></a>                            
   <ul>                                
                                <li><a href="<?php echo site_url(CPREFIX . '/products/order_cash'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Cash</span></a></li>                            

                                <li><a href="<?php echo site_url(CPREFIX . '/products/order_paypal'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">PayPal</span></a></li>                            
                            </ul> </li>
                        
<!--              <li><a href="#"><span class="ico"><i class="fa fa-shopping-cart"></i></span><span class="text">Order</span></a>                                                             
                            <ul>                                
                                <li><a href="<?php // echo site_url(CPREFIX . '/products/paypal_order'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">PayPal</span></a></li>                            

                                <li><a href="<?php // echo site_url(CPREFIX . '/products/manual_order'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Manual</span></a></li>                            
                            </ul>   
              </li>             -->
                        
                        
                        
                        
                        
                        
                        
<!--                        <li><a href="#"><span class="ico"><i class="fa fa-usd"></i></span><span class="text">Transactions</span></a>                                                             
                            <ul>                                
                                <li><a href="<?php // echo site_url(CPREFIX . '/products/cash'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Cash</span></a></li>                            

                                <li><a href="<?php // echo site_url(CPREFIX . '/products/paypal'); ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">PayPal</span></a></li>                            
                            </ul>   </li>                        
                        <li><a href="<?php // echo site_url(CPREFIX . '/products/paypal_list'); ?>"><span class="ico"><i class="fa fa-paypal"></i></span><span class="text">PayPal</span></a></li>                                                              -->





                        <!--                          
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        li><a href="<?php // echo site_url(CPREFIX . '/campaign/campaign_updates');  ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Campaign Updates</span></a></li>                                -->
                        <!--                                <li><a href="<?php // echo site_url(CPREFIX . '/campaign/campaign_comments');  ?>"><span class="ico"><i class="icon-chevron-right"></i></span><span class="text">Campaign Comments</span></a></li>                            -->

                        </li>                        






                        <li><a href="<?php echo site_url(CPREFIX . "/logout"); ?>"><span class="ico"><i class="icon-off"></i></span>Logout</a></li>                    
                    </ul>
                </div>

                <script type="text/javascript">
                    //auto active left menu
                    jQuery(document).ready(function($) {
                        //active last menu
                        var lf_nav = $(".leftmenu ul");
                        var actURL = (window.location.header_nav.active ? window.location.header_nav.active : window.location.href);
                        if (0 == lf_nav.find('[href="' + actURL + '"]').length) {
                            var tact = actURL.split('/');
                            tact.pop();
                            actURL = tact.join('/');
                        }
                        lf_nav.find('.active').removeClass('active').end();
                        lf_nav.find('[href="' + actURL + '"]')
                        .parents('li:first').addClass('active')
                        .parents('li').find('a:first').trigger('click')
                        ;
                    });
                </script>
                <script type="text/javascript">
                    /*/auto active left menu
                        jQuery(document).ready(function($) {
                        //active last menu
                        var lf_nav = $(".leftmenu ul");
                        //link to reference menu
                        lf_nav.find('[data-ref-child]').on('click',function() {
                        redirectto = $(this).attr('data-ref-child');
                        if (redirectto)
                        window.location = redirectto;
                        });
                        });*/
                </script>
                <div class="span9" id="content">
                    <?php
                    if (!function_exists('getFlushMsg')) {

                        function getFlushMsg($Session) {
                            global $lastFlushMessage;
                            $class = '';

                            $flash = $Session->flash('flash', array('element' => false));
                            if ($flash) {
                                $class = 'alert alert-info';
                                return $lastFlushMessage = $flash = '<div class="span alert ' . $class . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $flash . '</div>';
                            }

                            $flash = $Session->flash('success', array('element' => false));
                            if ($flash) {
                                $class = 'alert alert-success';
                                return $lastFlushMessage = $flash = '<div class="span alert ' . $class . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $flash . '</div>';
                            }

                            $flash = $Session->flash('error', array('element' => false));
                            if ($flash) {
                                $class = 'alert alert-error';
                                return $lastFlushMessage = $flash = '<div class=" span alert ' . $class . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $flash . '</div>';
                            }

                            $flash = $Session->flash('warning', array('element' => false));
                            if ($flash) {
                                $class = 'alert alert-warning';
                                return $lastFlushMessage = $flash = '<div class="span alert ' . $class . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $flash . '</div>';
                            }

                            $flash = $Session->flash('info', array('element' => false));
                            if ($flash) {
                                $class = 'alert alert-info';
                                return $lastFlushMessage = $flash = '<div class="span  alert ' . $class . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $flash . '</div>';
                            }
                        }

                    }
                    $msg = getFlushMsg($this->ahrsession);
//                    echo!empty($msg) ? '<div class="row-fluid" style="display: inline-table;">' . $msg . '</div>' : '';
                    echo @$msg;
                    ?>

                    <!--start body content-->
                    <?php echo $this->fn->warningMessage(); ?>
<?php echo @$ci_content; ?>
                    <!--end body content-->

                </div>
            </div>
        </div>
    </body>
</html>
