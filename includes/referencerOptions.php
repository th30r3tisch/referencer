<?php

require_once( __DIR__. '/options/styling.php');
require_once( __DIR__. '/options/help.php');
require_once( __DIR__. '/options/social.php');
require_once( __DIR__. '/options/general.php');


class ReferencerOptions {
	
	function __construct($menuSlug) {
		$this->buildPage($menuSlug);
	}
	
		
	function buildPage($menuSlug) {
		
		$menuSlug = $menuSlug.'&tab=';
		$generalTabUrl = $menuSlug.'general';
		$stylingTabUrl = $menuSlug.'styling';
		$helpTabUrl = $menuSlug.'help';
		$socialTabUrl = $menuSlug.'social_links';
		
		//check if the user has the required capability
		if (!current_user_can('manage_options'))
		{
			wp_die( 'You do not have sufficient permissions to access this page.' );
		}	
		settings_errors(); ?>
		
		<div class="wrap">
			<h2><?php echo 'Referencer options' ?></h2>  
								
			<?php
				$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
			?>
	        <!-- makes the tabs in the wordpress options page -->
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo '?page='.$generalTabUrl ?>" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
	            <a href="<?php echo '?page='.$stylingTabUrl ?>" class="nav-tab <?php echo $active_tab == 'styling' ? 'nav-tab-active' : ''; ?>">Styles</a>
				<a href="<?php echo '?page='.$socialTabUrl ?>" class="nav-tab <?php echo $active_tab == 'social_links' ? 'nav-tab-active' : ''; ?>">Social</a>
	            <a href="<?php echo '?page='.$helpTabUrl ?>" class="nav-tab <?php echo $active_tab == 'help' ? 'nav-tab-active' : ''; ?>">Help</a>
        	</h2>
			  
			<!-- switches between the different tabs -->
			<?php
			if( $active_tab == 'general' ) {	 
				new General($generalTabUrl);
			} elseif ($active_tab == 'help') {
				new Help($helpTabUrl);
			} elseif ($active_tab == 'social_links') {
				new Social($socialTabUrl);
			}elseif ($active_tab == 'styling') {
				new Styling($stylingTabUrl);
			}?>
		</div>
		
		<?php 
		}
}