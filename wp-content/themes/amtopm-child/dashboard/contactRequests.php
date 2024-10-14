<?php
global $wpdb;

if(isset($_GET['request-delete'])){
    $query = "DELETE FROM `contactRequest` WHERE id=".$_GET['request-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-contact-requests");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Contact Requests</h2>
</div> 
<div class="maincontent zones">
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Listing</th>
    			<th>Customer</th>
    			<th>Customer Address</th>
    			<th>Customer IP</th>
    			<th>Description</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $contactRequests = $wpdb->get_results("SELECT * FROM `contactRequest` order by id desc ");
    	            foreach($contactRequests as $contactRequest){
    	                $listing=$wpdb->get_row($wpdb->prepare("SELECT * FROM `listings` WHERE id=".$contactRequest->product));
    	    ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td>
        			    <div class="user listings">
            			    <?php if($listing->gallery1!=''){ ?>
                                <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery1; ?>" alt="<?php echo $listing->title; ?>">
                            <?php }elseif($listing->gallery2!=''){ ?>
                                <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery2; ?>" alt="<?php echo $listing->title; ?>">
                            <?php }elseif($listing->gallery3!=''){ ?>
                                <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery3; ?>" alt="<?php echo $listing->title; ?>">
                            <?php } ?>
        			        <label><?php echo $listing->title; ?></label>
        			    </div>
        			</td>
        			<td>
        			    <?php echo $contactRequest->firstName.' '.$contactRequest->lastName; ?><br>
        			    <?php echo $contactRequest->emailAddress; ?><br>
        			    <?php echo $contactRequest->phoneNumber; ?>
        			</td>
        			<td><?php echo $contactRequest->address; ?></td>
        			<td><?php echo $contactRequest->userIP; ?></td>
        			<td><?php echo $contactRequest->description; ?></td>
        			<td>
        			    <a href="/wp-admin/admin.php?page=bully-contact-requests&request-delete=<?php echo $contactRequest->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
        			</td>
        		</tr>
    		<?php
    		        $i++;
    	        }
    		?>
    	</tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>