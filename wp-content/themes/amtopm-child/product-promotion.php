<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
include('vendor/autoload.php');
/* 
Template Name: product-promotion
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

if(isset($_POST['submit'])){
    $productForPromotion=$_POST['productForPromotion'];
    $ChoosePromotion=$_POST['choosePromotion'];
    $DaysWeeksMonths=$_POST['daysWeeksMonths'];
    $startDate=$_POST['startDate'];
    $endDate=$_POST['endDate'];
    $merchant=$_POST['merchant'];
    $card=$_POST['card'];
    $expire=$_POST['expire'];
    $cvc=$_POST['cvc'];
    
    if($merchant=='stripe'){
        try{
            
            $promotionPrices=mysqli_query($con,"SELECT * FROM `productPromotion` where `id`='".$ChoosePromotion."' "); 
            $promotionPrice = mysqli_fetch_array($promotionPrices);
            $promotionPriceStripe=isset($promotionPrice['id'])?$promotionPrice['price']:0;
            
            Stripe\Stripe::setApiKey('pk_test_51DoKXKEdK7bJLn1BR1IkSOxghrE9IbNcuV8HANCsTefPSdXLvBtvo1tqmGt6XFWqX4Tt35QSSod4ob1Sk0Fxr1kI004HnlYFHT');
    		$token = Stripe\Token::create(array(
    		  "card" => array(
    		  "number"    => str_replace(' ', '', $card),
    		  "exp_month" => str_replace(' ', '', explode(" / ",$expire)[0]),
    		  "exp_year"  => str_replace(' ', '', explode(" / ",$expire)[1]),
    		  "cvc"       => $cvc,
    		  "name"      => ''
    		)));
    		Stripe\Stripe::setApiKey('sk_test_51DoKXKEdK7bJLn1BDzjzxPrIgmy1VKZNyzpBd6piQsOk0z7KuyCFl3KyzudLxzLFfxpgkymKlZZmE4wkeN1Kda0l00LmIHQ0CD');
    		$customer=Stripe\Charge::create ([
    			  "amount" => (float)$promotionPriceStripe*100,
    			  "currency" => 'USD',
    			  "source" => $token,
    			  "description" => 'Product Promotion' 
    		]);
    		$stripeResponse = 'success';
        }catch(Exception $e) {
    		$stripeResponse = $e->getMessage();
    	}
    	if($stripeResponse=='success'){
            mysqli_query($con," INSERT INTO `productPromotionStore`(`userID`, `product`, `promotion`, `duration`, `startDate`, `endDate`, `paid`, `status`) 
            VALUES ('".$_COOKIE["user_id"]."','".$productForPromotion."','".$ChoosePromotion."','".$DaysWeeksMonths."','".$startDate."','".$endDate."','1','1') ");
    	}	    
    }else{
        mysqli_query($con," INSERT INTO `productPromotionStore`(`userID`, `product`, `promotion`, `duration`, `startDate`, `endDate`, `paid`, `status`) 
        VALUES ('".$_COOKIE["user_id"]."','".$productForPromotion."','".$ChoosePromotion."','".$DaysWeeksMonths."','".$startDate."','".$endDate."','0','0') ");
        $leaderBoardID = mysqli_insert_id($con);
    }
      
    if($merchant=='paypal'){
        $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotion` where `id`='".$ChoosePromotion."' "); 
        $productPromotion = mysqli_fetch_array($productPromotions);
        $paypalPrice=$productPromotion['price'];
    }
    
}

if(isset($_GET['paypalReturn'])){
    mysqli_query($con," UPDATE `productPromotionStore` SET `paid`='1',`status`='1' WHERE `id`=".$_GET['paypalReturn']." ");
    header("location: /product-promotion/");
}

get_header();
?>
<style>
.error{
	color: red !important;
	font-size: 13px !important;
    padding: 10px !important;
	background-color: transparent !important;
}
.ruk-promotion-price-card .pricing-card {
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
/*         width: 320px; */
        text-align: center;
}
.ruk-promotion-price-card .pricing-card h3 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #0d3b66;
        margin-bottom: 20px;
    }
