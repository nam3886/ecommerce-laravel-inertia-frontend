<template>
  <main class="main">
    <breadcrumb />
    <div class="page-content mt-6 pb-2 mb-10">
      <div class="container">
        <login-popup />
      </div>
    </div>

    <Head title="Login" />
  </main>
</template>

<script>
import Layout from "@/Shared/Layout/";
import { Head } from "@inertiajs/inertia-vue3";
import Breadcrumb from "@/Shared/Breadcrumb.vue";
import LoginPopup from "@/Shared/Popup/Login/Login.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: { Head, Breadcrumb, LoginPopup },
};
</script>

