<?php
/**
 * Template Name: Contact Us
 * Description: A custom template for the Contact Us page
 */
get_header();
?>


<style>

.form-section {
  margin-top: 80px;
}
.container h2 {
  line-height: normal;
  color: #000000;
  font-size: 21px;
  font-weight: 800;
  margin-bottom: 26px;
}

.alert {
  display: flex;
  align-items: center;
  background-color: #e5fdff;
  border-left: 4px solid #00becc;
  border-radius: 5px;
}
.alert i {
  margin-right: 18px;
  color: #00becc;
}

.col input,
#description {
  background-color: #f5f6fa;
}

.col label {
  color: #adadad;
  font-size: 16px;
  font-weight: 600;
}

.col samll {
  color: #999999;
  font-size: 14px;
  font-weight: 400;
}
small i {
  margin-right: 6px;
  color: #999999;
}

#flexCheckChecked {
  margin-right: 8px;
}

.ruk-bully-contact-us-sec .ruk-bully-contact-btn {
  background-color: #0b1e3e !important;
  color: #f2f2f2;
  padding-top: 18px;
  padding-bottom: 18px;
  border: none;
  border-radius: 2000px;
}

.col button i {
  color: #f2f2f2;
  font-size: 16px;
  margin-left: 6px;
}

.ideas-section {
  margin-top: 80px;
  margin-bottom: 80px;
}

.ideas-heading {
  text-align: center;
  margin-bottom: 36px;
}
.ideas-heading h2 {
  font-size: 21px;
  font-weight: 800;
  color: #000000;
  line-height: normal;
}

.ideas-section .idea-section-box {
  max-width: 860px;
  margin: auto;
  text-align: center;
  display: flex;
}

.box-1 {
  max-width: fit-content;
  padding: 72px 63px 72px 0;
}

.ideas-section .idea-section-box i {
  font-size: 50px;
  line-height: normal;
  margin-bottom: 15px;
}

.ideas-section .idea-section-box p {
  margin-bottom: 0;
}
.ideas-section .idea-section-box p > a {
  text-decoration: none;
  color: #252b42;
}
.ideas-section .idea-section-box span {
  display: block;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

.ideas-section .idea-section-box button {
  padding: 14px 48px;
  color: #0b1e3e;
  background-color: #fff !important;
  border: 1.8px solid #0b1e3e;
  border-radius: 68px;
}

.box-2 {
  color: #fff;
  background-color: #0b1e3e !important;
  padding: 72px 63px;
}
.idea-section-box .box-2 p > a {
  color: #fff;
}
.idea-section-box .box-2 button {
  color: #fff;
  background-color: #0b1e3e !important;
  border: 1.8px solid #fff;
}
.box-3 {
  max-width: fit-content;
  padding: 72px 0 72px 63px;
}


.ruk-bully-contact-us-sec .wpcf7-form-control-wrap input {
    border: unset;
}

.ruk-bully-contact-us-sec .wpcf7-form-control-wrap textarea {
    border: unset;
}


.ruk-bully-contact-us-sec .alert-secondary p {
    color: #008F99;
}
.contact-us-form-submit .col{
    display: flex;
    justify-content: center;
    align-items: center;
}
.contact-us-form-submit .col .wpcf7-submit{
    width:50vw !important;
    border-radius:25px;
	background-color:#0B1E3E;

}

	
</style>
<div class="container">
        <h2>Contact Form</h2>
	<?php echo do_shortcode('[contact-form-7 id="1f93a46" title="Contact-us"]'); ?>
</div>

<!-- <div class="form-section ruk-bully-contact-us-sec">
      <div class="container">
        <h2>Contact Form</h2>
        <div class="row">
          <div class="col">
            <div class="alert alert-secondary">
              <i class="fa-solid fa-circle-exclamation"></i>A simple primary
              alert—check it out!
            </div>
          </div>
        </div>
        <div class="row">
          <div class="mb-3 mt-3 col">
            <label for="name">Name*</label>
            <input type="text" id="name" class="form-control" name="name" />
          </div>
          <div class="mb-3 mt-3 col">
            <label for="name">Name*</label>
            <input type="text" id="name" class="form-control" name="name" />
          </div>
        </div>
        <div class="row">
          <div class="mb-3 mt-3 col">
            <label for="description">Description*</label><br />
            <textarea name="desc" class="form-control" id="description" rows="10" cols="90" ></textarea>
            <small
              ><i class="fa-solid fa-circle-exclamation"></i>Lorem ipsum dolor
              sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut</small
            >
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
            <label class="form-check-label" for="flexCheckChecked">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut
            </label>
          </div>
        </div>
        <div class="row">
          <div class="mt-3 col d-flex">
            <button type="submit" class="flex-grow-1 ruk-bully-contact-btn">
              Submit<i class="fa fa-arrow-right" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
</div>
  -->
    <div class="ideas-section">
      <div class="ideas-heading">
        <h2>We help small businesses with big ideas</h2>
      </div>

      <div class="idea-section-box">
        <div class="box-1">
          <i class="fa fa-phone" aria-hidden="true"></i>
          <p><a href="#">georgia.young@example.com</a></p>
          <p><a href="#">georgia.young@ple.com</a></p>
          <span>Get Support</span>
          <button type="submit">Submit</button>
        </div>
        <div class="box-2">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <p><a href="#">georgia.young@example.com</a></p>
          <p><a href="#">georgia.young@ple.com</a></p>
          <span>Get Support</span>
          <button type="submit">Submit</button>
        </div>
        <div class="box-3">
          <i class="fa fa-envelope" aria-hidden="true"></i>
          <p><a href="#">georgia.young@example.com</a></p>
          <p><a href="#">georgia.young@ple.com</a></p>
          <span>Get Support</span>
          <button type="submit">Submit</button>
        </div>
      </div>
      
    </div>


<?php
        get_footer();
?>