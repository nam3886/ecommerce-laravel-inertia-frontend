<template>
  <div>
    <p class="minipopup-title">Someone Purchased</p>
    <div class="product product-purchased product-cart mb-0">
      <figure class="product-media">
        <a href="#">
          <img
            :src="`${$baseUrl}/images/cart/product-1.jpg`"
            alt="product"
            width="90"
            height="90"
          />
        </a>
      </figure>
      <div class="product-detail">
        <a href="product.html" class="product-name">
          Daisy Shoes Sonia by Sonia-Blue
        </a>
        <span class="purchased-time">12 MINUTES AGO</span>
      </div>
    </div>
  </div>
</template>

