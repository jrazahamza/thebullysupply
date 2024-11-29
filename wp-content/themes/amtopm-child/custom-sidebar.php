<?php
    $loginUsers=mysqli_query($con,"SELECT * FROM `account` where `id`='".$_COOKIE["user_id"]."' ");      
    $loginUser = mysqli_fetch_array($loginUsers);
?>
<style>
/* Sidebar styling */
.thebullysupply-vender-sidebar {
	width: 257px;
	height: 92vh;
	position: relative;
	color: #000;
	display: flex;
	flex-direction: column;
	padding-top: 20px;
	background-color:#fff;
    border-right: 1px solid #e5e5e5;
	z-index:999;
	border-bottom: 1px solid #e5e5e5;
    border-radius: 0px 0px 10px;
}
.thebullysupply-vender-sidebar a {
	color: #202224;
	padding: 15px 20px;
	display: flex;
	align-items: center;
	font-weight: 500;
	text-decoration: none;
}
.thebullysupply-vender-sidebar a:hover, .thebullysupply-vender-sidebar .active {
	background-color: #052A4C;
	color: #fff;
}
.thebullysupply-vender-sidebar a i {
	margin-right: 10px;
}
.thebullysupply-vender-sidebar .dropdown-toggle::after {
	margin-left: auto;
}
.thebullysupply-vender-sidebar .badge {
	font-size: 0.75em;
	margin-left: 5px;
}
/* Contact Support Card */
.support-card {
	color: #fff;
	border-radius: 10px;
	text-align: center;
	padding: 15px;
	margin: auto 20px 20px;
	background-image: url(/wp-content/uploads/2024/11/vender-pro-bg.png);
    background-size: cover;
    background-repeat: no-repeat;
	display: flex;
    flex-direction: column;
    align-items: center;
}
.support-card .vender-pro {
    text-align: left;
    margin-left: 12px;
}	
.support-card img {
	width: 50px;
	height: 50px;
	border-radius: 50%;
	margin-bottom: 10px;
}
.support-card .button {
	background-color: #fff;
	color: #0d3b66;
	border: none;
	padding: 8px 16px;
	border-radius: 20px;
	font-size: 0.9em;
	margin-top: 10px;
	text-decoration:none;
	width: 148px;
}
.support-card .sidbar-vender-pro-img {
    background-color: #fff;
    padding: 8px 10px;
}
.ruk-custom-sidebar .svg-icon {
    margin-right: 16px;
}	
.ruk-custom-sidebar a:hover .svg-icon svg path{
    fill:#fff !important;
}
.ruk-custom-sidebar a:active .svg-icon svg path{
    fill:#fff !important;
}


.ruk-custom-sidebar .active .svg-icon svg path{
    fill:#fff !important;
}

.ruk-custom-sidebar .dropdown-toggle::after {
    content: none !important; 
    display: none; 
}

.ruk-custom-sidebar .side-bar-down {
    position: relative;
    left: 46%;
}
@media screen and (max-width: 1440px) {
.ruk-custom-sidebar .side-bar-down {
    position: relative;
    left: 38%;
}
.thebullysupply-vender-sidebar {
  width: 257px;
  height: 100vh;
  }	


}	
  	
