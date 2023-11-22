<?php

/**
 * Plugin Name: Local Long Tail
 * Plugin URI: https://exclusivewebmarketing.com/llt
 * Description: The Plugin Allows You Create Multiple Location Based SEO Optimized Posts
 * Version: 1.5.0
 * Update URI: https://api.freemius.com
 * Author: Exclusive Web Marketing
 * Author URI: https://exclusivewebmarketing.com/
 * Text Domain: exclusive-web-llt
 * Domain Path: /languages/
 * License: GPLv2 or any later version
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package WPBDP
 */
// Do not allow direct access to this file. // Process images
define( 'LLT_HOME_DIR', dirname( __FILE__ ) );

if ( !function_exists( 'llt_fs' ) ) {
    // Create a helper function for easy SDK access.
    function llt_fs()
    {
        global  $llt_fs ;
        
        if ( !isset( $llt_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $llt_fs = fs_dynamic_init( array(
                'id'               => '11872',
                'slug'             => 'local-long-tail',
                'type'             => 'plugin',
                'public_key'       => 'pk_7bf5d8c95212cabc5b39d26fff0be',
                'is_premium'       => true,
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => false,
                'trial'            => array(
                'days'               => 14,
                'is_require_payment' => true,
            ),
                'menu'             => array(
                'slug'    => 'ewm-dpm-llt',
                'support' => false,
            ),
                'is_live'          => true,
            ) );
        }
        
        return $llt_fs;
    }
    
    // Init Freemius.
    llt_fs();
    // Signal that SDK was initiated.
    do_action( 'llt_fs_loaded' );
}

add_action( 'admin_enqueue_scripts', 'ewm_llt_load_admin_resources' );
function ewm_llt_load_admin_resources( $options )
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ewm-llt-main-lib-uploader-js', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/admin-script.js', 'jquery' ) );
    wp_localize_script( 'ewm-llt-main-lib-uploader-js', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_style( 'ewm-llt-_style_public', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/admin-style.css' ) );
    wp_enqueue_media();
}

add_action( 'wp_enqueue_scripts', 'ewm_llt_load_public_resources' );
function ewm_llt_load_public_resources( $options )
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ewm-llt-public-main-lib-uploader-js', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/public-script.js', 'jquery' ) );
    wp_localize_script( 'ewm-llt-public-main-lib-uploader-js', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_style( 'ewm-llt-style_public', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/public-style.css' ) );
}

// add_action( 'admin_footer', 'ewm_llt_manage_plans' );

class EwmLLT
{
    public static function my_dash()
    {
        $dashllt_list_url = LLT_HOME_DIR . '/templates/admin/dashboard.php';
        include_once $dashllt_list_url;
    }

    public static function is_allowed_parent( $args = [] ){

        $post_parent_list = get_posts( [
			"post_type"     => "ewm_main_llt",
			"post_status"   => "active",
			"posts_per_page" => "-1",
		] );

        $post_p_list_count = count( $post_parent_list );
        $ewm_reponse = 'allowed';;

        if ( llt_fs()->is_plan('professional', true) ) { // professional
            if( $post_p_list_count >= 3 ){
                $ewm_reponse = 'not_allowed';
            }
        }
        elseif( llt_fs()->is_plan('enterprise', true) ){ // enterprise -> unlimited
            $ewm_reponse = 'allowed';
        }
        else{ // free -> if is equal or greater than threshold -> not_allowed
            if( $post_p_list_count >= 1 ){
                $ewm_reponse = 'not_allowed';
            }
        }

        return $ewm_reponse;

    }

    public static function is_allowed_group( $args = [] ){

        $post_parent_list = get_posts( [
			"post_type"     => "ewm_main_llt",
			"post_status"   => "active",
			"posts_per_page" => "-1",
		] );

        $post_p_list_count = count( $post_parent_list );
        $ewm_reponse = 'allowed';;

        if ( llt_fs()->is_plan('professional', true) ) { // professional
            if( $post_p_list_count >= 3 ){
                $ewm_reponse = 'not_allowed';
            }
        }
        elseif( llt_fs()->is_plan('enterprise', true) ){ // enterprise -> unlimited
            $ewm_reponse = 'allowed';
        }
        else{ // free -> if is equal or greater than threshold -> not_allowed
            if( $post_p_list_count >= 1 ){
                $ewm_reponse = 'not_allowed';
            }
        }

        return $ewm_reponse;

    }
    
    public static function mainllt()
    {
        $mainllt_list_url = LLT_HOME_DIR . '/templates/admin/mainllt/mainllt.php';
        if ( array_key_exists( 'ewm_llt_id', $_GET ) ) {
            $mainllt_list_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/single_main_llt.php';
        }
        include_once $mainllt_list_url;
    }

    public static function lltlocationgroup()
    {
        $locationlltgroup_list_url = LLT_HOME_DIR . '/templates/admin/locationllt/single_group/LocationGroupLlt.php';

        if ( array_key_exists( 'ewmLltLocationGroupId', $_GET ) ) {
            $locationlltgroup_list_url = LLT_HOME_DIR . '/templates/admin/locationllt/single_group/SingleLocationGroupLlt.php';
            // return 'hallo world';
        }

        include_once $locationlltgroup_list_url;

    }
    
    public static function lltlocation()
    {
        $locationllt_list_url = LLT_HOME_DIR . '/templates/admin/locationllt/locationllt.php';

        if ( array_key_exists( 'ewm_llt_location_id', $_GET ) ) {
            $locationllt_list_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/single_main_llt.php';
        }

        include_once $locationllt_list_url;

    }
    
    public static function lltsetting()
    {
        $settingllt_list_url = LLT_HOME_DIR . '/templates/admin/settingllt/settingllt.php';
        include_once $settingllt_list_url;
    }
    
    public static function lltitem()
    {
        $itemllt_list_url = LLT_HOME_DIR . '/templates/admin/itemllt/item_list.php';
        if ( array_key_exists( 'ewm_llt_item_id', $_GET ) ) {
            $itemllt_list_url = LLT_HOME_DIR . '/templates/admin/itemllt/single/single_main_llt.php';
        }
        include_once $itemllt_list_url;
    }
    
    public static function admin_menu()
    {
        add_menu_page(
            __( 'Local Long Tail', 'exclusive-web-marketing-llt' ),
            __( 'Local Long Tail', 'exclusive-web-marketing-llt' ),
            'edit_pages',
            'ewm-dpm-llt',
            'EwmLLT::my_dash',
            'dashicons-align-pull-left',
            // 'dashicons-ellipsis',
            2
        );

        add_submenu_page(
            'ewm-dpm-llt',
            'Dashboard',
            'Dashboard',
            'edit_pages',
            'ewm-dpm-llt',
            '',//'EwmLLT::my_dash',
            2
        );

        add_submenu_page(
            'ewm-dpm-llt',
            'Parent Posts',
            'Parent Posts',
            'edit_pages',
            'ewm-dpm-mainllt',
            'EwmLLT::mainllt',
            2
        );

        /*add_submenu_page(
            'ewm-dpm-llt',
            'Child Posts',
            'Child Posts',
            'manage_options',
            'ewm-dpm-lltitem',
            'EwmLLT::lltitem',
            3
        );
        add_submenu_page(
            'ewm-dpm-llt',
            'Locations',
            'Locations',
            'manage_options',
            'ewm-dpm-lltlocation',
            'EwmLLT::lltlocation',
            3
        ); */

        add_submenu_page(
            'ewm-dpm-llt',
            'Locations',
            'Location Groups',
            'edit_pages',
            'ewm-dpm-lltlocationgroup',
            'EwmLLT::lltlocationgroup',
            3
        );

        add_submenu_page(
            'ewm-dpm-llt',
            'Setting',
            'Setting',
            'edit_pages',
            'ewm-dpm-lltsetting',
            'EwmLLT::lltsetting',
            4
        );
    }
    
    public static function create_llt_posts()
    {
        $ewmdsm_content = 'sample_keyword_content';
        $ewmdsm_heading = 'Title';
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $ewmdsm_heading );
        $post_data = [
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $ewmdsm_content,
            "post_title"            => $ewmdsm_heading,
            "post_excerpt"          => '',
            "post_status"           => "active",
            "comment_status"        => "open",
            "ping_status"           => "closed",
            "post_password"         => "",
            "post_name"             => $ewm_new_mainllt_name,
            "to_ping"               => "",
            "pinged"                => "",
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content_filtered" => "",
            "post_parent"           => $ewmdsm_heading,
            "guid"                  => "",
            "menu_order"            => 0,
            "post_type"             => "ewm_main_llt",
            "post_mime_type"        => "",
            "comment_count"         => "0",
            "filter"                => "raw",
        ];
        global  $wp_error ;
        $post_id = wp_insert_post( $post_data, $wp_error );
        return $post_id;
    }
    
    public static function update_llt_posts( $args = array() )
    {
        $_POST['ewmdsm_heading'];
        $_POST['ewmdsm_content'];
        $_POST['ewmdsm_main_id'];
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $args['ewmdsm_heading'] );
        $post_data = [
            "ID"                => $args['ewmdsm_main_id'],
            "post_author"       => $current_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $args['ewmdsm_content'],
            "post_title"        => $args['ewmdsm_heading'],
            "post_status"       => "active",
            "comment_status"    => "open",
            "post_name"         => $ewm_new_mainllt_name,
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_type"         => "ewm_main_llt",
            "comment_count"     => "0",
        ];
        global  $wp_error ;
        $post_id = wp_update_post( $post_data, $wp_error );
        return $post_id;
    }
    
    public static function update_llt_locations( $args = array() )
    {
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $args['ewmdsm_location_name'] );
        // ewmdsm_location_name
        // ewmdsm_post_id
        $post_data = [
            "ID"                => $_POST['ewmdsm_post_id'],
            "post_author"       => $current_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $args['ewmdsm_location_name'],
            "post_title"        => $args['ewmdsm_location_name'],
            "post_status"       => "active",
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
        ];
        global  $wp_error ;
        $post_id = wp_update_post( $post_data, $wp_error );
        /*
        foreach( $ewm_swo_meta_list as $dpm_key => $dpm_value){
            $if_unique = false;    
            add_post_meta( $post_id, $dpm_key , $dpm_value, $if_unique );
        }
        */
        return $post_id;
    }
    
    public static function create_llt_locations( $args = array() )
    {
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $args['ewmdsm_location_name'] );

        // ewmdsm_location_name
        // ewmdsm_post_id
        $post_data = [
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $args['ewmdsm_location_name'],
            "post_title"            => $args['ewmdsm_location_name'],
            "post_excerpt"          => '',
            "post_status"           => "active",
            "comment_status"        => "open",
            "ping_status"           => "closed",
            "post_password"         => "",
            "post_name"             => $ewm_new_mainllt_name,
            "to_ping"               => "",
            "pinged"                => "",
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content_filtered" => "",
            "post_parent"           => $_POST['ewmdsm_post_group'],
            "guid"                  => "",
            "menu_order"            => 0,
            "post_type"             => "ewm_local_llt",
            "post_mime_type"        => "",
            "comment_count"         => "0",
            "filter"                => "raw",
        ];

        global  $wp_error ;
        $post_id = wp_insert_post( $post_data, $wp_error );

        /*        
        foreach( $ewm_swo_meta_list as $dpm_key => $dpm_value){
            $if_unique = false;    
            add_post_meta( $post_id, $dpm_key , $dpm_value, $if_unique );
        }
        */
        
        return $post_id;
    }


    public static function update_llt_locations_group( $args = array() )
    {
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $args['ewmdsm_location_name'] );
        // ewmdsm_location_name
        // ewmdsm_post_id
        $post_data = [
            "ID"                => $_POST['ewmdsm_post_id'],
            "post_author"       => $current_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $args['ewmdsm_location_name'],
            "post_title"        => $args['ewmdsm_location_name'],
            "post_status"       => "active",
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
        ];
        global  $wp_error ;
        $post_id = wp_update_post( $post_data, $wp_error );
        /*
        foreach( $ewm_swo_meta_list as $dpm_key => $dpm_value){
            $if_unique = false;    
            add_post_meta( $post_id, $dpm_key , $dpm_value, $if_unique );
        }
        */
        return $post_id;
    }
    
    public static function create_llt_locations_group( $args = array() )
    {
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $args['ewmdsm_location_name'] );

        // ewmdsm_location_name
        // ewmdsm_post_id
        $post_data = [
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $args['ewmdsm_location_name'],
            "post_title"            => $args['ewmdsm_location_name'],
            "post_excerpt"          => '',
            "post_status"           => "active",
            "comment_status"        => "open",
            "ping_status"           => "closed",
            "post_password"         => "",
            "post_name"             => $ewm_new_mainllt_name,
            "to_ping"               => "",
            "pinged"                => "",
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content_filtered" => "",
            "post_parent"           => '',
            "guid"                  => "",
            "menu_order"            => 0,
            "post_type"             => "ewmLocalGroup",
            "post_mime_type"        => "",
            "comment_count"         => "0",
            "filter"                => "raw",
        ];

        global  $wp_error ;
        $post_id = wp_insert_post( $post_data, $wp_error );

        /*        
        foreach( $ewm_swo_meta_list as $dpm_key => $dpm_value){
            $if_unique = false;    
            add_post_meta( $post_id, $dpm_key , $dpm_value, $if_unique );
        }
        */
        
        return $post_id;

    }

    public static function ajax_save_location_group_post()
    {

        $post_id = 0;

        if ( $_POST['ewmdsm_post_id'] == '0' ) {
            $post_id = EwmLLT::create_llt_locations_group( $_POST );
        } else {
            $post_id = EwmLLT::update_llt_locations_group( $_POST );
        }

        echo  json_encode( [
            'content' => $_POST,
            'postid'  => $post_id,
        ] ) ;

        wp_die();

    }
    
    public static function ajax_save_location_post()
    {

        $post_id = 0;        

        $title = $_POST['ewmdsm_location_name'] ;
        $args = array(
            "post_type" => "ewm_local_llt",
            "post_status" => "active",
            "posts_per_page" => "-1",
            "s" => $title
        );

        $query = get_posts( $args ) ;

        if( count( $query ) == 0 ){
            $_POST['ewmdsm_post_id'] = '0' ;
        }

        $args_list = [] ;

        if ( $_POST['ewmdsm_post_id'] == '0' ) {
            $post_id = EwmLLT::create_llt_locations( $_POST );
        } else {
            $post_id = EwmLLT::update_llt_locations( $_POST );
        }
        
        $ewm_location_id = EwmLLT::add_location_to_group( [
            'ewm_args_post_name' => $_POST['ewmdsm_location_name'],
            'ewm_args_post_id' =>  $post_id,
            'ewmdsm_post_group_id' => $_POST['ewmdsm_post_group'],
        ] );
        
        echo  json_encode( [
            'content' => $_POST,
            'postid'  => $post_id,
        ] );

        wp_die();

    }
    
    /*
        if ($_POST['main_id'] == 0) {
            $post_id = EwmLLT::create_llt_posts($_POST);
        } else {
    */
    public static function ajax_save_main_post()
    {
        $post_id = EwmLLT::update_llt_posts( $_POST );
        echo  json_encode( [
            'content' => $_POST,
            'postid'  => $post_id,
        ] ) ;
        wp_die();
    }
    
    public static function ewm_dpm_create_keyword_post()
    {
        $args_user_id = get_current_user_id();
        $ewmdsm_location_id = $_POST['ewmdsm_location_id'];
        $ewmdsm_main_llt_id = $_POST['ewmdsm_main_llt_id'];
        $ewmdsm_location_status = $_POST['ewmdsm_location_status'];
        $ewmdsm_keyword_name = $_POST['ewmdsm_keyword_name'];
        // $ewmdsm_keyword_id   = $_POST['ewmdsm_keyword_id'];
        // $ewmdsm_status       = $_POST['ewmdsm_status'];
        $ewmdsm_random_id = $_POST['ewmdsm_random_id'];
        // create new post of post type 'ewm_dpm_keyword'
        $post_data = [
            "post_author"       => $args_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $ewmdsm_keyword_name,
            "post_title"        => $ewmdsm_keyword_name,
            "post_status"       => "publish",
            "comment_status"    => "closed",
            "ping_status"       => "closed",
            "post_name"         => $ewmdsm_keyword_name,
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_parent"       => $ewmdsm_main_llt_id,
            "post_type"         => "ewmkeyword",
            "comment_count"     => "0",
        ];
        global  $wp_error ;
        $keyword_llt_id = wp_insert_post( $post_data, $wp_error );
        // add post meta 'ewm_dpm_radom_id'
        // add post meta 'llt_locations'
        $ewm_dpm_mea_list = [
            'ewm_dpm_radom_id' => $ewmdsm_random_id,
            'llt_locations'    => [
            $ewmdsm_location_id => $ewmdsm_location_status,
        ],
        ];
        foreach ( $ewm_dpm_mea_list as $ewm_dpm_key => $ewm_dpm_val ) {
            add_post_meta(
                $keyword_llt_id,
                $ewm_dpm_key,
                $ewm_dpm_val,
                true
            );
        }
        return $keyword_llt_id;
    }
    
    public static function new_keyword_location_is()
    {
        $ewmdsm_location_id = $_POST['ewmdsm_location_id'];
        $ewmdsm_main_llt_id = $_POST['ewmdsm_main_llt_id'];
        $ewmdsm_location_status = $_POST['ewmdsm_location_status'];
        $ewmdsm_keyword_name = $_POST['ewmdsm_keyword_name'];
        $ewmdsm_keyword_id = $_POST['ewmdsm_keyword_id'];
        $ewmdsm_status = $_POST['ewmdsm_status'];
        $ewmdsm_random_id = $_POST['ewmdsm_random_id'];
        $v_post_arr = get_posts( [
            'post_status' => 'published',
            'meta_query'  => [ [
                'relation' => 'AND',
                [
                'key'     => 'ewm_dpm_radom_id',
                'value'   => $ewmdsm_random_id,
                'compare' => '=',
            ],
            ] ],
        ] );
        // Check if a post for this new exists. If it does update. If it does not create one.
        
        if ( count( $v_post_arr ) > 0 ) {
            // Update from the random meta
            $keyword_llt_id = $v_post_arr[0]->ID;
            // Get location meta data from existing key word post
            $llt_locations = maybe_unserialize( get_post_meta( $keyword_llt_id, 'llt_locations', true ) );
            
            if ( is_array( $llt_locations ) ) {
                // Add the feature
                $llt_locations[$ewmdsm_location_id] = $ewmdsm_location_status;
                $status_d = update_post_meta( $keyword_llt_id, 'llt_locations', $llt_locations );
            } else {
                // Create feature list
                $llt_locations = [];
                $llt_locations[$ewmdsm_location_id] = 'true';
                $status_d = add_post_meta(
                    $keyword_llt_id,
                    'llt_locations',
                    $llt_locations,
                    true
                );
            }
        
        } else {
            // Create new post with random meta
            $ewm_dpm_post_id = EwmLLT::ewm_dpm_create_keyword_post();
        }
        
        return $ewm_dpm_post_id;
    }
    
    public static function update_keyword_location_is( $args )
    {
        /*
        form_data.append( 'ewmdsm_location_id', args.location_id );
        		form_data.append( 'ewmdsm_main_llt_id', args.main_llt_id );
        		form_data.append( 'ewmdsm_location_status', args.location_status );
        form_data.append( 'ewmdsm_keyword_name', args.keyword_name );
        form_data.append( 'ewmdsm_keyword_id', args.keyword_id );
        form_data.append( 'ewmdsm_status', args.status );
        form_data.append( 'ewmdsm_random_id', args.random_id );
        */
        $ewmdsm_location_id = $_POST['ewmdsm_location_id'];
        $ewmdsm_main_llt_id = $_POST['ewmdsm_main_llt_id'];
        $ewmdsm_location_status = $_POST['ewmdsm_location_status'];
        // $ewmdsm_keyword_name = $_POST['ewmdsm_keyword_name'];
        // $ewmdsm_keyword_id = $_POST['ewmdsm_keyword_id'];
        // $ewmdsm_status = $_POST['ewmdsm_status'];
        // $ewmdsm_random_id    = $_POST['ewmdsm_random_id'];
        // $location_id         = $_POST['ewmdsm_location_id'];
        // $main_llt_id         = $_POST['ewmdsm_main_llt_id'];
        $location_status = $_POST['ewmdsm_location_status'];
        // get location meta data // Update the post meta
        $llt_locations = maybe_unserialize( get_post_meta( $ewmdsm_main_llt_id , 'llt_locations', true ) );
        
        if ( is_array( $llt_locations ) ) {
            // Add the feature
            $llt_locations[$ewmdsm_location_id] = $ewmdsm_location_status;
            $status_d = update_post_meta( $ewmdsm_main_llt_id, 'llt_locations', $llt_locations );
        } else {
            // Create feature list
            $llt_locations = [];
            $llt_locations[$ewmdsm_location_id] = 'true';
            $status_d = add_post_meta(
                $ewmdsm_main_llt_id,
                'llt_locations',
                $llt_locations,
                true
            );
        }
        
        return $status_d;
    }
    
    public static function ajax_save_main_locations()
    {
        /*if( $_POST['ewm_llt_keyword_id'] > 0 ){
              $keyword_id = EwmLLT::new_keyword_location_is( $_POST );
          }
          else{*/
        $keyword_id = EwmLLT::update_keyword_location_is( $_POST );
        //}
        echo  json_encode( [
            'keyword_id' => $keyword_id,
            'post'       => $_POST,
        ] ) ;

        wp_die();
    }
    
    public static function new_item_post( $args )
    {
        $keyword_id = 0;
        $keyword_name = '';
        $location_id = 0;
        // return new post id
        // update_post
        // $keyword_data  = get_post($args['keyword_id']);
        // $keyword_data->post_title;
        $post_data = [
            "post_author"       => $args['user_id'],
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $args['new_content'],
            "post_title"        => $args['new_title'],
            "post_status"       => "publish",
            "comment_status"    => "closed",
            "ping_status"       => "closed",
            "post_name"         => $args['ewm_dpm_item_name'],
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_parent"       => $args['main_id'],
            "comment_count"     => "0",
            'meta_input'        => array(
            'ewm_dpm_location_id' => $args['location_id'],
            'ewm_dpm_keyword_id'  => $args['keyword_id'],
            'ewm_dpm_post_type'   => 'llt_child',
        ),
        ];
        global  $wp_error ;
        $post_id = wp_insert_post( $post_data, $wp_error );
        return get_post( $post_id );
    }
    
    public static function create_new_item_post( $args ){

        /*
            'location_id' => $args['location']->ID,
            'main_id'     => $args['main']->ID,
            'keyword_id'  => $args['keyword']->ID,
            'new_title'   => $post_title,
            'new_content' => $post_content,
            'categories'  => $cat_list_IDs,
        */

        // check if the post is created, if not create one
        // $create_new_post = true;
        $post_id = '';
        // main post => location post
        // parent_id = main_id
        // meta_query = 'location_id' => location id

        /* 
            'location_id'   => $args['location']->ID,
            'main_id'       => $args['main']->ID,
            'new_title'     => $post_title ,
            'new_content'   => $post_content,
        */

        $current_user_id = get_current_user_id();
        $ewm_dpm_item_name = '';

        $_item_posts = get_posts( [
            'post_parent' => $args['main_id'],
            "post_status" => "publish",
            'meta_query'  => [ 
                [
                    'relation' => 'AND',
                    [
                        'key'     => 'ewm_dpm_location_id',
                        'value'   => $args['location_id'],
                        'compare' => '=',
                    ] /*,
                    [
                        'key'     => 'ewm_dpm_keyword_id',
                        'value'   => $args['keyword_id'],
                        'compare' => '=',
                    ], */
                ]
            ],
        ] );

        /*
        foreach($_item_posts as $titem_k => $titem_v){
            echo 'location details id: ';
            var_dump( get_post_meta( $titem_v->ID, 'ewm_dpm_location_id', true ) );
            wp_delete_post(  $titem_v->ID );
        }
        */
        
        if ( count( $_item_posts ) > 0 ) {
            $post_id = $_item_posts[0]->ID;
            $post_ = $_item_posts[0];
        } else {
            $args['user_id'] = get_current_user_id();
            $args['ewm_dpm_item_name'] = $ewm_dpm_item_name;
            $post_ = EwmLLT::new_item_post( $args );
            $post_id = $post_->ID;
        }
        
        // if it does not exist create the item post
        // use child post id to update the post
        // update_post
        $post_data = [
            "ID"                => $post_id,
            "post_author"       => $current_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $args['new_content'],
            "post_title"        => $args['new_title'],
            "post_name"         => $args['new_title'],
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_category"     => $args['categories'],
            'post_parent'       => $args['main_id'],
        ];

        global  $wp_error ;
        $update_status = wp_update_post( $post_data, $wp_error );
        
        update_post_meta(
            $post_id,
            'ewm_dpm_post_type',
            'llt_child',
            true
        ) ;

        return [
            'status'  => $update_status,
            'post_id' => $post_id,
        ] ;

    }
    
    public static function get_single_get_id( $category_name ){

        // if the category exists? return existing : alternatively create new category and return it's it.
        $category_name_slug = str_replace( "-", " ", $category_name );
        $cat_id = '';
        $term_exists_id = term_exists( $category_name );
        
        if ( !$term_exists_id ) {
            $cat_id = wp_insert_term( $category_name, 'category', array(
                'description' => $category_name,
                'slug'        => $category_name_slug,
            ) );
            $term_exists_id = $cat_id["term_id"];
        }
        
        return $term_exists_id;

    }
    
    public static function get_cat_lists( $args ){

        $resulting_id_list = [];
        foreach ( $args as $cat_key => $cat_value ) {
            $cat_value_id = EwmLLT::get_single_get_id( $cat_value );
            $resulting_id_list[$cat_value_id] = $cat_value_id;
        }

        return $resulting_id_list;

    }
    
    public static function convert_each_location( $args ){

        /*
            'location' => $post_location_,
            'keyword' => $__main_llt_post, // $single_keyword,
            'location_id' => $sub_v->ID,
            'main' => $__main_llt_post,
            'keyword_id' => $__main_llt_post->ID,
            'post' => [
                'title'   => $__main_llt_post->post_title,
                // 'content' => $__main_llt_post->post_content,
            ],
        */

        $main_id = $args['main']->ID ;
        $post_content = EwmLLT::generate_content_sec_content( [
            'ewm_llt_id' => $main_id,
            'location' => $args['location']->post_title,
        ] );

        // $args['post']['content'] = '';
        // convert post to add location
        $post_title_l = str_replace( "[LLT_Location]", $args['location']->post_title, $args['post']['title'] );
        // $post_content_l = str_replace( "[LLT_Location]", $args['location']->post_title, $post_content );

        // convert post to add keyword
        $post_title =  $post_title_l ; //str_replace( "[LLT_Keyword]", $args['keyword']->post_title, $post_title_l );
        $post_content = $post_content ; //$post_content_l ; // str_replace( "[LLT_Keyword]", $args['keyword']->post_title, $post_content_l );

        $cat_list = [
            'location_cat' => $args['location']->post_title,
            // 'keyword_cat'  => $args['keyword']->post_title,
        ];

        $cat_list_IDs = EwmLLT::get_cat_lists( $cat_list );

        // $args['ewm_llt_id'] // $args['location']
        // save the content ad individual posts - location id, main id,
        $location_arr = EwmLLT::create_new_item_post( [
            'location_id' => $args['location']->ID,
            'main_id'     => $args['main']->ID,
            'keyword_id'  => $args['keyword']->ID,
            'new_title'   => $post_title,
            'new_content' => $post_content,
            'categories'  => $cat_list_IDs,
        ] );

        // update the content on the meta
        return [
            'title' => $post_title,
            // 'content'      => $post_content,
            // 'location_arr' => $location_arr,
            'link' => admin_url( 'post.php?post=' . $location_arr['post_id'] . '&action=edit' )
        ];
        
    }
    
    public static function convert_each_keyword( $args = array() ){

        $single_keyword = $args['keyword_data'];
        $llt_locations = maybe_unserialize( get_post_meta( $single_keyword->ID, 'llt_locations', true ) );
        $keyword_id = $single_keyword->ID;
        $ewm_llt_item_list = [];
        $__main_llt_post = $args[ 'main' ];
        $item_index_id = 0;

        if( is_string($llt_locations) ) {
            $llt_locations = [];
        }

        foreach( $llt_locations as $location_k => $location_v ) {

            if( $location_v == true ) {
                $ewm_location_l = get_post_meta( $location_k , 'ewm_location_l', true );
                if( is_string( $ewm_location_l ) ){
                    $ewm_location_l = [];
                }

                foreach($ewm_location_l as $_k => $status_v) {
                    if($status_v == 'true') {
                        $post_location_  = get_post($_k);
                        $ewm_llt_item_list[ $item_index_id ] = EwmLLT::convert_each_location( [
                            'location' => $post_location_,
                            'keyword' => $__main_llt_post,
                            'location_id' => $_k,
                            'main' => $__main_llt_post,
                            'keyword_id' => $__main_llt_post->ID,
                            'post' => [
                                'title'   => $__main_llt_post->post_title,
                            ],
                        ] );
                    }
                    $item_index_id++;
                }
            }
        }

        global  $wp_rewrite ;
        $wp_rewrite->flush_rules( true );

        return $ewm_llt_item_list;

    }
    
    public static function ajax_generate_main_llt( $args = [] ){
        
        // $__main_llt_post = get_post( $_POST['ewmdsm_main_llt_id'] );
        // convert keyword
        /*$post_parent_list_keyword = get_posts([
            "post_status" => "publish",
            "post_parent" => $_POST['ewmdsm_main_llt_id'],
            "post_type"   => "ewmkeyword",
        ]); */

        // $_POST['ewmdsm_main_llt_id'] = get_post( $args['ewmdsm_main_llt_id'] );
        $ewmdsm_main_llt_d = get_post( $_POST['ewmdsm_main_llt_id'] );
        $_keyword_index = 0;
        $keyword_dat = [];

        // foreach ( $post_parent_list_keyword as $k_list => $v_list ) {

        $location_list = EwmLLT::convert_each_keyword([
            'keyword_data' => $ewmdsm_main_llt_d, //$v_list,
            'main' => $ewmdsm_main_llt_d,
        ]);

        // return the final content to the client
        $keyword_dat[$_keyword_index] = [
            'keyword'       => [ 'title' => $ewmdsm_main_llt_d->post_title ],
            'location_list' => $location_list,
        ] ;
        // $_keyword_index++;

        // }

        echo  json_encode([
            'main_id'      => $_POST['ewmdsm_main_llt_id'],
            'keyword_list' => $keyword_dat,
        ]) ;

        wp_die();
    }
    
    public static function register_new_post()
    {
        $post_type = 'ewmllt';
        register_post_type( $post_type, array(
            'labels'       => array(
            'name'          => 'ewmllt',
            'singular_name' => 'ewmllt',
        ),
            'public'       => true,
            'has_archive'  => true,
            'show_in_menu' => 'admin.php?page=ewm-dpm-lltitem',
        ) );
    }
    
    public static function add_seo_titles()
    {
        $ewm_post_detail = get_post();
        // var_dump($ewm_post_detail);
        $ewm_dpm_location_id = get_post_meta( $ewm_post_detail->ID, 'ewm_dpm_location_id', true );
        $ewm_dpm_location_post = get_post( $ewm_dpm_location_id );
        $site_name = '';
        $ewm_s_f_industry = get_option( 'ewm_s_f_industry' );
        ?>

        
<script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "industry": {
                    "@type": "DefinedTerm",
                    "termCode": "238220",
                    "name": "<?php echo  $ewm_s_f_industry ; ?>",
                    "url": "https://www.naics.com/naics-code-description/?code=238220",
                    "inDefinedTermSet": "NAICS (North American Industry Classification System)"
                }
            }                
        </script>


    <?php 
    }
    
    public static function installation_times()
    {
        flush_rewrite_rules();
    }
    
    public static function ajax_settings_save()
    {
        update_option( 'ewm_s_f_industry', $_POST['ewm_setting_f_industry'] );
        echo  json_encode( $_POST ) ;
        wp_die();
    }
    
    public static function ajax_create_keyword()
    {
        // keyword id
        $ewm_llt_main_id = $_POST['ewm_llt_main_id'];
        $ewm_dpm_status = $_POST['status'];
        $args_user_id = get_current_user_id();
        $ewmdsm_main_llt_id = $_POST['ewmdsm_main_llt_id'];
        $ewmdsm_keyword_name = $_POST['ewmdsm_keyword_name'];
        $ewmdsm_random_id = $_POST['ewmdsm_random_id'];
        // create new post of post type 'ewm_dpm_keyword'
        $post_data = [
            "post_author"       => $args_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $ewmdsm_keyword_name,
            "post_title"        => $ewmdsm_keyword_name,
            "post_status"       => "publish",
            "comment_status"    => "closed",
            "ping_status"       => "closed",
            "post_name"         => $ewmdsm_keyword_name,
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_parent"       => $ewm_llt_main_id,
            "post_type"         => "ewmkeyword",
            "comment_count"     => "0",
        ];
        global  $wp_error ;
        $keyword_llt_id = wp_insert_post( $post_data, $wp_error );
        $ewm_dpm_mea_list = [
            'ewm_dpm_radom_id' => $ewmdsm_random_id,
            'llt_locations'    => [],
        ];
        foreach ( $ewm_dpm_mea_list as $ewm_dpm_key => $ewm_dpm_val ) {
            add_post_meta(
                $keyword_llt_id,
                $ewm_dpm_key,
                $ewm_dpm_val,
                true
            );
        }
        //return $keyword_llt_id;
        echo  json_encode( [
            'post_id' => $keyword_llt_id,
            'post'    => $_POST,
        ] ) ;
        wp_die();
    }
    
    public static function ajax_update_keyword()
    {
        // keyword id
        $ewm_llt_main_id = $_POST['ewm_llt_main_id'];
        $ewm_dpm_status = $_POST['status'];
        $args_user_id = get_current_user_id();
        $ewmdsm_main_llt_id = $_POST['ewmdsm_main_llt_id'];
        $ewmdsm_keyword_name = $_POST['ewmdsm_keyword_name'];
        $ewmdsm_random_id = $_POST['ewmdsm_random_id'];
        // create new post of post type 'ewm_dpm_keyword'
        $post_data = [
            "ID"                => $_POST['ewm_dpm_active_keywords_id'],
            "post_author"       => $args_user_id,
            "post_date"         => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content"      => $ewmdsm_keyword_name,
            "post_title"        => $ewmdsm_keyword_name,
            "post_status"       => $ewm_dpm_status,
            "comment_status"    => "closed",
            "ping_status"       => "closed",
            "post_name"         => $ewmdsm_keyword_name,
            "post_modified"     => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt" => date( 'Y-m-d H:i:s' ),
            "post_parent"       => $ewm_llt_main_id,
            "post_type"         => "ewmkeyword",
            "comment_count"     => "0",
        ];
        global  $wp_error ;
        $keyword_llt_id = wp_update_post( $post_data, $wp_error );
        foreach ( $ewm_dpm_mea_list as $ewm_dpm_key => $ewm_dpm_val ) {
            update_post_meta(
                $keyword_llt_id,
                $ewm_dpm_key,
                $ewm_dpm_val,
                true
            );
        }
        //return $keyword_llt_id;
        echo  json_encode( [
            'post_id' => $keyword_llt_id,
            'post'    => $_POST,
        ] ) ;
        wp_die();
    }
    
    public static function ajax_delete_keyword()
    {
        $_keywords_status = wp_delete_post( $_POST['ewm_dpm_keywords_id'] );
        echo  json_encode( [
            'keywords_status' => $_keywords_status,
            'post'            => $_POST,
        ] ) ;
        wp_die();
    }
    
    public static function delete_main_post( $args = array() )
    {
        $ewm_data_main_post = wp_delete_post( $_POST['ewm_data_main_post_id'] );
        return $ewm_data_main_post;
    }
    
    public static function ajax_delete_main_post_keyword()
    {
        $_main_post_id = $_POST['ewm_data_main_post_id'];
        //delete main post
        $main_status = EwmLLT::delete_main_post();
        //delete keyword post
        $ewm_keyword_post_list = get_posts( [
            "post_parent" => $_main_post_id,
            "post_type"   => "ewmkeyword",
        ] );
        foreach ( $ewm_keyword_post_list as $keyword_key => $keyword_value ) {
            wp_delete_post( $keyword_value->ID );
        }
        echo  json_encode( [
            'post'           => $_POST,
            'main_status'    => $main_status,
            'keyword_status' => count( $ewm_keyword_post_list ),
        ] ) ;        
        wp_die();
    }
    
    public static function ajax_delete_location()
    {

        $ewm_llt_location_post = wp_delete_post( $_POST['ewm_llt_location_post_id'] );
        echo  json_encode([
            'past_data' => $ewm_llt_location_post,
            'post'      => $_POST,
        ]) ;

    }

    public static function ewmNewSectionPost(){

        $ewmdsm_content = 'Content';
        $ewmdsm_heading = 'Title';

        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $ewmdsm_heading );

        $post_data = [
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $ewmdsm_content,
            "post_title"            => $ewmdsm_heading,
            "post_excerpt"          => '',
            "post_status"           => "preactive",
            "comment_status"        => "open",
            "ping_status"           => "closed",
            "post_password"         => "",
            "post_name"             => $ewm_new_mainllt_name,
            "to_ping"               => "",
            "pinged"                => "",
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content_filtered" => "",
            "post_parent"           => $_POST['ewmParentId'],
            "guid"                  => "",
            "menu_order"            => 0,
            "post_type"             => "ewmPSection",
            "post_mime_type"        => "",
            "comment_count"         => "0",
            "filter"                => "raw",
        ];

        global  $wp_error ;
        $post_id = wp_insert_post( $post_data, $wp_error );

        return $post_id;

    }

    public static function ajax_ewmCreateNewPSection(){

        $ewmNewSectionPostID = EwmLLT::ewmNewSectionPost();

        // TODO create child posts
        echo json_encode([
            'post'      => $_POST,
            'section_id'=> $ewmNewSectionPostID
        ]);

        wp_die();
        
    }

    public static function ajax_ewmGetPSection(){

        $ewmSectionData = get_post( $_POST['ewmSectionId'] );
        $ewmImageURL = get_post_meta( $_POST['ewmSectionId'],  'ewmImageURL' );
        $ewmService = get_post_meta( $_POST['ewmSectionId'],  'ewmService' );

        if( is_array( $ewmService ) ){
            if( array_key_exists( 0, $ewmService ) ) {
                $ewmService = $ewmService[0];
            }
        }

        if( is_array( $ewmImageURL ) ){
            if( array_key_exists( 0, $ewmImageURL ) ) {
                $ewmImageURL = $ewmImageURL[0];
            }
        }

        echo json_encode( [
            'post' => $_POST,
            'ewmSectionData' => $ewmSectionData,
            'ewmTitle' => $ewmSectionData->post_title ,
            'ewmContent' => $ewmSectionData->post_content,
            'ewmImage' => $ewmImageURL,
            'ewmService' => $ewmService
        ] );

        wp_die();

    }

    public static function renameImage( $args ){ // $args['post_id'] // $args['location'];

        $path2 = '';
        $name2 = '';

        $ewmImageURL = get_post_meta( $args['post_id'] , 'ewmImageURL', true );
        $ewmService = get_post_meta( $args['post_id'] , 'ewmService', true );

        $ewmLocation = $args['location'];

        if( is_string( $ewmImageURL ) && is_string( $ewmService ) ) {

            if( strlen( $ewmImageURL ) > 0 && strlen( $ewmService ) > 0 ) {
                $wordpress_media_attachment_id = attachment_url_to_postid( $ewmImageURL );
            }
            else{
                return [
                    'img_src' => $path2,
                    'img_alt' => $name2,
                    'has_img' => false,
                ];
            }

        }
        else{

            return [
                'img_src' => $path2,
                'img_alt' => $name2,
                'has_img' => false,
            ];

        }

        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        $wp_upload_dir = wp_upload_dir();
        $imgMeta = wp_get_attachment_metadata( $wordpress_media_attachment_id ); // var_dump($wordpress_media_attachment_id); // var_dump($imgMeta);
        $imgMime = $imgMeta[ 'sizes' ][ 'thumbnail' ][ 'mime-type' ];
        $absolutePath = "$wp_upload_dir[basedir]/$imgMeta[file]"; // $name = basename( $imgMeta['file'] );
        $service = $ewmService ; // mt_rand(); // service

        $ewmImageURL_l = str_replace( '/', '_', $ewmImageURL );
        $name2 = 'Image-'.$service.'-'.$ewmLocation.'-'.$args['post_id'].'-'. $args['parent_id'] .'-' . $ewmImageURL_l ; // service + location
        $path2 = "$wp_upload_dir[path]/$name2.png" ; // $absolutePath2 = "$wp_upload_dir[basedir]/$name2.png";
        
        if( !file_exists( $path2 ) ) { // Check if the file exists > if it exists > use the existing > and use the new

            @copy( $absolutePath , $path2 ) ;
            chmod( $path2, 0777 ) ;

            $attachment = array(
                'guid'=> "$wp_upload_dir[url]/$path2",
                'post_mime_type' => $imgMime,
                'post_title' => $name2,
                'post_content' => $name2,
                'post_status' => 'inherit'
            ) ;

            $image_id = wp_insert_attachment( $attachment, $path2 ) ;
            $attach_data = wp_generate_attachment_metadata( $image_id, $path2 ) ;
            wp_update_attachment_metadata( $image_id, $attach_data ) ;

        }

        $path2_url = str_replace(
            wp_get_upload_dir()['basedir'],
            wp_get_upload_dir()['baseurl'],
            $path2
        );

        $renamedImage = [
            'img_src' => $path2_url,
            'img_alt' => $ewmImageURL , // $name2,
            'has_img' => true,
        ];

        return $renamedImage;

    }

    public static function ewmPGetUniqueIMG( $args = [] ) { // post id //

        // $ewmImgID = ''
        // $ewmImgID
        // get image url
        // rename image $ save 
        // save and return as img tag
        // water heater [location 1]
        // $ewmImageURL = get_post_meta( $args['post_id'] , 'ewmImageURL' );
        // $ewmService = get_post_meta( $args['post_id'] , 'ewmService' );

        $img_src = '' ;
        $img_alt = '' ;
        $wordpress_media_attachment_id = 0;

        $renamedImage = EwmLLT::renameImage( [
            'post_id' => $args['post_id'],
            'location' => $args['location'],
            'parent_id' => $args['parent_id'],
        ] );

        /*
        $renamedImage = [
            'img_src' => '',
            'img_alt' => '',
            'has_img' => false
        ];
        */

        $img_src = $renamedImage['img_src'];
        $img_alt = $renamedImage['img_alt'];

        // on the original section post 
        // - add duplicate image & add alt text

        if( $renamedImage['has_img'] == true ) {
            // return '<img src="'.$renamedImage['img_src'].'" class="ewmImageDisplay">';
            return '<div style="width:100%;">
                <img src="'.$renamedImage['img_src'].'" alt="'.$renamedImage['img_alt'].'">
            </div>';
        }
        else{
            return '';
        }

    }

    public static function generate_content_sec_content( $args = [] ){ // $args['ewm_llt_id'] // $args['location']

        $ewmPSections = get_posts( [
            "post_status" => "active",
            "post_parent" => $args['ewm_llt_id'],
            "post_type" => "ewmPSection",
            "posts_per_page" => "-1",
            "orderby" => "ID",
            "order" => "ASC", // "DESC", // ASC
        ] );

        $ewmPSections_HTML = '';

        $ewm_header_number = 2;

        foreach( $ewmPSections as $ewmPSect_k => $ewmPSect_v ){

            $first_h = '<div><h'.$ewm_header_number.'>';
            $last_h = '</h'.$ewm_header_number.'></div>';
            // id // title str_replace( "[LLT_Location]", $args['location']->post_title, $post_content )
            $ewmPSections_HTML .= $first_h.''. str_replace( "[LLT_Location]", $args['location'] , $ewmPSect_v->post_title ).''.$last_h;
            // paragraph
            $ewmPSections_HTML .= '<div>'. str_replace( "[LLT_Location]", $args['location'] , $ewmPSect_v->post_content ) .'</div>';
            // image
            $ewmIMG_URL = EwmLLT::ewmPGetUniqueIMG([
                'post_id' => $ewmPSect_v->ID,
                'location' => $args['location'],
                'parent_id' => $args['ewm_llt_id']
            ]); // $ewmPSect_v->ID );

            // echo '<br><br>Url:<br>'; // var_dump($ewmIMG_URL); // echo '<br><br><br>';
            $ewmPSections_HTML .= '<div>'. $ewmIMG_URL .'</div>';
            // $ewmPSections_HTML .= 'Post id: ' . $ewmPSect_v->ID;
            if( $ewm_header_number < 6 ) {
                $ewm_header_number++;   
            }

        }
        // var_dump($ewmPSections_HTML);

        return $ewmPSections_HTML;

    }

    public static function update_single_section_p( $args = [] ){

        $ewmdsm_heading = $_POST['ewm_llt_header_input_full'];
        $ewmdsm_content = $_POST['ewm_llt_content'];

        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $ewmdsm_heading );

        $post_data = [
            'ID'                    => $args['ewm_post_id'],
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $ewmdsm_content,
            "post_title"            => $ewmdsm_heading,
            "post_excerpt"          => '',
            "post_status"           => "active",
            "comment_status"        => "open",
            "ping_status"           => "closed",
            "post_password"         => "",
            "post_name"             => $ewm_new_mainllt_name,
            "to_ping"               => "",
            "pinged"                => "",
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
            "post_content_filtered" => "",
            "post_parent"           => $_POST['ewmParentId'],
            "guid"                  => "",
            "menu_order"            => 0,
            "post_type"             => "ewmPSection",
            "post_mime_type"        => "",
            "comment_count"         => "0",
            "filter"                => "raw",
        ];

        global  $wp_error;
        $post_id = wp_update_post( $post_data, $wp_error );

        delete_post_meta( $post_id , 'ewmImageURL' );
        update_post_meta( $post_id , 'ewmImageURL', $_POST['ewmImageURL'] );

        delete_post_meta( $post_id , 'ewmService' );
        update_post_meta( $post_id , 'ewmService', $_POST['ewmServiceRightInput'] );

        // generate duplicate image // get duplicate service name
        // $_img_duplicate = EwmLLT::generate_img_duplicate( $args );
        // $args['img_duplicate'] = $_img_duplicate;
        // EwmLLT::generate_parent_children( $args );
        return $post_id;

    }

    public static function ajax_ewmSaveSingleSection(){

        $post_id = EwmLLT::update_single_section_p( $_POST );

        echo json_encode([
            'post'  => $_POST,
            'post_id' => $post_id
        ]);

        wp_die();

    }

    public static function ajax_ewmDeleteParentSection(){

        wp_delete_post( $_POST[ 'ewmSectionId' ] );

        echo json_encode([
            'post' => $_POST,
            'ewmSectionId' => $_POST['ewmSectionId']
        ]);

        wp_die();

    }

    public static function ajax_ewm_llt_main_delete_button_location(){

        // $post_id = wp_delete_post( $_POST['ewm_llt_location_to_delete'] );
        $args = [
            'ewmdsm_post_group_id' => $_POST['ewm_llt_group_id'],
            'ewm_args_post_id' => $_POST['ewm_llt_location_id']
        ] ;

		$ewm_location_l = get_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l', true );

		if( is_array( $ewm_location_l ) ) {
			$ewm_location_l[ $args['ewm_args_post_id'] ] = 'false' ;
			$ewm_location_id = update_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l' , $ewm_location_l );
		}
		else{
			$ewm_location_l = [] ;
			$ewm_location_l[ $args['ewm_args_post_id'] ] = 'false' ;
			$ewm_location_id = add_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l' , $ewm_location_l , true );
		}

        // $post_id = wp_delete_post( $_POST['ewm_llt_location_group_to_delete'] );
        echo json_encode( [
            'post' => $_POST,
            'location_id' => $_POST['ewm_llt_location_id']
        ] );

        wp_die();

    }

    public static function ajax_delete_button_location_group(){

        // return 0;
		/*
        $post_parent_list = get_posts([
			// 'post_parent'   => $args['order_id'],
			"post_type" => "ewm_local_llt",
			"post_status" => "active",
			"posts_per_page" => "-1",
			"post_parent" => $_POST['ewm_llt_location_group_to_delete'],
		]);

        foreach( $post_parent_list  as $ewm_local_llt_k => $ewm_local_llt_v ){
            wp_delete_post( $ewm_local_llt_v->ID );
        }
        */

        $post_id = wp_delete_post( $_POST['ewm_llt_location_group_to_delete'] );

        echo json_encode([
            'post' => $_POST,
            'location_id' => $_POST['ewm_llt_location_group_to_delete']
        ]);

        wp_die();

    }

    public static function ajax_ewmLltDeleteButtonP(){

        wp_delete_post( $_POST['ewm_llt_p_id'] ) ;

    }

    public static function ajax_update_main_llt_title(){

        $ewmdsm_heading = $_POST['ewmdsm_main_llt_title'];
        $ewmdsm_content = '';
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $ewmdsm_heading );

        $post_data = [
            'ID'                    => $_POST['ewmdsm_main_llt_id'],
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => $ewmdsm_content,
            "post_title"            => $ewmdsm_heading,
            "post_name"             => $ewm_new_mainllt_name,
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        ];

        global  $wp_error;
        $post_id = wp_update_post( $post_data, $wp_error );

        echo json_encode([ 'post_id'=>$post_id ]);

        wp_die();

    }

    public static function ajax_ewm_group_update_name(){

        $ewm_group_id = $_POST['ewm_group_id'];
		$ewm_group_name = $_POST['ewm_group_name'];
        $current_user_id = get_current_user_id();
        $ewm_new_mainllt_name = str_replace( "-", " ", $ewm_group_name );
        // $ewmdsm_content = 

        $post_data = [
            'ID'                    => $ewm_group_id,
            "post_author"           => $current_user_id,
            "post_date"             => date( 'Y-m-d H:i:s' ),
            "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
            "post_content"          => 'ewmdsm_content',
            "post_title"            => $ewm_group_name,
            "post_name"             => $ewm_new_mainllt_name,
            "post_modified"         => date( 'Y-m-d H:i:s' ),
            "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        ] ;

        global  $wp_error;
        $post_id = wp_update_post( $post_data, $wp_error );

        echo json_encode([ 
            'post_id' => $post_id ,
            'post' => $_POST
        ]);

        wp_die();

    }

    public static function search_for_similar( $args = [] ){

        $title = $args['search_term'];
        $args = array(
            "post_type" => "ewm_local_llt",
            "post_status" => "active",
            "posts_per_page" => "-1",
            "s" => $title
        );
        $query = get_posts( $args );
        $args_list = [];
        foreach( $query as $s_row => $s_post){
            $args_list[ $s_post->ID ] = $s_post->post_title;
        }

        return $args_list;

    }

    public static function ajax_update_on_search(){

        $search_for_similar = EwmLLT::search_for_similar([
            'search_term' => $_POST['var_to_search'],
        ]);

        echo json_encode([
            'post'          => $_POST,
            'search_list'   => $search_for_similar
        ]);

        wp_die();

    }

    public static function add_location_to_group( $args = [] ){

        // add location as meta description to group
        // get the array from meta.
        // $args['ewm_args_post_name']
        // $args['ewm_args_post_id']
        // $args['ewmdsm_post_group_id']

		$ewm_location_l = get_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l', true );

		if( is_array( $ewm_location_l ) ) {
			// $ewm_location_l = []; //[ $args['ewm_args_post_id'] ] = 'true' ;
			$ewm_location_l[ $args['ewm_args_post_id'] ] = 'true' ;
			$ewm_location_id = update_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l' , $ewm_location_l );
		}
		else{
			$ewm_location_l = [] ;
			$ewm_location_l[ $args['ewm_args_post_id'] ] = 'true' ;
			$ewm_location_id = add_post_meta( $args['ewmdsm_post_group_id'] , 'ewm_location_l' , $ewm_location_l , true );
		}

        return $ewm_location_id ;

    }

    public static function ajax_update_single_location_to_group(){

        $ewm_location_id = EwmLLT::add_location_to_group( [
            'ewm_args_post_name' => $_POST['ewm_args_post_name'],
            'ewm_args_post_id' => $_POST['ewm_args_post_id'],
            'ewmdsm_post_group_id' => $_POST['ewmdsm_post_group_id'],
        ] );
        
        echo json_encode( [
            'post' => $_POST,
            'ewm_location_id' => $ewm_location_id
        ] );

        wp_die();

    }

}

