<template>
    <li class="nav-item dropdown mr-4">
        <b-nav-item-dropdown
            class="font-weight-bold"
            :text="user.data.full_name"
            right
        >
            <b-dropdown-item>
                <router-link to="/user-profile">
                    <p>My Profile</p>
                </router-link>
            </b-dropdown-item>
            <b-dropdown-item>
                <a href="#" @click="logOut">
                    <p>Logout</p>
                </a>
            </b-dropdown-item>
        </b-nav-item-dropdown>
    </li>
</template>

<script>
import {mapState} from "vuex";
export default {
    data() {
        return {
        };
    },
    computed:{
            ...mapState("auth", {
            user(state){
                return state.user;
            }
        })
    },
    methods: {
        logOut() {
            this.$Progress.start();
            this.$store.dispatch("auth/destroyToken").then((response) => {
                this.$Progress.finish();
                this.$router.push({ name: "Welcome" });
            });
        },
    },
};
</script>
