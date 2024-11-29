<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: vendor-chat
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

$accounts=mysqli_query($con,"SELECT * FROM `account` where `id`='".$_COOKIE["user_id"]."' ");      
$account = mysqli_fetch_array($accounts);

get_header(); 
?>
<style>

.ruk-my-message-content .dashboard {
  flex-grow: 1;
  display: flex;
}

.ruk-my-message-content .my-messages-box {
  border: 0.3px solid #b9b9b9;
  border-radius: 14px;
  color: #202224;
  width: 286px;
  padding-top: 24px;
  padding-bottom: 42px;
  padding-left: 18px;
  padding-right: 24px;
  margin-top: 32px;
  margin-left: 13px;
}

.ruk-my-message-content .my-messages-box h1 {
  font-size: 28px;
  font-weight: 800;
  overflow: hidden;
  margin-bottom: 16px;
}

.ruk-my-message-content .my-messages-box .search input {
  padding: 11px 0 10px 16px;
  background-color: #f5f6fa;
  border: 0.6px solid #d5d5d5;
  border-radius: 5px;
  margin-bottom: 21px;
}

.ruk-my-message-content .my-messages-box .chat-box {
  display: grid;
  grid-template-columns: auto 1fr 1fr;
  align-items: center;
  margin-bottom: 27px;
}

.ruk-my-message-content .my-messages-box .chat-box img {
  width: 45px;
  height: 45px;
}

.ruk-my-message-content .chat-box .chat-box-headings h3 {
  overflow: hidden;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 700;
}
.ruk-my-message-content .chat-box .chat-box-headings span {
  font-size: 12px;
  font-weight: 400;
  color: #258c60;
}

.ruk-my-message-content .chat-box .chat-box-time {
  justify-self: right;
}
.ruk-my-message-content .chat-box .chat-box-time p {
  margin-bottom: 0;
  color: #a9abad;
  font-size: 11px;
  font-weight: 500;
}
.ruk-my-message-content .chat-box .chat-box-time .badge {
  color: #fff;
  background-color: #d34141;
  border-radius: 50%;
  float: right;
  text-align: center;
}

.ruk-my-message-content .all-messages {
  margin-top: 30px;
}

.ruk-my-message-content .all-messages p {
  display: flex;
  align-items: center;
  gap: 7px;
  margin-bottom: 13px;
  font-size: 12px;
  font-weight: 400;
}

.ruk-my-message-content .main-chat {
  flex-grow: 1;
  border: 0.3px solid #b9b9b9;
  border-radius: 14px;
  color: #202224;
  padding-top: 17px;
  padding-bottom: 19px;
  padding-left: 22px;
  padding-right: 21px;
  margin-top: 32px;
  margin-left: 21px;
  margin-right: 29px;
  display: flex;
  flex-direction: column;
}

.ruk-my-message-content .box-1 {
  display: grid;
  grid-template-columns: auto 1fr 1fr;
  color: #202224;
  gap: 18px;
  margin-bottom: 24px;
}

.ruk-my-message-content .box-1 img {
  width: 60px;
  height: 60px;
}

.ruk-my-message-content .box-1 h2 {
  overflow: hidden;
  margin-bottom: 0;
  font-size: 30px;
  font-weight: 500;
}

.ruk-my-message-content .box-1 span {
  font-size: 14px;
  font-weight: 500;
  color: #41d37e;
}

.ruk-my-message-content .box-1 .btn-group {
  justify-self: end;
}

.ruk-my-message-content .box-1 .btn-group button {
  padding: 12px 14px;
  border: 0.6px solid #003459;
  background-color: #fff;
}
.ruk-my-message-content .box-1 .btn-group button:nth-child(1) {
  border-right: none;
  border-top-left-radius: 12px;
  border-bottom-left-radius: 12px;
}
.ruk-my-message-content .box-1 .btn-group button:nth-child(3) {
  border-left: none;
  border-top-right-radius: 12px;
  border-bottom-right-radius: 12px;
}

.ruk-my-message-content .box-2 {
  border: 1px solid #cacaca;
  border-radius: 5px;
  padding: 10px 14px;
  display: grid;
  grid-template-columns: auto 1fr 1fr;
  align-items: center;
  gap: 9px;
}

.ruk-my-message-content .box-2 span:nth-child(1) {
  font-size: 16px;
  font-weight: 800;
  color: #1a1a1a;
  margin-right: 9px;
}
.ruk-my-message-content .box-2 span:nth-child(2) {
  font-size: 14px;
  font-weight: 600;
  color: #8b1339;
  margin-right: 9px;
}
.ruk-my-message-content .box-2 span:nth-child(3) {
  font-size: 9px;
  font-weight: 600;
  color: #2c742f;
  background-color: #ffd7e4;
  border: none;
  border-radius: 4px;
  padding: 3px 9px;
}

.ruk-my-message-content .box-2 button {
  justify-self: end;
  padding: 6px 18px;
  font-size: 10px;
  font-weight: 600;
  color: #fff;
  background-color: #8b1339;
  border: none;
  border-radius: 37px;
}

.ruk-my-message-content .box-3 {
  margin-top: 258px;
  max-width: 339px;
}
.ruk-my-message-content .box-3 .headings {
  display: inline-block;
}

