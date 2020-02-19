  
<template>
  <div>
    <b-navbar toggleable="lg" type="dark" style="background-color:#FF8728" fixed="top">
      <b-navbar-brand>
        <router-link :to="{ name: 'Welcome'}" style="color:white; background-color:#FF8728">
          <img :src="'../storage/img/PROJECTDUO_ExtendedLogo.png'" style="height:50px; color:white" />
        </router-link>
      </b-navbar-brand>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item>
            <b-form inline>
              <b-input id="inline-form-input-name" class="mb-2 mr-sm-2 mb-sm-0" placeholder="Email" v-model="pdem_email"></b-input>
              <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
                <b-input id="inline-form-input-username" placeholder="Password" type="password" v-model="password"></b-input>
              </b-input-group>

              <b-button variant="outline-light" @click="login">
                <i class="fas fa-hand-holding-heart"></i> Login
              </b-button>
<!-- 
              <b-button variant="outline-light" @click="logout">
                <i class="fas fa-hand-holding-heart"></i> Logout
              </b-button> -->
            </b-form>
          </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
      {{pdem_email}}
    </b-navbar>
  </div>
</template>


<script>
export default {
  name: "navbar",
  data() {
    return {
      pdem_email: null,
      password: null
    };
  },
  methods: {
    login() {
      this.$store.dispatch('retrieveToken', {
        pdem_email: this.pdem_email,
        password: this.password
      }).then(response => {
        this.$router.push({ name: "Dashboard"});
      })
    },

    logout() {
    }
  },
  mounted() {
  }
};
</script>