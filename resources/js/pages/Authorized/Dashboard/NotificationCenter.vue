<template>
	<b-card
		class="text-center notification-card"
		header-bg-variant="primary"
		header-text-variant="white"
	>
		<template v-slot:header>
			<h1 class="component-title">Notification Center</h1>
		</template>
		<b-card-text>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>Code</th>
								<th>Item</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr
								v-for="(notification,
                                notification_index) in notifications"
								:key="notification_index"
							>
								<td>
									<router-link
										:to="{
                        name: notification.data.link.name,
                        params: { id: notification.data.link.id },
                    }"
									>
										{{
										notification.data.notification_table.code
										}}
										<!-- CEPD20-0009.1v1/.2v1/ LACTUM_FBLIVE -->
									</router-link>
								</td>
								<td>
									{{
									notification.data.notification_table
									.item
									}}
									<!-- Project Creation -->
								</td>
								<td>
									{{
									notification.data.notification_table
									.status
									}}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</b-card-text>
	</b-card>
</template>

<script>
import {mapState} from "vuex"
export default {
    data() {
        return {
        };
    },

	computed:{
		...mapState("auth", {
			user(state){
				return state.user;
			},
			notifications(state){
				return state.user.notifications
			}
		})
	},
    methods: {
   
    },
    mounted() {
    },
};
</script>

<style lang="scss" scoped>
.notification-card {
	border-radius: 10px;
	box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
	transition: all 0.2s ease-out;

	&:hover {
		transform: translateY(4px);
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
	}
}
</style>