.ruk-my-message-content .box-3 .headings .heading {
  font-size: 16px;
  font-weight: 700;
  color: #202224;
  margin-right: 30px;
  overflow: hidden;
}

.ruk-my-message-content .box-3 .headings .time {
  font-size: 13px;
  font-weight: 400;
  color: #7c8b9f;
}

.ruk-my-message-content .box-3 .p1,
.p2 {
  max-width: 279px;
  font-size: 14px;
  font-weight: 500;
  color: #768396;
  padding: 12px 0 11px 16px;
  border-radius: 14px;
  background-color: #f5f6fa;
  margin-left: 50px;
}
.ruk-my-message-content .box-3 .p2 {
  max-width: 217px;
}

.ruk-my-message-content .line-container {
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
}

.ruk-my-message-content .line-container::after {
  content: "";
}
.ruk-my-message-content .line-left,
.ruk-my-message-content .line-right {
  border-top: 2px solid #212229;
  width: 40%;
  display: inline-block;
}

.ruk-my-message-content .line-text {
  font-size: 13px;
  font-weight: 500;
  color: #6b7c93;
  margin: 0 10px;
}

.ruk-my-message-content .box-4 {
  margin-top: 23px;
  margin-bottom: 83px;
  max-width: 339px;
  display: flex;
  flex-direction: column;
  align-self: end;
}
.ruk-my-message-content .box-4 .headings {
  display: flex;
  align-items: center;
  justify-content: end;
}

.ruk-my-message-content .box-4 .headings .heading {
  font-size: 16px;
  font-weight: 700;
  color: #202224;
  margin-left: 30px;
  margin-right: 9px;
  overflow: hidden;

}

.ruk-my-message-content .box-4 .headings .time {
  font-size: 13px;
  font-weight: 400;
  color: #7c8b9f;
}

.ruk-my-message-content .box-4 .p1 {
  max-width: 279px;
  font-size: 14px;
  font-weight: 500;
  color: #FFFFFF;
  padding: 13px 16px 12px 19px;
  border-radius: 14px;
  background-color: #003459;
  margin-right: 50px;
}

.ruk-my-message-content .comment-bar {
  display: flex;
  position: relative;
}
.ruk-my-message-content .comment-bar input{
  padding: 16px 0 15px 50px;
  font-size: 14px;
  font-weight: 500;
  color: #888888;
  background-color: #F5F6FA;
  border: 1px solid #D5D5D5;
  border-radius: 25px;
  flex-grow: 1;
}

