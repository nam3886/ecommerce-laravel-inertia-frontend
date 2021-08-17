<template>
  <form @submit.prevent="submit">
    <group :errorMessage="form.errors.email">
      <input
        id="register-email"
        v-model="form.email"
        type="email"
        class="form-control"
        name="register-email"
        placeholder="Your Email address *"
        autofocus
      />
    </group>
    <group :errorMessage="form.errors.password">
      <input
        id="register-password"
        v-model="form.password"
        type="password"
        class="form-control"
        name="register-password"
        placeholder="Password *"
      />
    </group>
    <group :errorMessage="form.errors.password_confirmation">
      <input
        id="register-password_confirmation"
        v-model="form.password_confirmation"
        type="password"
        class="form-control"
        name="register-password_confirmation"
        placeholder="Confirm_Password *"
      />
    </group>
    <div
      v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
      class="form-footer"
    >
      <div
        :class="{ 'is-invalid': form.errors.remember }"
        class="form-checkbox"
      >
        <input
          id="register-agree"
          v-model="form.terms"
          type="checkbox"
          class="custom-checkbox"
          name="register-agree"
          required
        />
        <label for="register-agree" class="form-control-label">
          I agree to the
          <a :href="route('policy.show')" target="_blank">privacy policy</a>
        </label>
      </div>
      <div
        v-if="form.errors.terms"
        class="alert-danger alert-simple border-no font-weight-normal mt-1"
        style="font-size: 13px"
      >
        {{ form.errors.terms }}
      </div>
    </div>
    <button
      :disabled="form.processing"
      :class="{ 'opacity-65': form.processing }"
      class="btn btn-dark btn-block btn-rounded"
      type="submit"
    >
      Register
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
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
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