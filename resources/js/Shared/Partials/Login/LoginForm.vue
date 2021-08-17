<template>
  <form @submit.prevent="submit">
    <div
      v-if="$page.props.status"
      class="mb-4 font-medium text-sm text-green-600"
    >
      {{ $page.props.status }}
    </div>
    <group :errorMessage="form.errors.email" class="mb-3">
      <input
        id="singin-email"
        v-model="form.email"
        type="text"
        class="form-control"
        name="singin-email"
        placeholder="Username or Email Address *"
        autofocus
      />
    </group>
    <group :errorMessage="form.errors.password">
      <input
        id="singin-password"
        v-model="form.password"
        type="password"
        class="form-control"
        name="singin-password"
        placeholder="Password *"
        autocomplete="current-password"
      />
    </group>
    <div class="form-footer">
      <div
        :class="{ 'is-invalid': form.errors.remember }"
        class="form-checkbox"
      >
        <input
          id="signin-remember"
          v-model="form.remember"
          type="checkbox"
          class="custom-checkbox"
          name="signin-remember"
        />
        <label class="form-control-label" for="signin-remember">
          Remember me
        </label>
      </div>
      <div
        v-if="form.errors.remember"
        class="alert-danger alert-simple border-no font-weight-normal mt-1"
        style="font-size: 13px"
      >
        {{ form.errors.remember }}
      </div>
      <a v-if="$page.props.canResetPassword" href="#" class="lost-link">
        Lost your password?
      </a>
    </div>
    <button
      :disabled="form.processing"
      :class="{ 'opacity-65': form.processing }"
      class="btn btn-dark btn-block btn-rounded"
      type="submit"
    >
      Login
    </button>
  </form>
</template>

<script>
import Group from "@/Shared/Inputs/Group.vue";

export default {
  components: { Group },

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
          onSuccess: () => this.$EMITTER.emit("hide-popup:login"),
        });
    },
  },
};
</script>

<style scoped>
form > button[type="submit"]:disabled {
  cursor: not-allowed;
}
</style>