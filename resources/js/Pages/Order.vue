<template>
  <main class="main order">
    <div class="page-content pt-7 pb-10">
      <checkout-breadcrumb index-active="3" />

      <div class="container mt-8">
        <div v-if="checkout_success" class="order-message mr-auto ml-auto">
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
              <p class="lh-1 ls-m">Đơn đặt hàng của bạn đã được nhận</p>
            </div>
          </div>
        </div>

        <div class="order-results">
          <div class="overview-item">
            <span>Mã đơn:</span>
            <strong>{{ order.data.order_code }}</strong>
          </div>
          <div class="overview-item">
            <span>Tình trạng:</span>
            <strong>Pending</strong>
          </div>
          <div class="overview-item">
            <span>Thời gian:</span>
            <strong>{{ order.data.created_at }}</strong>
          </div>
          <div class="overview-item">
            <span>Email:</span>
            <strong>{{ $page.props.user.email }}</strong>
          </div>
          <div class="overview-item">
            <span>Tổng:</span>
            <strong>{{ order.data.grandtotal_format }}</strong>
          </div>
          <div class="overview-item">
            <span>Thanh toán:</span>
            <strong>{{ order.data.payment_method.name }}</strong>
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
          Chi tiết
        </h2>
        <div
          v-for="(sub_order, index) in order.data.sub_orders"
          :key="index"
          :class="{ 'mt-5': index }"
          class="order-details"
        >
          <table class="order-details-table">
            <thead>
              <tr class="summary-subtotal">
                <td>
                  <h3 class="summary-subtitle">
                    <i class="fas fa-store text-primary"></i>&nbsp;
                    {{ sub_order.shop.name }}
                  </h3>
                </td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in sub_order.items" :key="item.id">
                <td class="product-name">
                  <link-slug :slug="item.slug">{{ item.name }}</link-slug>&nbsp;
                  <span> <i class="fas fa-times"></i> {{ item.quantity }}</span>
                </td>
                <td class="product-price">{{ item.price_format }}</td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Tổng tiền:</h4>
                </td>
                <td class="summary-subtotal-price">
                  {{ sub_order.subtotal_format }}
                </td>
              </tr>
              <tr v-if="sub_order.tax" class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Thuế:</h4>
                </td>
                <td class="summary-subtotal-price">
                  {{ sub_order.tax_format }}
                </td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Phí vận chuyển:</h4>
                </td>
                <td class="summary-subtotal-price">
                  {{ sub_order.shipping_fee_format }}
                </td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Thanh toán:</h4>
                </td>
                <td class="summary-subtotal-price">
                  {{ order.data.payment_method.name }}
                </td>
              </tr>
              <tr class="summary-subtotal">
                <td>
                  <h4 class="summary-subtitle">Tổng:</h4>
                </td>
                <td>
                  <p class="summary-total-price">
                    {{ sub_order.grandtotal_format }}
                  </p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <h2 class="title title-simple text-left pt-10 mb-2">
          Địa chỉ nhận hàng
        </h2>
        <div class="address-info pb-8 mb-6">
          <p class="address-detail pb-2">
            {{ order.data.billing_address.name }}<br />
            {{ order.data.billing_address.address }}<br />
            {{ order.data.billing_address.phone }}
          </p>
          <p class="email">{{ $page.props.user.email }}</p>
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
import Layout from "@/Layouts/AppLayout/index.vue";
import { Head } from "@inertiajs/inertia-vue3";
import CheckoutBreadcrumb from "@/Shared/CheckoutBreadcrumb.vue";
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: { Head, CheckoutBreadcrumb, LinkSlug },

  props: ["order", "checkout_success"],
};
</script>