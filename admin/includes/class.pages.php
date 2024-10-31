<?php
/**
* 
*	Class responsible for Network King Pages
*/
class Network_King_Pages{
	//static  $settings_page_hook = 'toplevel_page_network_king-network';
	//static public $speedguard_options = 'speedguard_options'; 
		function __construct(){
			//Set defaults here						
		}	
	
	public static function publishing_stats_page() {
		$screen = get_current_screen();	
		$stats_page_hook = 'toplevel_page_network_king-network';
			if ( ($screen->id ==  $stats_page_hook) ) {		
			  wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); 	
				add_meta_box( 'stats-meta-box', __('Pub stats','network-king'), array('Network_King_Pages', 'stats_meta_box' ), $stats_page_hook, 'publishing-stats', 'core' ); 
									
			?>
			<div class="wrap">        
				<h2><?php _e( 'Network King :: Publishing Stats', 'network-king' ); ?></h2>		
						<div id="poststuff" class="metabox-holder has-right-sidebar">
							<div id="webpagetest-iframe-box">
								<?php 							
								do_meta_boxes( $stats_page_hook, 'publishing-stats', 0 ); ?>
							</div>
						</div>	
			</div>
			<?php 
			}
		}
	public static function stats_meta_box(){
		ob_start();
		echo '<table class="table-fill" style="font-size: 1em;"><thead><tr>
				<td>'. __( 'Site ID', 'network-king' ).'</td>
				<td>'. __( 'URL', 'network-king' ).'</td>
				<td>'. __( 'Publish', 'network-king' ).'</td>
				<td>'. __( 'Pending', 'network-king' ).'</td>
				<td>'. __( 'Draft', 'network-king' ).'</td>
				<td>'. __( 'Future', 'network-king' ).'</td>
				<td>'. __( 'Today', 'network-king' ).'</td>
				<td>'. __( 'Trash', 'network-king' ).'</td>				  
				</tr></thead><tbody class="table-hover">'; 
		$today = getdate();
		$sites = get_sites(); 
			foreach ( $sites as $site ) {				
				$blog_id = $site->blog_id;
				$site_url = get_site_url($blog_id);
					if ($blog_id < 51) {              
						switch_to_blog( $blog_id ); 
							echo '<tr>';						
							echo '<td>'.$blog_id.'</td>';
							echo '<td><a target="_blank" href="'.$site_url.'/wp-admin/">'.$site_url.'</a></td>';					
										$args = array('post_type'      => 'post', 'post_status'    => 'publish', 'numberposts'     => -1, 'fields' => 'ids');			
										$publish_posts = get_posts( $args );
										$count_publish_posts = 	count($publish_posts);									
							echo '<td>'.$count_publish_posts.'</td>';									
										$args = array('post_type'      => 'post', 'post_status'    => 'pending', 'numberposts'     => -1, 'fields' => 'ids');			
										$pending_posts = get_posts( $args );
										$count_pending_posts = 	count($pending_posts);
							echo '<td>'.$count_pending_posts.'</td>';								
										$args = array('post_type'      => 'post', 'post_status'    => 'draft', 'numberposts'     => -1, 'fields' => 'ids');			
										$draft_posts = get_posts( $args );			
							echo '<td>'.count($draft_posts).'</td>';
										$args = array('post_type'      => 'post', 'post_status'    => 'future', 'numberposts'     => -1, 'fields' => 'ids');			
										$future_posts = get_posts( $args );			
							echo '<td>'.count($future_posts).'</td>';
										$args = array('post_type'      => 'post', 'post_status'    => 'publish', 'numberposts'     => -1, 'fields' => 'ids', 
										'order' => 'DESC', 'date_query' => array(
										array(
											'year'  => $today['year'],
											'month' => $today['mon'], 
											'day'   => $today['mday'], 
										),
									)
									); 			 
										$yesterday_posts = get_posts( $args );	 	
							echo '<td>'.count($yesterday_posts).'</td>';							
										$args = array('post_type'      => 'post', 'post_status'    => 'trash', 'numberposts'     => -1, 'fields' => 'ids');			
										$trashed_posts = get_posts( $args );
							echo '<td>'.count($trashed_posts).'</td>';	
							echo '</tr></tbody>'; 
							
					restore_current_blog();
					}//endif
				}//endforeach
			echo '</table>';  
			
			$output = ob_get_contents();
			
			return $output; 
			ob_end_clean();
		}		
		
		
}
new Network_King_Pages; 


