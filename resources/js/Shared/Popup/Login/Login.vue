<template>
  <div class="login-popup overlay-popup">
    <div class="form-box">
      <div class="tab tab-nav-simple tab-nav-boxed form-tab">
        <ul
          class="
            nav nav-tabs nav-fill
            align-items-center
            border-no
            justify-content-center
            mb-5
          "
          role="tablist"
        >
          <li class="nav-item">
            <a class="nav-link active border-no lh-1 ls-normal" href="#signin"
              >Login</a
            >
          </li>
          <li class="delimiter">or</li>
          <li class="nav-item">
            <a class="nav-link border-no lh-1 ls-normal" href="#register"
              >Register</a
            >
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="signin">
            <login-form />
            <div class="form-choice text-center">
              <label class="ls-m">or Login With</label>
              <login-social />
            </div>
          </div>
          <div class="tab-pane" id="register">
            <register-form />
            <div class="form-choice text-center">
              <label class="ls-m">or Register With</label>
              <login-social />
            </div>
          </div>
        </div>
      </div>
    </div>
    <slot />
  </div>
</template>

<script>
import LoginForm from "@/Shared/Partials/Login/LoginForm.vue";
import LoginSocial from "@/Shared/Partials/Login/LoginSocial.vue";
import RegisterForm from "@/Shared/Partials/Login/RegisterForm.vue";

export default {
  components: { LoginForm, LoginSocial, RegisterForm },
};
</script>