.ruk-my-message-content .comment-bar .fa-microphone {
  position: absolute;
  top: 19px;
  left: 30px;
}
.ruk-my-message-content .comment-bar-icons {
  position: absolute;
  top: 19px;
  right: 16px;
}
.ruk-my-message-content .comment-bar-icons i {
  margin-right: 20px;
}

    
</style>
<link rel="stylesheet" href="/wp-content/themes/amtopm-child/chat.css">
<section id="leaderboard-promotion" class="leaderboard-promotion template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar='vendor-chat'; include "custom-sidebar.php"; ?>
                </div>
                <div class="content-wrapper" id="inboxChatPage">

						      <div class="ruk-my-message-content">
							<div class="dashboard">
							  <div class="my-messages-box">
								<h1>My Messages</h1>
								<div class="search">
								  <input type="text" placeholder="Search Messages" />
								</div>

								<div class="recent-chats">
									<?php
                                    $i=1;
                                    $randomColorArray = array('#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399', '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933', '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF');
                                    $chats=mysqli_query($con,"SELECT * FROM `chat` where `vendor`='".$_COOKIE["user_id"]."' ");      
                                    while($chat = mysqli_fetch_array($chats)){
										
                                ?> 
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3><?php echo $chat['recievername']; ?></h3>
<!-- 									  <span>Typing...</span> -->
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
									<?php } ?>
								</div>

								<div class="all-messages">
								  <p><i class="fa fa-weixin" aria-hidden="true"></i>All Messages</p>

								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								  <div class="chat-box">
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
									<div class="chat-box-headings">
									  <h3>Killan James</h3>
									  <span>Typing...</span>
									</div>
									<div class="chat-box-time">
									  <p>4:30 PM</p>
									  <span class="badge">2</span>
									</div>
								  </div>
								</div>
							  </div>

							  <div class="main-chat">
								<div class="box-1">
								  <img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
								  <div class="headings">
									<h2>Mr Jack</h2>
									<span>online</span>
								  </div>
								  <div class="btn-group">
									<button><i class="fa fa-download" aria-hidden="true"></i></button>
									<button><i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>
									<button><i class="fa fa-trash" aria-hidden="true"></i></button>
								  </div>
								</div>

								<div class="box-2">
								  <img src="/wp-content/uploads/2024/11/listing-pro-232.png" alt="" />
								  <div class="headings">
									<span>Shiba Inu Sepia</span>
									<span>34.000 USD</span>
									<span>From Store</span>
								  </div>
								  <button>View Listing</button>
								</div>

								<div class="box-3">
								  <img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
								  <div class="headings">
									<span class="heading">Killan James</span>
									<span class="time">10:12 AM</span>
								  </div>
								  <p class="p1">Hi, do your still have bully?.</p>
								  <i class="fa-solid fa-ellipsis-vertical"></i>
								  <p class="p2">would love to bully dogs 😁</p>
								</div>

								<div class="line-container">
								  <hr class="line-left" />
								  <span class="line-text">Today, March 24</span>
								  <hr class="line-right" />
								</div>

								<div class="box-4">
								  <div class="headings">
									<span class="time">10:12 AM</span>
									<span class="heading">Killan James</span>
									<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
								  </div>
								  <p class="p1">Great 🔥 Yes! I have one..... 😍👏</p>
								</div>
								<div class="comment-bar">
								  <i class="fa fa-microphone" aria-hidden="true"></i>
									<input type="hidden" name="id" class="id" />
                                  <input type="hidden" name="senderid" class="senderid" value="<?php echo $account['id']; ?>">
                                  <input type="hidden" name="recievername" class="recievername" value="<?php if($account['firstname']!=''){ echo $account['firstname'].' '.$account['lastname']; }else{ echo $account['username']; } ?>">
                                  <?php if($account['profile']!=''){ ?>
                                  <input type="hidden" name="senderProfile" class="senderProfile" value="<?php echo $account['profile']; ?>">
                                  <?php }else{ ?>
                                  <input type="hidden" name="senderProfile" class="senderProfile" value="/wp-content/uploads/2024/05/profile.jpg">
                                  <?php } ?>
                                  <input type="hidden" name="senderProfileName" class="senderProfileName" value="">
                                  <input type="hidden" name="userProfile" class="userProfile" value="">
                                  <input type="hidden" name="userProfileName" class="userProfileName" value="">
								  <input type="text" placeholder="Add a comment..." />
								  <div class="comment-bar-icons">
									<i class="fa fa-picture-o" aria-hidden="true"></i>
									<i class="fa fa-smile-o" aria-hidden="true"></i>
									<i class="fa fa-paper-plane" aria-hidden="true"></i>
									<i class="fa fa-map-marker" aria-hidden="true"></i>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
					
					
					
					 	<div id="chat-box"></div>
					  <input type="text" id="chat-message" placeholder="Type a message" />
					  <button id="send-message">Send</button>
					
					
					
					<!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                
                      <div class="app-chat card overflow-hidden">
                        <div class="row g-0">
                          <!-- Chat & Contacts -->
                          <div
                            class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                            id="app-chat-contacts"
                          >
                            <div class="sidebar-header">
                              <div class="d-flex align-items-center me-3 me-lg-0">
                                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                  <span class="input-group-text" id="basic-addon-search31"><i class="fa fa-search"></i></span>
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Search Users..."
                                    aria-label="Search..."
                                    id="search_user_chat_input"
                                  />
                                </div>
                              </div>
                              <i
                                class="fa fa-times cursor-pointer d-lg-none d-block position-absolute mt-2 me-1 top-0 end-0"
                                data-overlay
                                data-bs-toggle="sidebar"
                                data-target="#app-chat-contacts"
                              ></i>
                            </div>
                            <hr class="container-m-nx m-0" />
                            <div class="sidebar-body">
                              <!-- Chats -->
                              <ul class="list-unstyled chat-contact-list" id="chat-list">
                                <?php
                                    $i=1;
                                    $randomColorArray = array('#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399', '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933', '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF');
                                    $chats=mysqli_query($con,"SELECT * FROM `chat` where `vendor`='".$_COOKIE["user_id"]."' ");      
                                    while($chat = mysqli_fetch_array($chats)){
                                ?> 
                                  <li class="chat-contact-list-item userChat userChatMessage<?php echo str_replace('.', '_', $chat['customer']); ?>" data-designation='Customer' data-role='customer' data-userID=<?php echo str_replace('.', '_', $chat['customer']); ?> data-userName="Customer <?php echo $i; ?>" data-userImage="C" data-userImageType="name" data-onlineStatus="Offline" data-position=0>
                                    <a class="d-flex align-items-center">
                                      <div class="avatar d-block flex-shrink-0">
                                        <?php
                                            $k = array_rand($randomColorArray);
                                        ?>
                                            <span style="background-color:<?php echo $randomColorArray[$k]; ?> !important;color:#fff !important;" class="avatar-initial rounded-circle bg-label-primary">C</span>
                                      </div>
                                      <div class="chat-contact-info flex-grow-1 ms-2">
                                        <h6 class="chat-contact-name text-truncate m-0">Customer <?php echo $i; ?></h6>
                                        <p class="chat-contact-status text-muted text-truncate mb-0">User</p>
                                      </div>
                                      <span class="unread_messages_appear_here_set" id="unread_messages_appear_here_set<?php echo str_replace('.', '_', $chat['customer']); ?>"></span>
                                    </a>
                                  </li>
                                  <?php $i++; } ?>
                              </ul>
                            </div>
                          </div>
                          <!-- /Chat contacts -->
                
                          <!-- Chat History -->
                          <div class="col app-chat-history bg-body">
                            <div class="chat-history-wrapper">
                              <div class="chat-history-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="d-flex overflow-hidden align-items-center">
                                   <div class="flex-shrink-0 avatar" id="chatUserboxImage">
                                      <img
                                        src=""
                                        alt="Avatar"
                                        class="rounded-circle"
                                        data-bs-toggle="sidebar"
                                        data-overlay
                                        data-target="#app-chat-sidebar-right" style="display: none;"
                                      />
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-2">
                                      <h6 class="m-0" id="chatUserboxName"></h6>
                                      <small class="user-status text-muted" id="chatUserboxDesignation"></small>
                                    </div>
                                  </div>
                                  <div class="d-flex align-items-center" id="headerRightSideIcons" style="display: none !important;">
                                    <span class="search-chat-box">
                                      <i class="fa fa-search cursor-pointer d-sm-block d-none me-3"></i>
                                      <input type="text" name="search_chat" placeholder="Search Chat..." class="form-control" id="search_chat">
                                    </span>
                                    <div class="dropdown">
                                      <i
                                        class="fa fa-dots-vertical cursor-pointer"
                                        id="chat-header-actions"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                      >
                                      </i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="chat-history-body bg-body">
                                <ul class="list-unstyled chat-history" id="chat-history">
                                  <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                      <div class="user-avatar flex-shrink-0 me-3">
                                        <div class="avatar avatar-sm">
                                          <span>BS</span>
                                        </div>
                                      </div>
                                      <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                          <p class="mb-0">Let's get started! Select the vendor to connect</p>
                                          <p class="mb-0">With, initiate conversations, and let the conversation begin.</p>
                                        </div>
                                        <div class="chat-message-text mt-2">
                                          <p class="mb-0">If you have any questions or need assistance, don't hesitate to reach out to our support.</p>
                                          <p class="mb-0">We're here to ensure you have the best possible chat experience.</p>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <!-- Chat message form -->
                              <div class="chat-history-footer shadow-sm"> 
                                <form class="chat_message_send d-flex justify-content-between align-items-center" action="/wp-content/themes/amtopm-child/ajax.php" method="post" >
                                  <input type="hidden" name="id" class="id" />
                                  <input type="hidden" name="senderid" class="senderid" value="<?php echo $account['id']; ?>">
                                  <input type="hidden" name="recievername" class="recievername" value="<?php if($account['firstname']!=''){ echo $account['firstname'].' '.$account['lastname']; }else{ echo $account['username']; } ?>">
                                  <?php if($account['profile']!=''){ ?>
                                  <input type="hidden" name="senderProfile" class="senderProfile" value="<?php echo $account['profile']; ?>">
                                  <?php }else{ ?>
                                  <input type="hidden" name="senderProfile" class="senderProfile" value="/wp-content/uploads/2024/05/profile.jpg">
                                  <?php } ?>
                                  <input type="hidden" name="senderProfileName" class="senderProfileName" value="">
                                  <input type="hidden" name="userProfile" class="userProfile" value="">
                                  <input type="hidden" name="userProfileName" class="userProfileName" value="">
                                  <input
                                    class="form-control message-input border-0 me-3 shadow-none"
                                    placeholder="Type your message here" required
                                  />
                                  <div class="message-actions d-flex align-items-center">
                                    <button class="btn btn-primary d-flex send-msg-btn">
                                      <i class="fa fa-send me-md-1 me-0"></i>
                                      <span class="align-middle d-md-inline-block d-none">Send</span>
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- /Chat History -->
                
                          <div class="app-overlay"></div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- / Content -->
                
                    <div class="content-backdrop fade"></div>
                  </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>
