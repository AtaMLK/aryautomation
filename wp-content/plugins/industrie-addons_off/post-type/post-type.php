<?php 
/** Added all post type
*/
class Rsaddon_pro_Post_Type{
	public function __construct(){
		$this->load_post_type();
	}

	public function load_post_type(){
		$rs_post_type_setting = get_option( 'rselements_addon_option' );
		if( isset( $rs_post_type_setting['rs_team_post'] ) == 'rs_team_post' ) {
			require plugin_dir_path( __FILE__ ). '/team/team.php';		
		}
		if( isset( $rs_post_type_setting['rs_portfolio_post'] ) == 'rs_portfolio_post' ) {
			require plugin_dir_path( __FILE__ ). '/portfolio/portfolio.php';
		}
		if( isset( $rs_post_type_setting['rs_service_post'] ) == 'rs_service_post' ) {
			require plugin_dir_path( __FILE__ ). '/service/service.php';
		}
	}
	
}
new Rsaddon_pro_Post_Type();
