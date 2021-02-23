<!doctype html>
<html lang="en-gb" class="no-js">
    <head>
        <?php $this->load->view($this->theme->path('_head')); ?>

    </head>

<body id="home">
<!-- header -->
<?php $this->load->view($this->theme->path('includes/header')); ?>
<!-- end header -->
<!-- hero area (the grey one with a slider) -->
<?php echo @$ci_content; ?>


<?php $this->load->view($this->theme->path('_footer')); ?>
</body>

</html>