.ruk-promotion-price-card .price-option {
        display: flex;
        align-items: center;
        justify-content: start;        
        color: #fff;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 15px;
        position: relative;
}
.ruk-promotion-price-card .price-option {
    background-image:url(/wp-content/uploads/2024/11/permotion-card-heading-bg.png);
    background-repeat:no-repeat;
/*     background-size:contain; */
	background-size: 100% 62px !important;
    background-position:center center;
}
.ruk-promotion-price-card .price-option .icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: #7A1715;
        border-radius: 50%;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        margin-top: -10px;
        border: 4px solid #FFD166;
	    margin-left: -20px;
    }
.ruk-promotion-price-card .price-option .price {
        font-size: 1.25rem;
        font-weight: bold;
 }
 .ruk-promotion-price-card .price-option .duration {
        font-size: 0.8rem;
        font-weight: normal;
        color: #adb5bd;
        margin-left: 5px;
    }
.ruk-promotion-price-card .icon img {
        width: 70%;
        height: auto;
        border-radius: 50%;
    }
    /* Specific styling for the discount text */
.ruk-promotion-price-card .discount-text {
        font-size: 0.75rem;
        font-weight: bold;
        color: #fff;
}

.ruk-product-promotion-sec {
    border: 0.3px solid #eaeaea;
    border-radius:14px;
	margin: 40px 0px;
    padding: 40px 24px;
}

.ruk-product-promotion-sec .promote-store {
/*   padding: 40px 36px 40px 24px; */
  margin: 27px 30px 48px 13px;
  /* width: 1141px;
  height: 604px; */
/*   border: 0.3px solid #b9b9b9; */
/*   border-radius: 14px; */
}

.ruk-product-promotion-sec .promote-store h2 {
  font-size: 28px;
  font-weight: 700;
  color: #202224;
}
.ruk-product-promotion-sec .promotion-des {
    color: #39393A;
}
.ruk-product-promotion-sec .promote-store p {
  font-size: 16px;
  font-weight: 400;
  margin-bottom: 27px;
  color: #39393a;
}
.ruk-product-promotion-sec .promote-store span {
  padding: 11px 40px;
  background-color: #e5f4ff;
  color: #003459;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 800;
  margin-right: 12px;
}

.ruk-product-promotion-sec .promote-store form {
  margin-top: 49px;
  display: flex;
  flex-direction: column;
  gap: 25px;
}
	
.ruk-product-promotion-sec .promote-store form label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.ruk-product-promotion-sec .formValidationQuery select, input {
    border: unset !important;
    background-color: #F5F6FA !important;
    height:42px !important;
    box-shadow:unset !important;
}
.ruk-product-promotion-sec .promote-store form select {
  width: 100%;
  padding: 11px 0 11px 16px;
  border: 0.6px solid #d5d5d5;
  background-color: #f5f6fa;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 400;
}
.ruk-product-promotion-sec .promote-store form input {
  width: 100%;
  padding: 11px 0 11px 16px;
  border: 0.6px solid #d5d5d5;
  background-color: #f5f6fa;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 400;
}

.ruk-product-promotion-sec .promote-store form button {
  padding: 10px 24px;
  border-radius: 60px;
  border: none;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  background-color: #8B1339;
  align-self: flex-end;
}


.ruk-product-promotion-sec .ruk-promotion-price-card {
/*     display: flex;
    justify-content: space-between; */
	display:grid;
	grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
}

.ruk-promotion-price-card .price-option .discount-text img {
    min-width: 36px !important;
    
}

.ruk-promotion-price-card .price-text {
    font-size: 24px;
    font-family: 'Manrope';
    font-weight:bold;
    margin-top:-10px;
    margin-left: 16px;
}

.ruk-promotion-price-card .percentage {
    font-size: 18px;
    font-weight: bold;
    font-family: 'Manrope';    
}


