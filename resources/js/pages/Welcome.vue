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
                <div class="card row card-holder">
                    <div class="col-md-6 left-side-login">
                        <!-- <b-card class="image-login-holder"> -->
                        <img
                            class="image-login"
                            src="/img/login/login.png"
                            width="400"
                            height="230"
                        />
                        <!-- </b-card> -->
                    </div>

                    <div class="col-md-6 right-side-login">
                        <div class="header-login">
                            <h3 class="font-weight-bold">Login</h3>
                        </div>

                        <div class="sub-header-login">
                            <h6 class="font-italic">
                                Welcome to Project Duo Information System
                            </h6>
                        </div>

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
                            <div class="col-md-6">
                                <b-form-checkbox class="mb-2 mr-sm-2 mb-sm-0"
                                    >Remember me</b-form-checkbox
                                >
                            </div>
                            <div class="col-md-6 text-right">
                                <b-link href="#foo">Forgot Password?</b-link>
                            </div>
                        </div>

                        <div class="button-login">
                            <b-button block variant="primary font-weight-bold"
                                >Login</b-button
                            >
                        </div>
                    </div>
                    <!-- card card-holder div -->
                </div>
                <!-- tile div -->
            </div>
        </div>
        <!-- vue particles -->
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
    font-family: "Lato";
}
.card {
    border-radius: 10px;
    box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.19) !important;
    transition: all 0.2s ease-out;

    &:hover {
        transform: translateY(4px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.08) !important;
    }
}
.card-holder {
    width: 930px;
    height: 450px;
    // background: #eff2f7;
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
    .left-side-login {
        background: #eff2f7;
        padding-bottom: 118px;
        padding-left: 20px;
        border-radius: 10px 0 0 10px;
    }
    .right-side-login {
        padding-top: 30px;
    }
    .header-login {
        margin-bottom: 15px;
    }
    .sub-header-login {
        margin-bottom: 40px;
    }
    .image-login {
        margin-top: 100px;
    }
    .button-login {
        margin-top: 55px;
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
