<!-- Content
======================================= -->  
<div id="product-show-area">
    <div class="container">

        <!-- content area -->
        <div class="res-view">
            <h2>Rubbish Removal Bin Hire</h2>

            
      <p style="margin-bottom: 30px;">Beaudesert Area Skip Bin Hire have added 
        booking on line to simplify the booking process for our customers. To 
        book your bin you will need to think about where you would like our truck 
        to place your bin and also consider if a big truck is going to have reasonable 
        access to your prefered bin location site.</p>
      <p style="margin-bottom: 30px;">To give you an idea of the bin size you 
        may need. A 6x4 Box Trailer holds approximately 1 Cubic Meter.</p>
		<ul>
		<li>3.0 Cubic Meter Bin = 3 6x4 Trailers</li>
		<li>4.0 Cubic Meter Bin = 4 6x4 Trailers</li>
		<li>4.5 Cubic Meter Bin = 4.5 6x4 Trailers</li>
		<li>6.0 Cubic Meter Bin = 6 6x4 Trailers</li>
		<li>8.5 Cubic Meter Bin = 8.5 6x4 Trailers</li>
		<li>11.0 Cubic Meter Bin = 11 6x4 Trailers</li>
		<li>20.0 Cubic Meter Bin = 20 6x4 Trailers</li>
		</ul>
            
            
            <div class="row">
                <?php foreach ($products as $p): ?>
                <form action="<?php echo site_url('product/product_details/'.$p->id); ?>" method="post">
                <input type="hidden" name="p_id" value="<?php echo $p->id ?>">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="product-show">
                        <a href="<?php echo site_url('product/product_details/' . $p->id); ?>"><img src="<?php echo $p->p_image_url; ?>" alt="Beaudeser" />
                        <h4 style="margin-top: 10px;color: green !important;margin-left: 25px;"><?php echo $p->p_title; ?></h4></a>
                        <button type="submit" class="bin-select">Select Options</button>
                    </div>
                </div>
                </form>
                <?php endforeach; ?>
            </div>
            

        </div><!-- end content area -->

        <?php //$this->load->view($this->theme->path('includes/right_sidebar')); ?>

        <!-- end sidebars navigation -->

    </div>
</div>
