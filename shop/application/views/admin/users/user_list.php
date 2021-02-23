


<div class="row-fluid <?php if (!empty($users) && empty($index)) {
    echo 'hidden';
} ?>">
    <div class="span12">
        <div class="box for-form-horizontal">
            <header>
                <div class="icons"><i class="icon-plus-sign" style="font-size: 20px; color: #0066cc;"></i></div>
                <h5 style="font-size: 18px; font-weight: bold;">Edit Customer</h5>
                <div class="toolbar">
                    <ul class="nav">
                        <li>
                            <div class="btn-group">
                                <a class="accordion-toggle btn btn-mini minimize-box" data-toggle="collapse"
                                   href="#collapse3">
                                    <i class="icon-chevron-up"></i>
                                </a>
                                <!--<button class="btn btn-mini btn-danger close-box"><i class="icon-remove"></i></button>-->
                            </div>
                        </li>
                    </ul>
                </div>
            </header>           
            <div id="collapse3" class="accordion-body collapse in body">
                <div><?php echo (isset($error)) ? $error : ""; ?></div>
                <div><?php echo (isset($success)) ? $success : ""; ?></div>               
                <?php
                $template = '<div class="control-group">
                        {label}
                        <div class="controls">{input}</div>
                        {error}
                        </div>';
                echo $this->ahrform->set_template($template);
                echo $this->ahrform->set_input_default(array('label' => array('class' => 'control-label'), 'input' => array('class' => 'input-xlarge')));
                ?>
                <form action="" method="post" class="form-horizontal" id="inline-validate">
                    <?php echo $this->ahrform->input(array('name' => 'id', 'type' => 'hidden', 'label' => false, 'template' => false)); ?>

<?php echo $this->ahrform->input(array('name' => 'username', 'type' => 'text', 'label' => 'Username')); ?>
 <?php echo $this->ahrform->input(array('name' => 'email', 'type' => 'text', 'label' => 'Email')); ?>
      <?php echo $this->ahrform->input(array('name' => 'fname', 'type' => 'text', 'label' => 'First Name')); ?>

 <?php echo $this->ahrform->input(array('name' => 'lname', 'type' => 'text', 'label' => 'Last Name')); ?>
                    <?php echo $this->ahrform->input(array('name' => 'company_name', 'type' => 'text', 'label' => 'Company Name')); ?>
                    <?php echo $this->ahrform->input(array('name' => 'address', 'type' => 'text', 'label' => 'Address')); ?>
                    <?php echo $this->ahrform->input(array('name' => 'suburb', 'type' => 'text', 'label' => 'Suburb')); ?>
                    <?php // echo $this->ahrform->input(array('name' => 'state', 'type' => 'text', 'label' => 'State')); ?>
                    <?php //echo $this->ahrform->input(array('name' => 'username', 'type' => 'text', 'label' => 'Username')); ?>
                    <?php echo $this->ahrform->input(array('name' => 'postcode', 'type' => 'text', 'label' => 'Postcode')); ?>
                    <?php echo $this->ahrform->input(array('name' => 'phone', 'type' => 'text', 'label' => 'Phone')); ?>

                        
                        <?php
                    if (!$this->ahrform->get('id')) {
                        echo $this->ahrform->input(array('name' => 'password', 'type' => 'password', 'label' => 'Password'));
                    }
                    ?>
                    

                  

                        <?php if ($id = $this->ahrform->get('id')) { ?>
                        <div class="control-group">
    <?php echo $this->ahrform->label('Change Password'); ?>
                            <div class="controls">
                                <a href="<?php echo site_url(CPREFIX . "/users/change_password/$id") ?>"><i class="icon-lock"></i> Change Password</a>
                            </div>
                        </div>
<?php } ?>
                    <div class="form-actions">
                        <button value="" class="btn btn-primary" name="data[form_acion]" type="submit" id="btn"><i class="icon-save"></i> Save</button>
                        or <a href="<?php echo site_url('/' . CPREFIX . '/users/user_list_all'); ?>"><i class="icon-backward"></i> Back to list</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        /*----------- BEGIN validate CODE -------------------------*/
        var sdform = $('#inline-validate');
        sdform.validate({
            ignore: [], //hiden field validate
            rules: {
                username: {
                    required: true,
<?php if ($id != $this->ahrform->get('id')) { ?>
                                            remote: {
                                                url: '<?php echo site_url(CPREFIX . "/user/check_username") ?>',
                                                type: "post",
                                                data: {
                                                    requestby: 'jquery_validator',
                                                    id: function() {
                                                        return sdform.find('[name="id"]').val();
                                                    },
                                                    username: function() {
                                                        return sdform.find('[name="username"]').val();
                                                    }
                                                }
                                            }
<?php } ?>
                                    },
                                    email: {
                                        required: true,
                                        email: true	
                                    },
                                    password: {
                                        required: true, 
                                        minlength: 6
                                    }	
                                },
                                messages: {
                                    username: {
                                        remote: 'Username address already exist.'
                                    }
                                },
                                errorClass: 'help-inline',
                                errorElement: 'span',
                                highlight: function(element, errorClass, validClass) {
                                    $(element).parents('.control-group').removeClass('success').addClass('error');
                                },
                                unhighlight: function(element, errorClass, validClass) {
                                    $(element).parents('.control-group').removeClass('error').addClass('success');
                                }
                            });
                        });
</script>



