<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: Profile-panel 
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

if(isset($_POST['submit'])){
    $storeName=$_POST['storeName']?$_POST['storeName']:'';
    $streetAddress=$_POST['streetAddress']?$_POST['streetAddress']:'';
    $description=$_POST['description']?$_POST['description']:'';
    $city=$_POST['city']?$_POST['city']:'';
    $state=$_POST['state']?$_POST['state']:'';
    
    mysqli_query($con,"UPDATE `shop` SET `name`='".$storeName."',`description`='".$description."',`street`='".$streetAddress."',`city`='".$city."',`state`='".$state."' WHERE `userID`=".$_COOKIE["user_id"]." ");
    
    $temporaryprofileURL=$_POST['temporaryprofileURL']?$_POST['temporaryprofileURL']:'';
    
    $i=1;
    function slug_checker($cat, $req_slug, $con) {
        global $i;
        $slug = slugify($cat);
        $slugs = mysqli_query($con, "SELECT * FROM `shop` WHERE `slug`='" . $slug . "' AND `userID`!='" . $_COOKIE["user_id"] . "'");
        $slug_check = mysqli_fetch_array($slugs);
        if ($slug_check['id']) {
            $slug = slugify($cat) . '-' . $i;
            $i++;
            return $slug;
        } else {
            return false;
        }
    }
    function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    } 
    
    $s_c = slugify($temporaryprofileURL);
    $final_slug = slugify($temporaryprofileURL);
    while (is_string($s_c)) {
        if (is_string($s_c)) {
            $s_c = slug_checker($s_c, $temporaryprofileURL, $con);
            if (is_string($s_c)) {
                $final_slug = $s_c;
            }
        }
    }
    
    mysqli_query($con,"UPDATE `shop` SET `slug`='".$final_slug."' WHERE `userID`=".$_COOKIE["user_id"]." ");
    
    $profilePhoto = '';
    if(!empty($_FILES["profilePhoto"]["type"])){
        $fileName = time().'_'.$_FILES['profilePhoto']['name'];
        $sourcePath = $_FILES['profilePhoto']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/store/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $profilePhoto = "/wp-content/themes/amtopm-child/uploaded/store/".$fileName;
        }
    }
    if($profilePhoto!=''){
        mysqli_query($con,"UPDATE `shop` SET `profile`='".$profilePhoto."' WHERE `userID`=".$_COOKIE["user_id"]." ");
    }
    
}

get_header();
$shops=mysqli_query($con,"SELECT * FROM `shop` where `userID`='".$_COOKIE["user_id"]."' ");      
$shop = mysqli_fetch_array($shops);
?>

<section id="Profile-panel" class="Profile-panel template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="profile-panel"; include("custom-sidebar.php"); ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>My Shop</h2>
                        </div>
                        <!--==== Template Form-->
                        <div class="common-form-class my-shop-form">
                            <div class="form-title">
                                <h4>Profile Info</h4>
                                <p>Please fill in all fields and click Publish Profile to update your profile.</p>
                            </div>
                            <div class="template-form">
                                <form id="shopForm" class="formValidationQuery" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="flex-block flex-block01">
                                        <div class="flex-block-item flex-block-item01">
                                          <label class="template-label" for="StoreName">Store Name</label>
                                          <input type="text" id="StoreName" name="storeName" placeholder="The Bully Supply" value="<?php echo $shop['name']; ?>" maxlength="50" required />
                                          <label class="template-label-bottom">Max 50 characters</label>
                                        </div>
                                        <div class="flex-block-item flex-block-item02">
                                              <label class="template-label" for="street-Address">Street Address</label>
                                              <input type="text" id="street-Address" name="streetAddress" placeholder="123 blvd, 123 Ave" maxlength="50" value="<?php echo $shop['street']; ?>" required />
                                              <label class="template-label-bottom">Max 50 characters</label>
                                        </div>
                                    </div>
                                    
                                     <div class="flex-block flex-block02">
                                         
                                        <div class="flex-block-item flex-block-item01">
                                          <label class="template-label" for="Description">Description</label>
                                          <textarea required name="description" placeholder="Welcome to our premier dog emporium, where tails wag and hearts melt! Step into a world of canine delight at our dog store, where we cater to every breed, size, and personality. Our store is a haven for all things dog-related, curated with care to ensure your furry friend receives only the best."><?php echo $shop['description']; ?></textarea>
                                          <label class="template-label-bottom">Max 50 characters</label>
                                        </div>
                                        
                                        <div class="flex-block-item flex-block-item02">
                                            <div class="inner-flex-block">
                                                <div class="inner-flex-item inner-flex-item01">
                                                  <label class="template-label" for="city">City</label>
                                                      <input type="text" id="city" name="city" placeholder="Houston" maxlength="50" value="<?php echo $shop['city']; ?>" required />
                                                      <label class="template-label-bottom">Max 50 characters</label>
                                                </div>
                                                <div class="inner-flex-item inner-flex-item02">
                                                      <label class="template-label" for="street-Address">State</label>
                                                      <input type="text" id="street-Address" name="state" placeholder="Tx" maxlength="50" value="<?php echo $shop['state']; ?>" required />
                                                      <label class="template-label-bottom">Max 50 characters</label>
                                                </div>
                                            </div>
                                            <div class="flex-block-item flex-block-item03"> 
                                                <label class="template-label" for="temporaryprofile-url">Your temporary profile URL is:</label>
                                                <span class="storeLink">http://thebullysupply.com/<input type="text" id="temporaryprofile-url" name="temporaryprofileURL" value="<?php echo $shop['slug']; ?>" placeholder="the-dog-store" required /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== Template Form Button-->
                                    <div class="flex-block-item flex-block-item03">
                                        <div class="flex-block-item flex-block-item01">
                                            <div class="file-upload">
                                                <label class="template-label" for="profile-Photo">Profile Photo</label>
                                                <div class="Profile-Photo-uploade <?php if($shop['profile']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow" <?php if($shop['profile']!=''){ ?> style="background-image:url(<?php echo $shop['profile']; ?>);" <?php } ?>>
                                                    <input type="file" name="profilePhoto" class="uploadImagePreviewer" data-preview="uploadImagePreviewerShow" id="profile-Photo" style="cursor:pointer;" accept="image/png, image/gif, image/jpeg">
                                                    <div class="file-inner-content">
                                                        <span class="uploade-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png"></span>
                                                        <label class="upload-label">Drag or Upload Your Avatar</label>
                                                    </div>
                                                </div>
                                                <label class="template-label-bottom">Image must be at least 150 pixels wide and 110 pixels tall.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="template-form-button">
                                        <input type="submit" name="submit" value="Save Profile" class="save-profile">
                                    </div>
                                    <!--====== Template Form Button-->
                                </form>
                        </div>
                    </div>
                </div>
                <!-- End Template Page Content-->
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>