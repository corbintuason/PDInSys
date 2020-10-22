<template>
	<div v-if="cash_release != null">
		<!-- Cash Release -->

		<b-card
			border-variant="primary"
			header-text-variant="white"
			header-class="font-weight-bold"
			header-bg-variant="primary"
		>
			<template v-slot:header>
				{{ payment.payment }}
			</template>
			<label>Cash Release Checklist</label>
			<table class="table table-sm">
				<thead>
					<tr>
						<th></th>
						<th v-if="payment.status == 'For Releasing'">
							Thru
						</th>
						<th>BDO Ref. No</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Online Release</td>
						<td v-if="payment.status == 'For Releasing'">
							<b-form-select
								v-if="accounts_payable_officers != null"
								v-model="cash_release.thru"
								:disabled="disableForm"
							>
								<b-form-select-option
									v-for="(officer,
									officer_index) in accounts_payable_officers"
									:key="officer_index"
									:value="officer.id"
								>
									{{ officer.full_name }}
								</b-form-select-option>
							</b-form-select>
						</td>
						<td>
							<b-form-input
								:disabled="disableForm"
								v-model="cash_release.ref_no"
							></b-form-input>
						</td>
						<td>
							<!-- {{ term_of_payment.status }} -->
							{{ payment.status }}
						</td>
						<td>
							<!-- <b-button
								variant="outline-primary"
								v-if="hasAbility"
								@click="releaseCashClick"
								>{{ current_step.action }}</b-button
							> -->
							<!-- Date and Time when it was released -->
						</td>
					</tr>
				</tbody>
			</table>

			<!--  -->
			<history-log :payment="payment"></history-log>

			<!-- File -->
			<template v-slot:footer>
				<div class="proof-of-payment float-left">
					<strong>Proof Of Payment: </strong> <a href="#" @click.prevent="downloadPayment">{{file_name}}</a>
				</div>

				<b-button
					class="float-right"
					variant="outline-success"
					@click="processCash"
					v-if="!disableForm"
					>{{ current_step.action }}</b-button
				>
			</template>
		</b-card>
	</div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
