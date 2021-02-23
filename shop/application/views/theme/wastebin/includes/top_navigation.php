 <nav id="menu-wrap">    
	<ul id="menu">
               <li><a href="/">HOME</a></li>
               <li> <a href="/shop/product">BOOK A BIN</a> </li>
              <li> <a href="/faq.php">FAQ</a></li>
              <li><a href="/about.php">ABOUT</a></li>
		      <li><a href="/pick_up.php">PICK UP MY BIN</a></li>
		      <li><a href="/contact.php">CONTACT</a></li>
                <?php if( $this->session->userdata('user_id') && $this->session->userdata('group_id')==2): ?>
                    <li><a href="<?php echo site_url('login/logout'); ?>">Logout [<?php echo $this->session->userdata('user_name'); ?>]</a></li>
                <?php endif; ?>
	</ul>
</nav>