<script src="https://www.gstatic.com/firebasejs/5.0.0/firebase-app.js"></script>
<script>
jQuery(document).on('click','ul#chat-list li.userChat',function(){
    jQuery('ul#chat-list li.userChat').removeClass('active');
    jQuery(this).addClass('active');
    var userID=jQuery(this).attr('data-userid');
    var userRole=jQuery(this).attr('data-role');
    var userDesignation=jQuery(this).attr('data-designation');
    var userName=jQuery(this).attr('data-username');
    var userImage=jQuery(this).attr('data-userimage');
    var userImageType=jQuery(this).attr('data-userImageType');
    var onlineStatus=jQuery(this).attr('data-onlinestatus');
    jQuery("form.chat_message_send input.id").val(userID);
    jQuery('h6#chatUserboxName').text(userName);
    jQuery('small#chatUserboxDesignation').text(userDesignation);
    jQuery("#chatmedia_popup .modal-body").html('');
    if(userImageType=='image'){
        jQuery('div#chatUserboxImage').html('<img src="'+userImage+'" alt="Avatar" class="rounded-circle app-chat-sidebar-right-btn" data-target="'+userID+'" />');
        jQuery("form.chat_message_send input.userProfile").val(userImage);
        jQuery("form.chat_message_send input.userProfileName").val('');
    }else{
        jQuery('div#chatUserboxImage').html('<span class="avatar-initial rounded-circle bg-label-primary app-chat-sidebar-right-btn" data-target="'+userID+'">'+userImage+'</span>');
        jQuery("form.chat_message_send input.userProfile").val('');
        jQuery("form.chat_message_send input.userProfileName").val(userImage);
    }
    jQuery('div#chatUserboxImage').show();
    jQuery('div#headerRightSideIcons').attr('style','display: flex !important;');
    jQuery('.app-chat .app-chat-history .chat-history-footer').show();
    jQuery("ul#chat-history").html('');
    setTimeout(function(){ retrive_chat_history(); }, 500);
});

