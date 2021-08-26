<template>
  <nav
    class="
      toolbox toolbox-horizontal
      sticky-toolbox sticky-content
      fix-top
      pt-2
    "
    data-top="1174"
  >
    <aside class="sidebar sidebar-fixed shop-sidebar">
      <div class="sidebar-overlay"></div>
      <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
      <div class="sidebar-content toolbox-left">
        <div class="toolbox-item select-menu">
          <a class="select-menu-toggle" href="#">Select Size</a>
          <ul class="filter-items">
            <li><a href="#">Extra Large</a></li>
            <li><a href="#">Large</a></li>
            <li><a href="#">Medium</a></li>
            <li><a href="#">Small</a></li>
          </ul>
        </div>
        <div class="toolbox-item select-menu">
          <a class="select-menu-toggle" href="#">Select Color</a>
          <ul class="filter-items">
            <li><a href="#">Black</a></li>
            <li><a href="#">Blue</a></li>
            <li><a href="#">Brown</a></li>
            <li><a href="#">Green</a></li>
          </ul>
        </div>
        <div class="toolbox-item select-menu">
          <a class="select-menu-toggle" href="#">Select Price</a>
          <ul class="filter-items filter-price">
            <li><a href="#">$0.00 - $50.00</a></li>
            <li><a href="#">$50.00 - $100.00</a></li>
            <li><a href="#">$100.00 - $200.00</a></li>
            <li><a href="#">$200.00+</a></li>
          </ul>
        </div>
      </div>
    </aside>
    <div class="toolbox-left">
      <a
        href="#"
        class="
          toolbox-item
          left-sidebar-toggle
          btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right
          d-lg-none
        "
      >
        Filter<i class="d-icon-arrow-right"></i
      ></a>
      <div class="toolbox-item toolbox-sort select-menu">
        <select name="orderby" class="form-control ls-normal">
          <option value="default" selected="selected">Default sorting</option>
          <option value="popularity">Most popular</option>
          <option value="rating">Average rating</option>
          <option value="date">Latest</option>
          <option value="price-low">Sort forward price low</option>
          <option value="price-high">Sort forward price high</option>
          <option value="">Clear custom sort</option>
        </select>
      </div>
    </div>
    <div class="toolbox-right">
      <div class="toolbox-item toolbox-show select-box text-dark">
        <label>show :</label>
        <select name="count" class="form-control">
          <option value="12">10</option>
          <option value="24" selected>15</option>
          <option value="36">20</option>
          <option value="36">30</option>
        </select>
      </div>
      <div class="toolbox-item toolbox-layout">
        <a href="shop-list.html" class="d-icon-mode-list btn-layout"></a>
        <a href="shop.html" class="d-icon-mode-grid btn-layout active"></a>
      </div>
    </div>
  </nav>
</template>

<script>
export default {};
</script>
