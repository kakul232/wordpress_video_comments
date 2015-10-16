
<!-- Polling Form Start Here ---->



 <?php do_action('bootsrtap_hook'); 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>
 
<div class="poll-wrap">
  
<div>

  <div class="pull-right">
Welcome To Video Comment Dashboard
    
  </div>
  
  <div class="clear"></div>
  
<div class="row">
	<h1 class="col-xs-12 mr-bt-20">Dashbord</h1> 
	<div class="clear"></div>
  <?php echo @$msg; ?>





  <hr />

<!-- Display poll from Here ---->

  <div class="mr-tp-20 allpollwrap">
  
	<h2> Your Comment </h2>

 <table class="wp-list-table widefat fixed striped posts" border="1">
   <thead>
                  <tr>
                    <th><strong>Post Title</strong></th>
                    <th><strong>Video Comment </strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Action</strong></th>
                  </tr>
                </thead>
    
    <tbody>
		 <?php 
		 /*****************************************************
		 @ Display Poll On Table 
		 *****************************************************/
$paged = $paged = (!isset($_REQUEST['paged']) ? '1' : $_REQUEST['paged'] );
$args = array (
  'posts_per_page' => 3,
  'paged' => $paged
);

$query = new WP_Query( $args );
?><?php if ($query->have_posts()) : ?><?php while ($query->have_posts()) : $query->the_post(); 
      
$current_stat= get_post_meta(get_the_ID(),'vc_stat');

if(isset($current_stat[0]))
{
    if($current_stat[0]=='1')
    {
         $status='<label class="label label-success">Active</label>';
    }
    else
    {
         $status='<label class="label label-danger">Inactive</label>';
    }
}else
{
      $status='<label class="label label-success">Active</label>';
}

?>
               <tr>
                  <td id=""><?php the_title(); ?><input type="hidden" id="postID" value="<?php echo get_the_ID();?>"></td>
                  
                  <td>
                      <iframe frameborder="0" height="100%" width="100%" src="https://frankly.me/widgets/viewComment?flagRedirect=null&amp;url=<?php the_permalink() ?>"></iframe>
                </td>
                <td id="status"><?php _e($status);?></td>
                  <td><select class="action">
                      <option>-Select-</option>
                      <option value="1" >Active</option>
                      <option value="0">Inactive</option>
                    </select></td>
                </tr>
            

<?php endwhile; ?>
<tr><td colspan="4"><?php if ( $query->max_num_pages > 1 ) :
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => $paged,
    'total' => $query->max_num_pages
  ) );
endif;?></td></tr>
<?php endif; ?>
               
    </tbody>
    
  </table>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="myModalLabel" class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">

        <form id="update" method="post" action="#">
          
          <div class="form-group mr-bt-10 clearfix">
            <label class="col-xs-12 col-sm-4 col-md-3 col-lg-2">About:</label>
            <textarea class='col-xs-12 col-sm-8 col-md-8 col-lg-6' placeholder="Tell me about Yourself?" id="about_edit" name="about_edit" required></textarea>
           <span id="user-result"></span>
           <input type="hidden" class='col-xs-12 col-sm-8 col-md-8 col-lg-6' placeholder="Add your Frankly User Id ?" id="frankly_userid_edit" name="frankly_userid_edit" required>
        
         </div>
        <input type="submit" id="AskFrankly" class="btn button-primary button-large submit-btn" placeholder="" value="Update">
    

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  
  </div>

</div>

</div>

<script type="text/javascript">



 /****************************************************************************************************
                       Action Onchange
*****************************************************************************************************/
(function($){

$('.action').on("change",function(e){
  e.preventDefault();
var def=$(this);
var select=$(this).val();
var post_id=$(this).closest("tr").find('#postID').val();


// Active Inactive Delete

    $.ajax({
      method: 'post',
      url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
      data:{
        action: 'update_comment',
        post_id: post_id,
        select : select
      },
      success:function(response){
            if(response != ''){

            var obj = JSON.parse(response);
            

                // if inactive
                if(obj.stat =='0')
                {
                  def.closest("tr").children('td#status').html('<label class="label label-danger">Inactive</label>');
                }
                 // if active
                if(obj.stat =='1')
                {
                  def.closest("tr").children('td#status').html('<label class="label label-success">Active</label>');
                }
          }
     }
    });





})

               

})(jQuery);
            
</script>
<!-- Display poll End Here -->

<script src="https://frankly.me/js/franklywidgets.js"> </script>

