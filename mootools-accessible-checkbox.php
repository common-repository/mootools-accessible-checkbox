<?php
/*
Plugin Name: MooTools Accessible Checkbox
Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-checkbox/
Description: WAI-ARIA Enabled Checkbox Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "MooToolsAccessibleCheckbox_init");
function MooToolsAccessibleCheckbox_init() {
    register_sidebar_widget(__('MooTools Accessible Checkbox'), 'widget_MooToolsAccessibleCheckbox');
    register_widget_control(   'MooTools Accessible Checkbox', 'MooToolsAccessibleCheckbox_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_MooToolsAccessibleCheckbox') ) {
         wp_deregister_script('jquery');

        // add your own script
       wp_register_script('mootools-core', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-checkbox/lib/mootools-core.js'));
        wp_enqueue_script('mootools-core');

        wp_register_style('MooToolsAccessibleCheckbox_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-checkbox/lib/demo.css'));
        wp_enqueue_style('MooToolsAccessibleCheckbox_css');

        wp_register_script('MooToolsAccessibleCheckbox', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-checkbox/lib/demo.js'));
        wp_enqueue_script('MooToolsAccessibleCheckbox');
		
		wp_register_script('checkbox', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-checkbox/lib/checkbox.js'));
        wp_enqueue_script('checkbox');
    }
}

function widget_MooToolsAccessibleCheckbox($args) {
    extract($args);

    $options = get_option("widget_MooToolsAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Checkbox',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

	
    //Our Widget Content
    MooToolsAccessibleCheckboxContent();	
    echo $after_widget;
}

function MooToolsAccessibleCheckboxContent() {
    $options = get_option("widget_MooToolsAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Checkbox',
        );
    }
    
    echo '<div class="sa_demo_contentScreen">
			<form action="" id="MooAccessCheckbox">
				<p>
					<input type="checkbox" name="apple" value="apple" checked>
					
					<span>Apple</span>
					<br>
					<input type="checkbox" name="banana" value="banana">
					<span>Banana</span>
					<br>
					<input type="checkbox" name="orange" value="orange">
					<span>Orange</span>
					<br>
					<input type="checkbox" name="pineapple" value="pineapple">
					<span>Pineapple</span>
					<br>
					<input type="checkbox" name="melon" value="melon">
					<span>Melon</span>
				</p>
			</form>
		</div>';

}

function MooToolsAccessibleCheckbox_control() {
    $options = get_option("widget_MooToolsAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Checkbox',
        );
    }

    if ($_POST['MooToolsAccessibleCheckbox-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['MooToolsAccessibleCheckbox-WidgetTitle']);
        update_option("widget_MooToolsAccessibleCheckbox", $options);
    }
    ?>
    <p>
        <label for="MooToolsAccessibleCheckbox-WidgetTitle">Widget Title: </label>
        <input type="text" id="MooToolsAccessibleCheckbox-WidgetTitle" name="MooToolsAccessibleCheckbox-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="MooToolsAccessibleCheckbox-SubmitTitle" name="MooToolsAccessibleCheckbox-SubmitTitle" value="1" />
    </p>
   
    <?php
}

?>
