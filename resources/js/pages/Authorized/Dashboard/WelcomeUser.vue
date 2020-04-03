<template>
  <b-card class="text-center welcome-card">
    <div class="decoration-left">
      <img src="/img/welcome/welcome-left.png" alt="welcome-left" />
    </div>

    <div class="decoration-right">
      <img src="/img/welcome/welcome-right.png" alt="welcome-right" />
    </div>

    <b-card-text class="mt-4">
      <b-img
        :src="user.data.official_photo"
        rounded="circle"
        width="80px"
        height="80px"
        alt="Photo"
        v-if="user.data.official_photo != null"
      ></b-img>
      <b-img
        src="/img/avatar/user.png"
        rounded="circle"
        width="80px"
        height="80px"
        alt="Photo"
        v-else
      ></b-img>
    </b-card-text>

    <b-card-text>
      <div class="mb-2">
        <strong>
          Welcome Back,
          {{ user.meta.full_name }}
        </strong>
      </div>
      <div class="mt-1 ml-1 mb-3">
        <h5
          class="text-uppercase font-weight-bold text-primary"
        >{{ user.data.job_details.position }}</h5>
      </div>
    </b-card-text>
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

<style lang="scss" scoped>
.welcome-card {
  // background: linear-gradient(90deg, #6871b5, #9c8ef3, #6871b5);
  border-radius: 10px;
  box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
  transition: all 0.2s ease-out;

  &:hover {
    transform: translateY(4px);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
  }

  .decoration-left {
    position: absolute;
    top: 0;
    left: 0;
  }

  .decoration-right {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>
