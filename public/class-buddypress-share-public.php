<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Share
 * @subpackage Buddypress_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Buddypress_Share
 * @subpackage Buddypress_Share/public
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Buddypress_Share_Public {

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
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     * @access public
     * @since    1.0.0
     */

    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Buddypress_Share_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Buddypress_Share_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style('wpb-fa1', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/buddypress-share-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     * @access public
     * @since    1.0.0
     */

    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Buddypress_Share_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Buddypress_Share_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/buddypress-share-public.js', array('jquery'), $this->version, false);
    }

    /**
     * Display share button in front page.
     * @access public
     * @since    1.0.0
     */

    public function bp_activity_share_button_dis() {
            if( is_user_logged_in() ) {
                    add_action('bp_activity_entry_meta', array( $this, 'bp_share_activity_filter' ) );
            } else {
                    add_action('bp_before_activity_entry_comments', array($this,'bp_share_activity_filter') );
            }
    }

    /**
     * BP Share activity filter
     * @access public
     * @since    1.0.0
     */

    function bp_share_activity_filter() {
        $service = get_option('bp_share_services');
        $extra_options = get_option('bp_share_services_extra');
        $activity_type = bp_get_activity_type();
        $activity_link = bp_get_activity_thread_permalink();
        $activity_title = bp_get_activity_feed_item_title(); // use for description : bp_get_activity_feed_item_description()
        $plugin_path = plugins_url();
            if( !is_user_logged_in() ) {
                    echo '<div class = "activity-meta" >';
            }
        ?>
        <span class="bp-share-btn">
            <a class="button item-button bp-secondary-action bp-share-button" rel="nofollow"><?php _e( 'Share', BP_SHARE ); ?></a>
        </span>

        <div class="service-buttons <?php echo $activity_type ?>" style="display: none;">
            <?php
            if (!empty($service)) {
                foreach ($service as $key => $value) {
                    if (isset($key) && $key == 'bp_share_facebook' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="https://www.facebook.com/sharer/sharer.php?t=' . $activity_title . '&u=' . $activity_link . '" rel="facebook"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_twitter' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="http://twitter.com/share?text=' . $activity_title . '&url=' . $activity_link . '" rel="twitter"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_google_plus' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="https://plus.google.com/share?url=' . $activity_link . '" rel="google-plus"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_pinterest' && $value['chb_' . $key] == 1) {
                        $media = '';
                        $video = '';
                        echo '<a target="blank" class="bp-share" href="https://pinterest.com/pin/create/bookmarklet/?media=' . $media . '&url=' . $activity_link . '&is_video=' . $video . '&description=' . $activity_title . '" rel="penetrest"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_linkedin' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="http://www.linkedin.com/shareArticle?url=' . $activity_link . '&title=' . $activity_title . '"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_reddit' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="http://reddit.com/submit?url=' . $activity_link . '&title=' . $activity_title . '"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_wordpress' && $value['chb_' . $key] == 1) {
                        $description = '';
                        $img = '';
                        echo '<a target="blank" class="bp-share" href="http://wordpress.com/press-this.php?u=' . $activity_link . '&t=' . $activity_title . '&s=' . $description . '&i= ' . $img . ' "><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_pocket' && $value['chb_' . $key] == 1) {
                        echo '<a target="blank" class="bp-share" href="https://getpocket.com/save?url=' . $activity_link . '&title=' . $activity_title . '"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                    if (isset($key) && $key == 'bp_share_email' && $value['chb_' . $key] == 1) {
                        $email = 'mailto:?subject=' . $activity_link . '&body=Check out this site: ' . $activity_title . '" title="Share by Email';
                        echo '<a target="blank" class="bp-share" href="' . $email . '"><span class="fa-stack fa-lg"><i class="' . $value['service_icon'] . '"></i></span></a>';
                    }
                }
            } else {
                _e( 'Please enable share services!', BP_SHARE );
            }
            do_action('bp_share_user_services', $services = array(), $activity_link, $activity_title);
            ?>
        </div>
        <script>
            jQuery(document).ready(function () {
                var pop_active = '<?php echo isset($extra_options['bp_share_services_open']) ? $extra_options['bp_share_services_open'] : '' ?>';
                if (pop_active == 1) {
                    jQuery('.bp-share').addClass('has-popup');
                }
            });
        </script>
        <?php
		if( !is_user_logged_in() ) {
			echo '</div>';
		}
    }
}
