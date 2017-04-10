 <div class="pyre_metabox">
<?php
$this->select(	'page_title',
				'Page Title Bar',
				array('yes' => 'Show', 'no' => 'Hide'),
				''
			);
?>
<?php
$this->select(	'slider_type',
				'Slider Type',
				array('no' => 'No Slider', 'layer' => 'LayerSlider', 'flex' => 'FlexSlider', 'flex2' => 'ThemeFusion Slider', 'rev' => 'Revolution Slider', 'elastic' => 'Elastic Slider'),
				''
			);
?>
<?php
global $wpdb;
$slides_array[0] = 'Select a slider';
// Table name
$table_name = $wpdb->prefix . "layerslider";

// Get sliders
$sliders = $wpdb->get_results( "SELECT * FROM $table_name
									WHERE flag_hidden = '0' AND flag_deleted = '0'
									ORDER BY date_c ASC LIMIT 100" );

if(!empty($sliders)):
foreach($sliders as $key => $item):
	$slides[$item->id] = '';
endforeach;
endif;

if($slides){
foreach($slides as $key => $val){
	$slides_array[$key] = 'LayerSlider #'.($key);
}
}
$this->select(	'slider',
				'Select LayerSlider',
				$slides_array,
				''
			);
?>
<?php
$slides_array = array();
$slides = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('slide-page');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'wooslider',
				'Select FlexSlider',
				$slides_array,
				''
			);
?>
<?php
$slides_array = array();
$slides_array[0] = 'Select a slider';
$i = 1;
$data = $this->data;
while($i <= $data['flexsliders_number']){
	$slides_array['flexslider_'.$i] = 'TFSlider'.$i;
	$i++;
}
$this->select(	'flexslider',
				'Select ThemeFusion Slider',
				$slides_array,
				''
			);
?>
<?php
global $wpdb;
$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
$revsliders[0] = 'Select a slider';
if($get_sliders) {
	foreach($get_sliders as $slider) {
		$revsliders[$slider->alias] = $slider->title;
	}
}
$this->select(	'revslider',
				'Select Revolution Slider',
				$revsliders,
				''
			);
?>
<?php
$slides_array = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('themefusion_es_groups');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'elasticslider',
				'Select Elastic Slider',
				$slides_array,
				''
			);
?>
<?php $this->upload('fallback', 'Slider Fallback Image'); ?>
<?php
$this->select(	'full_width',
				'Page: Full Width',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'sidebar_position',
				'Page: Sidebar Navigation Position',
				array('left' => 'Left', 'right' => 'Right'),
				''
			);
?>
<?php
$this->text(	'portfolio_excerpt',
				'Portfolio: Excerpt Length',
				''
			);
?>
<?php
$this->select(	'portfolio_full_width',
				'Portfolio: Full Width',
				array('yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<?php
$this->select(	'portfolio_sidebar_position',
				'Portfolio: Sidebar Position',
				array('right' => 'Right', 'left' => 'Left'),
				''
			);
?>
<?php
$types = get_terms('portfolio_category', 'hide_empty=0');
$types_array[0] = 'All categories';
if($types) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
$this->multiple(	'portfolio_category',
				'Portfolio Type',
				$types_array,
				'Choose what portfolio category you want to display on this page. Leave blank for all categories.'
			);
}
?>
<?php
$this->text(	'page_bg_color',
				'Background Color (Hex Code)',
				''
			);
?>
<?php $this->upload('page_bg', 'Background Image'); ?>
<?php
$this->select(	'page_bg_full',
				'100% Background Image',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'page_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<?php $this->upload('page_title_bar_bg', 'Page Title Bar Background'); ?>
<?php
$this->text(	'page_title_bar_bg_color',
				'Page Title Bar Background Color (Hex Code)',
				''
			);
?>
<?php
global $post;
$current_page = $post->ID;

$page_list = array();
$page_list[0]["name"] = 'Select a page';
$page_list[0]["val"] = 0;
$page_list[0]["parent"] = 0;
$pages = get_pages( array('sort_column'=>'menu_order', 'sort_order'=>'ASC', 'post_status' => 'publish', 'exclude' => $current_page ) );

foreach($pages as $key => $val){
	$tmp["val"] = $val->ID;
	$tmp["name"] = $val->post_title;
	$tmp["parent"] = $val->post_parent;
	//$page_list[$val->ID] = $val->post_title;
	$page_list[] = $tmp;
}

$this->select_group('sidebar_navigation_parent_page',
				'Navigation Parent Page',
				$page_list,
				''
			);
?>
</div>