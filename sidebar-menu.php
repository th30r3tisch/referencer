<div id="menu" class="collapse">
	<div id="navbar" class="navbar-collapse" >
				<?php
				$args = array(
					'theme_location' => 'primary',
					'container' => 'false',
					'menu_class' => 'nav navbar-nav',
					'depth' => 2,
					'walker' => new bs4Navwalker()
				)
				?>
				<?php wp_nav_menu( $args ); ?>
	</div>
</div>