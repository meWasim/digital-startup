<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .banner-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Full screen height */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Banner content styling */
.banner-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 600px;
    opacity: 1; /* Full opacity for the content */
}

/* Banner header and description */
.banner-content h2 {
    margin-bottom: 10px;
}

.banner-content p {
    margin-bottom: 20px;
}

/* Form styling */
.user-form input {
    width: 80%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.user-form button {
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.user-form button:hover {
    background-color: #2980b9;
}

/* Close banner button */



</style>
{{-- <div id="banner" class="banner-container">
    <div class="banner-content">
        <h2>Welcome! Please fill out the form below.</h2>
        <p>To continue using our services, we need some basic information from you.</p>
        <form id="user-form" class="user-form">
            <input type="text" id="name" name="name" placeholder="Name" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="contact" name="contact" placeholder="Contact Number" required>
            <button type="submit">Submit</button>
        </form>

    </div>
</div> --}}

<footer class="red-bg w-100 d-block pt-3 pb-md-5 py-2">
     <div class="container">

         <div class="row">
             <div class="pros w-100 d-block">
                 <h2 class="w-100 d-block text-center pb-2">We Thrive When You Prosper</h2>
                 <p class="w-100 d-block text-center pb-3">Committed to deliver exceptionally high quality professional services by adding value to your business</p>
                 <a href="{{route('discuss.project')}}" class="diss">Discuss a Project</a>
             </div>
         </div>
     </div>
</footer>
<footer class="main-footer w-100 d-block">

        <div class="footer-top">
            <div class="container">
                <div class="row mb-md-5 mb-2">
                      <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-wrape justify-content-center pb-2">
                            <div class="ftr-logo">
                                  <a href="index.html"><img src="images/logo2.png" alt=""></a>
                            </div>
                      </div>
                      <a href="https://dialmyca.com/" class="ftr-lgo-txt w-100 text-center" target="_blank">A Unit of DialMyCA Advisory Services (P) Ltd</a>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 fnumber">
                        <p>Contact Number <br><span><a href="tel:+917971478657">+91 8100118818</a></span></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 fnumber">
                        <p>WhatsApp Number <br><span><a href="https://web.whatsapp.com/send?phone=+917971478657&amp;text=Hi, I would like to get more information.." class="whatsapplink hidemobile" target="_blank">+91 8100118818</a></span></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 fnumber">
                        <p>Email Us <br><span><a href="mailto:info@digitalstartups.in">info@digitalstartups.in</a></span></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 fnumber">
                        <p>For Suggestion Mail Us <br><span><a href="mailto:info@digitalstartups.in">info@digitalstartups.in</a></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="widgets-section">
                <div class="row">
                     <div class="col-md-5 col-sm-5 p-0">

                     </div>
                     <div class="col-md-4 col-sm-4">

                     </div>
                     <div class="col-md-3 col-sm-3">

                     </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-5 col-sm-5 p-md-0 pl-3">
                            <div class="footer-widget links-widget">
                                <span>About Us</span>
                            </div>
                            <div class="footer-widget">
                                 <p class="text-justify">As your trusted partner Digital Startups is the most admired Digital Marketing & Web development Company based on Kolkata. Digital Startups has always provides proven results to the businesses through Digital Marketing Services in India such as SEO, SMO, PPC and lot more. Our professionals uses customized solutions for your website ranking. We at Digital Startups always try our best to meet our customer expectations and satisfaction in terms of Best Digital marketing services, Best SEO Services, Best Social Media Marketing Services, Best PPC Services, Best Website designing services and Best Website development services along with Software development services and also Mobile App Development Services.</p>
                            </div>
                    </div>
                    <div class="col-md-2 col-sm-2 p-md-0 pl-3">
                          <div class="footer-widget links-widget text-md-left text-center">
                               <span class="pl-md-4">Quick Links</span>
                          </div>
                          <div class="footer-widget text-md-left text-center">
                              <ul class="list-link pl-md-4 pl-0">
                                  <li class="d-block"><a href="logo-design.php">Logo Designing</a></li>
                                  <li class="d-block"><a href="graphic-design.php">Graphic designing</a></li>
                                  <li class="d-block"><a href="website-design.php">Website Designing</a></li>
                                  <li class="d-block"><a href="brochure-design.php">Brochure Designing</a></li>
                                  <li class="d-block"><a href="mobile-application.php">Mobile Application</a></li>
                                  <li class="d-block"><a href="crm-software-development.php">CRM Software</a></li>
                              </ul>
                          </div>
                    </div>
                    <div class="col-md-2 col-sm-2 p-md-0 pl-3">
                          <div class="footer-widget links-widget text-md-left text-center">
                               <span>Digital Startups</span>
                          </div>
                          <div class="footer-widget links-widget text-md-left text-center">
                              <ul class="list-link pl-0">
                                  <li class="d-block"><a href="digital-marketing.php">Digital Marketing</a></li>
                                  <li class="d-block"><a href="domain-purches.php">Domain Purchase</a></li>
                                  <li class="d-block"><a href="#">SSL Purchase</a></li>
                                  <li class="d-block"><a href="hosting-service.php">Web Hosting</a></li>
                                  <li class="d-block"><a href="facebook-ad-campaign-service.php">Facebook Ad Campaign</a></li>
                                  <li class="d-block"><a href="google-ad-campaign.php">Google Ad Campaign</a></li>
                              </ul>
                          </div>
                    </div>

                    <div class="col-md-3 col-sm-3 pl-3">
                        <div class="footer-widget links-widget text-md-left text-center pb-md-5">
                            <p><u><b>Head Office</b></u><br/>PS Srijan Corporate Park, Unit No-406, 4th<br/>Floor, Tower-2, Plot No-G-2, Block-GP, <br>Sector-V, North 24 Parganas, Salt Lake <br/> Kolkata - 700091,<br/> West Bengal<br/>India</p>
                        </div>
                         <div class="footer-widget links-widget text-md-left text-center">
                            <h5 class="join-us">Join With Us</h5>
                            <ul class="social-footer pl-0">
                                <li><a href="https://www.facebook.com/DigitalStartups.in/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/tax_seva_kendra" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/digitalstartups1/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCjkF5JERzv7W7J2HqTfneuQ" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/taxsevakendra" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                         </div>
                    </div>
                    <div class="logo-wid" style="display: flex; justify-content: space-between; width: 100vw;">
                        <div class="w-full part-img flex justify-center">
                            <p class="logo-head">Bussiness Partners</p>
                                <div class="partner-logo">
                                    <img src="./images/meta.png" alt="" class="part-log">
                                    <img src="./images/TikTok.png" alt="" class="part-log">
                                    <img src="./images/amazon-adds.png" alt="" class="part-log">
                                    <img src="./images/google-partner.png" alt="" class="part-log">

                                </div>
                            </div>
                        <div class="col-md-9 col-sm-9 position-relative ftr-posi">
                            <div class="row" style="justify-content: center;">
                                <div class="col-md-8 col-sm-8 ftr-bdr" style="padding-bottom: 50px;">
                                    <ul class="digi-lgo pl-0">
                                        <li class="digi-sps"><figure><img src="images/digital-logo-01.png" alt=""><span>Startup India</span></figure></li>
                                        <li class="pt-1"><dd><img src="images/digital-india-logo.png" alt=""><span>Digital India</span></dd></li>
                                        <li class="pt-3"><dd><img src="images/iso-certified.png" alt=""><span>ISO Certified</span></dd></li>
                                        <li class="pt-md-4 mt-2"><figure><img src="images/ssl-secure.png" alt=""><span>SSL Secure</span></figure></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" ftr-bdr pt-mb-3">
                <div class="dgl-copyright text-center pt-md-5">© 2024 DigitalStartups All Rights Reserved</div>
            </div>
        </div>
</footer>


<!---------Start model popup------------>
<div class="modal svr-page" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title w-100 d-block text-center py-1">Get Quote</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
           <div class="get-quote-box w-100 d-block p-3">
                <form action="" id="">
                      <div class="row details mb-3">
                            <div class="col-md-12 col-sm-12 columns">
                              <div class="form-input-field ">



                                <label>Name *</label>
                                <input type="text" id="name" name="name" value="" class="inputfield" placeholder="Name">
                                <div id="err1" style="color: red"></div>
                              </div>
                            </div>
                      </div>
                      <div class="row details mb-3">
                            <div class="col-md-12 col-sm-12 columns">
                                  <div class="form-input-field apply-field-md d-inline-block mr-2">
                                      <label>Contact Number *</label>
                                      <input type="text" id="" name="" class="inputfield" placeholder="Contact Number">
                                  </div>
                                  <div class="form-input-field apply-field-md d-inline-block">
                                        <label>Email *</label>
                                        <input type="text" id="email" name="email" value="" class="inputfield" placeholder="e-mail">
                                  </div>
                            </div>
                      </div>
                      <div class="row details mb-3">
                            <div class="col-md-12 col-sm-12 columns">
                                  <div class="form-input-field apply-field-md d-inline-block mr-2">
                                    <label>City / Place *</label>
                                    <input type="text" id="city" name="city" class="inputfield" placeholder="City / Place">
                                  </div>
                                  <div class="form-input-field apply-field-md d-inline-block">
                                       <label class="w-100">State *</label>
                                        <select class="selectpicker inputfield  apply-field-md d-inline-block w-100" name="state" id="state">
                                        <option selected="selected" value="">State</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                      </select>
                                  </div>
                            </div>
                      </div>
                      <div class="row details mb-3">
                            <div class="col-md-12 col-sm-12">
                                  <div class="form-input-field">
                                       <label>Message</label>
                                      <textarea id="mssg" name="address" placeholder="Enter Your Message" class="gstin-address" rows="5" type="text"></textarea>
                                  </div>
                            </div>
                      </div>
                      <div class="row">
                           <div class="col-md-12 col-sm-12">
                                <button type="submit" class="proced-btn" id="btn" style="cursor: pointer">Submit</button>
                           </div>
                      </div>
                </form>
           </div>
      </div>
    </div>
  </div>
</div>
<!---------End model popup----------->
{{-- <script>
 $(document).ready(function() {
    // Initially hide the banner
    $('.banner-container').hide();

    // Show the banner after 4 seconds
    setTimeout(function() {
        $('.banner-container').fadeIn(); // Fade in the banner
    }, 4000); // 4000 milliseconds = 4 seconds

    // Close the banner when the close button is clicked
    $('.close-banner').click(function() {
        $('.banner-container').fadeOut(); // Fade out the banner
    });

    // Handle form submission (you can customize the form action)
    $('.user-form').submit(function(e) {
        e.preventDefault();
        alert('Form submitted');
        // You can process the form here
        $('.banner-container').fadeOut(); // Hide banner after submission
    });
});

</script> --}}
