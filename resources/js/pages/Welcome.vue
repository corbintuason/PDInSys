<template>
    <!-- <div>
    <header>
      <public-navbar> </public-navbar>
    </header>
    <div class="row justify-content-center" style="margin-top:10px;">
      <div class="col-12">
      </div>
    </div>
  </div> -->
    <div>
        <div class="tile is-parent">
            <div class="tile is-parent is-4">
                <b-card header-tag="header" footer-tag="footer" class="card">
                    <template v-slot:header>
                        <h4 class="mb-0">
                            Welcome to Project Duo Information System
                        </h4>
                    </template>
                    <b-form>
                        <b-form-group
                            label="Email address:"
                            label-for="input-1"
                        >
                            <b-form-input
                                type="email"
                                required
                                placeholder="Enter email"
                            ></b-form-input>
                        </b-form-group>

                        <b-form-group label="Password:" label-for="input-2">
                            <b-form-input
                                type="password"
                                required
                                placeholder="Enter Password"
                            ></b-form-input>
                        </b-form-group>
                    </b-form>

                    <div class="row">
                        <div class="col-md-8">
                            <b-form-checkbox class="mb-2 mr-sm-2 mb-sm-0"
                                >Remember me</b-form-checkbox
                            >
                        </div>
                        <div class="col-md-4 text-right">
                            <b-link href="#foo">Forgot Password?</b-link>
                        </div>
                    </div>

                    <template v-slot:footer>
                        <b-button block href="#" variant="primary"
                            >Login</b-button
                        >
                    </template>
                </b-card>
            </div>
        </div>

        <vue-particles id="particles-js"> </vue-particles>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    computed: {},
    methods: {},
    mounted() {}
};
</script>

<style lang="scss" scoped>
* {
    box-sizing: border-box;
}
.card {
    border-radius: 10px;
}
.tile {
    position: relative;
    height: 100vh;
    display: flex;
    z-index: 999;

    .is-4 {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
}
#particles-js {
    background: #3f4b94;
    background-size: cover;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