</style>
 <!-- thebullysupply vender Sidebar -->
  <div class="thebullysupply-vender-sidebar ruk-custom-sidebar">
    <a href="#" class="active">
      <i class="svg-icon home" >
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="none"><path fill="#000" d="M1 15h3.692V9.116h4.616V15H13V6L7 1.462 1 6zm-1 1V5.5L7 .212 14 5.5V16H8.308v-5.884H5.692V16z"/>          </svg>
		</i> Dashboard 
    </a>

    <!-- Individual Dropdown -->
    <a class="dropdown-toggle" href="#individualDropdown" data-bs-toggle="collapse" aria-expanded="false">
      <i class="svg-icon user">
		  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"><path stroke="#000" stroke-miterlimit="10" stroke-width="1.2" d="M10 12.5a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z"/><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M2.422 16.875a8.75 8.75 0 0 1 15.156 0"/>
		  </svg>
		</i> Individual  <i class="side-bar-down fa fa-angle-down" aria-hidden="true"></i>
    </a>
    <div class="collapse" id="individualDropdown">
      <a href="/create-listing/" class="ps-5">Create Listings</a>
      <a href="/my-shop/" class="ps-5">Manage Listings</a>
      <a href="#" class="ps-5">Settings</a>		
    </div>

    <!-- Breeder Dropdown -->
    <a class="dropdown-toggle" href="#breederDropdown" data-bs-toggle="collapse" aria-expanded="false">
      <span class="svg-icon vender-sdibar-svg">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="none"><path fill="#000" d="M7.619 5.757a1.43 1.43 0 0 0-1.43 1.429.476.476 0 0 0 .954 0 .476.476 0 1 1 .952 0 .476.476 0 0 0 .952 0 1.43 1.43 0 0 0-1.428-1.43m4.762 0a1.43 1.43 0 0 0-1.428 1.429.476.476 0 0 0 .952 0 .476.476 0 0 1 .953 0 .476.476 0 1 0 .952 0 1.43 1.43 0 0 0-1.429-1.43"/><path fill="#000" d="M18.608 3.87c-1.145-2.462-4.112-2.502-4.982-2.46C12.766.573 11.611.042 10 .042S7.233.572 6.374 1.41c-.87-.042-3.836 0-4.981 2.46C-.06 6.99-.377 9.15.445 10.293a1.88 1.88 0 0 0 1.586.768q.153 0 .304-.018c.326-.04.644-.131.942-.27-.374 1.954-.15 3.427.698 4.484 1.041 1.298 3.013 1.93 6.025 1.93s4.983-.632 6.025-1.93c.848-1.057 1.072-2.53.698-4.485.298.14.616.232.942.271q.151.018.304.018a1.88 1.88 0 0 0 1.586-.768c.823-1.143.504-3.304-.948-6.423m-16.38 6.227a1.04 1.04 0 0 1-1.01-.362C.943 9.354.494 8.058 2.256 4.271c.679-1.46 2.294-1.82 3.328-1.895C4.486 4.07 4.072 6.413 3.71 8.482q-.078.444-.155.871c-.144.3-.71.673-1.328.744M10 13.377a.953.953 0 0 1-.953-.953h1.906a.953.953 0 0 1-.953.953m5.283 1.284c-.798.994-2.38 1.502-4.807 1.562v-1.961a1.9 1.9 0 0 0 1.429-1.838.954.954 0 0 0-.952-.952H9.047a.953.953 0 0 0-.952.953c.003.866.59 1.62 1.429 1.837v1.96c-2.427-.059-4.009-.567-4.806-1.562-.707-.88-.853-2.201-.444-4.037.136-.613.253-1.283.374-1.977C5.275 5.059 5.986.994 10 .994s4.725 4.065 5.352 7.652c.121.694.238 1.364.374 1.977.408 1.836.263 3.157-.444 4.038m3.499-4.926a1.05 1.05 0 0 1-1.01.362c-.618-.07-1.183-.444-1.327-.744q-.08-.435-.155-.87c-.362-2.07-.776-4.414-1.874-6.107 1.034.076 2.65.436 3.328 1.896 1.762 3.786 1.313 5.082 1.038 5.463"/>
		  </svg>
      </span>
      <span class="breeder">Breeder </span>
    </a>
<!--     <div class="collapse" id="breederDropdown">
      <a href="#" class="ps-5">Submenu 1</a>
      <a href="#" class="ps-5">Submenu 2</a>
    </div>
 -->
    <!-- Shop Dropdown -->
    <a class="dropdown-toggle" href="#shopDropdown" data-bs-toggle="collapse" aria-expanded="false">
      <i class="svg-icon shop" >
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="none"><path fill="#AAA" d="M14.21 9.779h-2.718a1.35 1.35 0 0 0-1.349 1.348v2.084a1.35 1.35 0 0 0 1.349 1.349h2.717a1.35 1.35 0 0 0 1.349-1.349v-2.084a1.35 1.35 0 0 0-1.349-1.348m.367 3.432a.37.37 0 0 1-.368.368h-2.717a.37.37 0 0 1-.368-.368v-2.084c0-.204.167-.368.368-.368h2.717c.205 0 .368.168.368.368z"/><path fill="#AAA" d="M20 5.99a.46.46 0 0 0-.065-.24L16.959.517a.49.49 0 0 0-.424-.25H3.46a.49.49 0 0 0-.425.25L.066 5.75A.5.5 0 0 0 0 5.99c0 1.173.707 2.178 1.716 2.624v8.627c0 .27.221.49.49.49H17.79c.27 0 .49-.22.49-.49V8.675q.001-.03-.004-.053A2.88 2.88 0 0 0 20 5.99M3.747 1.254H16.25l2.325 4.09H1.426zM14.234 6.32a1.884 1.884 0 0 1-3.71 0zm-4.753 0a1.884 1.884 0 0 1-1.855 1.553c-.928 0-1.7-.67-1.86-1.553zm-8.468 0h3.715a1.888 1.888 0 0 1-3.715 0m7.226 10.43h-2.82v-5.293c0-.384.31-.699.699-.699h1.426c.384 0 .699.31.699.7v5.291zm9.06 0h-8.08v-5.293c0-.923-.751-1.68-1.68-1.68H6.115c-.924 0-1.68.752-1.68 1.68v5.296H2.697v-7.9q.086.006.172.005c.989 0 1.863-.503 2.378-1.267a2.865 2.865 0 0 0 4.757 0 2.858 2.858 0 0 0 4.749 0A2.87 2.87 0 0 0 17.13 8.86c.057 0 .11-.004.168-.004zm-.168-8.873c-.928 0-1.7-.67-1.855-1.553h3.715a1.895 1.895 0 0 1-1.86 1.553"/>
		  </svg>
		</i> Shop <span class="badge bg-success">Pro</span> 
