<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/*
Template Name: profile-information
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

if(isset($_POST['manageAddressSubmit'])){
    $streetAddress=$_POST['streetAddress']?$_POST['streetAddress']:'';
    $city=$_POST['city']?$_POST['city']:'';
    $stateProvince=$_POST['stateProvince']?$_POST['stateProvince']:'';
    $zippostalCode=$_POST['zippostalCode']?$_POST['zippostalCode']:'';
    $country=$_POST['country']?$_POST['country']:'';
    $bstreetAddress=$_POST['bstreetAddress']?$_POST['bstreetAddress']:'';
    $bcity=$_POST['bcity']?$_POST['bcity']:'';
    $bstateProvince=$_POST['bstateProvince']?$_POST['bstateProvince']:'';
    $bzippostalCode=$_POST['bzippostalCode']?$_POST['bzippostalCode']:'';
    $bcountry=$_POST['bcountry']?$_POST['bcountry']:'';
    mysqli_query($con," UPDATE `address` SET `street`='".$streetAddress."',`city`='".$city."',`state`='".$stateProvince."',`postal`='".$zippostalCode."',`country`='".$country."',`shipStreet`='".$bstreetAddress."',
    `shipCity`='".$bcity."',`shipState`='".$bstateProvince."',`shipPostal`='".$bzippostalCode."',`shipCountry`='".$bcountry."' WHERE `userID`='".$_COOKIE["user_id"]."' ");
}

if(isset($_POST['manageInformationSubmit'])){
    $firstName=$_POST['firstName']?$_POST['firstName']:'';
    $lastName=$_POST['lastName']?$_POST['lastName']:'';
    $phoneNumber=$_POST['phoneNumber']?$_POST['phoneNumber']:'';
    $newsLetter=$_POST['newsLetter']?'Yes':'No';
    mysqli_query($con," UPDATE `account` SET `contact`='".$phoneNumber."',`firstname`='".$firstName."',`lastname`='".$lastName."',`newsletter`='".$newsLetter."' WHERE `id`=".$_COOKIE["user_id"]." ");
}

if(isset($_POST['manageProfileSubmit'])){
    $state=$_POST['state']?$_POST['state']:'';
    $profile = '';
    if(!empty($_FILES["profilePhoto"]["type"])){
        $fileName = time().'_'.$_FILES['profilePhoto']['name'];
        $sourcePath = $_FILES['profilePhoto']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $profile = "/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        }
    }
    
    mysqli_query($con," UPDATE `account` SET `state`='".$state."' WHERE `id`=".$_COOKIE["user_id"]." ");
    if($profile!=''){
        mysqli_query($con," UPDATE `account` SET `profile`='".$profile."' WHERE `id`=".$_COOKIE["user_id"]." ");
    }
    
}

get_header();

$accounts=mysqli_query($con,"SELECT * FROM `account` where `id`='".$_COOKIE["user_id"]."' ");      
$account = mysqli_fetch_array($accounts);

$addresses=mysqli_query($con,"SELECT * FROM `address` where `userID`='".$_COOKIE["user_id"]."' ");      
$address = mysqli_fetch_array($addresses);

?>

<section id="profile-information" class="profile-information template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="dashboard"; include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>Profile Information</h2>
                        </div>
                        <div class="profile-information-content">
                            <h4>Account Information</h4>
                            
                            <div class="profile-information-block profile-information-block01">
                                <div class="flex-class-profile-block">
                                   <div class="profile-info">
                                    <div class="profile-user-image">
                                        <?php if($account['profile']!=''){ ?>
                                        <img src="<?php echo $account['profile']; ?>" alt="Profile Image">
                                        <?php }else{ ?>
                                        <img src="/wp-content/uploads/2024/05/profile.jpg" alt="Profile Image">
                                        <?php } ?>
                                    </div>
                                    </div>
                                    <div class="profile-name-and-info">
                                        <h3><?php echo $account['firstname'].' '.$account['lastname']; ?></h3>
                                        <p><?php echo $account['state']; ?></p>
                                    </div> 
                                </div>
                                <div class="edit-btn-div">
                                    <a style="cursor:pointer;" class="editBtn openProfileManageModel"><span class="edit-icon"><i class="fa fa-pencil"></i></span>Edit</a>
                                </div>
                            </div>
                            
                            <div class="profile-information-block profile-information-block02">
                                <h3 class="personal-information">Information</h3>
                                <div class="user-information-block user-information-block01">
                                    <div class="user-information-block-item user-information-block-item01">
                                         <h4 class="first-name-title">First Name</h4>
                                         <p class"first-name"><?php echo $account['firstname']; ?></p>
                                    </div>
                                    <div class="user-information-block-item user-information-block-item02">
                                         <h4 class="last-name-title">Last Name</h4>
                                         <p class"last-name"><?php echo $account['lastname']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="user-information-block user-information-block02">
                                    <div class="user-information-block-item user-information-block-item01">
                                         <h4 class="email-address-title">Email Address</h4>
                                         <p class"email-class"><?php echo $account['email']; ?></p>
                                    </div>
                                    <div class="user-information-block-item user-information-block-item02">
                                         <h4 class="phone-number-title">Phone Number</h4>
                                         <p class"number-class"><?php echo $account['contact']; ?></p>
                                    </div>
                                </div>
                                
                                <div class="user-information-block user-information-block03">
                                    <div class="user-information-block-item user-information-block-item01">
                                         <h4 class="news-letter">News Letter</h4>
                                         <p class"profile-information">You <?php if($account['newsletter']=='Yes'){ echo "are"; }else{ echo "aren't"; } ?> subscribed to Our news letter</p>
                                    </div>
                                </div>
                                
                                <div class="edit-btn-div">
                                    <a style="cursor:pointer;" class="editBtn openInformationManageModel"><span class="edit-icon"><i class="fa fa-pencil"></i></span>Edit</a>
                                </div>
                                
                            </div>
                            
                            <div class="profile-information-block profile-information-block03">
                                <h3 class="addressbook">Address</h3>
                                <div class="user-information-block user-information-block01">
                                    <div class="user-information-block-item user-information-block-item01">
                                         <h4>Default Billing Address</h4>
                                         <?php if($address['street']!=''){ ?>
                                         <p><?php echo $address['street']; ?>, <?php echo $address['city']; ?>, <?php echo $address['state']; ?> <?php echo $address['postal']; ?>, <?php echo $address['country']; ?></p>
                                         <?php } ?>
                                    </div>
                                    <div class="user-information-block-item user-information-block-item02">
                                         <h4>Default Shipping Address</h4>
                                         <?php if($address['shipStreet']!=''){ ?>
                                         <p><?php echo $address['shipStreet']; ?>, <?php echo $address['shipCity']; ?>, <?php echo $address['shipState']; ?> <?php echo $address['shipPostal']; ?>, <?php echo $address['shipCountry']; ?></p>
                                         <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="edit-btn-div">
                                    <a style="cursor:pointer;" class="editBtn openAddressManageModel"><span class="edit-icon"><i class="fa fa-pencil"></i></span>Edit</a>
                                </div>
                            </div>
                            <!--=========== Next Button-->
                            <!-- End Template Page Content-->  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>

<div class="popup-class" id="manageAddressModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Manage Addresses <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery1" method="post" id="billing-address">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                    <h4>Billing Address</h4>
                        <div class="input-blocks input-block01">
                            <label for="street-address">Street Address<span>*</span></label>
                            <textarea name="streetAddress" id="street-address" placeholder="Type your street address here" required><?php echo $address['street']; ?></textarea>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="City">City<span>*</span></label>
                            <input type="text" name="city" id="City" placeholder="Type your city here" value="<?php echo $address['city']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block03">
                            <label for="state-province">State/Province<span>*</span></label>
                            <input type="text" name="stateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php echo $address['state']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="zip-postal-code">Zip/Postal Code<span>*</span></label>
                            <input type="number" name="zippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php echo $address['postal']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="country">Country<span>*</span></label>
                            <select id="country" name="country" required>
                                <option value="" >Select your country</option>
                                <option <?php if($address['country']=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                                <option <?php if($address['country']=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                                <option <?php if($address['country']=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                                <option <?php if($address['country']=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                                <option <?php if($address['country']=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                                <option <?php if($address['country']=='france'){ echo "selected"; } ?> value="france">France</option>
                                <option <?php if($address['country']=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                                <option <?php if($address['country']=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                            </select>
                        </div>
                    </div>
                <div class="flex-class-popup-item flex-class-popup-item-right">
                    <h4>Shipping Address</h4>
                        <div class="input-blocks input-block01">
                            <label for="street-address">Street Address<span>*</span></label>
                            <textarea name="bstreetAddress" id="street-address" placeholder="Type your street address here" required><?php echo $address['shipStreet']; ?></textarea>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="City">City<span>*</span></label>
                            <input type="text" name="bcity" id="City" placeholder="Type your city here" required value="<?php echo $address['shipCity']; ?>" />
                        </div>
                        <div class="input-blocks input-block03">
                            <label for="state-province">State/Province<span>*</span></label>
                            <input type="text" name="bstateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php echo $address['shipState']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="zip-postal-code">Zip/Postal Code<span>*</span></label>
                            <input type="number" name="bzippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php echo $address['shipPostal']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="country">Country<span>*</span></label>
                            <select id="country" name="bcountry" required>
                                <option value="" >Select your country</option>
                                <option <?php if($address['shipCountry']=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                                <option <?php if($address['shipCountry']=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                                <option <?php if($address['shipCountry']=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                                <option <?php if($address['shipCountry']=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                                <option <?php if($address['shipCountry']=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                                <option <?php if($address['shipCountry']=='france'){ echo "selected"; } ?> value="france">France</option>
                                <option <?php if($address['shipCountry']=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                                <option <?php if($address['shipCountry']=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageAddressSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="popup-class" id="manageInformationModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Information Detail <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery" method="post" id="billing-address">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                        <div class="input-blocks input-block01">
                            <label for="firstName">First Name<span>*</span></label>
                            <input type="text" name="firstName" id="firstName" value="<?php echo $account['firstname']; ?>" placeholder="Albert" required>
                        </div>
                        <div class="input-blocks input-block01">
                            <label for="lastName">Last Name<span>*</span></label>
                            <input type="text" name="lastName" id="lastName" value="<?php echo $account['lastname']; ?>" placeholder="John" required>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="phoneNumber">Phone Number<span>*</span></label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" value="<?php echo $account['contact']; ?>" placeholder="1234567890" required/>
                        </div>
                        <br>
                        <div class="input-blocks input-block03 checkbox">
                            <label for="newsLetter">News Letter</label>
                            <input type="checkbox" name="newsLetter" <?php if($account['newsletter']=='Yes'){ echo "checked"; } ?> id="newsLetter" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageInformationSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="popup-class" id="manageProfileModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Profile Detail <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery2" method="post" id="billing-address" enctype="multipart/form-data">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                        <div class="flex-block-item flex-block-item03">
                            <div class="flex-block-item flex-block-item01">
                                <div class="file-upload">
                                    <label class="template-label" for="profile-Photo">Profile Photo</label>
                                    <div class="Profile-Photo-uploade <?php if($account['profile']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow" <?php if($account['profile']!=''){ ?> style="background-image:url(<?php echo $account['profile']; ?>);" <?php } ?> >
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
                        <div class="input-blocks input-block02">
                            <label for="state">State<span>*</span></label>
                            <input type="text" name="state" id="state" placeholder="Type your state here" value="<?php echo $account['state']; ?>" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageProfileSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).on('click','.openAddressManageModel',function(){
        jQuery('#manageAddressModelPopup').show();
    });
    jQuery(document).on('click','.openInformationManageModel',function(){
        jQuery('#manageInformationModelPopup').show();
    });
    jQuery(document).on('click','.openProfileManageModel',function(){
        jQuery('#manageProfileModelPopup').show();
    });
    jQuery(document).on('click','h3 i.closeModel',function(){
        jQuery('#manageAddressModelPopup').hide();
        jQuery('#manageInformationModelPopup').hide();
        jQuery('#manageProfileModelPopup').hide();
    });
</script>
<script>
    jQuery(".formValidationQuery").validate();
    jQuery(".formValidationQuery1").validate();
    jQuery(".formValidationQuery2").validate();
    
    function readURL(input,id) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          jQuery('#'+id).attr('style', 'background-image:url('+e.target.result+')');
          jQuery('#'+id).hide();
          jQuery('#'+id).fadeIn(650);
          jQuery('#'+id).addClass('show');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    jQuery(".uploadImagePreviewer").change(function() {
      var id=jQuery(this).attr('data-preview')
      if(jQuery(this).val()!=''){
        readURL(this,id);
      }else{
        jQuery('#'+id).removeClass('show');  
        jQuery('#'+id).removeAttr('style');  
      }
    });
</script>