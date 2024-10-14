<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: product chat
*/  

if(isset($_GET['id'])){
    $listings=mysqli_query($con,"SELECT * FROM `listings` where `id`=".$_GET['id']." ");      
    $listing = mysqli_fetch_array($listings);
    if(!isset($listing['id'])){
        header("location: /category/");
    }
}else{
   header("location: /category/"); 
}

get_header();
?>
<link rel="stylesheet" href="/wp-content/themes/amtopm-child/chat.css">
<div class="content-wrapper" id="inboxChatPage">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

      <div class="add">
        <h2><?php echo $listing['title']; ?></h2>
      </div>

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
                    $randomColorArray = array('#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC', '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399', '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933', '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF');
                    $accounts=mysqli_query($con,"SELECT * FROM `account` where `id`='".$listing['userID']."' ");      
                    $account = mysqli_fetch_array($accounts);
                ?> 
                  <li class="chat-contact-list-item userChat userChatMessage<?php echo $account['id']; ?>" data-designation='Vendor' data-role='vendor' data-userID=<?php echo $account['id']; ?> data-userName="<?php if($account['firstname']!='' && $account['lastname']!=''){ echo $account['firstname'].' '.$account['lastname']; }else{ echo $account['username']; } ?>" <?php if($account['profile']!=''){ ?> data-userImage="<?php echo $account['profile']; ?>" data-userImageType="image" <?php }else{ ?> data-userImage="<?php if($account['firstname']!='' && $account['lastname']!=''){ echo substr($account['firstname'].' '.$account['lastname'], 0, 1); }else{ echo substr($account['username'], 0, 1); } ?>" data-userImageType="name" <?php } ?> data-onlineStatus="Offline" data-position=0>
                    <a class="d-flex align-items-center">
                      <div class="avatar d-block flex-shrink-0">
                        <?php
                        if($account['profile']!=''){
                        ?>
                            <img src="<?php echo $account['profile']; ?>" alt="Avatar" class="rounded-circle">
                        <?php
                        }else{
                            $k = array_rand($randomColorArray);
                        ?>
                            <span style="background-color:<?php echo $randomColorArray[$k]; ?> !important;color:#fff !important;" class="avatar-initial rounded-circle bg-label-primary"><?php if($account['firstname']!='' && $account['lastname']!=''){ echo substr($account['firstname'].' '.$account['lastname'], 0, 1); }else{ echo substr($account['username'], 0, 1); } ?></span>
                        <?php } ?>
                      </div>
                      <div class="chat-contact-info flex-grow-1 ms-2">
                        <h6 class="chat-contact-name text-truncate m-0"><?php if($account['firstname']!='' && $account['lastname']!=''){ echo $account['firstname'].' '.$account['lastname']; }else{ echo $account['username']; } ?></h6>
                        <p class="chat-contact-status text-muted text-truncate mb-0">Vendor</p>
                      </div>
                      <span class="unread_messages_appear_here_set" id="unread_messages_appear_here_set<?php echo $account['id']; ?>"></span>
                    </a>
                  </li>
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
                  <input type="hidden" name="senderid" class="senderid" value="<?php echo str_replace('.', '_', $_SERVER['REMOTE_ADDR']); ?>">
                  <input type="hidden" name="recievername" class="recievername" value="Customer">
                  <input type="hidden" name="senderProfile" class="senderProfile" value="">
                  <input type="hidden" name="senderProfileName" class="senderProfileName" value="C">
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
<?php
get_footer();
?>
<script src="https://www.gstatic.com/firebasejs/7.13.2/firebase.js"></script>
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
        apiKey: "AIzaSyDD1F66oTvfWpUK8EO-GWaZasFEhBNC-ig",
        authDomain: "bully-2be4c.firebaseapp.com",
        databaseURL: "https://bully-2be4c-default-rtdb.firebaseio.com",
        projectId: "bully-2be4c",
        storageBucket: "bully-2be4c.appspot.com",
        messagingSenderId: "144737726018",
        appId: "1:144737726018:web:d42c6a68153e334f6207db"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
    var database = firebase.database(),
        d = new Date,
        t = d.getTime(), 
        counter = t;

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

database.ref("messages/").on("child_added", function(firebaseData) {
    var userID=jQuery("form.chat_message_send input.id").val();
    var senderID=jQuery("form.chat_message_send input.senderid").val();
    var senderProfile=jQuery("form.chat_message_send input.senderProfile").val();
    var senderProfileName=jQuery("form.chat_message_send input.senderProfileName").val();
    var userProfile=jQuery("form.chat_message_send input.userProfile").val();
    var userProfileName=jQuery("form.chat_message_send input.userProfileName").val();
    var firebaseValue = firebaseData.val();
    nodeCounter=firebaseValue.unique_id;
    var msg_senderID=senderID;
    var allUsersIDs=jQuery("ul#chat-list li").length;
    var allUsersIDs_array=[];
    jQuery('ul#chat-list li').each(function(){
        if(jQuery(this).attr('data-userid')!=undefined){
            allUsersIDs_array.push(parseInt(jQuery(this).attr('data-userid')));
        }
    });
    if((msg_senderID!=parseInt(firebaseValue.sender) && (msg_senderID==parseInt(firebaseValue.user1) || 
        msg_senderID==parseInt(firebaseValue.user2))) && (allUsersIDs_array.indexOf(parseInt(firebaseValue.user1)) != -1 || 
        allUsersIDs_array.indexOf(parseInt(firebaseValue.user2)) != -1)){
        if(firebaseValue.MsgSend=='no'){
            database.ref("messages/").child(firebaseValue.unique_id).update({
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
                database.ref("messages/").child(firebaseValue.unique_id).update({
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
                allUsersIDs_array.push({id:parseInt(jQuery(this).attr('data-userid')),c:0});
            }
        });
    //top of the function end

        database.ref("messages/").once("value", function(firebaseData) {
            var userID=jQuery("form.chat_message_send input.id").val();
            var senderID=jQuery("form.chat_message_send input.senderid").val();
            var firebaseValue = firebaseData.val();
            if(firebaseValue!=null){
                var keys = Object.keys(firebaseValue).map((i) => Number(i));
                for (var i = 0; i < keys.length; i++){
                    database.ref('messages/' + keys[i]).once("value", function(detail){
                        var detailed = detail.val();
                        
                        if(detailed!=null){
                            //show unread message numbers here start
                                if(((senderID==detailed.user1 || senderID==detailed.user2) && detailed.sender!=detailed.user1) && allUsersIDs_array.findIndex(x => x.id === parseInt(detailed.user2))!=-1){
                                    if(detailed.status=='unread'){
                                        allUsersIDs_array[allUsersIDs_array.findIndex(x => x.id === parseInt(detailed.user2))].c=(allUsersIDs_array[allUsersIDs_array.findIndex(x => x.id === parseInt(detailed.user2))].c)+1;
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

    database.ref("messages/").once("value", function(firebaseData) {
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
                database.ref('messages/' + keys[i]).once("value", function(detail){
                    var detailed = detail.val();
                    
                    if(detailed!=null){

                        if((userID == detailed.user1 && senderID == detailed.user2) || (userID == detailed.user2 && senderID == detailed.user1)) {
                            
                            jQuery("#unread_messages_appear_here_set"+userID).html('');
                            jQuery("#unread_messages_appear_here_set"+userID).hide();
                            jQuery("span#message_total_show_number").html('');
                            jQuery("span#message_total_show_number").hide();
                            if(senderID!=detailed.sender){
                                database.ref("messages/").child(detailed.unique_id).update({
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
                database.ref("messages/" + make_me_unique).set(i);
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