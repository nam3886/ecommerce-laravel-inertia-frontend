<template>
  <div class="sticky-footer sticky-content fix-bottom">
    <a href="demo1.html" class="sticky-link active">
      <i class="d-icon-home"></i>
      <span>Home</span>
    </a>
    <a href="shop.html" class="sticky-link">
      <i class="d-icon-volume"></i>
      <span>Categories</span>
    </a>
    <a href="wishlist.html" class="sticky-link">
      <i class="d-icon-heart"></i>
      <span>Wishlist</span>
    </a>
    <a href="account.html" class="sticky-link">
      <i class="d-icon-user"></i>
      <span>Account</span>
    </a>
    <div class="header-search hs-toggle dir-up">
      <a href="#" class="search-toggle sticky-link">
        <i class="d-icon-search"></i>
        <span>Search</span>
      </a>
      <form action="#" class="input-wrapper">
        <input
          type="text"
          class="form-control"
          name="search"
          autocomplete="off"
          placeholder="Search your keyword..."
          required
        />
        <button class="btn btn-search" type="submit">
          <i class="d-icon-search"></i>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>