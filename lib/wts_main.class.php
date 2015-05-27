<?php
class WTSMAIN{
	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueLibs' ) );
		add_action('media_buttons', array( $this, 'shorcodeButton'), 15);
		add_action( 'admin_footer', array( $this, 'thickboxLayout') );
		
		add_action('in_widget_form', array($this,'widgetShortCodeLabel'));
		
		//shortcode		
		add_shortcode( 'wts', array($this, 'addShortCode') );
	}

	
	function enqueueLibs($hook){
		if($hook == 'post.php' || $hook == 'page.php' || $hook == 'post-new.php'){
			wp_enqueue_style( 'wts-style', WTSPLUGINURL.'lib/css/style.css' );
			wp_enqueue_script( 'wts-script', WTSPLUGINURL.'lib/js/wts-script.js', array(), '1.0.0', true );
			wp_enqueue_script('thickbox');
		}			
	}
	
	function shorcodeButton() {	
		echo '<a href="#TB_inline?width=600&height=550&inlineId=wts-shortcode-lists" id="wts-add-shortcode" title="Select Widget Shortcodes" class="button thickbox"> Add Widgets</a>';	
	}
	
	function thickboxLayout(){
	$currentScreen = get_current_screen();
		error_log(print_r(get_current_screen(),true));

		if($currentScreen->parent_base == 'edit'){
			require_once('display/wts-view.php');
		}
	}
	
	function addShortCode($atts){
		$a = shortcode_atts( array(
			'widget' => '',
			'number' => '',
			'id' => '',
		), $atts );
		$widgetOption ='';
		if ( base64_encode(base64_decode($a['id'], true)) === $a['id']){
			$widgetOption = base64_decode($a['id']);
		}else{
			$widgetOption = $a['id'];
		}
		
		$widgetData = get_option($widgetOption);
		if(!isset($widgetData[$a['number']]['title'])){$widgetData[$a['number']]['title']='';}
		ob_start();
		the_widget( $a['widget'], $widgetData[$a['number']] );
		$toReturn = ob_get_clean();

		return $toReturn;
	}

	function widgetShortCodeLabel($instance){
		$widgetData = get_option($instance->option_name);
		echo '
			<label>Copy Shortcode:</label><br />
			<span style="font-size:12px; color:#000; background:#eee;">
				[wts widget="'.get_class($instance).'" id="'.$instance->option_name.'" number="2"]
			</span><br /><br /><br /><br />';

	}	
}


?>