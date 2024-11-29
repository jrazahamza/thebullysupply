<?php
/**
 * Template Name: About Us
 * Description: A custom template for the About Us page
 */
get_header();
?>
<style>
.about-us-page-content .banner-content{   
    width:100% !important;
}
.about-us-page-content .hero-heading {
    width: 60%;
}

.about-us-page-content .hero-img {
    width: 40%;
    position:relative;
    bottom:-78px;
}

.about-us-page-content .hero-img img {
    width: 100%;
}
	
.about-us-page-content .about-us-banner {
    background-image: url(/wp-content/uploads/2024/11/Website-Mainvdh-Banner-Option-3.png) !important;
    background-size: cover;
    background-repeat: no-repeat;
    background-position:bottom center;
    min-width: 100%;
}

.about-us-page-content .hero-heading {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-content: center;
  height: 100%;
}
.about-us-page-content .banner-content{
   display: flex;
  justify-content: space-between;
  align-items:center;
}	
.about-us-page-content .hero-heading h1 {
  font-family: Nova Klasse;
	color: #ffffff;
  line-height: normal;
  font-size: 36px;
  font-weight: 400;
  max-width: 561px;
}

.about-us-page-content .hero-heading p {
  color: #e0e4e8;
  font-size: 17px;
  font-weight: 400;
  margin-top: 12px;
  max-width: 778px;
}
.about-us-page-content .about-us-section {
  margin: 100px 0px;
  color: #121212;
  display: flex;
  display: flex;
    justify-content: space-between;
	align-items: center;
}

.about-us-page-content .about-us-heading {
/*   margin: 45px 81px 45px 0; */
  max-width: 770px;
}

.about-us-page-content .about-us-heading span {
  font-size: 18px;
  font-weight: 400;
}
.about-us-page-content .about-us-heading h2 {
  font-size: 21px;
  font-weight: 800;
  line-height: normal;
  margin-bottom: 31px;
}
.about-us-page-content .about-us-heading p {
  font-size: 16px;
  font-weight: 400;
  color: #afadb5;
}

.about-us-page-content .about-us-right img {
  width: 100%;
  height: auto;
}

.about-us-page-content .community-section {
/*   margin: 159px 174px 100px 154px; */
  display: flex;
}

.about-us-page-content .community-left {
  width: 50%;
  height: 504px;
  background-color: #0b1e3e;
  border-radius: 20px;
  margin-right: 20px;
  color: #ffff;
	display: flex;
	flex-direction: column;
	justify-content: center;	
	background-image: url(/wp-content/uploads/2024/11/1321316305.png);
	background-repeat: no-repeat;
	background-size: cover;
	padding: 0px 50px;
}

.about-us-page-content .community-left span {
  font-size: 18px;
  font-weight: 400;
}
.about-us-page-content .community-left h2 {
  font-size: 21px;
  font-weight: 800;
  line-height: normal;
  margin-top: 5px;
  margin-bottom: 26px;
}

.about-us-page-content .community-left p {
  color: #e0e4e8;
  font-size: 16px;
  font-weight: 400;
  line-height: 27px;
  margin-bottom: 26px;
}

.about-us-page-content .community-left a {
  color: #0b1e3e;
 width:190px;
  padding: 14px 38px;
  font-size: 14px;
  font-weight: 600;
  background-color: #fff;
  border-radius: 52px;
  text-decoration: none;
}

.about-us-page-content .community-right {
  width: 50%;
	display: flex;
    justify-content: center;
    align-items: center;
  background-color: #f5f5f5;
  border-radius: 20px;
}

.about-us-page-content .testimonial-section {
/*   margin: 0 166px 167px 167px; */
  display: flex;
	justify-content: space-between;
}

.about-us-page-content .testimonial-left {
/*   margin: 42px 53px 0 0; */
  max-width: 748px;
  color: #000;
display: flex;
    flex-direction: column;
    justify-content: center;
}

.about-us-page-content .testimonial-content span {
  font-size: 19px;
  font-weight: 400;
}
.about-us-page-content .testimonial-content h2 {
  line-height: normal;
  font-size: 36px;
  font-weight: 800;
  margin-top: 56px;
  margin-bottom: 56px;
}

.about-us-page-content .testimonial-statistics {
  display: flex;
  gap: 64px;
}
.about-us-page-content .testimonial-statistic h2 {
  line-height: normal;
  color: #151411;
  font-size: 44px;
  font-weight: 700;
}
.about-us-page-content .testimonial-statistic span {
  color: #afadb5;
  font-size: 18px;
  font-weight: 500;
}

