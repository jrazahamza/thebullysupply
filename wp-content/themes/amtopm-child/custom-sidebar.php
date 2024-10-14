<?php
    $loginUsers=mysqli_query($con,"SELECT * FROM `account` where `id`='".$_COOKIE["user_id"]."' ");      
    $loginUser = mysqli_fetch_array($loginUsers);
?>
<div class="custom-sidebar">
    <div class="inner-sidebar-wrapper">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-pic">
                <?php if(isset($loginUser['profile']) && $loginUser['profile']!=''){ ?>
                <img src="<?php echo $loginUser['profile']; ?>" alt="Profile Image">
                <?php }else{ ?>
                <img src="/wp-content/uploads/2024/05/profile.jpg" alt="Profile Image">
                <?php } ?>
            </div>
            <div class="sidebar-username">
                <h4><?php if(isset($loginUser['id'])){ echo $loginUser['firstname']." ".$loginUser['lastname'];  } ?></h4>
            </div>
            <div class="View-Shop-btn">
                <a href="/profile-panel/">View Shop</a>
            </div>
        </div>
        <div class="sidebar-Menu">
            <nav>
                <ul class="sidebar-menu-ul">
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='create-listing'){ echo "active"; } ?>">
                        <a href="/create-listing/">
                            <span class="menu-icon">
                               <img src="/wp-content/uploads/2024/05/questionnaire-paper-listing_svgrepo.com_.png" class="menu-image"/>
                            </span>
                        <span class="menu-title">Create Listing</spa>
                        </a>
                    </li>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='my-shop'){ echo "active"; } ?>">
                        <a href="/my-shop/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/listing-list_svgrepo.com_.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">My Listing</spa>
                        </a>
                    </li>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='my-messages'){ echo "active"; } ?>">
                        <a href="/my-messages/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/chat-square-call_svgrepo.com-1.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">My Messages</spa>
                        </a>
                    </li>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='vendor-chat'){ echo "active"; } ?>">
                        <a href="/vendor-chat/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/chat-square-call_svgrepo.com-1.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Chat</spa>
                        </a>
                    </li>
                    <?php if(false){ ?>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='leaderboard-promotion'){ echo "active"; } ?>">
                        <a href="/leaderboard-promotion/">
                            <span class="menu-icon">
                                  <img src="/wp-content/uploads/2024/05/promotion_svgrepo.com_.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Leader board Promotion</spa>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='product-promotion'){ echo "active"; } ?>">
                        <a href="/product-promotion/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/promotion_svgrepo.com_.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Product Promotion</spa>
                        </a>
                    </li>
                    <?php if(false){ ?>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='banner-promotion'){ echo "active"; } ?>">
                        <a href="/banner-promotion/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/sign_svgrepo.com-1.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Banner Promotion</spa>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='dashboard'){ echo "active"; } ?>">
                        <a href="/dashboard/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/settings_svgrepo.com_.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Account setting</spa>
                        </a>
                    </li>
                     <li class="menu-list-items <?php if(isset($activeSidebar) && $activeSidebar=='profile-panel'){ echo "active"; } ?>">
                        <a href="/profile-panel/">
                            <span class="menu-icon">
                                <img src="/wp-content/uploads/2024/05/shop-minimalistic_svgrepo.com_.png" class="menu-image"/>
                            </span>
                            <span class="menu-title">Shop Setting</spa>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="logout-link">
            <div class="logout-inner">
                <a href="/?user-action=logout">
                    <span class="logout-icon">
                        <img src="/wp-content/uploads/2024/05/Log_Out.jpg"/>
                    </span>
                    <span class="Logout">Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>