<!--     </a>
    <div class="collapse" id="shopDropdown">
      <a href="/profile-panel/" class="ps-5">Profile Panel</a>      
    </div> -->

    <a href="/my-messages/">
      <i class="svg-icon message">
		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"><path fill="#000" d="M1.145 15.122a1.2 1.2 0 0 0 .314 1.174 1.2 1.2 0 0 0 1.173.314l2.01-.539a8.45 8.45 0 0 0 4.328 1.183A8.53 8.53 0 0 0 15 14.777a8.5 8.5 0 0 0 2.477-6.479 8.54 8.54 0 0 0-3.197-6.183C11.183-.364 6.704-.34 3.63 2.171.348 4.854-.464 9.513 1.684 13.113zm3.253-12.01C7.03.96 10.868.938 13.52 3.061c1.655 1.326 2.629 3.209 2.744 5.304a7.3 7.3 0 0 1-2.123 5.552c-2.402 2.401-6.218 2.817-9.075.988a.6.6 0 0 0-.485-.075l-2.264.607.607-2.264a.6.6 0 0 0-.076-.484C.856 9.58 1.522 5.462 4.398 3.11"/><path fill="#000" d="M6.851 7.26a.607.607 0 0 0 .608-.608c0-.467.21-.904.58-1.198.372-.298.841-.4 1.32-.29a1.52 1.52 0 0 1 1.12 1.121 1.54 1.54 0 0 1-.646 1.645c-.908.603-1.45 1.646-1.45 2.793a.607.607 0 1 0 1.214 0c0-.738.34-1.404.908-1.78a2.745 2.745 0 0 0 1.157-2.93 2.72 2.72 0 0 0-2.03-2.032 2.76 2.76 0 0 0-3.116 1.478c-.18.372-.273.78-.272 1.194a.607.607 0 0 0 .607.607m2.151 5.147h-.006a.605.605 0 0 0-.604.607.61.61 0 0 0 1.04.43.607.607 0 0 0-.43-1.037"/></svg>
		</i> Inquiries
    </a>
    <a href="/vendor-chat/">
      <i class="svg-icon chat" >		
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" fill="none"><g clip-path="url(#a)"><path fill="#000" fill-rule="evenodd" d="M5.466 5.637a1.057 1.057 0 1 1-.005 0zM1.1 0h17.13a1.1 1.1 0 0 1 1.101 1.101v11.46a1.1 1.1 0 0 1-1.1 1.101H9.837l-4.154 3.081c-.786.749-1.49 1.22-2.025 1.259-.787.047-1.197-.488-1.101-1.819v-2.516H1.1A1.1 1.1 0 0 1 0 12.566V1.1A1.1 1.1 0 0 1 1.101 0m17.13 1.07H1.101a.03.03 0 0 0-.03.018l-.001.013v11.46a.03.03 0 0 0 .01.018.03.03 0 0 0 .021.004h1.988a.535.535 0 0 1 .535.535v3.105c-.036.495-.043.704-.027.703.263-.016.75-.387 1.376-.982l.05-.04 4.288-3.184a.53.53 0 0 1 .353-.137h8.567a.027.027 0 0 0 .027-.027V1.101a.027.027 0 0 0-.027-.027zM9.506 5.63a1.057 1.057 0 1 1-.003 2.115 1.057 1.057 0 0 1 .003-2.114m4.041 0a1.057 1.057 0 1 1-.003 2.115 1.057 1.057 0 0 1 .003-2.114" clip-rule="evenodd"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h19.328v18H0z"/></clipPath></defs></svg>
		</i> My Messages
    </a>	  
    <a href="/product-promotion/">
      <i class="svg-icon megaphone">
		<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" fill="none"><path fill="#000" fill-rule="evenodd" d="M14.503 2.978a.442.442 0 1 1-.564-.683L16.593.102a.442.442 0 1 1 .564.682zM1.607 10.706a1.1 1.1 0 0 0-.65.528c-.164.29-.238.666-.233 1.068q.004.259.05.53a3.9 3.9 0 0 0 .343 1.062q.122.245.273.458c.247.344.553.617.907.754.308.122.655.14 1.029.01l.007-.001a.3.3 0 0 1 .127-.016q.045.003.09.016l.008-.004c.1-.033.205-.065.307-.097l.28-.086.29-.084q.135-.04.275-.076a.36.36 0 0 1 .275.035l.009.005a.36.36 0 0 1 .17.256c.024.11.054.225.075.336.192.86.379 1.688.627 2.359.021.067.048.132.072.199.076.211.155.43.243.629.085.194.175.366.277.493v.002c.076.095.164.155.268.16.114.005.257-.05.436-.189.078-.072.148-.133.22-.195l.016-.014c.212-.183.423-.365.515-.613a1.4 1.4 0 0 0-.19-.097l-.006-.002c-.188-.079-.375-.16-.51-.33-.138-.17-.212-.418-.16-.823q.001-.037.008-.067l.009-.074c.023-.184.035-.279.028-.305v-.004c-.005-.007-.042-.033-.116-.102l-.064-.06a.9.9 0 0 1-.236-.357 1.3 1.3 0 0 1-.074-.48c.002-.165.027-.338.064-.502.045-.199.11-.389.176-.546l.003-.005a.36.36 0 0 1 .28-.213h.004c1.333-.185 2.41-.16 3.313-.044.816.106 1.487.284 2.084.453a11 11 0 0 1-1.254-1.797 17 17 0 0 1-1.245-2.778 18.6 18.6 0 0 1-.763-2.889 11.7 11.7 0 0 1-.196-2.136 14 14 0 0 1-2.202 2.513c-1.15 1.02-2.721 2.049-4.933 2.863l-.07.023-.01.017-.038.062-.004.005a.37.37 0 0 1-.199.15zm10.049 1.363a11.6 11.6 0 0 0 1.094 1.74c.377.487.782.904 1.208 1.22l.044.003a.3.3 0 0 0 .06 0h.007a.4.4 0 0 0 .208-.065 1.1 1.1 0 0 0 .224-.352 2.3 2.3 0 0 0 .148-.543c.097-.604.05-1.377-.099-2.232-.164-.933-.454-1.96-.82-2.966a20 20 0 0 0-1.255-2.789c-.438-.796-.902-1.472-1.35-1.935a3 3 0 0 0-.482-.414 1.1 1.1 0 0 0-.396-.173h-.004q-.042-.007-.068-.009c-.008 0 0-.005-.004-.003-.002 0-.002.003-.01.01a2 2 0 0 0-.133.134l-.007.014c-.204.423-.274 1.092-.23 1.908.045.828.211 1.802.48 2.813.767-.176 1.366-.014 1.778.33.241.2.415.46.523.752a2.1 2.1 0 0 1 .113.926 2.13 2.13 0 0 1-1.029 1.631m2.24 3.68a.36.36 0 0 1-.204-.03l-.14-.028c-.334-.069-.658-.162-1.006-.26l-.023-.008c-1.196-.34-2.692-.766-5.088-.47-.031.091-.058.19-.079.287a2 2 0 0 0-.035.298q0 .112.023.199a.2.2 0 0 0 .058.102l.042.038c.196.178.29.266.346.467.044.162.024.312-.015.608q-.006.06-.015.122c-.018.142.005.225.047.276.044.053.12.086.197.118l.01.004c.246.105.492.213.62.563a.37.37 0 0 1 .023.21v.002c-.055.283-.172.5-.318.685-.143.181-.312.326-.479.47l-.039.034q-.087.073-.169.151l-.028.025c-.382.305-.708.414-.995.384-.29-.03-.532-.203-.737-.46a3 3 0 0 1-.36-.623c-.103-.23-.191-.47-.276-.705q-.034-.098-.072-.195c-.26-.703-.452-1.558-.65-2.44-.063.017-.127.039-.19.056q-.148.044-.289.088l-.28.088-.005.002-.034.012-.005.002a.6.6 0 0 1-.173.053.3.3 0 0 1-.155-.021c-.509.14-.979.098-1.398-.07-.476-.194-.884-.555-1.209-1.008l-.003-.004a4.6 4.6 0 0 1-.735-1.821A4.4 4.4 0 0 1 0 12.309c-.005-.532.099-1.036.33-1.443.207-.364.517-.65.938-.808q.023-.037.043-.064a.5.5 0 0 1 .08-.084l.008-.006a.5.5 0 0 1 .107-.068c.036-.016.076-.032.13-.051l.05-.018c2.239-.824 3.787-1.878 4.899-2.908C7.696 5.829 8.373 4.82 8.86 4.088l.01-.016c.273-.409.493-.735.713-.955.057-.056.106-.102.159-.14a.7.7 0 0 1 .384-.14q.103-.004.234.018c.208.033.42.12.633.253q.326.206.651.547c.483.5.98 1.222 1.447 2.066.486.877.94 1.885 1.314 2.915.384 1.057.687 2.139.857 3.13.157.914.203 1.755.094 2.426a3 3 0 0 1-.218.76 1.8 1.8 0 0 1-.386.56l-.023.022-.032.023a1.17 1.17 0 0 1-.611.204h-.007q-.053 0-.1-.002-.04-.006-.083-.01m4.336-1.925a.44.44 0 0 1-.458-.425.44.44 0 0 1 .424-.458l3.1-.116a.443.443 0 0 1 .034.884zm-.088-3.012a.443.443 0 0 1-.118-.876l2.864-.38a.443.443 0 0 1 .118.875zm-.603-2.766a.444.444 0 0 1-.29-.837l2.936-1.02a.442.442 0 1 1 .29.837zm-1.384-2.662a.44.44 0 0 1-.603-.165.44.44 0 0 1 .166-.603l2.783-1.596a.44.44 0 0 1 .602.166.44.44 0 0 1-.165.602z" clip-rule="evenodd"/>
		  </svg>
		</i> Product Promotion
    </a>
    <a href="/dashboard/">
      <i class="svg-icon setting">
		<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none"><g clip-path="url(#a)"><path fill="#000" d="M17 8.492C17 3.804 13.192 0 8.5 0S0 3.804 0 8.492a8.5 8.5 0 0 0 3.009 6.47c.017.017.034.017.034.034.153.12.306.238.476.357.085.051.153.118.238.186A8.5 8.5 0 0 0 8.517 17a8.5 8.5 0 0 0 4.76-1.46c.085-.052.153-.119.238-.17.153-.119.323-.238.476-.357.017-.017.034-.017.034-.034C15.827 13.4 17 11.073 17 8.492M8.5 15.93c-1.598 0-3.06-.51-4.267-1.359.017-.136.051-.27.085-.407.102-.368.25-.722.442-1.053.187-.323.408-.612.68-.867.255-.255.561-.492.867-.679a4.459 4.459 0 0 1 2.193-.577 4.44 4.44 0 0 1 3.111 1.24q.586.585.918 1.375.178.46.255.968a7.47 7.47 0 0 1-4.284 1.36M5.899 8.068a2.7 2.7 0 0 1-.221-1.088c0-.373.068-.747.221-1.087s.357-.645.612-.9.561-.458.901-.611.714-.221 1.088-.221c.391 0 .748.068 1.088.22.34.154.646.358.901.612.255.255.459.56.612.9s.221.714.221 1.087c0 .39-.068.748-.221 1.086-.147.336-.354.641-.612.901-.26.258-.566.465-.901.611a2.9 2.9 0 0 1-2.193 0 3 3 0 0 1-.901-.61 2.65 2.65 0 0 1-.595-.9m7.888 5.637c0-.034-.017-.05-.017-.085a5.5 5.5 0 0 0-.731-1.494 5.2 5.2 0 0 0-1.156-1.206 5.5 5.5 0 0 0-1.105-.646q.268-.178.493-.407.381-.377.663-.833c.378-.618.572-1.33.561-2.054a3.9 3.9 0 0 0-.306-1.562 4 4 0 0 0-.867-1.274c-.368-.36-.8-.649-1.275-.85a3.9 3.9 0 0 0-1.564-.305 3.9 3.9 0 0 0-1.564.306c-.48.199-.913.494-1.275.866-.362.366-.65.799-.85 1.274a3.9 3.9 0 0 0-.306 1.562q0 .56.153 1.07c.102.357.238.68.425.984.17.306.408.578.663.833q.23.23.51.407a5.3 5.3 0 0 0-1.105.663c-.442.34-.833.747-1.156 1.19-.32.456-.567.96-.731 1.493-.017.034-.017.068-.017.085-1.343-1.359-2.176-3.193-2.176-5.23 0-4.093 3.349-7.44 7.446-7.44s7.446 3.347 7.446 7.44a7.4 7.4 0 0 1-2.159 5.213"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h17v17H0z"/></clipPath></defs></svg>
		</i> Settings
    </a>
	 <a href="/account-settings/">
		  <i class="svg-icon setting">
			<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none"><g clip-path="url(#a)"><path fill="#000" d="M17 8.492C17 3.804 13.192 0 8.5 0S0 3.804 0 8.492a8.5 8.5 0 0 0 3.009 6.47c.017.017.034.017.034.034.153.12.306.238.476.357.085.051.153.118.238.186A8.5 8.5 0 0 0 8.517 17a8.5 8.5 0 0 0 4.76-1.46c.085-.052.153-.119.238-.17.153-.119.323-.238.476-.357.017-.017.034-.017.034-.034C15.827 13.4 17 11.073 17 8.492M8.5 15.93c-1.598 0-3.06-.51-4.267-1.359.017-.136.051-.27.085-.407.102-.368.25-.722.442-1.053.187-.323.408-.612.68-.867.255-.255.561-.492.867-.679a4.459 4.459 0 0 1 2.193-.577 4.44 4.44 0 0 1 3.111 1.24q.586.585.918 1.375.178.46.255.968a7.47 7.47 0 0 1-4.284 1.36M5.899 8.068a2.7 2.7 0 0 1-.221-1.088c0-.373.068-.747.221-1.087s.357-.645.612-.9.561-.458.901-.611.714-.221 1.088-.221c.391 0 .748.068 1.088.22.34.154.646.358.901.612.255.255.459.56.612.9s.221.714.221 1.087c0 .39-.068.748-.221 1.086-.147.336-.354.641-.612.901-.26.258-.566.465-.901.611a2.9 2.9 0 0 1-2.193 0 3 3 0 0 1-.901-.61 2.65 2.65 0 0 1-.595-.9m7.888 5.637c0-.034-.017-.05-.017-.085a5.5 5.5 0 0 0-.731-1.494 5.2 5.2 0 0 0-1.156-1.206 5.5 5.5 0 0 0-1.105-.646q.268-.178.493-.407.381-.377.663-.833c.378-.618.572-1.33.561-2.054a3.9 3.9 0 0 0-.306-1.562 4 4 0 0 0-.867-1.274c-.368-.36-.8-.649-1.275-.85a3.9 3.9 0 0 0-1.564-.305 3.9 3.9 0 0 0-1.564.306c-.48.199-.913.494-1.275.866-.362.366-.65.799-.85 1.274a3.9 3.9 0 0 0-.306 1.562q0 .56.153 1.07c.102.357.238.68.425.984.17.306.408.578.663.833q.23.23.51.407a5.3 5.3 0 0 0-1.105.663c-.442.34-.833.747-1.156 1.19-.32.456-.567.96-.731 1.493-.017.034-.017.068-.017.085-1.343-1.359-2.176-3.193-2.176-5.23 0-4.093 3.349-7.44 7.446-7.44s7.446 3.347 7.446 7.44a7.4 7.4 0 0 1-2.159 5.213"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h17v17H0z"/></clipPath></defs></svg>
			</i> Account Settings
		</a>		
    <a href="/?user-action=logout">
      <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
    </a>
	  
    <!-- Support Card -->
    <div class="support-card mt-auto">
		<div class="support-card-pro-header d-flex">			
		  <img src="/wp-content/uploads/2024/11/vender-pro-img.png" class="sidbar-vender-pro-img" alt="Support Icon">
			<div class="vender-pro">
				<span class="vender-title">The Bully Supply</span>
				<span class="vender-name">Admin</span>
			</div>
		</div>			
 
      <a href="/contact-us/" class="button" target="_blank">Contact Support</a>
    </div>
  </div>
<script>
// document.querySelector('.ruk-custom-sidebar').innerHTML = document.querySelector('.ruk-custom-sidebar').innerHTML.replace(/&nbsp;/g, ' ');
</script>
<!-- 
<div class="custom-sidebar ">
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
 -->