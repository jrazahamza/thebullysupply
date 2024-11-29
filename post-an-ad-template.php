<?php ob_start();
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
include('connection.php');
/* 
Template Name: Post And Add 
*/

get_header();
?>

<style>
	* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Manrope;
}


/* POST AN AD */

.post-an-ad {
  /* width: 1407px; */
  /* height: 1264px; */
  margin-top: 100px;
  /* border: 1px solid black; */
  padding: 56px 69px;
}

.form-dog-house {
  display: flex;
  gap: 85px;
  justify-content: space-between;
}
.post-an-ad .form-dog-house h1 {
  font-size: 40px;
  font-weight: 800;
  color: #121212;
}

.form {
  margin-top: 49px;
}
.form .category label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.form .category input {
  width: 704px;
  height: 59px;
  border: none;
  border-radius: 200px;
  background-color: #f5f6fa;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
  padding-left: 36px;
  margin-top: 11px;
  margin-bottom: 26px;
}

.form .sub-divs {
  display: flex;
  gap: 18px;
}

.sub-divs .sub-divs-category label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}

.sub-divs .sub-divs-category input {
  width: 343px;
  height: 59px;
  border: none;
  border-radius: 200px;
  background-color: #f5f6fa;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
  padding-left: 36px;
  margin-top: 11px;
  margin-bottom: 26px;
}

.form .description textarea {
  border-radius: 20px;
  background-color: #f5f6fa;
  margin-top: 11px;
  padding-top: 20px;
  padding-left: 30px;
}

.form .upload-img-btn {
  border: 1px solid #003459;
  border-radius: 61px;
  padding: 15px 30px;
  margin-top: 25px;
  color: #003459;
  background-color: #ffffff;
}

.form .check {
  margin-top: 25px;
}
.form .check input {
  border: 1px solid #003459;
}

.form .check label {
  font-size: 16px;
  font-weight: 400;
  color: #787070;
}

.form .post-btn {
  border: none;
  border-radius: 61px;
  padding: 15px 30px;
  color: #ffffff;
  background-color: #8b1339;
  margin-top: 25px;
}

/* Do House */

.dog-house {
  width: 35%;
}

.dog-house .dog-house-container {
  width: 479px;
  height: 636px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  /* background-color: #787070; */
}

.dog-house .dog-house-container img {
  width: 347px;
  height: 311px;
}

.dog-house p {
  font-size: 20px;
  font-weight: 500;
  color: #080808;
}

.dog-house .check-mark {
  display: flex;
  align-items: center;
  padding-left: 36px;
  margin-top: 10px;
}
.dog-house .check-mark img {
  width: 22px;
  height: 22px;
  margin-right: 9px;
}

.dog-house .check-mark span {
  font-size: 16px;
  font-weight: 400;
  color: #787070;
}

</style>
<div class="post-an-add">

  <!-- POST AN AD SECTION-->
  <div class="wrapper post-and-add-section">
    <div class="post-an-ad">
      <h1>POST AN AD</h1>
      <div class="form-dog-house">
        <!-- Form Section -->
        <div class="form">
          <form action="#">
            <div class="category">
              <label for="category">Category*</label><br />
              <input type="text" placeholder="Bully" id="Category" name="Category" />
            </div>
            <div class="category">
              <label for="sub-category">Sub Catecory*</label><br />
              <input type="text" placeholder="Bullies" id="sub-category" name="subcategory" />
            </div>
            <div class="category">
              <label for="sub-sub-category">Sub Catecory*</label><br />
              <input type="text" placeholder="American Bully Supply" id="sub-sub-category" name="subsubcategory" />
            </div>
            <div class="category">
              <label for="sub-sub-category">Title Of Ad*</label><br />
              <input type="text" placeholder="The Bully Supply" id="sub-sub-category" name="subsubcategory" />
            </div>
            <div class="sub-divs">
              <div class="sub-divs-category">
                <label for="sub-sub-category">Location*</label><br />
                <input type="text" placeholder="Missouri USA" id="sub-sub-category" name="subsubcategory" />
              </div>
              <div class="sub-divs-category">
                <label for="sub-sub-category">Price*in USD</label><br />
                <input type="text" placeholder="399.99" id="sub-sub-category" name="subsubcategory" />
              </div>
            </div>
            <div class="sub-divs">
              <div class="sub-divs-category">
                <label for="sub-sub-category">Gender*</label><br />
                <input type="text" placeholder="Male" id="sub-sub-category" name="subsubcategory" />
              </div>
              <div class="sub-divs-category">
                <label for="sub-sub-category">Age in Years</label><br />
                <input type="text" placeholder="2" id="sub-sub-category" name="subsubcategory" />
              </div>
            </div>
            <div class="category description">
              <label for="sub-sub-category">Description</label><br />
              <textarea name="Description" id="sub-sub-category" rows="10" cols="90">
                type here</textarea>
            </div>

            <button class="upload-img-btn">Upload Image</button>
            <div class="check">
              <input type="checkbox" id="vehicle2" name="vehicle2" />
              <label for="vehicle1">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit</label>
            </div>
            <button class="post-btn">Post an Ad</button>
          </form>
        </div>

        <!-- Do House -->
        <div class="dog-house">
          <div class="dog-house-container">
            <img src="./imgs/dog-house.png" alt="" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="check-mark-container">
              <div class="check-mark">
                <img src="./imgs/check.png" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="./imgs/check.png" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="./imgs/check.png" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="./imgs/check.png" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>



<?php
get_footer();
?>
