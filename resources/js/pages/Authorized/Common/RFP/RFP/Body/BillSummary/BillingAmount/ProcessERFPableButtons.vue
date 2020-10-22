<template>
	<b-button-group v-if="has_ability">
		<b-button
			@click="processERFPable"
			v-if="has_ability"
			variant="outline-danger"
			>Reject</b-button
		>
		<b-button
			@click="processERFPable"
			v-if="has_ability"
			variant="outline-secondary"
			>Return</b-button
		>

		<b-button
			@click="processERFPable"
			v-if="has_ability"
			variant="outline-success"
			>{{ current_step }}</b-button
		>
	</b-button-group>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";

export default {
	data() {
		return {
			has_ability: null,
		};
	},
	props: {
		erfpable: Object,
		namespace: String,
	},
	computed: {
		// show_process_buttons(){
		// 	return false;
		// },
		current_step() {
			if (this.erfpable.status == "For Review") {
				return "Review";
			} else if (this.erfpable.status == "For ERFP Approval") {
				return "ERFP Approve";
			} else {
				return "k";
			}
		},
	},
	methods: {
		loadHasAbility() {
			console.log("Hi im checking ability");
			console.log(this.erfpable.current_handler);
						if(this.erfpable.status != 'ERFP Approved'){
						axios
				.put("/api/bouncer/hasAbility", {
					ability: this.erfpable.current_handler.ability,
					model: "App\\ERFPable",
					model_id: this.erfpable.id,
				})
				.then((response) => {
					console.log("response?");
					console.log(response.data.value);
					this.has_ability = response.data.value;
					console.log(this.has_ability);
				});
			}else{
				this.has_ability = false;
			}
	
		},
		processERFPable() {
			swal.fire({
				title: this.current_step + " " + this.erfpable.code,
				icon: "question",
				text:
					"Are you sure you want to " +
					this.current_step +
					" " +
					this.erfpable.code +
					"?",
				confirmButtonText: this.current_step,
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
		this.loadHasAbility();
	},
};
</script>