.about-us-page-content .testimonial-right {
  max-width: 594px;
	margin: 100px 0px;
}

.about-us-page-content .testimonial-chat-bubble {
  display: flex;
  margin-bottom: 14px;
  overflow: hidden;
}

.testimonial-right .chat-bubble-icon i.fa {
    padding:8px 10px;
    border-radius:25px;
    background-color:#EFF8FF;
    color:#8B1339;
    font-size:18px;
}	
.about-us-page-content .chat-bubble-icon i {
  font-size: 34px;
  margin-right: 25px;
  overflow: hidden;
}

.about-us-page-content .chat-bubble-content h2 {
  line-height: normal;
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 16px;
}
.about-us-page-content .chat-bubble-content p {
  color: #afadb5;
  font-size: 18px;
  font-weight: 400;
  line-height: 32px;
}

.about-us-page-content .timeline-section {
/*   margin: 0 221px 364px 222px; */
  color: #121212;
  display: flex;
	margin-bottom:100px;
}

.about-us-page-content .timeline-heading {
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  width: 13%;
  /* background-color: #afadb5; */
}
.about-us-page-content .timeline-heading span {
  font-size: 33px;
  font-weight: 400;
}
.about-us-page-content .timeline-heading h1 {
  font-size: 70px;
  font-weight: 800;
  line-height: normal;
  margin: 0;
}

