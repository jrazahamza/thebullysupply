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
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>PRODUCT PROMOTION</h2>
                        </div>
                        <!--==== Template Form-->
                        <div class="common-form-class my-shop-form">
                            <div class="form-title">
                                <h4>Promote Your Store</h4>
                            </div>
                            <div class="template-form promotionpage">
                                <form id="shopForm" class="formValidationQuery" method="POST" enctype="multipart/form-data">
                                    <?php
                                        if(isset($stripeResponse) && $stripeResponse!='success'){
                                    ?>
                                    <p style="color:red;font-size:16px;text-align:center;" class="stripe-error-message">Stripe error: <?php echo $stripeResponse; ?></p>
                                    <?php
                                        }
                                    ?> 
                                    <div class="flex-block flex-block01">
                                    <div class="flex-block-item flex-block-item01">
                                        <label class="template-label">Budget</label>
                                        <ul class="promotionsBudget">
                                            <?php
                                                $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotion` where `type`='store' and `status`='1' "); 
                                                while($productPromotion = mysqli_fetch_array($productPromotions)){
                                            ?>
                                            <li><?php echo $productPromotion['name'].' : $'.$productPromotion['price']; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div> 
                                    </div>
                                    <div class="flex-block flex-block02">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="product-for-promotion">Select Product For Promotion</label>
                                             <select class="form-control" id="product-for-promotion" name="productForPromotion" required>
                                                <option value="">--- Select a product ---</option>
                                                <?php
                                                    $listings=mysqli_query($con,"SELECT * FROM `listings` where `userID`='".$_COOKIE["user_id"]."' "); 
                                                    while($listing = mysqli_fetch_array($listings)){
                                                ?>
                                                <option value="<?php echo $listing['id']; ?>"><?php echo $listing['title']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-block flex-block03">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="choose-promotion">Choose A Promotion</label>
                                             <select class="form-control" id="choose-promotion" name="choosePromotion" required>
                                                <option value="">Select Promotion</option>
                                                <?php
                                                    $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotion` where `type`='store' and  `status`='1' "); 
                                                    while($productPromotion = mysqli_fetch_array($productPromotions)){
                                                ?>
                                                <option value="<?php echo $productPromotion['id']; ?>"><?php echo $productPromotion['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-block flex-block04">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="days-weeks-months">Days/Weeks/Months</label>
                                            <input type="number" id="days-weeks-months" name="daysWeeksMonths" min=1 placeholder="1" required />
                                        </div>
                                    </div>
                                    
                                    <div class="flex-block flex-block04">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="startDate">Start Date</label>
                                            <input type="date" id="startDate" name="startDate" required />
                                        </div>
                                    </div>
                                    
                                    <div class="flex-block flex-block04">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="endDate">End Date</label>
                                            <input type="date" id="endDate" name="endDate" required />
                                        </div>
                                    </div>
                                    
                                    <div class="flex-block flex-block03">
                                        <div class="flex-block-item flex-block-item01">
                                             <label class="template-label" for="choose-merchant">Choose A Merchant</label>
                                             <select class="form-control" id="choose-merchant" name="merchant" required>
                                                <option value="">Select Merchant</option>
                                                <option value="paypal">Paypal</option>
                                                <option value="stripe">Stripe</option>
                                            </select>
                                        </div>
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
                                    
                                    <!--====== Template Form Button-->
                                    <div class="template-form-button">
                                        <input type="submit" name="submit" value="Next" class="next" style="display:none;">
                                        <button type="button" id="validate" style="cursor:pointer;">Next</button>
                                    </div>
                                    <!--====== Template Form Button-->
                                </form>
                            </div>
                        </div>
                        <div class="template-page-history">
                <h4>History</h4>
                <div class="history-tablel-records">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Duration <span>(In Days)</span></th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Is Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $leaderBoardPromotions=mysqli_query($con,"SELECT * FROM `productPromotionStore` where `userID`='".$_COOKIE["user_id"]."' "); 
                                while($leaderBoardPromotion = mysqli_fetch_array($leaderBoardPromotions)){
                                    $products=mysqli_query($con,"SELECT * FROM `listings` where `id`='".$leaderBoardPromotion["product"]."' "); 
                                    $product = mysqli_fetch_array($products);
                                    $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotion` where `id`='".$leaderBoardPromotion["promotion"]."' "); 
                                    $productPromotion = mysqli_fetch_array($productPromotions);
                            ?>
                            <tr>
                                <td><?php if(isset($product['id'])){ echo $product['title']; } ?></td>
                                <td><?php if($leaderBoardPromotion['startDate']!=''){ echo date("F d, Y", strtotime($leaderBoardPromotion['startDate'])); } ?></td>
                                <td><?php if($leaderBoardPromotion['endDate']!=''){ echo date("F d, Y", strtotime($leaderBoardPromotion['endDate'])); } ?></td>
                                <td><?php echo $leaderBoardPromotion['duration']; ?> <?php if(isset($productPromotion['id'])){ 
                                    if($productPromotion['option']=='daily'){
                                        echo "days";
                                    }
                                    if($productPromotion['option']=='weekly'){
                                        echo "weeks";
                                    }
                                    if($productPromotion['option']=='monthly'){
                                        echo "months";
                                    }
                                    if($productPromotion['option']=='yearly'){
                                        echo "years";
                                    }
                                } ?></td>
                                <td><?php if(isset($productPromotion['id'])){ echo "$".$productPromotion['price']; } ?></td>
                                <td>
                                <?php
                                    $start_date = $leaderBoardPromotion['startDate'];
                                    $end_date = $leaderBoardPromotion['endDate'];
                                    $current_date = date("Y-m-d");
                                    if(($start_date=='' && $end_date=='') || (strtotime($current_date) >= strtotime($start_date) && strtotime($current_date) <= strtotime($end_date))) {
                                        if($leaderBoardPromotion['status']==0){ 
                                            echo "Pending";
                                        }elseif($leaderBoardPromotion['status']==1){
                                            echo "Active"; 
                                        }else{
                                            echo "Rejected";
                                        }
                                    } else {
                                        echo "Expired";
                                    }
                                ?>
                                </td>
                                <td>
                                    <?php if($leaderBoardPromotion['paid']==1){ ?>
                                    <a class="paid">Paid</a>
                                    <?php }else{ ?>
                                    <a style="cursor:pointer;" data-price="<?php if(isset($productPromotion['id'])){ echo $productPromotion['price']; }else{ echo 0; } ?>" data-id="<?php echo $leaderBoardPromotion['id']; ?>" class="unpaid paypalButtonPayNow">Unpaid</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
                </div>
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
</script>