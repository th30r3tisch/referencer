<?php

require_once( __DIR__. '\options\styling.php');
require_once( __DIR__. '\options\help.php');
require_once( __DIR__. '\options\social.php');


class referencerOptions {
	
	function __construct() {
		$this->buildPage();
	}
	
		
	function buildPage() {
		
		//check if the user has the required capability
		if (!current_user_can('manage_options'))
		{
			wp_die( 'You do not have sufficient permissions to access this page.' );
		}	
		
		settings_errors(); ?>
		
		<div class="wrap">
			<h2><?php echo 'Referencer options' ?></h2>  
								
			<?php
				$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'styling';
			?>
	        <!-- makes the tabs in the wordpress options page -->
			<h2 class="nav-tab-wrapper">
	            <a href="?page=referencer_theme_options&tab=styling" class="nav-tab <?php echo $active_tab == 'styling' ? 'nav-tab-active' : ''; ?>">Styles</a>
	            <a href="?page=referencer_theme_options&tab=help" class="nav-tab <?php echo $active_tab == 'help' ? 'nav-tab-active' : ''; ?>">Help</a>
	            <a href="?page=referencer_theme_options&tab=social_links" class="nav-tab <?php echo $active_tab == 'social_links' ? 'nav-tab-active' : ''; ?>">Social</a>
        	</h2>
			  
			<!-- switches between the different tabs -->
			<?php
			if( $active_tab == 'styling' ) {	 
				new Styling;
			} elseif ($active_tab == 'help') {
				new Help;
			} elseif ($active_tab == 'social_links') {
				new Social;
			}?>
		</div>
		
		<?php 
		}
}