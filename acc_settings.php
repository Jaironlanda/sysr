<?php
    session_start();
    require './db-config/db.php';
    require './helper/pswdhash.php';

    $newHash = new CreateHash();

    $setting_type = $_POST['setting_type'];
    if(!empty($setting_type)){
        // email update
        if($setting_type == 1){
            // senetize input
            $email_setting = array(
                'email' => FILTER_VALIDATE_EMAIL,
                'old_email' => FILTER_VALIDATE_EMAIL,
            );
            $email_input = filter_input_array(INPUT_POST, $email_setting);
            // ensure email is exist
            $req_email = "SELECT user_id, email FROM user WHERE email='".$email_input['old_email']."'";
            $check_email = $conn->query($req_email);
            
            if(!$check_email){
                echo "Error: " . $req_email . "<br>" . mysqli_error($conn);
                exit;
            }
            
            if($check_email->num_rows == 1){
                // get user data base on user email
                $row = $check_email->fetch_assoc();
                //ensure entered email is unique
                $check_unique_email = "SELECT email FROM user WHERE email='".$email_input['email']."'";
                $is_unique_email = $conn->query($check_unique_email);
                
                if($is_unique_email->num_rows > 0){
                    $_SESSION['message_error'] = "Email allready exist in system.";
                    header('location: profile.php?user_id='.$row['user_id']);
                    exit; // avoid php run another script
                }else {
                    // update email
                    $sql_update_email = "UPDATE user SET email='".$email_input['email']."' WHERE user_id='".$row['user_id']."'";
                    $update_email = $conn->query($sql_update_email);
                }
                $_SESSION['message_noti'] = "Success update user profile";
            }else {
                $_SESSION['message_error'] = "Email not exist";
            }
            header('location: profile.php?user_id='.$row['user_id']);
            exit;
        }else if ($setting_type == 2){
            $user_id = $_POST['user_id'];
            $user_lvl = $_SESSION['is_logged']['user_lvl'];
            

            if ($_POST['new_pswd'] == $_POST['confirm_pswd']){
                if($user_lvl !=1){
                    $new_pswd = $newHash->pswd_hash($_POST['new_pswd']);
                    $update_pswd = "UPDATE user SET pswd='".$new_pswd."' WHERE user_id='".$user_id."'";
                    $conn->query($update_pswd);
                    
                    $_SESSION['message_noti'] = "Success update user password";
                    header('location: profile.php?user_id='.$user_id);

                }else {
                    // check if old password is equal
                    $req_pswd = "SELECT user_id, pswd FROM user WHERE user_id='".$user_id."'";
                    $get_user = $conn->query($req_pswd);
                    print_r($get_user);
                    if($get_user->num_rows == 1){
                        $row_pswd = $get_user->fetch_assoc();
                        print_r($row_pswd);
                        if(password_verify($_POST['old_pswd'], $row_pswd['pswd'])){
                            $new_pswd_user = $newHash->pswd_hash($_POST['new_pswd']);
                            $update_pswd_user = "UPDATE user SET pswd='".$new_pswd_user."' WHERE user_id='".$user_id."'";
                            $conn->query($update_pswd_user);
                            $_SESSION['message_noti'] = "Success update password";
                            header('location: profile.php');
                        }else {
                            $_SESSION['message_error'] = "Password not match!";
                            header('location: profile.php');
                        }
                    }
                    
                }
            }else {
                $_SESSION['message_error'] = "New password and confirm password not match!";
                if($user_lvl !=1){
                    header('location: profile.php?user_id='.$user_id);
                }else {
                    header('location: profile.php');
                }
                
            }

            // if admin old password is not require else rquire
            // update password
        }
    }else {
        header('location: https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        exit;
    }
?>