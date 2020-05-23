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
import {mapState, mapActions, mapMutations} from "vuex"
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
    components: {
        "admin-nav": adminNav,
    },
    methods: {
        ...mapMutations("auth", {
            pushNotification(commit, payload){
                return commit("pushNotification", payload);
            }
        }),
        ...mapActions("auth", {
            storeUser(dispatch, payload){
                return dispatch("storeUser");
            }
        }),
        	activateNotification(notification) {
			this.$notify({
				group: "PDIS",
				title: notification.notification.data.notification_bell.header,
				text: "123",
				type: "warn"
			});
		},
		echoNotifications() {
			// Call Echo to listen to notifications
			Echo.private("users." + this.user.data.id).notification(
				notification => {
                    // Push New Notification
                    // this.pushNotification(notification.notification);
                    this.storeUser();
					// this.all_notifications.unshift(notification.notification);

					// Activate Notification
					this.activateNotification(notification);

					// Activate Sound
					// this.activateNotificationSound();
				}
			);
		}
    },
    mounted() {
        this.echoNotifications();
    },
};
</script>