jQuery(document).on('click','.app-chat-sidebar-right-btn',function(){
    var actionID=jQuery(this).attr('data-target');
    jQuery('.col.app-chat-sidebar-right.app-sidebar').removeClass('show');
    jQuery('#app-chat-sidebar-right'+actionID).addClass('show');
});

jQuery(document).on('click','div.col.app-chat-sidebar-right.app-sidebar i.close-sidebar',function(){
    jQuery('.col.app-chat-sidebar-right.app-sidebar').removeClass('show');
});

jQuery(document).on('keyup','input#search_user_chat_input',function(){
  var searchString = jQuery(this).val();
  jQuery("ul#chat-list li.chat-contact-list-item.userChat").each(function(index, value) {
    var currentName = jQuery(value).text()
    if(currentName.toUpperCase().indexOf(searchString.toUpperCase()) > -1) {
      jQuery(value).show();
    } else {
      jQuery(value).hide();
    }
  });
});

jQuery(document).on('keyup','input#search_chat',function(){
  var searchString = jQuery(this).val();
  jQuery("ul#chat-history li.chat-message").each(function(index, value) {
    var currentName = jQuery(value).text()
    if(currentName.toUpperCase().indexOf(searchString.toUpperCase()) > -1) {
      jQuery(value).show();
    } else {
      jQuery(value).hide();
    }
  });
});

 
//chat firebase integrations start here

 // Your web app's Firebase configuration
  var firebaseConfig = {       
          apiKey: "AIzaSyAO0ucQkbe5xTna5eu4gfq_evnxPstfCn0",
		  authDomain: "the-bully-supply-caeb1.firebaseapp.com",
		  databaseURL: "https://the-bully-supply-caeb1-default-rtdb.firebaseio.com",
		  projectId: "the-bully-supply-caeb1",
		  storageBucket: "the-bully-supply-caeb1.firebasestorage.app",
		  messagingSenderId: "1054069613650",
		  appId: "1:1054069613650:web:f2793638de7635600feb8b"
      };
	
	
	firebase.initializeApp(firebaseConfig);
	
	 var database = firebase.database(),
        d = new Date,
        t = d.getTime(), 
        counter = t;
	

    // DOM Elements
    const chatBox = document.getElementById('chat-box');
    const chatMessage = document.getElementById('chat-message');
    const sendMessage = document.getElementById('send-message');

    // Load Messages
    database.ref('messages').on('child_added', (snapshot) => {
      const data = snapshot.val();
      const msgDiv = document.createElement('div');
      msgDiv.textContent = `${data.sender}: ${data.message}`;
      chatBox.appendChild(msgDiv);
      chatBox.scrollTop = chatBox.scrollHeight;
    });

    // Send Message
    sendMessage.addEventListener('click', () => {
      const message = chatMessage.value.trim();
      if (message) {
        database.ref('messages').push({
          sender: 'User1', // Static sender, can be dynamic
          message: message
        });
        chatMessage.value = '';
      }
    });
   

//chat firebase integrations end here

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' '+hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

var nodeCounter=0;

