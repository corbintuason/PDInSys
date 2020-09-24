<template>
	<div>
		<b-button
			@click="processERFPable"
			v-if="hasAbility"
			variant="outline-success"
			>{{ current_step.name }}</b-button
		>
		<!-- <show-process-buttons
                    :namespace="namespace"
                ></show-process-buttons> -->
	</div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";

export default {
	data() {
		return {};
	},
	props: {
		erfpable: Object,
		namespace: String,
	},
	computed: {
		...mapState({
			current_step(state, getters) {
				return getters[this.namespace + "/getCurrentStep"];
			},
		}),
		hasAbility(item) {
			return this.$store.getters["auth/hasAbility"](
				this.erfpable.current_handler,
				this.erfpable.id
			);
		},
	},
	methods: {
		processERFPable() {
			swal.fire({
				title: this.current_step.name +  " " + this.erfpable.code,
                icon: "question",
                text: "Are you sure you want to " + this.current_step.name + " " + this.erfpable.code +"?",
				confirmButtonText: "Review",
				showLoaderOnConfirm: true,
				showCancelButton: true,
				cancelButtonColor: "#d33",
				allowOutsideClick: false,
				preConfirm: () => {
					return new Promise((resolve, reject) => {
						axios
							.put(
								"/api/erfpable/" + this.erfpable.id,
								this.erfpable
							)
							.then((response) => {
								resolve(response.data);
							})
							.catch((e) => {
								//(e);
								swal.showValidationMessage(
									`Unable to process item`
								);
								swal.hideLoading();
								reject(e);
							});
					});
				},
			}).then((result) => {
				if (result.value) {
					swal.fire({
						title: result.value.success_text,
						icon: "success",
						onClose: () => {
						    this.$router.go();
						},
					});
				}
			});
		},
	},
	mounted() {
		console.log("current_handler", this.erfpable.current_handler);
	},
};
</script>