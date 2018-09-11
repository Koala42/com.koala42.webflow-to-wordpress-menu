<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://koala42.com
 * @since      1.0.0
 *
 * @package    Wf_Wp_Menu
 * @subpackage Wf_Wp_Menu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wf_Wp_Menu
 * @subpackage Wf_Wp_Menu/public
 * @author     KOALA42 <info@koala42.com>
 */
class Wf_Wp_Menu_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wf_Wp_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wf_Wp_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wf-wp-menu-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wf_Wp_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wf_Wp_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wf-wp-menu-public.js', array( 'jquery' ), $this->version, false );

	}


    /**
     * Register Navbar Menu
     *
     * @since   1.0.0
     */
    function register_my_menu() {
        register_nav_menu('navbar-menu',__( 'Navbar Menu' ));
    }

    /**
     * The Webflow to Wordpress menu function for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function nav_menu($theme_location) {

        // tutorial: https://developer.wordpress.org/reference/functions/wp_get_nav_menu_items/
        // check if there are some menus and if the wanted menu exists
        if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {

            $menu_list = "";
            //get all term data from database by term ID, second parametr: taxonomy --> for menus taxonomy is: nav_menu
            $menu = wp_get_nav_menu_object($locations[$theme_location]);
            //get nav menu items from term_id which is a menu
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            //start foreach
            foreach ($menu_items as $menu_item) {
                //current item
                $current = ($menu_item->object_id == get_queried_object_id()) ? ' w--current' : '';
                //if menu item doesn't have a parent - if menu item is not a submenu
                //start if
                if ($menu_item->menu_item_parent == 0) {
                    //add for each menu item it's id to variable parrent
                    $parent = $menu_item->ID;

                    $menu_array = array();
                    foreach ($menu_items as $submenu) {
                        //current item for submenus
                        $current_sub = ($submenu->object_id == get_queried_object_id()) ? ' w--current' : '';
                        if ($submenu->menu_item_parent == $parent) {
                            $bool = true;
                            $menu_array[] = '<a href="' . $submenu->url . '" class="dropdown-link w-dropdown-link' . $current_sub . '">' . $submenu->title . '</a>';
                        }
                    }//end foreach
                    //submenu
                    if ($bool == true && count($menu_array) > 0) {

                        $menu_list .= '<div data-delay="0" data-hover="1" class="w-dropdown">';
                        $menu_list .= '<div class="navigation-link w-dropdown-toggle">';
                        $menu_list .= '<div class="icon w-icon-dropdown-toggle"></div>';
                        $menu_list .= '<div>' . $menu_item->title . '</div>';
                        $menu_list .= '</div>';

                        $menu_list .= '<nav class="w-dropdown-list">';
                        $menu_list .= implode($menu_array);
                        $menu_list .= '</nav>';

                        $menu_list .= '</div>';

                    } else {
                        //normal menu
                        //$menu_list .= '<li>' ."\n";
                        $menu_list .= '<a href="' . $menu_item->url . '" class="navigation-link w-nav-link' . $current . '">' . $menu_item->title . '</a>';
                    }//end if
                }//end if
            }//end foreach
        } else {
            $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
        }
        echo $menu_list;
    }


}
