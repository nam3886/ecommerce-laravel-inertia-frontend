<template>
  <div>
    <table
      v-for="(cart, index) in carts"
      :key="index"
      :class="{ 'mb-4': !index }"
      class="order-table"
    >
      <thead>
        <tr>
          <th align="left">
            <i class="fas fa-store text-primary"></i>&nbsp;
            {{ cart.shop.name }}
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in cart.items" :key="item.rowId">
          <td class="product-name break-word">
            <link-slug :slug="item.options.slug">{{ item.name }}</link-slug>
            <span class="product-quantity">×&nbsp;{{ item.qty }}</span>
          </td>
          <td class="product-total text-body">
            {{ item.options.subtotal_format }}
          </td>
        </tr>
        <tr v-if="cart.tax" class="summary-subtotal">
          <td>
            <h4 class="summary-subtitle">Thuế</h4>
          </td>
          <td class="summary-subtotal-price pb-0 pt-0">
            {{ cart.tax_format }}
          </td>
        </tr>
        <tr class="summary-subtotal">
          <td>
            <h4 class="summary-subtitle">Phí vận chuyển</h4>
          </td>
          <td class="summary-subtotal-price pb-0 pt-0">
            {{ cart.shipping_fee_format }}
          </td>
        </tr>
        <tr class="summary-subtotal border-no">
          <td>
            <h4 class="summary-subtitle">Tổng</h4>
          </td>
          <td class="summary-subtotal-price pb-0 pt-0">
            {{ cart.grandtotal_format }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";

export default {
  props: ["carts"],

  components: { LinkSlug },
};
</script>

<style scoped>
table .product-name {
  width: 75%;
}
@media (max-width: 992px) {
  table .product-name {
    width: 100%;
  }
}
</style>