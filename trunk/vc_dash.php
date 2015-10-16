
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
	<h1 class="col-xs-12 mr-bt-20"><a href="https://frankly.me"><img src="https://frankly.me/img/logo-frankly-new.png"></a>Dashboard</h1>  <small>Powered by <a href="https://frankly.me">Frankly.me</a></small>

	<div class="clear"></div>
  <?php echo @$msg; ?>





  <hr />

<!-- Display poll from Here ---->

  <div class="mr-tp-20 allpollwrap">

	<h2> Your Comment </h2>

 <table id="myTable_vc" class="wp-list-table widefat fixed striped posts" border="1">
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
$search_term="hELLO";
$paged = (!isset($_REQUEST['paged']) ? '1' : $_REQUEST['paged'] );
$args = array (
  'posts_per_page' => 10,
  'paged' => $paged,
  'search_prod_title' => $search_term,
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
                  <td width="20%" id=""><?php the_title(); ?><input type="hidden" id="postID" value="<?php echo get_the_ID();?>">
                   <input type="hidden" id="parmalink" value="<?php the_permalink() ?>">
                   </td>

                  <td width="70%">

                      <button type="button" class="btn btn-success view_vc" data-toggle="modal" data-target="#myModal">View Comments</button>

                </td>
                <td width="5%" id="status"><?php _e($status);?></td>
                  <td width="5%"><select class="action">
                      <option>-Select-</option>
                      <option value="1" >Active</option>
                      <option value="0">Inactive</option>
                    </select></td>
                </tr>


<?php endwhile; ?>

<?php endif; ?>

    </tbody>

  </table>


<!-- ################################## Model ##############################--->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Comments</h4>
        </div>
        <div class="modal-body display_vc_model" style="height:350px; width:500px">
         <!-- Ifram -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

<!-- ################################## Model ##############################--->
<div class="pull-right"></div><?php if ( $query->max_num_pages > 1 ) :
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => $paged,
    'total' => $query->max_num_pages
  ) );
endif;?></div>



  </div>

</div>

</div>
  <small>Powered by <a href="https://frankly.me">Frankly.me</a></small>
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

      // Data table
        $('#myTable_vc').DataTable({"bPaginate": false,});


     $('.view_vc').on("click",function(e){
        var parm=$(this).closest("tr").find('#parmalink').val();
        console.log(parm);
         $('.display_vc_model').html(' <iframe frameborder="0" height="100%" width="120%" src="https://frankly.me/widgets/viewComment?flagRedirect=null&amp;url='+parm+'"></iframe>');
    })

})(jQuery);

</script>
<!-- Display poll End Here -->

<script src="https://frankly.me/js/franklywidgets.js"> </script>
