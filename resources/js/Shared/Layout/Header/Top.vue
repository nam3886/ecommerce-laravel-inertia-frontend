<template>
  <div class="header-top">
    <div class="container">
      <div class="header-left">
        <p class="welcome-msg">Welcome to Riode store message or remove it!</p>
      </div>
      <div class="header-right">
        <div class="dropdown">
          <a href="#currency">USD</a>
          <ul class="dropdown-box">
            <li><a href="#USD">USD</a></li>
            <li><a href="#EUR">EUR</a></li>
          </ul>
        </div>
        <!-- End DropDown Menu -->
        <div class="dropdown ml-5">
          <a href="#language">ENG</a>
          <ul class="dropdown-box">
            <li>
              <a href="#USD">ENG</a>
            </li>
            <li>
              <a href="#EUR">FRH</a>
            </li>
          </ul>
        </div>
        <!-- End DropDown Menu -->
        <span class="divider"></span>
        <a href="contact-us.html" class="contact d-lg-show"
          ><i class="d-icon-map"></i>Contact</a
        >
        <a href="#" class="help d-lg-show"
          ><i class="d-icon-info"></i> Need Help</a
        >
        <a
          @click.prevent="emitter.emit('show-popup:login', 'login')"
          :href="route('login')"
          data-toggle="login-modal"
          class="login-link"
        >
          <i class="d-icon-user"></i>Sign in
        </a>
        <span class="delimiter">/</span>
        <a
          @click.prevent="emitter.emit('show-popup:login', 'register')"
          :href="route('login')"
          data-toggle="login-modal"
          class="register-link ml-0"
        >
          Register
        </a>
        <!-- End of Login -->
      </div>
    </div>
  </div>
</template>