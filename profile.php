<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");

$message_obj = new Message($con, $userLoggedIn);

if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
  $profile_user_obj = new User($con, $username);
}




if(isset($_POST['remove_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->removeFriend($username);
}

if(isset($_POST['add_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->sendRequest($username);
}
if(isset($_POST['respond_request'])) {
	header("Location: requests.php");
}

if(isset($_POST['post_message'])) {
  if(isset($_POST['message_body'])) {
    $body = mysqli_real_escape_string($con, $_POST['message_body']);
    $date = date("Y-m-d H:i:s");
    $message_obj->sendMessage($username, 'none', $body, $date);
  }

  $link = '#profileTabs a[href="#messages_div"]';
  echo "<script> 
          $(function() {
              $('" . $link ."').tab('show');
          });
        </script>";


}

 ?>

 	<style type="text/css">
	 	.wrapper {
	 		margin-left: 0px;
			padding-left: 0px;
	 	}

 	</style>
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 user_profile_details column">
          <a href="<?php echo "profile.php?profile_username=".$username; ?>" class="user_profile_details_link">  <img class="user_profile_details_img" align="middle" src="<?php echo $user_array['profile_pic']; ?>"> </a>
          <br>
          <data></data>
          <div class="user_profile_details_left_right">
            <a href="<?php echo "profile.php?profile_username=".$username; ?>" style="text-align:center;font-size: 17px;font-weight: bold;">
            <?php echo $user_array['first_name'] . " " . $user_array['last_name'];?>
            </a>
            <br><br/>
            <?php echo "<b>Title:</b><br> " . $user_array['title']. "<br>"; 
            echo "<br><b>About:</b><br> " . $user_array['about']. "<br>";
            echo "<br><b>Friends:</b> " . $num_friends . "<br>";;
            if($userLoggedIn != $username) {
                echo "<br><b>Mutual Friends:</b> " . $profile_user_obj->getMutualFriends($username);
            }
            ?>
          </div>

        </div>

        <div class="user_profile_button_details column">
          <form action="<?php echo "profile.php?profile_username=" . $username; ?>" method="POST">
            <?php 
            // $profile_user_obj = new User($con, $username); 
            if($profile_user_obj->isClosed()) {
              header("Location: user_closed.php");
            }

            $logged_in_user_obj = new User($con, $userLoggedIn); 

            if($userLoggedIn != $username) {

              if($logged_in_user_obj->isFriend($username)) {
                echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
              }
              else if ($logged_in_user_obj->didReceiveRequest($username)) {
                echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
              }
              else if ($logged_in_user_obj->didSendRequest($username)) {
                echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
              }
              else 
                echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';

            }

            ?>
          </form>
          <input type="submit" class="danger" data-toggle="modal" data-target="#post_form" value="Post Something">

        </div>


        <div class="col-md-3 user_friends_details columnFriends" id="conversations">
              <div class="modal-title" id="profileFriendsHead">
              <b>&nbsp;&nbsp;&nbsp;Friends</b>
              </div>
              
              <div class="loaded_friends">
                <?php echo $profile_user_obj->getFriendsList(); ?>
              </div>
              <br>
        </div>
        
      	<div class="col-md-6 profile_main_column column">

          <ul class="nav nav-tabs" role="tablist" id="profileTabs">
            <li role="presentation" class="active"><a href="#newsfeed_div" aria-controls="newsfeed_div" role="tab" data-toggle="tab">Newsfeed</a></li>
            <li role="presentation"><a href="#about_div" aria-controls="about_div" role="tab" data-toggle="tab">About</a></li>
            <li role="presentation"><a href="#messages_div" aria-controls="messages_div" role="tab" data-toggle="tab">Messages</a></li>
          </ul>

          <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active" id="newsfeed_div">
              <div class="posts_area"></div>
              <img id="loading" src="assets/images/icons/loading.gif">
            </div>
            
            <div role="tabpanel" class="tab-pane fade" id="about_div">
            <form action="<?php echo "profile.php?profile_username=" . $username; ?>" method="POST">
              <?php
              if ($username != $userLoggedIn){
                echo '<table class = "tg tg_profile" border="0">
                    <table class = "tg tg_profile" border="0">
                    <tr><td class="tg-9hbo"><h4>First Name: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="first_name" value=' .$user_array["first_name"]. ' disabled></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Last Name: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="last_name" value=' .$user_array["last_name"]. ' disabled></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Email: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="email" value=' .$user_array["email"]. ' disabled></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Title: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="title" value=' .$user_array["title"]. ' disabled></td></tr>
                <br><br>
                <tr><td class="tg-9hbo"><h4>About: </h4></td>
                    <td class="tg-yw4l"><textarea name="about" class = "profile_about" disabled>' . $user_array["about"].'</textarea></td></tr>
                <br><br>
                <tr><td class="tg-9hbo"><h4>Projects: </h4></td>
                <td class="tg-yw4l">
                <textarea name = "projects" class = "profile_about" disabled>'.$user_array["project"].'</textarea>
                </td></tr>
                <br><br>
              </table>';
              }
              else{
                echo '<table class = "tg tg_profile" border="0">
                    <table class = "tg tg_profile" border="0">
                    <tr><td class="tg-9hbo"><h4>First Name: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="first_name" value=' .$user_array["first_name"]. '></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Last Name: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="last_name" value=' .$user_array["last_name"]. '></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Email: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="email" value=' .$user_array["email"]. '></td></tr>
                <br><br>
                    <tr><td class="tg-9hbo"><h4>Title: </h4></td> 
                    <td class="tg-yw4l"><input style="min-width: 308px;" type="text" name="title" value=' .$user_array["title"]. '></td></tr>
                <br><br>
                <tr><td class="tg-9hbo"><h4>About: </h4></td>
                    <td class="tg-yw4l"><textarea name="about" class = "profile_about">' . $user_array["about"].'</textarea></td></tr>
                <br><br>
                <tr><td class="tg-9hbo"><h4>Projects: </h4></td>
                <td class="tg-yw4l">
                <textarea name = "project" class = "profile_about">'.$user_array["project"].'</textarea>
                </td></tr>
                <br><br>
              </table>';
              echo '<br><div style="text-align: center;"><input type="submit" name="update_details" id="save_details" value="Update Details" class="danger settings_submit"></div><br>';
            }
              ?>
          </form>

        </div>

            <div role="tabpanel" class="tab-pane fade" id="messages_div">
              <?php  
              

                echo "<h4>You and <a href='profile.php?profile_username=" . $username ."'>" . $profile_user_obj->getFirstAndLastName() . "</a></h4><hr><br>";

                echo "<div class='loaded_messages' id='scroll_messages'>";
                  echo $message_obj->getMessages($username, 'none');
                echo "</div>";
              ?>



              <div class="message_post">
                <form action="" method="POST">
                    <textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>
                    <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>
                </form>

              </div>

              <script>
                var div = document.getElementById("scroll_messages");
                div.scrollTop = div.scrollHeight;
              </script>
            </div>


          </div>


      	</div>
        

      <!-- Modal -->
      <div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="postModalLabel">Post something!</h4>
            </div>

            <div class="modal-body">
            	<p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>

            	<form class="profile_post" action="" method="POST">
            		<div class="form-group">
            			<textarea class="form-control" name="post_body"></textarea>
            			<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
            			<input type="hidden" name="user_to" value="<?php echo $username; ?>">
            		</div>
            	</form>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="black-background danger" name="post_button" id="submit_profile_post">Post</button>
            </div>
          </div>
        </div>
      </div>

  </div>
</div>


<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';
  var profileUsername = '<?php echo $username; ?>';

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_profile_posts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    $(window).scroll(function() {
      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_profile_posts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
          cache:false,

          success: function(response) {
            $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.posts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });

  </script>


</body>
</html>
