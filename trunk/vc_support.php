<!-- /***********************************************************************************
@
@ user Not login With frankly Me
@
*************************************************************************************/
 -->


<style>
  #wpwrap { background: #fff}
  .dasboardwrap { padding: 30px 15px;  background: #fff;}
  .dasboardwrap input { width:350px; padding: 5px 10px; font-size:16px; color: #333; border:1px solid #ccc; box-shadow:none; margin-bottom:10px; }
  .dash-logintable { padding: 10px 15px;}




</style>


<div class="dasboardwrap">


    <a href="https://frankly.me"><img src="https://frankly.me/img/logo-frankly-new.png"></a><h1>Welcome To Frankly Support Center,</h1>  <small>Powered by <a href="https://frankly.me">Frankly.me</a></small>

        <table class="form-table dash-logintable">
        <tr>


            <td>
              <span id="user-result"></span>
              <table>
                <tr>
                  <td>
                      <label> Name : </label>
                    </td>

                      <td>
                        <input type="text" id="frankly_name" placeholder="Your Full Name (Required)" name="frankly_name" required/>
                      </td>
                </tr>

                <tr>
                  <td>
                    <label> Email :</label>
                  </td>
                  <td>
                        <input type="email" id="frankly_email" placeholder="Your Full Email (Required)" name="frankly_email" required/> <br>
                  </td>
                </tr>


                <tr>
                    <td>
                      <label> Phone :</label>
                    </td>
                    <td>
                          <input type="text" id="frankly_phone" placeholder="Your Full Phone (Required)" name="frankly_phone" required/> <br>  </label>
                        </td>
                      </tr>
                <tr>
                    <td>
                       <label> Organisation :</label>
                     </td>
                     <td>
                  <input type="text" id="frankly_organisation" placeholder="Your Full Organisation (Required)" name="frankly_organisation" required/> <br>  </label>
                </td>
              </tr>
              <tr>
                  <td>
              <label> Query (Required):</label>
            </td>
            <td>
                      <textarea class='col-xs-12 col-sm-8 col-md-8 col-lg-6' id="frankly_message" placeholder="Your Full Query (Required)" required name="frankly_message" /> </textarea>  </label>

               <button style="" class="button button-primary" id ="proceed"  >Submit</button>
             </td>
           </tr>
         </table>
                <br>


              <br><br>
                <b style="decorator:underlined">How to get frankly user name?</b><br>
                    <div style="margin-left:20px">
                    <ul style="list-style-type:circle">

                        <li> Download the frankly.me app from
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=me.frankly">
                            <img style="height:30px; vertical-align: middle;" src="<?=plugins_url( 'images/playstore.png' , __FILE__ );?>" class="MainGetAppLinks"></a>
                            <a target="_blank" href="https://itunes.apple.com/in/app/frankly.me-talk-to-celebrities/id929968427&amp;mt=8">
                            <img style="height:30px; vertical-align: middle;" src="<?= plugins_url( 'images/appstore.png' , __FILE__ );?>" class="MainGetAppLinks"></a> or Register at <a href="http://frankly.me/" target="_blank">frankly.me</a>.
                        </li>

                        <li> Create an account</li>
                        <li> Open your profile to get your user name.</li>
                    </ul>
                    <div>
            </td>
        </tr>
        </table>


    </div>

<script type="text/javascript">



            (function($){




/**********************************************************************************
@ Proceed Button Call
***********************************************************************************/

                $('#proceed').click(function(){

                    var name = $('#frankly_name').val();
                    var email = $('#frankly_email').val();
                    var phone = $('#frankly_phone').val();
                    var org = $('#frankly_organisation').val();
                    var query = $('#frankly_message').val();


                    $.ajax({
                            method: 'POST',
                            url: ajaxurl,
                            data: {

                                    'action': 'submit_query',
                                  'body':{  'name' : name,
                                            'email' : email,
                                            'phone' : phone,
                                            'organisation' : org,
                                            'message' : query
                                          }


                                 },
                            success: function(response)
                            {
                            	 var obj = JSON.parse(response);
                              if(obj.code=='200'){
                                $('#user-result').html('<div id="message" class="updated notice notice-success is-dismissible below-h2"><p>'+obj.msg+' </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>');
                              }else{
                                $('#user-result').html('<div id="message" class="update-nag notice notice-success is-dismissible below-h2"><p>'+obj.msg+' </p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>');

                              }
                            },
                            error:function(response){
                              console.log(response);
                            }
                        });

                });

 })(jQuery);






</script>
