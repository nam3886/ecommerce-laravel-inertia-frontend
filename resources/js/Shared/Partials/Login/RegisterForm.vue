<template>
  <form action="#">
    <div class="form-group">
      <input
        type="email"
        class="form-control"
        id="register-email"
        name="register-email"
        placeholder="Your Email address *"
        required
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        class="form-control"
        id="register-password"
        name="register-password"
        placeholder="Password *"
        required
      />
    </div>
    <div class="form-footer">
      <div class="form-checkbox">
        <input
          type="checkbox"
          class="custom-checkbox"
          id="register-agree"
          name="register-agree"
          required
        />
        <label class="form-control-label" for="register-agree"
          >I agree to the privacy policy</label
        >
      </div>
    </div>
    <button class="btn btn-dark btn-block btn-rounded" type="submit">
      Register
    </button>
  </form>
</template>