.about-us-page-content .timeline {
  /* background-color: #e0e4e8; */
  position: relative;
  max-width: 1145px;
  margin: 0 auto;
  /* width: 100%; */
}
.about-us-page-content .timeline::after {
  content: '';
  position: absolute;
  width: 3px;
  background-image: linear-gradient(#741030, #B7B7B7);
  top: 40px;
  bottom: 30px;
  left: 25px;
  margin-left: -3px;
}

.about-us-page-content .timeline-container {
  padding: 10px 50px;
  position: relative;
  background-color: inherit;
  width: 100%;
}


.about-us-page-content .timeline-container::after {
  content: '';
  position: absolute;
  width: 15px;
  height: 15px;
  left: 16px;
  background-color: white;
  background-image: url(./imgs/dot.png);
  background-repeat: no-repeat;
  background-position: center;
  border: 0.63px solid #B7B7B7;
  top: 40px;
  border-radius: 50%;
  z-index: 1;
}


.about-us-page-content .timeline-content span {
  font-size: 11px;
  font-weight: 400;
}

.about-us-page-content .timeline-content h2 {
  font-size: 24px;
  font-weight: 800;
  line-height: normal;
}

.about-us-page-content .timeline-content p {
  font-size: 18px;
  font-weight: 400;
  line-height: 32px;
  color: #AFADB5;
}


.about-us-page-content .video-section {
  width: 100%;
/*   height: 522px; */
  margin-bottom:100px;
/*   margin: 159px 174px 100px 154px; */
}
.about-us-page-content .video-section img {
  width: 100%;
}


@media screen and (max-width: 460px) {
	.about-us-page-content .hero-heading {
    width: 100% !important;
 }
.about-us-page-content .about-us-banner {
    height: 62vh !important;
 }
	.about-us-page-content .hero-heading h1{
		font-size:24px !important;
	}
	.about-us-page-content .hero-heading p{
		font-size:12px !important;
	}	
.about-us-page-content .hero-img {
	width: 100% !important;
	}
.about-us-page-content .hero-img img {
    width: 100% !important;
 }
.about-us-page-content .hero-img {
    width: 40%;
    position: relative;
    bottom: -40px !important;
}	
  .about-us-page-content .banner-content {
    height: 100%;
    flex-direction: column;
	}
 .about-us-page-content .about-us-section {
    flex-direction: column;
	}
.about-us-page-content .community-section {
    display: flex;
    flex-direction: column;
    row-gap: 30px;
    }
.about-us-page-content .community-left {
    width: 100% !important;
   }
.about-us-page-content .community-right {
    width: 100% !important;
  padding:0px !important;
  }
 .about-us-right-ruk img {
    width: 100%;
  }
  .community-right img {
    width: 74%;
    padding: 20px 0px;
	}
  .about-us-page-content .testimonial-section {
    flex-direction: column;
	}
  .about-us-page-content .testimonial-statistics {
    gap: 26px !important;
	}
  .about-us-page-content .timeline-heading {
    width: 15% !important;
  }
  .about-us-page-content .timeline-heading span {
    font-size: 16px !important;
  }
  .about-us-page-content .timeline-heading h1 {
    font-size: 34px !important;
  }
}  
</style>

<div class="about-us-page-content">
    <div class="about-us-banner">
		<div class="container-footer">	
			<div class="banner-content">					
			  <div class="hero-heading">
				<h1>Bully Dog Waiting To brighten your life!</h1>
				<p>
				  Experience joy and companionship with our amazing bully dogs. Each one
				  offer unique fun and unconditional friendship. Discover your prefect
				  bullydog and brighten your life
				</p>
			  </div>			
			  <div class="hero-img">
				<img src="/wp-content/uploads/2024/11/cute-puppy-sitting-looking-camera-purebred-dog-portrait-generated-by-artificial-intelligence-1.png" alt="" />
			  </div>
			  </div>
		</div>
    </div>
	<div class="container-footer">		
    <div class="about-us-section">
      <div class="about-us-left">
        <div class="about-us-heading">
          <span>About Us</span>
          <h2>Lorem Ipsum is simply dummy text</h2>
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type
            and scrambled it to make a type specimen book. It has survived not
            only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged.
          </p>
        </div>
      </div>
      <div class="about-us-right-ruk">
        <img src="/wp-content/uploads/2024/11/about-us-img.png" alt="" />
      </div>
    </div>

    <div class="community-section">
      <div class="community-left">
        <span>Community</span>
        <h2>BULLY COMMUNITY</h2>
        <p>
          Experience joy and companionship with our amazing bully dogs. Each one
          offer unique fun and unconditional friendship. Discover your prefect
          bullydog and brighten your life
        </p>
        <a href="#">Join Community</a>
      </div>
      <div class="community-right">
        <img src="/wp-content/uploads/2024/11/community-img.png" alt="" />
      </div>
    </div>

    <div class="testimonial-section">
      <div class="testimonial-left">
        <div class="testimonial-content">
          <span>Lorem Ipsum</span>
          <h2>
            Lorem Ipsum is simply dummy text of the printing and typesetting
          </h2>
        </div>
        <div class="testimonial-statistics">
          <div class="testimonial-statistic">
            <h2>20+</h2>
            <span>Years Experience</span>
          </div>
          <div class="testimonial-statistic">
            <h2>483</h2>
            <span>Vendors Ondoarded</span>
          </div>
          <div class="testimonial-statistic">
            <h2>150+</h2>
            <span>Items Listed</span>
          </div>
        </div>
      </div>
      <div class="testimonial-right">
        <div class="testimonial-chat-bubble">
          <div class="chat-bubble-icon">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </div>
          <div class="chat-bubble-content">
            <h2>Lorem Ipsum</h2>
            <p>
              24/7 support means a support service that is provided 24 hours a
              day and 7 days a week.
            </p>
          </div>
        </div>
        <div class="testimonial-chat-bubble">
          <div class="chat-bubble-icon">
            <i class="fa fa-weixin" aria-hidden="true"></i>
          </div>
          <div class="chat-bubble-content">
            <h2>Lorem Ipsum</h2>
            <p>
              24/7 support means a support service that is provided 24 hours a
              day and 7 days a week.
            </p>
          </div>
        </div>
        <div class="testimonial-chat-bubble">
          <div class="chat-bubble-icon">
            <i class="fa fa-universal-access" aria-hidden="true"></i>
          </div>
          <div class="chat-bubble-content">
            <h2>Lorem Ipsum</h2>
            <p>
              24/7 support means a support service that is provided 24 hours a
              day and 7 days a week.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="timeline-section">
      <div class="timeline-heading">
        <span>Journey</span>
        <h1>Our Journey</h1>
      </div>
      <div class="timeline">
        <div class="timeline-container right">
          <div class="timeline-content">
            <span>2017</span>
            <h2>THE START</h2>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry's standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged.
            </p>
          </div>
        </div>
        <div class="timeline-container right">
          <div class="timeline-content">
            <span>2019</span>
            <h2>THE START</h2>
          </div>
        </div>
        <div class="timeline-container right">
          <div class="timeline-content">
            <span>2022</span>
            <h2>THE START</h2>
          </div>
        </div>
        <div class="timeline-container right">
          <div class="timeline-content">
            <span>2024</span>
            <h2>THE LAUNCH</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="video-section">
      <img src="/wp-content/uploads/2024/11/video-section.png" alt="" />
    </div>

	</div>
</div>




<?php get_footer(); ?>
