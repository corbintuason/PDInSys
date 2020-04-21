<template>
    <div>
        <admin-nav :user="user"></admin-nav>
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import adminNav from "../components/authorized/navigation/AdminNav";
export default {
    data() {
        return {
            user: this.$store.state.user,
        };
    },
    methods: {
        getUser() {
            this.$store
                .dispatch("storeUser")
                .then((response) => {
                  console.log("hi!!");
                  console.log(response);
                })
                .catch((e) => {
                    this.$Progress.fail();
                    //(e);
                });
        },
    },
    components: {
        "admin-nav": adminNav,
    },
    created(){
      this.getUser();
    },
};
</script>
