<?php
class WTSMAIN{
	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueLibs' ) );
		add_action('media_buttons', array( $this, 'shorcodeButton'), 15);
		add_action( 'admin_footer', array( $this, 'thickboxLayout') );
		
		//shortcode		
		add_shortcode( 'wts', array($this, 'addShortCode') );
	}
	
	function renderBackend(){
		
		require_once('display/wts-view.php');
		
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
		require_once('display/wts-view.php');
	}
	
	function addShortCode($atts){
		$a = shortcode_atts( array(
			'widget' => '',
			'number' => '',
			'id' => '',
		), $atts );
	
		$widgetData = get_option(base64_decode($a['id']));
		if(!isset($widgetData[$a['number']]['title'])){$widgetData[$a['number']]['title']='';}
		ob_start();
		the_widget( $a['widget'], $widgetData[$a['number']] );
		$toReturn = ob_get_clean();

		return $toReturn;
	}			
}
?>