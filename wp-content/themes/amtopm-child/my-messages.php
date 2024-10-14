<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: my-messages
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}
if(isset($_GET['mark'])){
    mysqli_query($con," UPDATE `message` SET `read`='1' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-messages/");
}
get_header();
?>
<style>
    
</style>
<section id="my-messages" class="my-messages template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="my-messages";  include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>My Messages</h2>
                        </div>
                        <!--==== Tabs -->
                        <div class="contactRequestTable">
                                <table>
                                    <tbody>
                                        <?php
                                        $contactRequests=mysqli_query($con,"SELECT * FROM `contactRequest` order by id desc ");   
                                        while($contactRequest = mysqli_fetch_array($contactRequests)){
                                            $listings=mysqli_query($con,"SELECT * FROM `listings` where `id`='".$contactRequest['product']."' and `userID`='".$_COOKIE["user_id"]."' ");      
                                            $listing = mysqli_fetch_array($listings);
                                            if($listing['id']){
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="items">
                                                    <label>Product</label>
                                                    <div class="profile-pic-div">
                                                        <?php if($listing['gallery1']!=''){ ?>
                                                        <img src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>" style="border-radius:0px;">
                                                        <?php }elseif($listing['gallery2']!=''){ ?>
                                                        <img src="<?php echo $listing['gallery2']; ?>" alt="<?php echo $listing['title']; ?>" style="border-radius:0px;">
                                                        <?php }elseif($listing['gallery3']!=''){ ?>
                                                        <img src="<?php echo $listing['gallery3']; ?>" alt="<?php echo $listing['title']; ?>" style="border-radius:0px;">
                                                        <?php }else{ ?>
                                                        <img src="/wp-content/uploads/2024/05/images.png" alt="<?php echo $listing['title']; ?>" style="border-radius:0px;">
                                                        <?php } ?>
                                                        <h4><?php echo $listing['title']; ?></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Customer Name</label>
                                                    <p><?php echo $contactRequest['firstName'].' '.$contactRequest['lastName']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Customer Email</label>
                                                    <p><?php echo $contactRequest['emailAddress']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Customer Phone</label>
                                                    <p><?php echo $contactRequest['phoneNumber']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Customer Address</label>
                                                    <p><?php echo $contactRequest['address']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Description</label>
                                                <p><?php echo $contactRequest['description']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="items">
                                                    <label>Request At</label>
                                                    <h5><?php echo date("F d, Y", strtotime($contactRequest['created_at'])); ?></h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>

                        <!--==== Tabs -->    
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