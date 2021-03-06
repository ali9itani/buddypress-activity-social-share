<?php

/**
 * Fired during plugin activation
 *
 * @link       http://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Share
 * @subpackage Buddypress_Share/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Buddypress_Share
 * @subpackage Buddypress_Share/includes
 * @author     Wbcom Designs <admin@wbcomdesigns.com>
 */
class Buddypress_Share_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        if ( is_plugin_active('buddypress/bp-loader.php') and current_user_can('activate_plugins')) {
            if (get_option('bp_share_services') !== false) {
                $services = get_option('bp_share_services');
                if (empty($services)) {
                    $new_service_non_empty = array(
                        "bp_share_facebook" => array(
                            "chb_bp_share_facebook" => 1,
                            "service_name" => __( 'Facebook', BP_SHARE ),
                            "service_icon" => "fa fa-facebook",
                            "service_description" => __( 'Facebook is an American for-profit corporation and online social media and social networking service based in Menlo Park, California, United States.', BP_SHARE )
                        ),
                        "bp_share_twitter" => array(
                            "chb_bp_share_twitter" => 1,
                            "service_name" => __( 'Twitter', BP_SHARE ),
                            "service_icon" => "fa fa-twitter",
                            "service_description" => __( 'Twitter is an online news and social networking service where users post and read short 140-character messages called \'tweets\'. Registered users can post and read tweets, but those who are unregistered can only read them.', BP_SHARE)
                        ),
                        "bp_share_linkedin" => array(
                            "chb_bp_share_linkedin" => 1,
                            "service_name" => __('Linkedin', BP_SHARE ),
                            "service_icon" => "fa fa-linkedin",
                            "service_description" => __( 'LinkedIn is a business and employment-oriented social networking service that operates via websites.', BP_SHARE )
                        ),
                        "bp_share_google_plus" => array(
                            "chb_bp_share_google_plus" => 1,
                            "service_name" => __( 'Google Plus', BP_SHARE ),
                            "service_icon" => "fa fa-google-plus",
                            "service_description" => __( 'Google Plus is an interest-based social network that is owned and operated by Google.', BP_SHARE )
                        ),
                    );
                    update_option('bp_share_services', $new_service_non_empty);
                } else {
                    $facebook = array(
                        "chb_bp_share_facebook" => 1,
                        "service_name" => __( 'Facebook', BP_SHARE ),
                        "service_icon" => "fa fa-facebook",
                        "service_description" => __( 'Facebook is an American for-profit corporation and online social media and social networking service based in Menlo Park, California, United States.', BP_SHARE )
                    );
                    $twitter = array(
                        "chb_bp_share_twitter" => 1,
                        "service_name" => __( 'Twitter', BP_SHARE ),
                        "service_icon" => "fa fa-twitter",
                        "service_description" => __( 'Twitter is an online news and social networking service where users post and read short 140-character messages called \'tweets\'. Registered users can post and read tweets, but those who are unregistered can only read them.', BP_SHARE )
                    );
                    $linkedin = array(
                        "chb_bp_share_linkedin" => 1,
                        "service_name" => __( 'Linkedin', BP_SHARE ),
                        "service_icon" => "fa fa-linkedin",
                        "service_description" => __( 'LinkedIn is a business and employment-oriented social networking service that operates via websites.', BP_SHARE )
                    );
                    $google_plus = array(
                        "chb_bp_share_google_plus" => 1,
                        "service_name" => __( 'Google Plus', BP_SHARE ),
                        "service_icon" => "fa fa-google-plus",
                        "service_description" => __( 'Google Plus is an interest-based social network that is owned and operated by Google.', BP_SHARE )
                    );
                    foreach ($services as $key => $value) {
                        $services['bp_share_facebook'] = $facebook;
                        $services['bp_share_twitter'] = $twitter;
                        $services['bp_share_linkedin'] = $linkedin;
                        $services['bp_share_google_plus'] = $google_plus;
                    }
                    update_option('bp_share_services', $services);
                }
            } else {
                $new_service_empty = array(
                    "bp_share_facebook" => array(
                        "chb_bp_share_facebook" => 1,
                        "service_name" => __( 'Facebook', BP_SHARE ),
                        "service_icon" => "fa fa-facebook",
                        "service_description" => __( 'Facebook is an American for-profit corporation and online social media and social networking service based in Menlo Park, California, United States.', BP_SHARE )
                    ),
                    "bp_share_twitter" => array(
                        "chb_bp_share_twitter" => 1,
                        "service_name" => __( 'Twitter', BP_SHARE ),
                        "service_icon" => "fa fa-twitter",
                        "service_description" => __( 'Twitter is an online news and social networking service where users post and read short 140-character messages called \'tweets\'. Registered users can post and read tweets, but those who are unregistered can only read them.', BP_SHARE)
                    ),
                    "bp_share_linkedin" => array(
                        "chb_bp_share_linkedin" => 1,
                        "service_name" =>  __( 'Linkedin', BP_SHARE ),
                        "service_icon" => "fa fa-linkedin",
                        "service_description" => __( 'LinkedIn is a business and employment-oriented social networking service that operates via websites.', BP_SHARE )
                    ),
                    "bp_share_google_plus" => array(
                        "chb_bp_share_google_plus" => 1,
                        "service_name" => __( 'Google Plus', BP_SHARE ),
                        "service_icon" => "fa fa-google-plus",
                        "service_description" => __( 'Google Plus is an interest-based social network that is owned and operated by Google.', BP_SHARE )
                    ),
                );
// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                $deprecated = null;
                $autoload = 'no';
                add_option('bp_share_services', $new_service_empty, $deprecated, $autoload);
            }
            if (get_option('bp_share_services') !== false) {
                $extra_option_new = array(
                    'bp_share_services_open' => 1
                );
                update_option('bp_share_services_extra', $extra_option_new);
            } else {
                $extra_option_new = array(
                    'bp_share_services_open' => 1
                );
                $deprecated = null;
                $autoload = 'no';
                add_option('bp_share_services_extra', $extra_option_new, $deprecated, $autoload);
            }
        }
    }
}
