<template>
  <b-card class="text-center">
    <b-card-text>
      <img src="img_avatar.png" style="border-radius:50%; border:solid 1px; " alt="Avatar" />
    </b-card-text>

    <b-card-text>Welcome Back <strong>{{ user.meta.full_name }}! </strong> </b-card-text>
  </b-card>
</template>

<script>
export default {
  data() {
    return {
      user: this.$store.state.user
    };
  },
  props: {}
};
</script>