database.ref("messages").on("child_added", function(firebaseData) {
	
    var userID=jQuery("form.chat_message_send input.id").val();
    var senderID=jQuery("form.chat_message_send input.senderid").val();
    var senderProfile=jQuery("form.chat_message_send input.senderProfile").val();
    var senderProfileName=jQuery("form.chat_message_send input.senderProfileName").val();
    var userProfile=jQuery("form.chat_message_send input.userProfile").val();
    var userProfileName=jQuery("form.chat_message_send input.userProfileName").val();
    var firebaseValue = firebaseData.val();
	
	console.log('firebaseValue', firebaseValue);
	
    nodeCounter=firebaseValue.unique_id;
    var msg_senderID=senderID;
    var allUsersIDs=jQuery("ul#chat-list li").length;
    var allUsersIDs_array=[];
	
	console.log('userID', userID);
		console.log('senderID', senderID);
		console.log('senderProfile', senderProfile);
		console.log('senderProfileName', senderProfileName);
		console.log('userProfile', userProfile);
	console.log('userProfileName', userProfileName);
	
    jQuery('ul#chat-list li').each(function(){
        if(jQuery(this).attr('data-userid')!=undefined){
            allUsersIDs_array.push(jQuery(this).attr('data-userid'));
        }
    });
    if((msg_senderID!=firebaseValue.sender && (msg_senderID==firebaseValue.user1 || 
        msg_senderID==firebaseValue.user2)) && (allUsersIDs_array.indexOf(firebaseValue.user1) != -1 || 
        allUsersIDs_array.indexOf(firebaseValue.user2) != -1)){
        if(firebaseValue.MsgSend=='no'){
            database.ref("messages").child(firebaseValue.unique_id).update({
                MsgSend: 'yes'
            });
            jQuery("div.customize_alert_message.alert-success").text(firebaseValue.recievername+' sent you new message!');
            jQuery("div.customize_alert_message.alert-success").show();
            setTimeout(function(){ jQuery('.customize_alert_message').hide(); }, 5000);
        }
    }
    only_check_unread_messages();
    if(userID!='' && senderID!=''){
        if ((userID == firebaseValue.user1 && senderID == firebaseValue.user2) || (userID == firebaseValue.user2 && senderID == firebaseValue.user1)) {

            if(senderID!=firebaseValue.sender){
                database.ref("messages").child(firebaseValue.unique_id).update({
                    status: 'read'
                });
            }

            var sender_title=senderID==firebaseValue.sender?'my':'other';
            var msgImage='';
            if(firebaseValue.images!=''){
                var sepImages=firebaseValue.images.split(',');
                msgImage+="<div class='msg_images'>";
                for(var i=0;i<sepImages.length;i++){
                    msgImage+="<img src='/public/upload/chat/"+sepImages[i]+"' />";
                }
                msgImage+="</div>";
            }
            jQuery("#chatmedia_popup .modal-body").append(msgImage);
            var profileImage=senderProfile!=''?'<img src="'+senderProfile+'" alt="Avatar" class="rounded-circle">':'<span>'+senderProfileName+'</span>';
            var userProfileImage=userProfile!=''?'<img src="'+userProfile+'" alt="Avatar" class="rounded-circle">':'<span>'+userProfileName+'</span>';
            
            var messageDateFromArray=firebaseValue.created_at.split(' ');
            var messageDateFromArrayDate=messageDateFromArray[0].split('-');
            var messageDateFromArrayTime=messageDateFromArray[1].split(':');
            var messageDateFromYear=messageDateFromArrayDate[0];
            var messageDateFromMonth=parseInt(messageDateFromArrayDate[1])<10?'0'+messageDateFromArrayDate[1]:messageDateFromArrayDate[1];
            var messageDateFromDay=parseInt(messageDateFromArrayDate[2])<10?'0'+messageDateFromArrayDate[2]:messageDateFromArrayDate[2];
            var messageDateFromHour=parseInt(messageDateFromArrayTime[0])<10?'0'+messageDateFromArrayTime[0]:messageDateFromArrayTime[0];
            var messageDateFromMinute=parseInt(messageDateFromArrayTime[1])<10?'0'+messageDateFromArrayTime[1]:messageDateFromArrayTime[1];
            var messageDateFromSecond=parseInt(messageDateFromArrayTime[2])<10?'0'+messageDateFromArrayTime[2]:messageDateFromArrayTime[2];
            var messageDateFrom=!isNaN(new Date(messageDateFromYear+'-'+messageDateFromMonth+'-'+messageDateFromDay+'T'+messageDateFromHour+':'+messageDateFromMinute+':'+messageDateFromSecond))?formatAMPM(new Date(messageDateFromYear+'-'+messageDateFromMonth+'-'+messageDateFromDay+'T'+messageDateFromHour+':'+messageDateFromMinute+':'+messageDateFromSecond)):'';
            
            if(sender_title=='my'){
                jQuery("ul#chat-history").append(`<li class="chat-message chat-message-right">
                    <div class="d-flex overflow-hidden">
                      <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                          `+msgImage+`
                          <p class="mb-0">`+firebaseValue.message+`</p>
                        </div>
                        <div class="text-end text-muted mt-1">
                          <small>`+messageDateFrom+`</small>
                        </div>
                      </div>
                      <div class="user-avatar flex-shrink-0 ms-3">
                        <div class="avatar avatar-sm">
                          `+profileImage+`
                        </div>
                      </div>
                    </div>
                  </li>`);
            }else{
                jQuery("ul#chat-history").append(`<li class="chat-message">
                    <div class="d-flex overflow-hidden">
                      <div class="user-avatar flex-shrink-0 me-3">
                        <div class="avatar avatar-sm">
                          `+userProfileImage+`
                        </div>
                      </div>
                      <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                          `+msgImage+`
                          <p class="mb-0">`+firebaseValue.message+`</p>
                        </div>
                        
                        <div class="text-muted mt-1">
                          <small>`+messageDateFrom+`</small>
                        </div>
                      </div>
                    </div>
                  </li>`);
            }
            jQuery('.app-chat .app-chat-history .chat-history-body').scrollTop(jQuery('.app-chat .app-chat-history .chat-history-body')[0].scrollHeight);
        }
    }
})

