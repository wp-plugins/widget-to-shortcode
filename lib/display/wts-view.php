<div id="wts-shortcode-lists" style="display:none;">
    <div class="wts-holder">
		<div class="widget">
			<div class="wts-centered">
				<?php
				$allWidgetsArr = get_option('sidebars_widgets',array());
				unset($allWidgetsArr['wp_inactive_widgets'],$allWidgetsArr['array_version']);

				global $wp_registered_widgets;
				$sidebarsWidgets = wp_get_sidebars_widgets();
				  if(!empty($allWidgetsArr)){
					foreach(array_keys($allWidgetsArr) as $keys){
						$widgetIDs = $sidebarsWidgets[$keys];
							if(empty($widgetIDs)){continue;}
							foreach($widgetIDs as $id) {
								$wdgtvar = 'widget_'._get_widget_id_base($id);
								$idvar = _get_widget_id_base($id);
								$instance = get_option($wdgtvar);
								$idbs = str_replace($idvar.'-', '', $id);
								if(!isset($wp_registered_widgets[$id])){continue;}
								$widgetClass = get_class($wp_registered_widgets[$id]['callback'][0]);
								$widgetNumber = trim($wp_registered_widgets[$id]['callback'][0]->number);
								$widgetOption = $wp_registered_widgets[$id]['callback'][0]->option_name;
								
								if(!isset($instance[$idbs]['title'])){$instance[$idbs]['title']='';}
								
								echo '	<div class="widget-top wts-shortcodes" data-is-selected="0" data-class="'.$widgetClass.'" data-option="'.$widgetOption.'" data-number="'.$idbs.'">		
											<div class="widget-title"><h4>'.$wp_registered_widgets[$id]['callback'][0]->name.'<span class="in-widget-title">: '.
											((strlen($instance[$idbs]['title']) > 40)?substr($instance[$idbs]['title'], 0, 45).'...':$instance[$idbs]['title'])
											.'</span></h4></div>
										</div>';
							}
					}
				  }
				?>
			<div style="clear:both;"></div>	
			</div>
		</div>
		
		<div style="clear:both;"></div>
		<div class="wts-action">
		<button id="wts-insert" class="button button-primary button-large">Insert Widget as Shortcode</button>
		</div>
    </div>
</div>