<template>
  <form action="#">
    <div class="form-group mb-3">
      <input
        type="text"
        class="form-control"
        id="singin-email"
        name="singin-email"
        placeholder="Username or Email Address *"
        required
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        class="form-control"
        id="singin-password"
        name="singin-password"
        placeholder="Password *"
        required
      />
    </div>
    <div class="form-footer">
      <div class="form-checkbox">
        <input
          type="checkbox"
          class="custom-checkbox"
          id="signin-remember"
          name="signin-remember"
        />
        <label class="form-control-label" for="signin-remember"
          >Remember me</label
        >
      </div>
      <a href="#" class="lost-link">Lost your password?</a>
    </div>
    <button class="btn btn-dark btn-block btn-rounded" type="submit">
      Login
    </button>
  </form>
</template>

<script>
export default {
  
}
</script>