/*
if ( ! function_exists( 'set_external_url_post_link' ) ):
	function set_external_url_post_link( $post_link, $post ) {
		if ( 'ewmllt' === $post->post_type ) {
			$external_url  = $post_link ;//.'mhhhj';//get_post_meta( $post->ID, 'MY_META_KEY', true );
			//if ( 'link' == get_post_format( $post->ID ) && ! empty( $external_url ) ) {
				return $external_url;
			//}
		}
		return $post_link;
	}
	add_filter( 'post_type_link', 'set_external_url_post_link', 10, 2 );
endif;
if ( ! function_exists( 'redirect_url_post_link' ) ):
	function redirect_url_post_link() {
		global $post;
		if ( is_single() && ( 'ewmllt' === get_post_type( $post ) ) ) {
			$external_url  = 'http://workshop-1.com/bb/l-california-k-second-keyword/';
            //get_post_meta( $post->ID, 'MY_META_KEY', true );
			//if ( 'link' == get_post_format( $post->ID ) && ! empty( $external_url ) ) {
				wp_redirect( $external_url );
				exit();
			//}
		}
	}
	// add_action('template_redirect', 'redirect_url_post_link');
endif;
*/

register_activation_hook( __FILE__, 'EWMLLT::installation_times' );
add_action( 'wp_head', 'EwmLLT::add_seo_titles' );
add_action( 'init', 'EwmLLT::register_new_post' );
add_action( "admin_menu", 'EwmLLT::admin_menu' );
add_action( "wp_ajax_ewm_dpm_save_main_post", 'EwmLLT::ajax_save_main_post' );
add_action( "wp_ajax_ewm_dpm_settings_save", 'EwmLLT::ajax_settings_save' );
add_action( "wp_ajax_ewm_dpm_save_location_post", 'EwmLLT::ajax_save_location_post' );
add_action( "wp_ajax_ewm_dpm_save_main_locations", 'EwmLLT::ajax_save_main_locations' );
add_action( "wp_ajax_ewm_dpm_generate_main_llt", 'EwmLLT::ajax_generate_main_llt' );
add_action( "wp_ajax_ewm_dpm_create_keyword", 'EwmLLT::ajax_create_keyword' );
add_action( "wp_ajax_ewm_dpm_update_keyword", 'EwmLLT::ajax_update_keyword' );
add_action( "wp_ajax_ewm_llt_delete_keyword", 'EwmLLT::ajax_delete_keyword' );
add_action( "wp_ajax_ewm_llt_delete_main_post_keyword", 'EwmLLT::ajax_delete_main_post_keyword' );
add_action( "wp_ajax_ewm_llt_delete_location", 'EwmLLT::ajax_delete_location' );
add_action( "wp_ajax_ewmCreateNewPSection", 'EwmLLT::ajax_ewmCreateNewPSection' );
add_action( "wp_ajax_ewmGetPSection", 'EwmLLT::ajax_ewmGetPSection' );
add_action( "wp_ajax_ewmSaveSingleSection", 'EwmLLT::ajax_ewmSaveSingleSection' );
add_action( "wp_ajax_ewm_llt_main_delete_button_location", 'EwmLLT::ajax_ewm_llt_main_delete_button_location' );
add_action( "wp_ajax_ewmDeleteParentSection", 'EwmLLT::ajax_ewmDeleteParentSection' );

add_action( "wp_ajax_ewm_llt_ajax_save_location_group", 'EwmLLT::ajax_save_location_group_post' );
add_action( "wp_ajax_ewm_llt_main_delete_button_location_group", 'EwmLLT::ajax_delete_button_location_group' );
add_action( "wp_ajax_ewm_dpm_update_main_llt_title", 'EwmLLT::ajax_update_main_llt_title' );

add_action( "wp_ajax_ewm_group_update_name", 'EwmLLT::ajax_ewm_group_update_name' );
add_action( "wp_ajax_ewmLltDeleteButtonP", 'EwmLLT::ajax_ewmLltDeleteButtonP' );
add_action( "wp_ajax_ewm_llt_update_on_search", 'EwmLLT::ajax_update_on_search' );
add_action( "wp_ajax_ewm_llt_update_s_l_to_g", 'EwmLLT::ajax_update_single_location_to_group' );

// args.section.data('section-id')
/*
LLT main
    single - LLT list(beaver) - group(locations, key words)
Items - display, edit,
*/