.ruk-promotion-price-card .off {
    font-size: 9px;
    font-family: 'Manrope';    
}	
.ruk-promote-pro-form {
    width: 100% !important;
}	

@media screen and (max-width: 1440px) {  
.ruk-promotion-price-card .price-text {
    font-size: 18px !important;
    font-family: 'Manrope';
    font-weight: bold;
    margin-top: -10px;
    margin-left: 8px !important;
}
  
.ruk-promotion-price-card .pricing-card h3 {
    font-size: 1.3rem !important;
} 
  
}  
</style>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal_main_form" method="post" style="display:none;">
    <input type="hidden" name="business" value="sb-q1vaj30147122@business.example.com" />
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="item_name" value="Product Promotion" />
    <input type="hidden" name="amount" value="<?php if(isset($paypalPrice)){ echo $paypalPrice; } ?>" />
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="return" value="https://bully.cloudstandly.com/product-promotion/?paypalReturn=<?php if(isset($leaderBoardID)){ echo $leaderBoardID; } ?>">
    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="Buy Now" />
</form>

<section id="leaderboard-promotion" class="leaderboard-promotion template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="product-promotion"; include ("custom-sidebar.php"); ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
					
					
					    <div class="ruk-product-promotion-sec">
							<div class="promotion-heading">
								<h2 class="pro-h">Promote Your Store</h2>
							    <p class="promotion-des">2 Listings are free (1 individual & 1 Breeder)</p>
							</div>
							
							<div class="ruk-promotion-price-card">								
								<div class="pricing-card">
									<h3>1 Extra Listing</h3>

									<!-- Price Option 2 -->
									<div class="price-option">
										<div class="icon">
											<span class="discount-text"><img src="/wp-content/uploads/2024/11/Vector-icons.png" alt="" /></span>
										</div>
										<div class="price">
											<div class="price-text">
											    $2.99<span class="duration">/mon</span>
											</div>
										</div>
									</div>
									<!-- Price Option 3 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">10%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $7.99<span class="duration">/3mon</span>
											</div>
									</div>
									<!-- Price Option 4 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">20%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $27.99<span class="duration">/3mon</span>
											</div>
									</div>									
								</div>								
								<div class="pricing-card">
									<h3>3 Extra Listing</h3>

									<!-- Price Option 2 -->
									<div class="price-option">
										<div class="icon">
											<span class="discount-text"><img src="/wp-content/uploads/2024/11/Vector-icons.png" alt="" /></span>
										</div>
										<div class="price">
											<div class="price-text">
											    $2.99<span class="duration">/mon</span>
											</div>
										</div>
									</div>
									<!-- Price Option 3 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">10%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $7.99<span class="duration">/3mon</span>
											</div>
									</div>
									<!-- Price Option 4 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">20%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $27.99<span class="duration">/3mon</span>
											</div>
									</div>									
								</div>		
								<div class="pricing-card">
									<h3>5 Extra Listing</h3>

									<!-- Price Option 2 -->
									<div class="price-option">
										<div class="icon">
											<span class="discount-text"><img src="/wp-content/uploads/2024/11/Vector-icons.png" alt="" /></span>
										</div>
										<div class="price">
											<div class="price-text">
											    $2.99<span class="duration">/mon</span>
											</div>
										</div>
									</div>
									<!-- Price Option 3 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">10%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $7.99<span class="duration">/3mon</span>
											</div>
									</div>
									<!-- Price Option 4 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">20%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $27.99<span class="duration">/3mon</span>
											</div>
									</div>									
								</div>		
								<div class="pricing-card">
									<h3>Breeder Verified</h3>

									<!-- Price Option 2 -->
									<div class="price-option">
										<div class="icon">
											<span class="discount-text"><img src="/wp-content/uploads/2024/11/Vector-icons.png" alt="" /></span>
										</div>
										<div class="price">
											<div class="price-text">
											    $2.99<span class="duration">/mon</span>
											</div>
										</div>
									</div>
									<!-- Price Option 3 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">10%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $7.99<span class="duration">/3mon</span>
											</div>
									</div>
									<!-- Price Option 4 -->
									<div class="price-option">
										<div class="icon">
											<div class="discount-text"><span class="percentage">20%</span> <span class="off"><br>Off</span></div>
										</div>
											<div class="price-text">
											    $27.99<span class="duration">/3mon</span>
											</div>
									</div>									
								</div>																																		
								
							</div>														
							<div class="promote-store">
							  <span>DAILY:$.50</span>
							  <span>WEEKLY:$3.50</span>
							  <span>MONTHLY:$15</span>

                              <form id="shopForm" class="formValidationQuery" method="POST" enctype="multipart/form-data">
								  <?php if(isset($stripeResponse) && $stripeResponse!='success'){ ?>
                    				<p style="color:red;font-size:16px;text-align:center;" class="stripe-error-message">Stripe error: <?php echo $stripeResponse; ?></p>
								  <?php } ?>
								<div class="pro-promotion-sele">
								  <label for="select-product">Select Product For Promotion</label
								  ><br />
								  <select name="productForPromotion" class="productPromotion" id="select-product" required>
									  <option value="">--- Select a product ---</option>
										<?php
										  $listings=mysqli_query($con,"SELECT * FROM `listings` where `userID`='".$_COOKIE["user_id"]."' "); 
										  while($listing = mysqli_fetch_array($listings)){
										  ?>
										  <option value="<?php echo $listing['id']; ?>"><?php echo $listing['title']; ?></option>
										<?php } ?>
								  </select>
									<span class="error" id="productError"></span>
								</div>
								<div class="choose-promotion-selec">
								  	<label for="choose-promotion">Choose A Promotion</label><br />
								   	<select name="choosePromotion" class="promotion" required id="select-product" required>
										<option value="">Select Promotion</option>
										<?php
											$productPromotions=mysqli_query($con,"SELECT * FROM `productPromotion` where `type`='store' and  `status`='1' "); 
											while($productPromotion = mysqli_fetch_array($productPromotions)){
										?>
											<option value="<?php echo $productPromotion['id']; ?>"><?php echo $productPromotion['name']; ?></option>
										<?php } ?>
									</select>
									<span class="error" id="productPromotionError"></span>
								</div>

								<div class="duration-promotion">
								  	<label for="duration">Days/Weeks/Months</label><br />
									<input type="number" id="days-weeks-months" name="daysWeeksMonths" min=1 placeholder="1" required />
									<span class="error" id="daysWeeksMonthsError"></span>
								</div>
								  
								<div class="start-date-promotion">
								  	<label for="duration">Start Date</label><br />
									<input type="date" id="startDate" name="startDate" required />
									<span class="error" id="startDateError"></span>
								</div>
								  
								<div class="end-date-promotion">
								  	<label for="duration">End Date</label><br />
                                    <input type="date" id="endDate" name="endDate" required />
									<span class="error" id="endDateError"></span>
								</div>
								  
								<div class="choose-pay-method">
								  	<label for="duration">Choose A Merchant</label><br />
									<select id="choose-merchant" name="merchant" required>
										<option value="">Select Merchant</option>
										<option value="paypal">Paypal</option>
										<option value="stripe">Stripe</option>
									</select>
								</div>
								    
								<div id="payment-stripe" class="container" style="display:none;">
                                      <div class="row text-left">
                                        <div class="col-sm-12">
                                          <div class="form-group">
                                            <label for="cc-number" class="control-label">Credit Card Number <small class="text-muted">[<span data-payment="cc-brand"></span>]</small></label>
                                            <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>                                    
                                              <input id="cc-number" type="tel" class="input-lg form-control cc-number" name="card" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" data-payment='cc-number' required>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-8">
                                          <div class="form-group">
                                            <label>Expiration (MM/YYYY)</label>
                                            <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" name="expire" autocomplete="cc-exp" placeholder="•• / ••••" data-payment='cc-exp' required>
                                            </div>
                                          </div>
                                        </div>        
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <label>CVC Code</label>
                                            <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                              <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" name="cvc" autocomplete="off" placeholder="•••" data-payment='cc-cvc' required>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
								  
