<?php 
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);

if(isset($_GET['group_name'])) {
  $groupName = $_GET['group_name'];
  $group_details_query = mysqli_query($con, "SELECT * FROM groups WHERE group_name='$groupName'");
  $group_array = mysqli_fetch_array($group_details_query);
  $group_owner = $group_array['group_owner'];
  $num_members = (substr_count($group_array['users_array'], ",")) - 1;
  $group_user_obj = new Groups($con, $userLoggedIn, $groupName);
}

if(isset($_POST['leave_group'])) {
  $groups = new Groups($con, $userLoggedIn, $groupName);
  $groups->removeMember();
  header("Refresh:0");
}

if(isset($_POST['join_group'])) {
  $groups = new Groups($con, $userLoggedIn, $groupName);
  $groups->sendRequest();
  header("Refresh:0");
}
// !!!!!!!!!!!!NEED TO IMPLEMENT THIS FUNC
if(isset($_POST['delete_group'])) {
  $groups = new Groups($con, $userLoggedIn, $groupName);
  $groups->deleteGroup();
  // header("Location: groups_list.php");
}
// if(isset($_POST['new_request'])) {
//   header("Location: groups_requests.php");
// }

if(isset($_POST['post_message'])) {
  if(isset($_POST['message_body'])) {
    $body = mysqli_real_escape_string($con, $_POST['message_body']);
    $date = date("Y-m-d H:i:s");
    $message_obj->sendMessage('none', $groupName, $body, $date);
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
  
  <div class="profile_left">
  <?php
    if($userLoggedIn == $group_owner) {
      echo '<a href="upload_group_pic.php?group_name='.$groupName .'">';
    }
    ?>
    <img align="middle" src="<?php echo $group_array['group_pic']; ?>">
    <?php
    if($userLoggedIn == $group_owner) {
      echo '</a>';
    }
    ?>
    <h4 style="text-align:center"><?php echo $group_user_obj->getGroupName(); ?></h4>
    <div class="profile_info">
      <p><?php echo "Posts: " . $group_array['num_posts']; ?></p>
      <p><?php echo "Members: " . $group_array['num_users']; ?></p>
      <?php  
        if($userLoggedIn != $group_array['group_owner']) {
          echo '<div style="text-align:center" class="profile_info_bottom">';
            // echo '<p>';
            echo $group_user_obj->getMutualFriends() . " friends as members";
            // echo '</p>';
          echo '</div>';
        }


    ?>
      <!-- <p><?php echo "Friends: " . $num_members ?></p> -->
    </div>

    <form action="<?php echo "group.php?group_name=".$groupName; ?>" method="POST">
      <?php 
      // $group_user_obj = new Groups($con, $userLoggedIn, $groupName); 
      // if($group_user_obj->isDeleted() || $group_user_obj->hasNoPermission()) {
      //   header("Location: group_closed.php");
      // }
      if($group_user_obj->isDeleted())
          header("Location: groups_list.php");
      else if  ($group_user_obj->hasNoPermission())
          header("Location: group_closed.php");

      $logged_in_user_obj = new User($con, $userLoggedIn); 

      if($userLoggedIn != $group_owner) {

        if($group_user_obj->isMember() && $groupName!="IU_Global_Forum") {
          echo '<input type="submit" name="leave_group" class="danger" value="Leave Group"><br>';
        }
        else if ($group_user_obj->didSendRequest()) {
          echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
        }
        else if($groupName!="IU_Global_Forum")
          echo '<input type="submit" name="join_group" class="success" value="Join Group"><br>';


      }
      // Not Sure about the below func
      else{
        echo '<input type="submit" name="delete_group" id="delete_group_button" class="danger" value="Delete Group"><br>';
        // if ($logged_in_user_obj->didReceiveRequest($groupName)) {
        //   echo '<input type="submit" name="new_request" class="success" value="New Member Requests"><br>';
        // }
      } 

      ?>

    </form>
    <?php
    if($group_user_obj->isMember()) {
          echo '<input type="submit" id = "post_button" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">';
        }
    ?>
    


  </div>


  <div class="profile_main_column column">

    <ul class="nav nav-tabs" role="tablist" id="profileTabs">
      <li role="presentation" class="active"><a href="#newsfeed_div" aria-controls="newsfeed_div" role="tab" data-toggle="tab">Newsfeed</a></li>
      <li role="presentation"><a href="#messages_div" aria-controls="messages_div" role="tab" data-toggle="tab">Messages</a></li>
    </ul>

    <div class="tab-content">

      <div role="tabpanel" class="tab-pane fade in active" id="newsfeed_div">
        <div class="posts_area"></div>
        <img id="loading" src="assets/images/icons/loading.gif">
      </div>


      <div role="tabpanel" class="tab-pane fade" id="messages_div">
        <?php  
        

          echo "<h4><a href='group.php?group_name=" . $groupName ."'>" . $group_user_obj->getGroupName() . "</a> Discussions</h4><hr><br>";

          echo "<div class='loaded_messages' id='scroll_messages'>";
            echo $message_obj->getMessages('none', $groupName);
          echo "</div>";
        ?>

        <?php
        if($group_user_obj->isMember()) {
              echo '<div class="message_post">
                    <form action="" method="POST">
                        <textarea name="message_body" id="message_textarea" placeholder="Write your message ..."></textarea>
                        <input type="submit" name="post_message" class="info" id="message_submit" value="Send">
                    </form>

                  </div>';
            }
        ?>

        <!-- <div class="message_post">
          <form action="" method="POST">
              <textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>
              <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>
          </form>

        </div> -->

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
        <p>This will appear on the Groups's profile page and also their newsfeed for your friends to see!</p>

        <form class="profile_post" action="" method="POST">
          <div class="form-group">
            <textarea class="form-control" name="post_body"></textarea>
            <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
            <input type="hidden" name="user_to" value="<?php echo $groupName; ?>">
          </div>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_group_post">Post</button>
      </div>
    </div>
  </div>
</div>


<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';
  var profileGroupName = '<?php echo $groupName; ?>';

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_group_posts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn + "&profileGroupName=" + profileGroupName,
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
          url: "includes/handlers/ajax_load_group_posts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileGroupName=" + profileGroupName,
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

    // $('#delete_group_button').on('click', function() {
    //         alert("abc");
    //         bootbox.confirm("Are you sure you want to delete this group?", function(result) {
    //           // alert("abccc");
    //           $.post("includes/form_handlers/delete_group.php?group_name=<?php echo $groupName; ?>", {result:result});

    //           if(result)
    //             // header("Location: group_lists.php");
    //             location.reload();

    //         });
    //       });

  });

  </script>





  </div>
</body>
</html>