<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Adwait2196
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Adwait <adwait.deshpande21@gmail.com>
 */
class Wp_Book_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );

	}

	/****************************************************
	* This function will add custom post type named 'Book'.
	****************************************************/

	public function wpb_cust_post_book() {

		$labels = array(
			'name' 							 	=> _x( 'Books', 'Post Type General Name', 'wp-book' ),
			'singular_name' 		 	=> _x( 'Book', 'Post Type Singular Name', 'wp-book' ),
			'menu_name' 				 	=> __( 'Book', 'wp-book' ),
			'all_items' 				 	=> __( 'All Books', 'wp-book' ),
			'view_item' 				 	=> __( 'View Book', 'wp-book' ),
			'add_new_item' 			 	=> __( 'Add New Book', 'wp-book' ),
			'add_new' 					 	=> __( 'Add New', 'wp-book' ),
			'edit_item' 				 	=> __( 'Edit Book', 'wp-book' ),
			'update_item' 			 	=> __( 'Update Book', 'wp-book' ),
			'search_item' 			 	=> __( 'Search Book', 'wp-book' ),
			'not_found' 				 	=> __( 'Book Not Found', 'wp-book' ),
			'not_found_in_trash' 	=> __( 'Book Not Found In Trash', 'wp-book' )
		);

		$args = array(
			'labels' 							=> $labels,
			'description'					=> 'Book custom post type.',
			'public' 							=> true,
			'has_archive' 				=> true,
			'publicly_queryable' 	=> true,
			'query_var'          	=> true,
			'hierarchical'       	=> false,
			'show_ui'            	=> true,
      'show_in_menu'       	=> true,
			'menu_position'				=> 6,
			'rewrite'            	=> array( 'slug' => 'book' ),
      'capability_type'    	=> 'post',
			'supports'           	=> array( 'title', 'editor', 'author', 'thumbnail' ),
      //'taxonomies'         	=> array( 'category', 'post_tag' ),
			'show_in_rest'       	=> true
		);

		register_post_type( 'book', $args );
	}

	/********************************************************************
	* This function adds custom hierarchical taxonomy named Book Category.
	********************************************************************/

	public function wpb_cust_hie_taxonomy() {

		$labels = array(
			'name' 							=> _x( 'Book Categories', 'Taxonomy General Name', 'wp-book' ),
			'singular_name' 		=> _x( 'Book Category', 'Taxonomy Singular Name', 'wp-book' ),
			'search_items' 			=> __( 'Search For Book Category', 'wp-book' ),
			'all_items'         => __( 'All Book Categories', 'wp-book' ),
      'parent_item'       => __( 'Parent Book Category', 'wp-book' ),
      'parent_item_colon' => __( 'Parent Book Category:', 'wp-book' ),
      'edit_item'         => __( 'Edit Book Category', 'wp-book' ),
      'update_item'       => __( 'Update Book Category', 'wp-book' ),
      'add_new_item'      => __( 'Add New Book Category', 'wp-book' ),
      'new_item_name'     => __( 'New Book Category', 'wp-book' ),
      'menu_name'         => __( 'Book Category', 'wp-book' ),
		);

		$args = array(
			'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => [ 'slug' => 'book-category' ],
		);

		register_taxonomy( 'book-category', array( 'book' ), $args );
	}

	/*******************************************************************
	* This function adds custom non-hierarchical taxonomy named Book Tag.
	*******************************************************************/

	public function wpb_cust_nonhie_taxonomy() {

		$labels = array(
			'name' 							=> _x( 'Book Tags', 'Taxonomy General Name', 'wp-book' ),
			'singular_name' 		=> _x( 'Book Tag', 'Taxonomy Singular Name', 'wp-book' ),
			'search_items' 			=> __( 'Search For Book Tag', 'wp-book' ),
			'all_items'         => __( 'All Book Tags', 'wp-book' ),
      'edit_item'         => __( 'Edit Book Tag', 'wp-book' ),
      'update_item'       => __( 'Update Book Tag', 'wp-book' ),
      'add_new_item'      => __( 'Add New Book Tag', 'wp-book' ),
      'new_item_name'     => __( 'New Book Tag', 'wp-book' ),
      'menu_name'         => __( 'Book Tags', 'wp-book' ),
		);

		$args = array(
			'hierarchical'      => false,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => [ 'slug' => 'book-tag' ],
		);

		register_taxonomy( 'book-tag', array( 'book' ), $args );
	}

	/**************************************************************
	* This function will create table in the database with the prefix
	**************************************************************/

	public function bookmeta_integrate_wpdb() {
		global $wpdb;

		$wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
		$wpdb->tables[] = 'bookmeta';

		return;
	}

	/******************************************************
	* These functions add custom meta box for posts type Book and it's content.
	******************************************************/

	public function wpb_cust_meta_box() {
		add_meta_box( 'wpb-meta-book',
									__( 'Book Details', 'wp-book' ),
									array( $this, 'wpb_cust_meta_box_content' ),
									'book',
									'side',
									'high' );
	}

	public function wpb_cust_meta_box_content( $post ) {
		wp_nonce_field( basename( __FILE__ ), "wp_wpb_cpt_nonce" );
		?>
			<label for="author_name"><?php _e( 'Author Name :', 'wp-book' ) ?></label><br/>
			<?php
				$ath_name = get_book_meta( $post->ID, "book_author_name" );
			?>
			<input name="author_name" id="author_name" type="text" value="<?php _e( $ath_name ); ?>" /><br/>
			<label for="price"><?php _e( 'Price :', 'wp-book' ) ?></label><br/>
			<?php
				$pri = get_book_meta( $post->ID, "book_price" );
			?>
			<input name="price" id="price" type="text" value="<?php _e( $pri ); ?>"/><br/>
			<label for="publisher"><?php _e( 'Publisher :', 'wp-book' ) ?></label><br/>
			<?php
				$pub = get_book_meta( $post->ID, "book_publisher" );
			?>
			<input name="publisher" id="publisher" type="text" value="<?php _e( $pub ); ?>"/><br/>
			<label for="year"><?php _e( 'Year :', 'wp-book' ) ?></label><br/>
			<?php
				$yr = get_book_meta( $post->ID, "book_year" );
			?>
			<input name="year" id="year" type="text" maxlength="4" value="<?php _e( $yr ); ?>"/><br/>
			<label for="edition"><?php _e( 'Edition :', 'wp-book' ) ?></label><br/>
			<?php
				$edi = get_book_meta( $post->ID, "book_edition" );
			?>
			<input name="edition" id="edition" type="text" value="<?php _e( $edi ); ?>"/><br/>
			<label for="ur_l"><?php _e( 'URL :', 'wp-book' ) ?></label><br/>
			<?php
				$uri = get_book_meta( $post->ID, "book_url" );
			?>
			<input name="ur_l" id="ur_l" type="text" value="<?php _e( $uri ); ?>"/><br/>
		<?php
	}

	/*********************************************************************
	*	This function will save data from book details meta box to meta table
	*********************************************************************/

	public function wpb_save_book_metabox_data( $post_id, $post ) {
		if( !isset( $_POST[ 'wp_wpb_cpt_nonce' ] ) || !wp_verify_nonce( $_POST[ 'wp_wpb_cpt_nonce' ], basename( __FILE__ ))) { // To Verify Nonce
				return $post_id;
		}

		$post_slug = "book";
		if( $post_slug != $post->post_type ){ // Verifying slug value
			return;
		}

		// save data to database
		$auth_name = '';
		$price = '';
		$pub_name = '';
		$year = '';
		$edition = '';
		$url = '';
		if( !empty($_POST['author_name']) && !empty($_POST['price']) && !empty($_POST['publisher']) && !empty($_POST['year']) && !empty($_POST['edition']) && !empty($_POST['ur_l']) ) {
			$auth_name = sanitize_text_field( $_POST[ 'author_name' ] );
			$price = sanitize_text_field( $_POST[ 'price' ] );
			$pub_name = sanitize_text_field( $_POST[ 'publisher' ] );
			$year = sanitize_text_field( $_POST[ 'year' ] );
			$edition = sanitize_text_field( $_POST[ 'edition' ] );
			$url = sanitize_text_field( $_POST[ 'ur_l' ] );
			$values_arr = array(
				'book_author_name' => $auth_name,
				'book_price' 			 => $price,
				'book_publisher' 	 => $pub_name,
				'book_year' 			 => $year,
				'book_edition' 		 => $edition,
				'book_url' 				 => $url
			);
			foreach( $values_arr as $key_val => $val ){
				update_book_meta( $post_id, $key_val, $val );
			}
		}
		else {
			$this->cust_metabox_alert();
		}
	}

	public function cust_metabox_alert() {
		echo '<div class="notice notice-error is-dismissible">
             <p>Please fill all of the meta box fields to save them.</p>
         </div>';
	}

	/********************************************************
	* These functions will create menu page for books settings
	********************************************************/

	public function wpb_cust_menu_page() {
		add_menu_page( 'WPT Book Menu', __( 'Books Menu', 'wp-book' ), 'manage_options', 'book_menu', array( $this, 'wpb_create_book_menu_page' ) );
	}

	public function wpb_create_book_menu_page() {
		require_once 'partials/wp-book-admin-display.php';
	}

	/***************************************************
	* This function will register settings for books menu
	***************************************************/

	public function wpb_book_register_settings() {
		register_setting( 'books-setting-group', 'currency' );
		register_setting( 'books-setting-group', 'post-per-page' );
		add_settings_section( 'books-setting-section', __( 'Books setting section', 'wp-book' ), array( $this, 'wpb_book_settings_section' ), 'book_menu' );
		add_settings_field( 'book-currency', __( 'Currency', 'wp-book' ), array( $this, 'wpb_book_currency' ), 'book_menu', 'books-setting-section' );
		add_settings_field( 'book-post-pp', __( 'Posts Per Page', 'wp-book' ), array( $this, 'wpb_book_post_pp' ), 'book_menu', 'books-setting-section' );
	}

	public function wpb_book_settings_section() {}

	public function wpb_book_currency() {
		echo '<select name="currency" id="currency">
						<option value="$">USD</option>
						<option value="Rs">Rupees</option>
					</select>';
	}

	public function wpb_book_post_pp() {
		echo '<input type="text" name="post-per-page" value=""/>';
	}

	/*********************************************
	* This function is used to create a shortcode
	*********************************************/

	public function wpb_book_shortcode( $atts ) {
		//global $wpdb;
		$atts = shortcode_atts( array(
			'book_id' 		=> '',
			'author_name' => '',
			'year' 				=> '',
			'category' 		=> '',
			'tag' 				=> '',
			'publisher' 	=> ''
		), $atts );

		/*if( $attributes[ 'book_id' ] != '' ){
			$query_values = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM $wpdb->bookmeta WHERE book_id = %s", $attributes[ 'book_id' ] ), ARRAY_A );
			var_dump ( $query_values[1]['meta_value'] );
			echo "Hello";
		}
		else {
				return;
		}*/

		$args = array(
			'post_type' => 'book',
			'post_status' => 'publish',
		);

		if( $atts[ 'author_name' ] != '' ) {
			$args[ 'author_name' ] = $atts[ 'author_name' ];
		}

		if( $atts[ 'book_id' ] != '' ) {
			$args[ 'p' ] = $atts[ 'book_id' ];
		}

		if( $atts[ 'category' ] != '' ) {
			$args[ 'tax_query' ] = array(
				array(
					'taxonomy' => 'book-category',
          'terms' => array( $atts[ 'category' ] ),
          'field' => 'name',
          'operator' => 'IN'
				),
			);
		}

		if( $atts[ 'tag' ] != '' ){
			$args[ 'tax_query' ] = array(
				array(
					'taxonomy' => 'book-tag',
          'terms' => array( $atts[ 'tag' ] ),
          'field' => 'name',
          'operator' => 'IN'
				),
			);
		}

		return $this->wpb_book_shortcode_function( $args );
	}

	public function wpb_book_shortcode_caller() {
		add_shortcode( 'BookSc', array( $this, 'wpb_book_shortcode' ) );
	}

	/****************************************************
	* This function is used to display data with shortcode
	****************************************************/

	public function wpb_book_shortcode_function( $args ) {
		global $wpb_settings;

		$wpb_query = new WP_Query( $args );
		if( $wpb_query->have_posts() ) {
			while( $wpb_query->have_posts() ){
				$wpb_query->the_post();

				$wpb_info_author_name = get_metadata( 'book', get_the_id(), 'book_author_name' )[0];
        $wpb_info_price = get_metadata( 'book', get_the_id(), 'book_price' )[0];
				?>
				<ul style="list-style: none;">
					<?php
					if( get_the_title() != '' ){
						?>
							<li><?php _e( 'Book Title :', 'wp-book' ) ?><a href="<?php get_post_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
						<?php
					}
					if( $wpb_info_author_name != '' ){
          ?>
          	<li><?php _e( 'Author Name :', 'wp-book' ) ?><?php echo $wpb_info_author_name; ?></li>
          <?php
          }

					if( $wpb_info_price != '' ){
          ?>
        		<li><?php _e( 'Book Price :', 'wp-book' ) ?><?php echo $wpb_info_price; ?></li>
          <?php
          }
					?>
				</ul>
				<?php
			}
		}
		else {
			?>
				<h1><?php _e( 'Sorry no Books Found', 'wp-book' ) ?></h1>
			<?php
		}
	}

	/************************************************
	*	This function is used to create dashboard widget
	************************************************/

	public function wpb_top_five_widget() {
		wp_add_dashboard_widget( "top_five_book_widget",
														 __( "Top 5 books", 'wp-book' ),
													 	 array( $this, "wpb_get_top_five_books" ) );
	}

	public function wpb_get_top_five_books() {
		$args = [
			'orderby' => 'count',
			'order' => 'DESC',
			'number' => 5,
			'show_count' => 1,
			'taxonomy' => 'book-category',
			'style' => 'none',
		];
		wp_list_categories( $args );
	}

}

/************************************************************
* These are wrapper functions
************************************************************/

function add_book_meta( $book_id, $meta_key, $meta_value, $unique = false ) {
	return add_metadata( 'book', $book_id, $meta_key, $meta_value, $unique);
}

function delete_book_meta( $book_id, $meta_key, $meta_value = '') {
	return delete_metadata( 'book', $book_id, $meta_key, $meta_value );
}

function get_book_meta( $book_id, $key = '', $single = true ) {
	return get_metadata( 'book', $book_id, $key, $single );
}

function update_book_meta( $book_id, $meta_key, $meta_value, $prev_value = '' ) {
	return update_metadata( 'book', $book_id, $meta_key, $meta_value, $prev_value );
}
