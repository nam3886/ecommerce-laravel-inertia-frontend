<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-top">
        <div class="row align-items-center">
          <div class="col-lg-3">
            <a href="demo1.html" class="logo-footer">
              <img
                :src="`${$BASE_URL}/images/logo-footer.png`"
                alt="logo-footer"
                width="154"
                height="43"
              />
            </a>
            <!-- End FooterLogo -->
          </div>
          <div class="col-lg-9">
            <div
              class="widget widget-newsletter form-wrapper form-wrapper-inline"
            >
              <div class="newsletter-info mx-auto mr-lg-2 ml-lg-4">
                <h4 class="widget-title">Subscribe to our Newsletter</h4>
                <p>Get all the latest information, Sales and Offers.</p>
              </div>
              <form action="#" class="input-wrapper input-wrapper-inline">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  id="email"
                  placeholder="Email address here..."
                  required
                />
                <button
                  class="btn btn-primary btn-rounded btn-md ml-2"
                  type="submit"
                >
                  subscribe<i class="d-icon-arrow-right"></i>
                </button>
              </form>
            </div>
            <!-- End Newsletter -->
          </div>
        </div>
      </div>
      <!-- End FooterTop -->
      <div class="footer-middle">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="widget widget-info">
              <h4 class="widget-title">Contact Info</h4>
              <ul class="widget-body">
                <li>
                  <label>Phone:</label>
                  <a href="tel:#">Toll Free (123) 456-7890</a>
                </li>
                <li>
                  <label>Email:</label>
                  <a href="mailto:mail@riode.com">mail@riode.com</a>
                </li>
                <li>
                  <label>Address:</label>
                  <a href="#">123 Street Name, City, England</a>
                </li>
                <li>
                  <label>WORKING DAYS / HOURS:</label>
                </li>
                <li>
                  <a href="#">Mon - Sun / 9:00 AM - 8:00 PM</a>
                </li>
              </ul>
            </div>
            <!-- End Widget -->
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="widget ml-lg-4">
              <h4 class="widget-title">My Account</h4>
              <ul class="widget-body">
                <li>
                  <a href="about-us.html">About Us</a>
                </li>
                <li>
                  <a href="#">Order History</a>
                </li>
                <li>
                  <a href="#">Returns</a>
                </li>
                <li>
                  <a href="#">Custom Service</a>
                </li>
                <li>
                  <a href="#">Terms &amp; Condition</a>
                </li>
              </ul>
            </div>
            <!-- End Widget -->
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="widget ml-lg-4">
              <h4 class="widget-title">Contact Info</h4>
              <ul class="widget-body">
                <li>
                  <a href="#">Sign in</a>
                </li>
                <li>
                  <a href="cart.html">View Cart</a>
                </li>
                <li>
                  <a href="wishlist.html">My Wishlist</a>
                </li>
                <li>
                  <a href="#">Track My Order</a>
                </li>
                <li>
                  <a href="#">Help</a>
                </li>
              </ul>
            </div>
            <!-- End Widget -->
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="widget widget-instagram">
              <h4 class="widget-title">Instagram</h4>
              <figure class="widget-body row">
                <div
                  v-for="(image, index) in images"
                  :key="index"
                  class="col-3"
                >
                  <img
                    :src="image.url"
                    :alt="image.name"
                    width="64"
                    height="64"
                  />
                </div>
              </figure>
            </div>
            <!-- End Instagram -->
          </div>
        </div>
      </div>
      <!-- End FooterMiddle -->
      <div class="footer-bottom">
        <div class="footer-left">
          <figure class="payment">
            <img
              :src="`${$BASE_URL}/images/payment.png`"
              alt="payment"
              width="159"
              height="29"
            />
          </figure>
        </div>
        <div class="footer-center">
          <p class="copyright">
            Riode eCommerce &copy; 2021. All Rights Reserved
          </p>
        </div>
        <div class="footer-right">
          <div class="social-links">
            <a
              href="#"
              class="social-link social-facebook fab fa-facebook-f"
            ></a>
            <a href="#" class="social-link social-twitter fab fa-twitter"></a>
            <a
              href="#"
              class="social-link social-linkedin fab fa-linkedin-in"
            ></a>
          </div>
        </div>
      </div>
      <!-- End FooterBottom -->
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      images: [
        {
          url: `${this.$BASE_URL}/images/instagram/01.jpg`,
          name: "instagram 1",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/02.jpg`,
          name: "instagram 2",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/03.jpg`,
          name: "instagram 3",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/04.jpg`,
          name: "instagram 4",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/05.jpg`,
          name: "instagram 5",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/06.jpg`,
          name: "instagram 6",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/07.jpg`,
          name: "instagram 7",
        },
        {
          url: `${this.$BASE_URL}/images/instagram/08.jpg`,
          name: "instagram 8",
        },
      ],
    };
  },
};
</script>

<style>
</style>