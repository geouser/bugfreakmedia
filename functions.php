<?php 


	/**
	 *
	 * Increase wp upload max size limit
	 *
	*/
	update_option('max_file_size', '256000000');
	add_filter('upload_size_limit', 'increase_upload_size');
	function increase_upload_size($bytes) {
		return get_option('max_file_size');
	}


	/**
	 *
	 * Prevent placing selected categories on top of list when editing post
	 *
	*/
	function taxonomy_checklist_checked_ontop_filter ($args) {
		$args['checked_ontop'] = false;
		return $args;
	}
	add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');


	/**
	 *
	 * Add theme support
	 *
	*/
	function template_settings() {
		add_theme_support( 'post-thumbnails' ); 
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );

		//register_nav_menu( 'name', 'desc' );

		//add_image_size( 'name_thumbnail', 370, 370, true ); // name, width, height, crop
	}
	add_action( 'init', 'template_settings' ); // after_theme_setup

	/*function my_image_sizes($sizes) {
		$addsizes = array(
			"name_thumbnail" => __( "Description" )
		);
		$newsizes = array_merge( $sizes, $addsizes );
		return $newsizes;
	}*/


	/**
	 *
	 * Initialization of scripts and stylesheets
	 *
	*/
	function custom_links() {

		$theme = wp_get_theme();

		wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css', array(), $theme->get( 'Version' ), 'all'  );

		wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-1.12.4.min.js', array(), $theme->get( 'Version' ), true  );
		wp_enqueue_script( 'gmaps-js', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyB8OI63bD1KAI4MAo0yz7p0Fj-RiPEZYPk', array(), $theme->get( 'Version' ), true  );

		wp_enqueue_script( 'plugins-js', get_template_directory_uri() . '/js/plugins.js', array(), $theme->get( 'Version' ), true  );
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), $theme->get( 'Version' ), true  );

		wp_localize_script('main-js', 'theme', 
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'url' => get_template_directory_uri()
			)
		); 

	}
	add_action( 'wp_enqueue_scripts', 'custom_links' );


	/**
	 *
	 * Adding google maps API key
	 *
	*/

	/*
	function my_acf_google_map_api( $api ){
		$api['key'] = 'AIzaSyB8OI63bD1KAI4MAo0yz7p0Fj-RiPEZYPk';
		return $api;
	}
	add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
	*/


	/**
	 *
	 * Creates custom post type
	 *
	*/
	/*function create_settings() {
		register_post_type('settings', array(
		  'labels' => array(
			'name'			=> __( 'Главная информация', 'theme-domain' ),
			'singular_name'   => __( 'Главная информация', 'theme-domain'  ),
			'add_new'		 => __( 'Добавить информацию', 'theme-domain'  ),
			'add_new_item'	=> __( 'Добавить информацию', 'theme-domain'  ),
			'edit'			=> __( 'Редактировать информацию', 'theme-domain'  ),
			'edit_item'	   => __( 'Редактировать информацию', 'theme-domain'  ),
			'new_item'		=> __( 'Новая информация', 'theme-domain'  ),
			'all_items'	   => __( 'Вся информация', 'theme-domain'  ),
			'view'			=> __( 'Посмотреть информацию', 'theme-domain'  ),
			'view_item'	   => __( 'Посмотреть информацию', 'theme-domain'  ),
			'search_items'	=> __( 'Искать информацию', 'theme-domain'  ),
			'not_found'	   => __( 'Информация не найдена', 'theme-domain'  ),
		),
		'public' => true, // show in admin panel?
		'menu_position' => 0,
		'supports' => array( 'title', 'thumbnail'),
		'taxonomies' => array( '' ),
		'has_archive' => true,
		'capability_type' => 'post',
		'menu_icon'   => 'dashicons-location-alt',
		'rewrite' => array('slug' => 'settings'),
		));
	}
	add_action( 'init', 'create_settings' );*/


	
	/**
	 *
	 * Adds Ajax suport on site
	 *
	*/
	function my_func_name() {
		global $post;

		/* do staff here... */ 

		// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
		wp_die();
	}
	add_action('wp_ajax_name', 'my_func_name');
	add_action('wp_ajax_nopriv_name', 'my_func_name');

	
	/**
	 *
	 * Adds capability to translate theme
	 *
	*/
	function my_theme_setup(){
		load_theme_textdomain( 'theme-domain', get_template_directory() . '/languages' );
	}
	add_action( 'after_setup_theme', 'my_theme_setup' );



	/**
	 *
	 * Shortcode function 
	 *
	*/
	function function_name( $atts ) {
	    $atts = shortcode_atts( array(
	        // shortcode attributes
	    ), $atts, 'function_name' );

	    // shortcode logic goes here


	    ob_start();

	    	// html output goes here
	    
	    $content = ob_get_contents();
	    ob_end_clean();
	    return $content;
	}
	add_shortcode( 'shortcode_name', 'function_name' );


?>
