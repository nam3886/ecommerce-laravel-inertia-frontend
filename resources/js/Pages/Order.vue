<template>
  <main class="main order">
    <div class="page-content pt-7 pb-10">
      <checkout-breadcrumb index-active="3" />

      <div class="container mt-8">
        <div class="order-message mr-auto ml-auto">
          <div class="icon-box d-inline-flex align-items-center">
            <div class="icon-box-icon mb-0">
              <svg
                version="1.1"
                id="Layer_1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 50 50"
                enable-background="new 0 0 50 50"
                xml:space="preserve"
              >
                <g>
                  <path
                    fill="none"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="bevel"
                    stroke-miterlimit="10"
                    d="
											M33.3,3.9c-2.7-1.1-5.6-1.8-8.7-1.8c-12.3,0-22.4,10-22.4,22.4c0,12.3,10,22.4,22.4,22.4c12.3,0,22.4-10,22.4-22.4
											c0-0.7,0-1.4-0.1-2.1"
                  ></path>
                  <polyline
                    fill="none"
                    stroke-width="4"
                    stroke-linecap="round"
                    stroke-linejoin="bevel"
                    stroke-miterlimit="10"
                    points="
											48,6.9 24.4,29.8 17.2,22.3 	"
                  ></polyline>
                </g>
              </svg>
            </div>
            <div class="icon-box-content text-left">
              <h5 class="icon-box-title font-weight-bold lh-1 mb-1">
                Thank You!
              </h5>
              <p class="lh-1 ls-m">Your order has been received</p>
            </div>
          </div>
        </div>

        <div class="order-results">
          <div class="overview-item">
            <span>Order number:</span>
            <strong>4935</strong>
          </div>
          <div class="overview-item">
            <span>Status:</span>
            <strong>Processing</strong>
          </div>
          <div class="overview-item">
            <span>Date:</span>
            <strong>November 20, 2020</strong>
          </div>
          <div class="overview-item">
            <span>Email:</span>
            <strong>12345@gmail.com</strong>
          </div>
          <div class="overview-item">
            <span>Total:</span>
            <strong>$312.00</strong>
          </div>
          <div class="overview-item">
            <span>Payment method:</span>
            <strong>Cash on delivery</strong>
          </div>
        </div>

        <h2
          class="
            title title-simple
            text-left
            pt-4
            font-weight-bold
            text-uppercase
          "
        >
          Order Details
        </h2>
        <div class="order-details">
          <table class="order-details-table">
            <thead>
              <tr class="summary-subtotal">
                <td>
                  <h3 class="summary-subtitle">Product</h3>
                </td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="product-name">
                  Beige knitted shoes
                  <span> <i class="fas fa-times"></i> 1</span>
                </td>
                <td class="product-price">$84.00</td>
              </tr>
              <tr>
                <td class="product-name">
                  Best dark blue pedestrian
                  <span><i class="fas fa-times"></i> 1</span>
                </td>
                <td class="product-price">$76.00</td>
              </tr>
              <tr>
                <td class="product-name">
                  Women's fashion handing
                  <span><i class="fas fa-times"></i> 2</span>
                </td>
                <td class="product-price">$152.00</td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Subtotal:</h4>
                </td>
                <td class="summary-subtotal-price">$312.00</td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Shipping:</h4>
                </td>
                <td class="summary-subtotal-price">Free shipping</td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Payment method:</h4>
                </td>
                <td class="summary-subtotal-price">Cash on delivery</td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Total:</h4>
                </td>
                <td>
                  <p class="summary-total-price">$312.00</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>
        <div class="address-info pb-8 mb-6">
          <p class="address-detail pb-2">
            John Doe<br />
            Riode Company<br />
            Steven street<br />
            El Carjon, CA 92020<br />
            123456789
          </p>
          <p class="email">mail@riode.com</p>
        </div>

        <a
          href="shop.html"
          class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"
          ><i class="d-icon-arrow-left"></i> Back to List</a
        >
      </div>
    </div>

    <Head title="Order" />
  </main>
</template>

<script>
import Layout from "@/Shared/Layout/";
import { Head } from "@inertiajs/inertia-vue3";
import CheckoutBreadcrumb from "@/Shared/CheckoutBreadcrumb.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: { Head, CheckoutBreadcrumb },
};
</script>