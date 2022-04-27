<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Ds_Tender
 * @subpackage Ds_Tender/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ds_Tender
 * @subpackage Ds_Tender/includes
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Ds_Tender
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ds_Tender_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('DS_TENDER_VERSION')) {
			$this->version = DS_TENDER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ds-tender';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ds_Tender_Loader. Orchestrates the hooks of the plugin.
	 * - Ds_Tender_i18n. Defines internationalization functionality.
	 * - Ds_Tender_Admin. Defines all hooks for the admin area.
	 * - Ds_Tender_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-ds-tender-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-ds-tender-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-ds-tender-admin.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/common.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/tender_admin_base.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/company.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/tender.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-ds-tender-public.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/controller/api/get_tenders.php';

		$this->loader = new Ds_Tender_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ds_Tender_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Ds_Tender_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Ds_Tender_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$DS_tender_admin_base = new DS_tender_admin_base();
		$this->loader->add_action('admin_menu', $DS_tender_admin_base, 'ds_tender_admin_menu_section');

		$DS_tender_admin_company = new DS_tender_admin_company();
		$this->loader->add_action('wp_ajax_ds_tender_save_company', $DS_tender_admin_company, 'wp_ajax_ds_tender_save_company', 1, 1);
		$this->loader->add_action('wp_ajax_ds_tender_get_company_id', $DS_tender_admin_company, 'wp_ajax_ds_tender_get_company_id', 1, 1);
		
		$DS_tender_admin_tender = new DS_tender_admin_tender();
		$this->loader->add_action('wp_ajax_ds_tender_save_tender', $DS_tender_admin_tender, 'wp_ajax_ds_tender_save_tender', 1, 1);
		$this->loader->add_action('wp_ajax_ds_tender_check_if_added', $DS_tender_admin_tender, 'wp_ajax_ds_tender_check_if_added', 1, 1);
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Ds_Tender_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$DS_tender_public_get_tender_api = new DS_tender_public_get_tender_api();
		$this->loader->add_action('rest_api_init', $DS_tender_public_get_tender_api, 'rest_tenders', 1, 1);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ds_Tender_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
