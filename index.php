<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.facebook.com
 * @since             1.0.0
 * @package           Wordpress Survey
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Survery v3
 * Plugin URI:        https://www.facebook.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Steven Brough
 * Author URI:        https://www.facebook.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       customwebsitesurvey
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CUSTOMWEBSITESURVEY_VERSION', '1.0.0' );

define( 'ADMIN_EMAIL', 'admin@outsourcethat.today' );

function getTitle($index) {
	$titleArray = array("", "Solopreneur", "Entrepreneur and/or Small Team", "Small Business Owner and/or Manager", "Freelance Service Provider", "Introduction to Outsourcing", "Done For You Outsourcing", "Integrating Outsourcing", "Understanding Freelancers", "Project Planning and Management", "Outsourcing Administrative Support", "Outsourcing Business Services", "Outsourcing Graphic Design Services", "Outsourcing IT & Networking Support", "Outsourcing Multimedia Services", "Outsourcing Sales & Marketing Services", "Outsourcing SEO & Link Building Services", "Outsourcing Software Development", "Outsourcing Website Development", "Outsourcing Writing Services");
	return $titleArray[$index];
}

function footag_func( $atts ) {
	$a = shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts );

	ob_start();
	//return "foo = {$a['foo']}";
	if( $_REQUEST && $_REQUEST['need'] ) {
		include __DIR__ . '/includes/result.php';
	}
	else {
		include __DIR__ . '/includes/form.php';
	}
	$output = ob_get_clean();
	return $output;
}

add_shortcode( 'start_survey', 'footag_func' );


add_action('wp_enqueue_scripts', 'my_enqueue_scripts');
function my_enqueue_scripts() {
	wp_enqueue_script( 'wordpress_survey', plugin_dir_url( __FILE__ ) . 'js/depo.js', array('jquery'), false, false );
  wp_enqueue_style( 'wpsv_style', plugin_dir_url( __FILE__ ) . '/css/main.css' );
	wp_enqueue_script( 'wordpress_survey_tabs', plugin_dir_url( __FILE__ ) . 'js/tabs.js', array('jquery'), false, false );
	wp_localize_script('wordpress_survey_tabs', 'custom_survey_js', array('ajaxurl' => admin_url('admin-ajax.php')));
	//wp_enqueue_script( 'wordpress_survey_main', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), false, false );
}


add_action( 'wp_ajax_custom_survey_email', 'custom_survey_send_email' );
add_action( 'wp_ajax_nopriv_custom_survey_email', 'custom_survey_send_email' );

function custom_survey_send_email(){
	if(!$_REQUEST['emailId']) {
		echo "{status: false, message: 'Email is required'}";
		return;
	}
	if(!$_REQUEST['emailMessage']) {
		echo "{status: false, message: 'Message is empty'}";
		return;
	}
	$emailId = $_REQUEST['emailId'];
	$emailMessage = $_REQUEST['emailMessage'];
	$mailStatus = wp_mail( ADMIN_EMAIL, "Inquiry by $emailId", $emailMessage );
	// Process the post data...
	if($mailStatus) {
		echo "{status: true, message: 'mail send successfully'}";
	}
	else {
		echo "{status: false, message: 'some error while sending email'}";
	}
	wp_die();
}

// Our custom post type function
function create_posttype() {
    register_post_type( 'email',
        array(
            'labels' => array(
                'name' => __( 'Emails' ),
                'singular_name' => __( 'Email' )
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'email'),
            'taxonomies' => array( 'category' ),
        )
    );
		flush_rewrite_rules();
}