only_check_unread_messages();
function only_check_unread_messages(){
    //top of the function start
        var insideID=0;
        var allUsersIDs=jQuery("ul#chat-list li").length;
        var allUsersIDs_array=[];
        jQuery('ul#chat-list li').each(function(){
            if(jQuery(this).attr('data-userid')!=undefined){
                allUsersIDs_array.push({id:jQuery(this).attr('data-userid'),c:0});
            }
        });
    //top of the function end

        database.ref("messages").once("value", function(firebaseData) {
            var userID=jQuery("form.chat_message_send input.id").val();
            var senderID=jQuery("form.chat_message_send input.senderid").val();
            var firebaseValue = firebaseData.val();
            if(firebaseValue!=null){
                var keys = Object.keys(firebaseValue).map((i) => Number(i));
                for (var i = 0; i < keys.length; i++){
                    database.ref('messages' + keys[i]).once("value", function(detail){
                        var detailed = detail.val();
                        
                        if(detailed!=null){
                            //show unread message numbers here start
                                if(((senderID==detailed.user1 || senderID==detailed.user2) && detailed.sender!=detailed.user1) && allUsersIDs_array.findIndex(x => x.id === detailed.user2)!=-1){
                                    if(detailed.status=='unread'){
                                        allUsersIDs_array[allUsersIDs_array.findIndex(x => x.id === detailed.user2)].c=(allUsersIDs_array[allUsersIDs_array.findIndex(x => x.id === detailed.user2)].c)+1;
                                    }
                                }
                            //show unread message numbers here end 

                            if((userID == detailed.user1 && senderID == detailed.user2) || (userID == detailed.user2 && senderID == detailed.user1)) {
                                jQuery("#unread_messages_appear_here_set"+userID).html('');
                                jQuery("#unread_messages_appear_here_set"+userID).hide();
                                jQuery("span#message_total_show_number").hide();
                                jQuery("span#message_total_show_number").html('');
                                insideID=userID;
                            }
                        }
                    })
                }
            }
        })

    //final loop start here
        setTimeout(function(){
            var overallmessages=0;
            for(var x=0;x<allUsersIDs_array.length;x++){
                if(allUsersIDs_array[x].id!=insideID && allUsersIDs_array[x].c>0){
                    jQuery("#unread_messages_appear_here_set"+allUsersIDs_array[x].id).html(allUsersIDs_array[x].c);
                    jQuery("#unread_messages_appear_here_set"+allUsersIDs_array[x].id).attr('style','display:flex;');
                    jQuery("#unread_messages_appear_here_set"+allUsersIDs_array[x].id).parent().parent().attr('data-position',allUsersIDs_array[x].c);
                }else{
                    jQuery("#unread_messages_appear_here_set"+allUsersIDs_array[x].id).html('');
                    jQuery("#unread_messages_appear_here_set"+allUsersIDs_array[x].id).hide();
                }
                overallmessages+=allUsersIDs_array[x].c;
            }
            if(overallmessages>0){
                jQuery(function() {
                  jQuery("group#groupMyteam li").sort(sort_li).appendTo('group#groupMyteam');
                  function sort_li(b, a) {
                    return (jQuery(b).data('position')) < (jQuery(a).data('position')) ? 1 : -1;
                  }
                });

                jQuery("span#message_total_show_number").html(overallmessages); 
                jQuery("span#message_total_show_number").attr('style','display:flex;');   
            }else{
                jQuery("span#message_total_show_number").html('');
                jQuery("span#message_total_show_number").hide();
            }
            
        }, 1000);
    //final loop end here
}
function retrive_chat_history(){

    database.ref("messages").once("value", function(firebaseData) {
		
		console.log('fire data', firebaseData);
		
        var userID=jQuery("form.chat_message_send input.id").val();
        var senderID=jQuery("form.chat_message_send input.senderid").val();
        var senderProfile=jQuery("form.chat_message_send input.senderProfile").val();
        var senderProfileName=jQuery("form.chat_message_send input.senderProfileName").val();
        var userProfile=jQuery("form.chat_message_send input.userProfile").val();
        var userProfileName=jQuery("form.chat_message_send input.userProfileName").val();
        var firebaseValue = firebaseData.val();
        if(firebaseValue!=null){
            var keys = Object.keys(firebaseValue).map((i) => Number(i));
            jQuery("ul#chat-history").html('');
            jQuery("#chatmedia_popup .modal-body").html('');
            for (var i = 0; i < keys.length; i++){
                database.ref('messages' + keys[i]).once("value", function(detail){
                    var detailed = detail.val();
                    
                    if(detailed!=null){

                        if((userID == detailed.user1 && senderID == detailed.user2) || (userID == detailed.user2 && senderID == detailed.user1)) {
                            
                            jQuery("#unread_messages_appear_here_set"+userID).html('');
                            jQuery("#unread_messages_appear_here_set"+userID).hide();
                            jQuery("span#message_total_show_number").html('');
                            jQuery("span#message_total_show_number").hide();
                            if(senderID != detailed.sender) {
    							// Update the message status to 'read' in Firebase
								database.ref("messages/" + detailed.unique_id).update({
									status: 'read'
								});
							}

                            var sender_title=senderID==detailed.sender?'my':'other';
                            var msgImage='';
                            if(detailed.images!=''){
                                var sepImages=detailed.images.split(',');
                                msgImage+="<div class='msg_images'>";
                                for(var i=0;i<sepImages.length;i++){
                                    msgImage+="<img src='/public/upload/chat/"+sepImages[i]+"' />";
                                }
                                msgImage+="</div>";
                            }
                            jQuery("#chatmedia_popup .modal-body").append(msgImage);

                            var profileImage=senderProfile!=''?'<img src="'+senderProfile+'" alt="Avatar" class="rounded-circle">':'<span>'+senderProfileName+'</span>';
                            var userProfileImage=userProfile!=''?'<img src="'+userProfile+'" alt="Avatar" class="rounded-circle">':'<span>'+userProfileName+'</span>';
                            
                            var messageDateFromArray=detailed.created_at.split(' ');
                            var messageDateFromArrayDate=messageDateFromArray[0].split('-');
                            var messageDateFromArrayTime=messageDateFromArray[1].split(':');
                            var messageDateFromYear=messageDateFromArrayDate[0];
                            var messageDateFromMonth=parseInt(messageDateFromArrayDate[1])<10?'0'+messageDateFromArrayDate[1]:messageDateFromArrayDate[1];
                            var messageDateFromDay=parseInt(messageDateFromArrayDate[2])<10?'0'+messageDateFromArrayDate[2]:messageDateFromArrayDate[2];
                            var messageDateFromHour=parseInt(messageDateFromArrayTime[0])<10?'0'+messageDateFromArrayTime[0]:messageDateFromArrayTime[0];
                            var messageDateFromMinute=parseInt(messageDateFromArrayTime[1])<10?'0'+messageDateFromArrayTime[1]:messageDateFromArrayTime[1];
                            var messageDateFromSecond=parseInt(messageDateFromArrayTime[2])<10?'0'+messageDateFromArrayTime[2]:messageDateFromArrayTime[2];
                            var messageDateFrom=!isNaN(new Date(messageDateFromYear+'-'+messageDateFromMonth+'-'+messageDateFromDay+'T'+messageDateFromHour+':'+messageDateFromMinute+':'+messageDateFromSecond))?formatAMPM(new Date(messageDateFromYear+'-'+messageDateFromMonth+'-'+messageDateFromDay+'T'+messageDateFromHour+':'+messageDateFromMinute+':'+messageDateFromSecond)):'';
                            
                            if(sender_title=='my'){
                                jQuery("ul#chat-history").append(`<li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                      <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                          `+msgImage+`
                                          <p class="mb-0">`+detailed.message+`</p>
                                        </div>
                                        <div class="text-end text-muted mt-1">
                                          <small>`+messageDateFrom+`</small>
                                        </div>
                                      </div>
                                      <div class="user-avatar flex-shrink-0 ms-3">
                                        <div class="avatar avatar-sm">
                                          `+profileImage+`
                                        </div>
                                      </div>
                                    </div>
                                  </li>`);
                            }else{
                                jQuery("ul#chat-history").append(`<li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                      <div class="user-avatar flex-shrink-0 me-3">
                                        <div class="avatar avatar-sm">
                                          `+userProfileImage+`
                                        </div>
                                      </div>
                                      <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                          `+msgImage+`
                                          <p class="mb-0">`+detailed.message+`</p>
                                        </div>
                                        
                                        <div class="text-muted mt-1">
                                          <small>`+messageDateFrom+`</small>
                                        </div>
                                      </div>
                                    </div>
                                  </li>`);
                            }
                        }
                    }

                }) 
            }
        }
        jQuery('.app-chat .app-chat-history .chat-history-body').scrollTop(jQuery('.app-chat .app-chat-history .chat-history-body')[0].scrollHeight);
    })

}

