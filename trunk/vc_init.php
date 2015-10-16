<?php
ob_start();
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function moderate_comment(){
	//require_once('./wp-load.php');
	global $wpdb;

/***********************************************************************************
@
@  Create Table if NOt Exixt
@
*************************************************************************************/
  $vc_table =$wpdb->prefix.'vc_frankly';

	 $sql_team="CREATE TABLE IF NOT EXISTS `$vc_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text NOT NULL,
  `about` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";


    $result_ans=$wpdb->get_results($sql_team);

/***********************************************************************************
@
@  Hook Video Comment
@
*************************************************************************************/
function add_vc_comment(){
  echo '<div class="col s12 m6 l4">
    <div class="commentBtn" data-url="https://frankly.me/recorder/recorder?type=blog&amp;resourceId=&amp;sourceUrl=http://fcpunecity.com/news-details/fc-pune-city-rope-in-former-turkish-international-tuncay-sanli">
      <div class="waves-effect waves-light btn red lighten-1" style="text-transform: capitalize!important"><img src="http://embed.frankly.me/v1/common/img/logo-white.png" class="left btn-image">Add Video comment</div>
    </div>
  </div>';
  echo '<iframe src="http://google.com">';
}






/***********************************************************************************
@
@  Display On Admin Panel to moderate Comment
@
*************************************************************************************/
include_once('vc_dash.php');

 }

/**********************************************************************************
@
@  Update Ajax Callback
@
*************************************************************************************/
add_action('wp_ajax_nopriv_update_comment', 'update_comment_callback');
add_action('wp_ajax_update_comment', 'update_comment_callback');

function update_comment_callback(){

     $postmeta = get_post_meta($_POST['post_id'],'vc_stat');

    if(isset($postmeta))
    {
        update_post_meta($_POST['post_id'], 'vc_stat', $_POST['select']);
    }else
    {
      add_post_meta($_POST['post_id'], 'vc_stat', $_POST['select']);
    }
        $current_stat= get_post_meta($_POST['post_id'],'vc_stat');
        $json=array('stat'=>$current_stat[0]  );

    echo json_encode($json);



  wp_die();

}
/**********************************************************************************
@
@  Support Form Ajax Callback
@
*************************************************************************************/
add_action('wp_ajax_nopriv_submit_query', 'submit_query_callback');
add_action('wp_ajax_submit_query', 'submit_query_callback');

function submit_query_callback(){



    $json = json_encode($_POST['body']);
		$url="https://api.frankly.me/contactus";
		$response = wp_remote_post( $url, array(
				'method'      => 'POST',
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(
								'Content-Type'=>"application/json"
				),
			 'body'        => $json,
				'cookies'     => array()
				)
		);
		$res=json_decode($response['body'],true);
		if($res['success']){
			$send=array(
				'code'=>200,
				'msg'=>'Our Team will contact you shortly '
			);
		}else{
			$send=array(
				'code'=>400,
				'msg'=>'Invalid Entry !!!'
			);
		}

		echo json_encode($send);



  wp_die();

}




ob_flush();
?>