function wordpress_survey_settings() {
	for ($i=1; $i < 20; $i++) {
		add_option( '_description_'.$i , '');
		register_setting( '_recommended_textid_'.$i, '_description_'.$i, 'myplugin_callback' );

		add_option( '_blog_'.$i , '');
		register_setting( '_recommended_textid_'.$i, '_blog_'.$i, 'myplugin_callback' );

		add_option( '_shop_'.$i , '');
		register_setting( '_recommended_textid_'.$i, '_shop_'.$i, 'myplugin_callback' );

		add_option( '_report_'.$i , '');
		register_setting( '_recommended_textid_'.$i, '_report_'.$i, 'myplugin_callback' );
	}
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
add_action( 'admin_init', 'wordpress_survey_settings' );


function myplugin_register_options_page() {
  add_options_page('Survey Result settings', 'Survey Result Page', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_options_page() {
  ?>
  <div>
  	<style type="text/css">
		.accordion {
			background-color: #eee;
			color: #444;
			cursor: pointer;
			padding: 18px;
			text-align: left;
			border: none;
			outline: none;
			transition: 0.4s;
		}
		.active, .accordion:hover {
			background-color: #ccc;
		}
		.panel {
			padding: 0 18px;
			background-color: white;
			display: none;
			overflow: hidden;
		}
  	</style>
  <?php screen_icon(); ?>
  <h2>My Plugin Page Title</h2>
  <?php
  	for ($i=1; $i < 20; $i++) { ?>
  		<div style="border: 1px solid #d7d7d7;margin-bottom: 5px;">
	  		<div class="accordion"><?php echo $i ?>)
	  			<b>[recommended_text id="<?php echo $i ?>" description=1 blog=1 shop=1 report=1 title="<?php echo getTitle($i) ?>"]</b>
	  		</div>
	  		<div class="panel">
				<form method="post" action="options.php">
					<?php settings_fields( '_recommended_textid_'.$i ); ?>
					<table style="width:100%">
						<tr valign="top">
							<th scope="row"><label for="<?php echo '_description_'.$i ?>">Description</label></th>
							<td><textarea style="width:100%; min-height:100px" id="<?php echo '_description_'.$i ?>" name="<?php echo '_description_'.$i ?>"><?php echo get_option('_description_'.$i); ?></textarea></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="<?php echo '_blog_'.$i ?>">Blog</label></th>
							<td><textarea style="width:100%; min-height:100px" id="<?php echo '_blog_'.$i ?>" name="<?php echo '_blog_'.$i ?>"><?php echo get_option('_blog_'.$i); ?></textarea></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="<?php echo '_shop_'.$i ?>">Shop</label></th>
							<td><textarea style="width:100%; min-height:100px" id="<?php echo '_shop_'.$i ?>" name="<?php echo '_shop_'.$i ?>"><?php echo get_option('_shop_'.$i); ?></textarea></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="<?php echo '_report_'.$i ?>">Report</label></th>
							<td><textarea style="width:100%; min-height:100px" id="<?php echo '_report_'.$i ?>" name="<?php echo '_report_'.$i ?>"><?php echo get_option('_report_'.$i); ?></textarea></td>
						</tr>
					</table>
					<?php submit_button(); ?>
				</form>
			</div>
		</div>
  	<?php
  	}
  ?>
  <script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
		/* Toggle between adding and removing the "active" class,
		to highlight the button that controls the panel */
		this.classList.toggle("active");

		/* Toggle between hiding and showing the active panel */
		var panel = this.nextElementSibling;
		if (panel.style.display === "block") {
			panel.style.display = "none";
		}
		else {
			panel.style.display = "block";
		}
		});
	}
  </script>
  </div>
<?php
}

function recommended_text_callback( $atts ) {
	$a = shortcode_atts( array(
		'id' => '',
		'blog' => '',
		'shop' => '',
		'report' => '',
		'title' => '',
		'description' => ''
	), $atts );

	$id = 0;

	// Start the div
	$html = "<div class='toplightGray'>";
	if( $a['title'] ) {
		$html .= "<h4 style='margin: 30px 0;float: left;width: 100%;clear: both;'>".$a['title']."</h4>";
	}

	// If id is not present then sending error message
	if( !$a['id'] ) {
		$html .= "<p>Id is required</p>";
		return;
	}
	else {
		$id = $a['id'];
	}

	if( $a['description'] == 1 ) {
		$html .= "<div class='lightGray' style='background-color:#f5f5f5;float: left;width: 100%;clear: both;'>".get_option('_description_'.$id)."</div>";
	}

	// If blog is set to 1
	if( $a['blog'] == 1 ) {
		$blogData = get_option('_blog_'.$id);
		if( $blogData ) {
			$html .= "<div class='lightGray' style='background-color:#f5f5f5;float: left;width: 100%;clear: both;'><p><b>From the Blog</b></p>";
			$html .= $blogData;
			$html .= "</div>";
		}
	}

	// If shop is set to 1
	if( $a['shop'] == 1 ) {
		$shopData = get_option('_shop_'.$id);
		if( $shopData ) {
			$html .= "<div class='lightGray' style='background-color:#f5f5f5;float: left;width: 100%;clear: both;'><p><b>From the Shop</b></p>";
			$html .= $shopData;
			$html .= "</div>";
		}
	}

	// If report is set to 1
	if( $a['report'] == 1 ) {
		$reportData = get_option('_report_'.$id);
		if( $reportData ) {
			$html .= "<div class='lightGray' style='background-color:#f5f5f5;float: left;width: 100%;clear: both;'><p><b>Free Report</b></p>";
			$html .= $reportData;
			$html .= "</div>";
		}
	}
	$html .= "</div>";

	return $html;
	// echo "<pre>";
	// print_r($a);
	// echo "</pre>";
}

add_shortcode( 'recommended_text', 'recommended_text_callback' );


// Register and load the widget
function wpb_load_widget() {
	ob_start();
	include 'includes/widget.php';
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