<!-- 								<button type="submit">Next</button> -->
								  	<input type="submit" name="submit" value="Next" class="next" style="display:none;">
                                    <button type="button" id="validate" style="cursor:pointer;">Next</button>
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
<script>	
	
<?php if(isset($paypalPrice)){ ?>
    jQuery('form#paypal_main_form input[name="submit"]').click();
<?php } ?>
jQuery(document).on("click","a.paypalButtonPayNow",function(){
    var price=jQuery(this).attr('data-price');
    var id=jQuery(this).attr('data-id');
    jQuery('form#paypal_main_form input[name="amount"]').val(price);
    jQuery('form#paypal_main_form input[name="return"]').val('https://bully.cloudstandly.com/product-promotion/?paypalReturn='+id);
    jQuery('form#paypal_main_form input[name="submit"]').click();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.3.2/jquery.payment.min.js"></script>
<script>
(function( jQuery ){
    var PLUGIN_NS = 'paymentForm';
    var Plugin = function ( target, options )  { 
        this.jQueryT = jQuery(target); 
        this._init( target, options ); 
       this.options= jQuery.extend(
            true,
            {
                DEBUG: false
            },
            options
        );
        this._cardIcons = {
            "visa"          : "fa fa-cc-visa",
            "mastercard"    : "fa fa-cc-mastercard",
            "amex"          : "fa fa-cc-amex",
            "dinersclub"    : "fa fa-cc-diners-club",
            "discover"      : "fa fa-cc-discover",
            "jcb"           : "fa fa-cc-jcb",
            "default"       : "fa fa-credit-card-alt"
        };
        return this; 
    }
    Plugin.prototype._init = function ( target, options ) { 
        var base = this;
        base.number = this.jQueryT.find("[data-payment='cc-number']");
        base.exp = this.jQueryT.find("[data-payment='cc-exp']");
        base.cvc = this.jQueryT.find("[data-payment='cc-cvc']");
        base.brand = this.jQueryT.find("[data-payment='cc-brand']");
base.number.payment('formatCardNumber').data('payment-error-message', 'Please enter a valid credit card number.');
base.exp.payment('formatCardExpiry').data('payment-error-message', 'Please enter a valid expiration date.');
base.cvc.payment('formatCardCVC').data('payment-error-message', 'Please enter a valid CVC.');
        base.number.on('input', function() {
            base.cardType = jQuery.payment.cardType(base.number.val());
            var fg = base.number.closest('.form-group');
            fg.toggleClass('has-feedback', true);
            fg.find('.form-control-feedback').remove();            
            if (base.cardType) {
                base.brand.text(base.cardType);
                var icon = base._cardIcons[base.cardType] ? base._cardIcons[base.cardType] : base._cardIcons["default"];
                fg.append("<i class='" + icon + " fa-lg payment-form-icon form-control-feedback'></i>");
            } else {
                jQuery("[data-payment='cc-brand']").text("");
            }
        });
        base.number.on('change', function () {
            base._setValidationState(jQuery(this), !jQuery.payment.validateCardNumber(jQuery(this).val()));
        });
        base.exp.on('change', function () {
            base._setValidationState(jQuery(this), !jQuery.payment.validateCardExpiry(jQuery(this).payment('cardExpiryVal')));
        });
        base.cvc.on('change', function () {
            base._setValidationState(jQuery(this), !jQuery.payment.validateCardCVC(jQuery(this).val(), base.cardType));
        });   
    };
    Plugin.prototype.valid = function () {
        var base = this;
        var num_valid = jQuery.payment.validateCardNumber(base.number.val());
        var exp_valid = jQuery.payment.validateCardExpiry(base.exp.payment('cardExpiryVal'));
        var cvc_valid = jQuery.payment.validateCardCVC(base.cvc.val(), base.cardType);
        base._setValidationState(base.number, !num_valid);
        base._setValidationState(base.exp, !exp_valid);
        base._setValidationState(base.cvc, !cvc_valid);
        return num_valid && exp_valid && cvc_valid;
    }
    Plugin.prototype._setValidationState = function(el, erred) {
        var fg = el.closest('.form-group');
        fg.toggleClass('has-error', erred).toggleClass('has-success', !erred);
        fg.find('.payment-error-message').remove();
        if (erred) {
            fg.append("<span class='text-danger payment-error-message'>" + el.data('payment-error-message') + "</span>");
        }
        return this;
    }  
    Plugin.prototype.DLOG = function () 
    {
        if (!this.DEBUG) return;
        for (var i in arguments) {
            console.log( PLUGIN_NS + ': ', arguments[i] );    
        }
    }
    Plugin.prototype.DWARN = function () 
    {
        this.DEBUG && console.warn( arguments );    
    }
    jQuery.fn[ PLUGIN_NS ] = function( methodOrOptions ) {
        if (!jQuery(this).length) {
            return jQuery(this);
        }
        var instance = jQuery(this).data(PLUGIN_NS);
        if ( instance 
                && methodOrOptions.indexOf('_') != 0 
                && instance[ methodOrOptions ] 
                && typeof( instance[ methodOrOptions ] ) == 'function' ) {
            return instance[ methodOrOptions ]( Array.prototype.slice.call( arguments, 1 ) ); 
        } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            instance = new Plugin( jQuery(this), methodOrOptions );
            jQuery(this).data( PLUGIN_NS, instance );
            return jQuery(this);
        } else if ( !instance ) {
            jQuery.error( 'Plugin must be initialised before using method: ' + methodOrOptions );
        } else if ( methodOrOptions.indexOf('_') == 0 ) {
            jQuery.error( 'Method ' +  methodOrOptions + ' is private!' );
        } else {
            jQuery.error( 'Method ' +  methodOrOptions + ' does not exist.' );
        }
    };
})(jQuery);
var payment_form = jQuery('#payment-stripe').paymentForm();
jQuery('#validate').on('click', function(){
  var valid = jQuery('#payment-stripe').paymentForm('valid');
  var merchant = jQuery('form#shopForm select#choose-merchant').val();
  if(merchant=='stripe'){
      if(valid){
        jQuery('form#shopForm input[name="submit"]').click();
      }
  }else{
      jQuery('form#shopForm input[name="submit"]').click();
  }
});

jQuery(document).on("change","#choose-merchant",function(){
      if(jQuery(this).val()=='stripe'){
        jQuery('#payment-stripe').slideDown();    
      }else{
        jQuery('#payment-stripe').slideUp();  
      }
});

jQuery(document).on("change",'input[name="startDate"]',function(){
      if(jQuery(this).val()!=''){
        jQuery('input[name="endDate"]').attr('min',jQuery(this).val());    
      }
});
	
	
	
jQuery(document).ready(function ($) {
    console.log('call');

	// Helper function to validate both input and select fields
	function validateField(selector, errorSelector) {
		let value = $(selector).val().trim();
		let errorField = $(errorSelector);
		let isValid = true;

		if (value === '' || value === null) {
			errorField.text('This field is required');
			isValid = false;
		} else {
			errorField.text('');
		}

		return isValid;
	}


    // On form submission
    $('#shopForm').on('submit', function (event) {
        let isValid = true;

        // Validate each field
        isValid = validateField('#days-weeks-months', '#daysWeeksMonthsError') && isValid;
        isValid = validateField('#startDate', '#startDateError') && isValid;
        isValid = validateField('#endDate', '#endDateError') && isValid;

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Handle custom "Next" button click
    $('#validate').on('click', function () {
        $('#shopForm').submit();
    });
});
</script>