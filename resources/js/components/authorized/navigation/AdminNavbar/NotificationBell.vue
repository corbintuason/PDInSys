<template>
	<li class="nav-item dropdown">
		<a @click="markAsRead" class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="far fa-bell" style="font-size: 24px;"></i>
			<span
				v-if="unread_notifications.length > 0"
				class="badge navbar-badge notification-badge"
				style="font-size: 12px;"
			>
				<strong>{{ unread_notifications.length }}</strong>
			</span>
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<span class="dropdown-item dropdown-header">Notifications</span>

			<div v-for="(notification, notification_index) in notifications" :key="notification_index">
				<router-link
					:to="{
                        name: notification.data.link.name,
                        params: { id: notification.data.link.id },
                    }"
				>
					<template v-if="notification_index <= 5">
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							{{ notification.data.notification_bell.header }}
							<div>
								<i class="fas fa-envelope mr-2"></i>
								<a class="float-right text-sm">{{ notification.data.notification_bell.body }}</a>
							</div>
							<span class="float-right text-muted text-sm">
								{{
								notification.created_at
								}}
							</span>
							<hr />
						</a>
					</template>
				</router-link>
			</div>

			<router-link
				:to="{ name: 'Notifications' }"
				class="dropdown-item dropdown-footer"
			>See All Notifications</router-link>
		</div>
	</li>
</template>

<script>
import {mapState, mapMutations, mapActions} from "vuex";
export default {
	data() {
		return {
		};
	},
	computed: {
		...mapState("auth",{
			user(state){
				console.log("Checkign for the state", state);
				return state.user;
			},
			notifications(state){
				return state.user.notifications
			},
			unread_notifications(state, getters){
				return getters.unread_notifications;
			}
		}),
	},
	methods: {
		    ...mapActions("auth", {
            markAsRead(dispatch, payload) {
                return dispatch("markAsRead");
            },
        }),
		// markAsRead() {
		// 	console.log("ilang beses to lalabas");
		// 	axios.get("/mark-all-read/").then(response => {
		// 		this.all_notifications = response.data.notifications;
		// 	});
		// },


		activateNotificationSound() {
			var audio = new Audio(
				"../../../../../../public/sound/notification.mp3"
			);
			audio.muted = true;
			audio.play();
		},

		echoNotifications() {
			// Call Echo to listen to notifications
			Echo.private("users." + this.user.data.id).notification(
				notification => {
					// Push New Notification
					this.all_notifications.unshift(notification.notification);

					// Activate Notification
					this.activateNotification(notification);

					// Activate Sound
					this.activateNotificationSound();
				}
			);
		}
	},
	created() {
		// this.all_notifications = this.user.notifications;
		// this.echoNotifications();
	}
};
</script>

<style lang="scss" scoped>
.notification-badge {
	background: rgba(248, 147, 38, 0.8);
	margin-left: 10px;
}
</style>
