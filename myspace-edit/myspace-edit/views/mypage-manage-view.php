<?php

if( current_user_can( 'edit_users' ) ) { 
    
    // Populate the dropdown list with exising users.
    $dropdown_html = '<select multiple="multiple"  id="ems_user_select" name="ems[user_select][]">
                        <option value="">'.__( 'Select a User', "Edit MyPage" ).'</option>';
    $user_id = 0;
    if (!empty($_GET['ems_user_id'])){
      $target_user = get_user_by('ID', $_GET['ems_user_id']);
      if (empty($target_user))
        $wp_users = get_users( array( 'fields' => array( 'user_login', 'display_name', 'ID' ) ) );
      else {
        $wp_users[] = $target_user;
      }
      $user_id = $_GET['ems_user_id'];
    } else {
      $wp_users = get_users( array( 'fields' => array( 'user_login', 'display_name', 'ID' ) ) );
    }
    
    foreach ( $wp_users as $user ) {
      $user_login = esc_html( $user->user_login );
      $user_display_name = esc_html( $user->display_name );
      
      $dropdown_html .= '<option value="' . $user->ID . '"'.((!empty($user_id) && $user_id == $user->ID) ? "selected" : '').'>' . $user_login . ' (' . $user_display_name  . ') ' . '</option>' . "\n";
    }
    $dropdown_html .= '</select>';
    
    // Generate a custom nonce value.
    $ems_add_meta_nonce = wp_create_nonce( 'ems_add_user_meta_form_nonce' ); 
    
  // Build the Form
?>

<div class="container">
  <h1>My Space</h1> 
  <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data" id="edit_mypage_form">
    <input type="hidden" name="action" value="ems_form_response">
    <input type="hidden" name="ems_add_user_meta_nonce" value="<?php echo $ems_add_meta_nonce ?>" />

    <?php echo $dropdown_html; ?>
    <h1>Graduation Photo</h1>
    <div>
      <img src="" id="filepreviewimg1" value="<?php echo esc_attr( get_user_meta( $user_id, 'myspace_graduation_image', true ) ); ?>" alt="image/file" style=" display: none; width: 200px;margin-top: 5px;margin-bottom: 10px;">
    </div>
    <div class="upload-btn-wrapper">
    <button class="btn">Image</button>
    <input  type="file" name="<?php echo "ems[file]"; ?>[myspace_graduation_image] ?>" id="myspace_graduation_image" onchange="showImage1.call(this)" />
  </div>

    <h1>Leader Message</h1>

    <label>Leader image</label>
    <div>
      <img src="" id="filepreviewimg2" alt="image/file" value="<?php echo esc_attr( get_user_meta( $user_id, 'myspace_leader_image', true ) ); ?>"  style=" display: none; width: 200px;margin-top: 5px;margin-bottom: 10px;">
    </div>
    <div class="upload-btn-wrapper">
    <button class="btn">Image</button>
    <input  type="file" name="<?php echo "ems[file]"; ?>[myspace_leader_image] ?>" id="myspace_leader_image" onchange="showImage2.call(this)"/>
  </div>

    <label for="leader_message_title">Title</label>
    <input  type="text" id="leader_message_title" value="<?php echo esc_attr( get_user_meta( $user_id, 'leader_message_title', true ) ); ?>" name="<?php echo "ems[text]"; ?>[leader_message_title] ?>" placeholder="Enter leader message title..">

    <label for="leader_message_subtitle">Sub Title</label>
    <input  type="text" id="leader_message_subtitle" name="<?php echo "ems[text]"; ?>[leader_message_subtitle] ?>" placeholder="Enter leader message sub title.." value="<?php echo esc_attr( get_user_meta( $user_id, 'leader_message_subtitle', true ) ); ?>" >

    <label for="leader_message_content">Content</label>
    <textarea  name="<?php echo "ems[text]"; ?>[leader_message_content] ?>" id="leader_message_content" cols="112" rows="5" placeholder="Enter leader messege content" value="<?php echo esc_attr( get_user_meta( $user_id, 'leader_message_content', true ) ); ?>" ></textarea>


   <h1>Team Leader Message</h1>

    <label>Team Leader image</label>
    <div>
      <img src="" id="filepreviewimg3" alt="image/file" value="<?php echo esc_attr( get_user_meta( $user_id, 'myspace_team_leader_image' ) ); ?>"  style="display: none; width: 200px;margin-top: 5px;margin-bottom: 10px;">
    </div>
    <div class="upload-btn-wrapper">
    <button class="btn">Image</button>
    <input  type="file" name="<?php echo "ems[file]"; ?>[myspace_team_leader_image] ?>" id="myspace_team_leader_image" onchange="showImage3.call(this)"/>
  </div>

    <label for="team_leader_message_title">Title</label>
    <input  type="text" id="team_leader_message_title" name="<?php echo "ems[text]"; ?>[team_leader_message_title] ?>" placeholder="Enter team leader message title.." value="<?php echo esc_attr( get_user_meta( $user_id, 'team_leader_message_title', true ) ); ?>" >

    <label for="leader_message_subtitle">Sub Title</label>
    <input  type="text" id="team_leader_message_subtitle" name="<?php echo "ems[text]"; ?>[team_leader_message_subtitle] ?>" placeholder="Enter team leader message sub title.." value="<?php echo esc_attr( get_user_meta( $user_id, 'team_leader_message_subtitle', true ) ); ?>" >

    <label for="team_leader_message_content">Content</label>
    <textarea  name="<?php echo "ems[text]"; ?>[team_leader_message_content] ?>" id="team_leader_message_content" cols="112" rows="5" placeholder="Enter team leader messege content" value="<?php echo esc_attr( get_user_meta( $user_id, 'team_leader_message_content', true ) ); ?>" ></textarea>


    <h1>Before & After Video</h1>
    <div>
      <video width="400" controls>
      <source src="mov_bbb.mp4" id="video_before" value="<?php echo esc_attr( get_user_meta( $user_id, 'myspace_before_video', true ) ); ?>" >
        Your browser does not support HTML5 video.
    </video>
      
    </div>
    <label>Before</label>
    <div class="upload-btn-wrapper">
    <button class="btn">Video</button>
    <input  type="file" name="<?php echo "ems[file]"; ?>[myspace_before_video] ?>" class="file_multi_video1" accept="video/*">
  </div>

  <div>
    <video width="400" controls>
      <source src="mov_bbb.mp4" id="video_after" value="<?php echo esc_attr( get_user_meta( $user_id, 'myspace_after_video', true ) ); ?>" >
        Your browser does not support HTML5 video.
    </video>
    
    </div>
  <label>After</label>
    <div class="upload-btn-wrapper">
    <button class="btn">Video</button>
    <input  type="file" name="<?php echo "ems[file]"; ?>[myspace_after_video] ?>" class="file_multi_video2" accept="video/*">
  </div>
  <div>
    <input type="submit" name="submit" value="Submit">
  </div>
    
  </form>
</div> 
<?php    
  }
  else {  
  ?>
    <p> <?php __("You are not authorized to perform this operation.", "Edit MyPage") ?> </p>
  <?php   
  }