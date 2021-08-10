<template>
  <div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of Overlay -->
    <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
    <!-- End of CloseButton -->
    <div class="mobile-menu-container scrollable">
      <form action="#" class="input-wrapper">
        <input
          type="text"
          class="form-control"
          name="search"
          autocomplete="off"
          placeholder="Search your keyword..."
          required
        />
        <button class="btn btn-search" type="submit">
          <i class="d-icon-search"></i>
        </button>
      </form>
      <!-- End of Search Form -->
      <ul class="mobile-menu mmenu-anim">
        <li>
          <a href="demo1.html">Home</a>
        </li>
        <li>
          <a href="shop.html">Categories</a>
          <ul>
            <li>
              <a href="#"> Variations 1 </a>
              <ul>
                <li>
                  <a href="shop-banner-sidebar.html">Banner With Sidebar</a>
                </li>
                <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                <li>
                  <a href="shop-infinite-scroll.html">Infinite Ajaxscroll</a>
                </li>
                <li>
                  <a href="shop-horizontal-filter.html">Horizontal Filter</a>
                </li>
                <li>
                  <a href="shop-navigation-filter.html"
                    >Navigation Filter<span class="tip tip-hot">Hot</span></a
                  >
                </li>

                <li><a href="shop-off-canvas.html">Off-Canvas Filter</a></li>
                <li>
                  <a href="shop-right-sidebar.html">Right Toggle Sidebar</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#"> Variations 2 </a>
              <ul>
                <li>
                  <a href="shop-grid-3cols.html"
                    >3 Columns Mode<span class="tip tip-new">New</span></a
                  >
                </li>
                <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                <li><a href="shop-list.html">List Mode</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="product.html">Products</a>
          <ul>
            <li>
              <a href="#">Product Pages</a>
              <ul>
                <li><a href="product-simple.html">Simple Product</a></li>
                <li><a href="product.html">Variable Product</a></li>
                <li><a href="product-sale.html">Sale Product</a></li>
                <li>
                  <a href="product-featured.html">Featured &amp; On Sale</a>
                </li>

                <li>
                  <a href="product-left-sidebar.html">With Left Sidebar</a>
                </li>
                <li>
                  <a href="product-right-sidebar.html">With Right Sidebar</a>
                </li>
                <li>
                  <a href="product-sticky-cart.html"
                    >Add Cart Sticky<span class="tip tip-hot">Hot</span></a
                  >
                </li>
                <li><a href="product-tabinside.html">Tab Inside</a></li>
              </ul>
            </li>
            <li>
              <a href="#">Product Layouts</a>
              <ul>
                <li>
                  <a href="product-grid.html"
                    >Grid Images<span class="tip tip-new">New</span></a
                  >
                </li>
                <li><a href="product-masonry.html">Masonry</a></li>
                <li><a href="product-gallery.html">Gallery Type</a></li>
                <li><a href="product-full.html">Full Width Layout</a></li>
                <li><a href="product-sticky.html">Sticky Info</a></li>
                <li>
                  <a href="product-sticky-both.html">Left &amp; Right Sticky</a>
                </li>
                <li>
                  <a href="product-horizontal.html">Horizontal Thumb</a>
                </li>

                <li><a href="#">Build Your Own</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">Pages</a>
          <ul>
            <li><a href="about-us.html">About</a></li>
            <li><a href="contact-us.html">Contact Us</a></li>
            <li><a href="account.html">Login</a></li>
            <li><a href="faq.html">FAQs</a></li>
            <li><a href="error-404.html">Error 404</a></li>
            <li><a href="coming-soon.html">Coming Soon</a></li>
          </ul>
        </li>
        <li>
          <a href="blog-classic.html">Blog</a>
          <ul>
            <li><a href="blog-classic.html">Classic</a></li>
            <li><a href="blog-listing.html">Listing</a></li>
            <li>
              <a href="#">Grid</a>
              <ul>
                <li><a href="blog-grid-2col.html">Grid 2 columns</a></li>
                <li><a href="blog-grid-3col.html">Grid 3 columns</a></li>
                <li><a href="blog-grid-4col.html">Grid 4 columns</a></li>
                <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="#">Masonry</a>
              <ul>
                <li>
                  <a href="blog-masonry-2col.html">Masonry 2 columns</a>
                </li>
                <li>
                  <a href="blog-masonry-3col.html">Masonry 3 columns</a>
                </li>
                <li>
                  <a href="blog-masonry-4col.html">Masonry 4 columns</a>
                </li>
                <li>
                  <a href="blog-masonry-sidebar.html">Masonry sidebar</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#">Mask</a>
              <ul>
                <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                <li>
                  <a href="blog-mask-masonry.html">Blog mask masonry</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="post-single.html">Single Post</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">Elements</a>
          <ul>
            <li><a href="element-products.html">Products</a></li>
            <li><a href="element-typography.html">Typography</a></li>
            <li><a href="element-titles.html">Titles</a></li>
            <li><a href="element-categories.html">Product Category</a></li>
            <li><a href="element-buttons.html">Buttons</a></li>
            <li><a href="element-accordions.html">Accordions</a></li>
            <li>
              <a href="element-alerts.html">Alert &amp; Notification</a>
            </li>
            <li><a href="element-tabs.html">Tabs</a></li>
            <li><a href="element-testimonials.html">Testimonials</a></li>
            <li><a href="element-blog-posts.html">Blog Posts</a></li>
            <li><a href="element-instagrams.html">Instagrams</a></li>
            <li><a href="element-cta.html">Call to Action</a></li>
            <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
            <li><a href="element-icons.html">Icons</a></li>
          </ul>
        </li>
        <li>
          <a href="https://d-themes.com/buynow/riodehtml" target="_blank"
            >Buy Riode!</a
          >
        </li>
      </ul>
      <!-- End of MobileMenu -->
      <!-- <ul class="mobile-menu mmenu-anim">
                <li><a href="login.html">Login</a></li>
                <li><a href="cart.html">My Cart</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
            </ul> -->
      <!-- End of MobileMenu -->
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>