jQuery('form.chat_message_send input#attach-doc').change(function(){
    jQuery("form.chat_message_send span.uploadedNumber").attr('style','display:inline-flex;');
    jQuery("form.chat_message_send span.uploadedNumber").html(jQuery(this)[0].files.length);
});

jQuery("form.chat_message_send").on('submit', function(e){
    e.preventDefault();
    
    var msg=jQuery("form.chat_message_send input.message-input").val();
    var userID=jQuery("form.chat_message_send input.id").val();
    var senderID=jQuery("form.chat_message_send input.senderid").val();
    var recievername=jQuery("form.chat_message_send input.recievername").val();
    var actionURL=jQuery("form.chat_message_send").attr('action');
    jQuery.ajax({
            type: 'POST',
            url: actionURL,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            },
            success: function(image){
                jQuery('form.chat_message_send div.files_uploading_load').attr('style','display:none;');
                jQuery('form.chat_message_send .message-actions').removeAttr('style');
                var date = new Date;
                var created_at = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
                var make_me_unique=nodeCounter+1;
                i = {
                    user1: userID,
                    user2: senderID,
                    sender: senderID,
                    recievername: recievername,
                    images: '',
                    message: msg,
                    status: 'unread',
                    MsgSend: 'no',
                    created_at: created_at,
                    unique_id: make_me_unique
                };
                database.ref("messages" + make_me_unique).set(i);
                jQuery("form.chat_message_send input.message-input").val('');
                jQuery('form.chat_message_send input[type="file"]').val('');
                jQuery('form.chat_message_send span.uploadedNumber').hide();
                jQuery('form.chat_message_send span.uploadedNumber').html('0');
            }
    });
    
});

jQuery(document).on('click','#openuserProfileViewer',function(){
    jQuery('#app-chat-sidebar-left').toggleClass('active');
});
jQuery(document).on('click','#inboxChatPage #app-chat-sidebar-left i.close-sidebar',function(){
    jQuery('#app-chat-sidebar-left').toggleClass('active');
});
jQuery(document).on('click','#chatUserboxImage',function(){
    var id = jQuery('#inboxChatPage form.chat_message_send input.id').val();
    jQuery('#app-chat-sidebar-right'+id).toggleClass('active');
});
jQuery(document).on('click','#inboxChatPage .app-chat .app-chat-sidebar-right i.close-sidebar',function(){
    jQuery('#inboxChatPage .app-chat .app-chat-sidebar-right').removeClass('active');
});    
</script>