// import bouncer from "../../../../../../../../mixins/bouncer"
import historyLog from "./HistoryLog";
export default {
	data() {
		return {
			accounts_payable_officers: null,
			cash_release: null,
			has_ability: null,
		};
	},
	components: {
		"history-log": historyLog,
	},
	props: {
		payment: Object,
		namespace: String,
		statuses: Array,
	},
	// mixins:[bouncer],
	computed: {
		file_name(){
			if(!this.payment.file_name){
				return "No File Found"
			}else{
				return this.payment.file_name;
			}
		},
		disableForm() {
			if (!this.has_ability || this.rfp.status =='Closed' || this.payment.status =='Acknowledged') {
				return true;
			} else return false;
		},
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
			term_of_payment() {
				if (this.payment.payment == "Down Payment") {
					return this.rfp.term_of_payment.down_payment;
				} else {
					return this.rfp.term_of_payment.full_payment;
				}
			},

			current_step() {
				return this.statuses[
					this.statuses.findIndex(
						(status) => status.name == this.payment.status
					)
				];
			},
			next_step() {
				return this.statuses[
					this.statuses.findIndex(
						(status) => status.name == this.payment.status
					) + 1
				];
			},
		}),
	},
	methods: {
				downloadPayment() {
			var request = {
				path: this.payment.file_name,
			};
			axios({
				method: "post",
				url: "/api/term_of_payment/downloadPayment",
				responseType: "arraybuffer",
				data: request,
			}).then(response => {
				let blob = new Blob([response.data], {
					type: "application/pdf",
				});
				let link = document.createElement("a");
				link.href = window.URL.createObjectURL(blob);
				console.log(response);
				link.download = this.payment.file_name;
				link.click();
			});
		},
		releaseCashClick() {
			if (this.term_of_payment.status == "For Releasing") {
				this.releaseCash();
			} else {
				this.processCash();
			}
		},
		loadCashRelease() {
			this.cash_release = {
				thru: null,
				ref_no: this.payment.ref_no,
				file: null,
			};
		},
		processCash(){
			if(this.payment.status == 'For Releasing'){
				this.releaseCash();
			}else{
				this.processCashFile();
			}
		},
	releaseCash() {
		 swal
				.fire({
					title:
						this.current_step.action +
						" " +
						this.rfp.code +
						" " +
						this.payment.payment +
						"?",
					icon: "question",
					confirmButtonText: this.current_step.action,
					showLoaderOnConfirm: true,
					showCancelButton: true,
					cancelButtonColor: "#d33",
					allowOutsideClick: false,
					preConfirm: (file) => {
						return new Promise((resolve, reject) => {
							axios
								.post(
									"/api/term_of_payment/" +
										this.payment.id +
										"/cashRelease",
									this.cash_release
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
				})
				.then((result) => {
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
		async processCashFile() {
			await swal
				.fire({
					title:
						this.current_step.action +
						" " +
						this.rfp.code +
						" " +
						this.payment.payment +
						"?",
					icon: "question",
					confirmButtonText: this.current_step.action,
					showLoaderOnConfirm: true,
					showCancelButton: true,
					cancelButtonColor: "#d33",
					input: 'file',
					inputAttributes: {
						accept: '.pdf',
					},
					allowOutsideClick: false,
					preConfirm: (file) => {
						return new Promise((resolve, reject) => {
							this.cash_release.file = file;
							const formData = new FormData();

							Object.keys(this.cash_release).forEach((key) => {
								if (key == "file") {
									console.log("hi it's file");
									if(this.cash_release.file !=null){
										console.log("So may laman???");
										console.log(this.cash_release.file);
											var file_name = "test";
										formData.append(
										"file",
										this.cash_release.file,
										file_name
									);
									}else {
										console.log("hi it's file.. file is null");
										formData.append('file', null);
									}
								
								} else {
									formData.append(
										key,
										this.cash_release[key]
									);
								}
							});
							axios
								.post(
									"/api/term_of_payment/" +
										this.payment.id +
										"/cashRelease",
									formData
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
				})
				.then((result) => {
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

		// async processCash(swal_object) {
		//     const { value: file } = await swal.fire({
		// 		title:
		// 			this.current_step.action +
		// 			" " +
		// 			this.rfp.code +
		// 			"'s " +
		// 			this.payment +
		// 			"?",
		// 		icon: "question",
		// 		confirmButtonText: this.current_step.action,
		// 		showLoaderOnConfirm: true,
		// 		showCancelButton: true,
		// 		cancelButtonColor: "#d33",
		// 		allowOutsideClick: false,

		//         input: "file",
		//         inputAttributes: {
		//             accept: ".pdf",
		//         },
		//        			preConfirm: (file) => {
		// 			return new Promise((resolve, reject) => {
		// 				axios
		// 					.put("/api/erfp/" + this.rfp.id + "/releaseCash", this.cash_release)
		// 					.then((response) => {
		// 						resolve(response.data);
		// 					})
		// 					.catch((e) => {
		// 						//(e);
		// 						swal.showValidationMessage(
		// 							`Unable to process item`
		// 						);
		// 						swal.hideLoading();
		// 						reject(e);
		// 					});
		// 			});
		// 		},

		//     }).then((result) => {
		//         if (result.value) {
		//             console.log(result);
		//             swal.fire({
		//                 title: result.value.success_text,
		//                 icon: "success",
		//                 onClose: () => {
		//                    this.$router.go();

		//                 },
		//             });
		//         }
		//     });

		// },
		loadAccountsPayableOfficers() {
			axios
				.get("/api/user", {
					params: {
						positions: ["Accounts Payable Officer"],
					},
				})
				.then((response) => {
					this.accounts_payable_officers = response.data.data;
				});
		},
		loadHasAbility() {
			axios
				.put("/api/bouncer/hasAbility", {
					ability: this.current_step.ability,
					model: "App\\TermOfPayment",
					model_id: this.payment.id,
				})
				.then((response) => {
					console.log("response?");
					console.log(response.data.value);
					this.has_ability = response.data.value;
					console.log(this.has_ability);
				});
		},
	},
	mounted() {
		this.loadAccountsPayableOfficers();
		this.loadCashRelease();
		this.loadHasAbility();
	},
};
</script>
