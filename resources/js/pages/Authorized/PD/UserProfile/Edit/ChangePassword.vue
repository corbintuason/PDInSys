<template>
  <div>
    <h3>Edit Password</h3>
    <div class="component-sub-content">
      <!-- Contact Number -->
      <div class="form-group">
        <label>Password</label>
        <b-input-group>
          <b-input type="password" v-model="user.data.password"></b-input>
        </b-input-group>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <b-input-group>
          <b-input type="password" v-model="user.data.confirm_password"></b-input>
        </b-input-group>
      </div>
      <div>
        <b-button class="font-weight-bold" block variant="primary">Update Password</b-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            	user: JSON.parse(localStorage.getItem("user")),
        };
    },
};
</script>

<style></style>
