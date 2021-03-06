<?php
ob_start();
/**
* Plugin Name: Video Comment
* Description: FranklyMe Poll plugin allows you to easily manage the polls and cross-synchronization of Open Question from within your FranklyMe account, wherein users would be able to answer those question via FranklyMe app and website.
* Author: Frankly.me
* Version: 1.0
* Author URI: http://frankly.me
* Plugin URI: https://wordpress.org/plugins/Frankly-Video-Poll/
* Text Domain: frankly-me
* License: GPLv2
**/


/*  Copyright 2015  ABHISHEK GUPTA  (email : abhishekgupta@frankly.me)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/




/*--------------------------------------------------------------------------------------*
*  fRANKLY vIDEO cOMMENT 
    @kakul sarma
---------------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class frankly 
{
    
    function __construct()
    {
        add_action( 'admin_menu', array($this,'video_comment_menu') );
        add_action( 'admin_enqueue_scripts', array($this,'my_vc_adminscripts_main') ); 
        add_action('bootsrtap_hook', array($this,'add_bootstrap_vc_admin'));

        add_filter( 'the_content', array($this,'add_vc_comment'));
    }


    function video_comment_menu() {
        add_menu_page( 
            __( 'Video Comment Dashboard', 'textdomain' ),
            'Video Comment',
            'manage_options',
            'video_comment',
            'moderate_comment',
            plugins_url( '/images/icon.png', __FILE__  ),
            5
        ); 
    }


//  wp_enqueue_script for Admin

        function my_vc_adminscripts_main() {

            wp_enqueue_style( 'poll_style', plugins_url( '/css/admin-style.css' , __FILE__ ) );
            wp_enqueue_style( 'lightbox', plugins_url( '/css/bootstrap-lightbox.min.css' , __FILE__ ) );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script('bootstrap',plugins_url( '/js/bootstrap.min.js' , __FILE__ ),array( 'jquery' ));
                  
        }


//  Create hook for admin bootstrap



        function add_bootstrap_vc_admin()
        {
            wp_enqueue_style( 'bootstrap', plugins_url( '/css/bootstrap.min.css' , __FILE__ ) );
        }


/***********************************************************************************
@
@  Hook Video Comment
@
*************************************************************************************/
function add_vc_comment($content){

 if ( is_single() ) {

    $current_stat= get_post_meta(get_the_ID(),'vc_stat');

            if(isset($current_stat[0]))
            {
                if($current_stat[0]=='1')
                {
                     $video_comment= '<div class="franklywidget" data-user="" data-widget="videoComment" data-query="" data-height="40" data-width="240" style="margin: auto"><a href="https://frankly.me">Frankly.me</a></div>

                      <div class="franklywidget" data-user="" data-widget="viewComment" data-query="" data-height="340" data-width="100%" style="margin: auto"><a href="https://frankly.me">Frankly.me</a></div>

                      <script src="https://frankly.me/js/franklywidgets.js"> </script>


                      ';
                      return $content.$video_comment;
                }
                else
                {
                     return $content;
                }
            }else
            {
                             $video_comment= '<div class="franklywidget" data-user="" data-widget="videoComment" data-query="" data-height="40" data-width="240" style="margin: auto"><a href="https://frankly.me">Frankly.me</a></div>

              <div class="franklywidget" data-user="" data-widget="viewComment" data-query="" data-height="340" data-width="100%" style="margin: auto"><a href="https://frankly.me">Frankly.me</a></div>

              <script src="https://frankly.me/js/franklywidgets.js"> </script>


              ';
              return $content.$video_comment;
            }

  
}
if(is_page())
{
      return $content;  
}


}







}

    $vc=new frankly;

// Incude some action File 

require_once(dirname(__FILE__) . '/vc_init.php');



ob_flush();



?>