<template>
  <div>
    <h3>Edit User Information</h3>
    <div class="component-sub-content mt-4">
      <div class="form-group mt-4">
        <label>User Avatar</label>
        <b-input-group>
          <b-form-file v-model="user.data.official_photo"></b-form-file>
        </b-input-group>
      </div>

      <!-- Contact Number -->
      <div class="form-group mt-4">
        <label>Birthday</label>
        <b-input-group>
          <b-form-datepicker v-model="user.data.birth_date"></b-form-datepicker>
        </b-input-group>
      </div>

      <!-- Contact Number -->
      <div class="form-group mt-4">
        <label>Contact Number</label>
        <b-input-group>
          <b-input type="text" v-model="user.data.contact_numbers"></b-input>
        </b-input-group>
      </div>
      <div>
        <b-button class="font-weight-bold" block variant="primary">Update</b-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
			user: JSON.parse(localStorage.getItem("user")),
			official_photo: null
        };
	},
    methods: {
    onFileChange(e) {
      const file = e.target.files[0];
      this.user.data.official_photo = URL.createObjectURL(file);
    }
  }
};
</script>

<style lang="scss" scoped>

.official-photo {
  height: 90px;
  width: 90px;
  border: 2px solid #333;
  border-radius: 50px;
}
</style>
