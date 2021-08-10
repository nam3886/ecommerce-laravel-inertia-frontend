<template>
  <form @submit.prevent="submit">
    <div
      v-if="$page.props.status"
      class="mb-4 font-medium text-sm text-green-600"
    >
      {{ $page.props.status }}
    </div>
    <div class="form-group mb-3">
      <input
        v-model="form.email"
        type="text"
        class="form-control"
        id="singin-email"
        name="singin-email"
        placeholder="Username or Email Address *"
        autofocus
      />
      <div
        v-if="form.errors.email"
        class="alert-danger alert-simple border-no font-weight-normal"
        style="font-size: 13px"
      >
        {{ form.errors.email }}
      </div>
    </div>
    <div class="form-group">
      <input
        v-model="form.password"
        type="password"
        class="form-control"
        id="singin-password"
        name="singin-password"
        placeholder="Password *"
        autocomplete="current-password"
      />
      <div
        v-if="form.errors.password"
        class="alert-danger alert-simple border-no font-weight-normal"
        style="font-size: 13px"
      >
        {{ form.errors.password }}
      </div>
    </div>
    <div class="form-footer">
      <div class="form-checkbox">
        <input
          type="checkbox"
          class="custom-checkbox"
          id="signin-remember"
          name="signin-remember"
          v-model="form.remember"
        />
        <label class="form-control-label" for="signin-remember">
          Remember me
        </label>
      </div>
      <a v-if="$page.props.canResetPassword" href="#" class="lost-link">
        Lost your password?
      </a>
    </div>
    <button
      :disabled="form.processing"
      class="btn btn-dark btn-block btn-rounded"
      type="submit"
    >
      Login
    </button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
          onSuccess: () => this.emitter.emit("hide-popup:login"),
        });
    },
  },
};
</script>