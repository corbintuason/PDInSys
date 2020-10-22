<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<b-card>
					<template v-slot:header>
						{{current_step.name}}
						{{ rfp.receipts }}
					</template>
					<b-card-body>
						<table class="table table-sm">
							<thead>
								<tr>
									<th>VAT Registration</th>
									<th>Date</th>
									<th>Customer</th>
									<th>TIN #</th>
									<th>Address</th>
									<th>City</th>
									<th>Invoice</th>
									<th>Gross Amount</th>
									<th>VAT Exempt Sales</th>
									<th>VATable Sales</th>
									<th>VAT Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr
									v-for="(receipt, receipt_index) in rfp
										.closing_erfp.receipts"
									:key="receipt_index"
								>
									<td>
										<b-form-select size="sm" v-model="receipt.vat_registration" :disabled="rfp.closing_erfp.status == 'Closed'">
                                            <b-form-select-option v-for="(registration, registration_index) in registrations" :key="registration_index" :value="registration">
                                                {{registration}}
                                            </b-form-select-option>
                                        </b-form-select>
									</td>
									<td>
										<b-datepicker size="sm" v-model="receipt.date" :disabled="rfp.closing_erfp.status == 'Closed'"></b-datepicker>
									</td>
									<td>
										<b-input size="sm" v-model="receipt.customer" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" v-model="receipt.tin_no" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" v-model="receipt.address" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" v-model="receipt.city" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" v-model="receipt.invoice_no" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" type="number" v-model="receipt.gross_amount" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input size="sm" type="number" v-model="receipt.vat_exempt_sales" :disabled="rfp.closing_erfp.status == 'Closed'"></b-input>
									</td>
									<td>
										<b-input disabled type="number" :value="vatableSales(receipt)" size="sm"></b-input>
									</td>
									<td>
										<b-input disabled type="number" :value="vatAmount(receipt)" size="sm"></b-input>
									</td>

									<td v-if="receipt_index != 0">
										<b-button
                                            v-if="rfp.closing_erfp.status != 'Closed'"
											size="sm"
											@click="
												removeReceipt(receipt_index)
											"
											variant="outline-danger"
											><i class="far fa-trash-alt"></i
										></b-button>
									</td>
								</tr>
							</tbody>
						</table>
						<b-button
                                                                    v-if="rfp.closing_erfp.status != 'Closed'"
							@click="addReceipt"
							block
							variant="outline-primary"
							>Add Receipt</b-button
						>
					</b-card-body>
					<template v-slot:footer>
						<b-button
                            v-if="show_process_liquidation"
							@click="processLiquidation"
							class="float-right"
							variant="outline-success"
							>{{ current_step.action }}</b-button
						>
					</template>
				</b-card>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
	data() {
		return {
            registrations: ["Vat Registered", "Non-Vat Registered", "Not Registered"],
			statuses: [
				{
					name: "For Submission",
					action: "Submit",
					ability: "submit",
					color: "orange",
				},
				{
					name: "For Closing",
					action: "Close",
					ability: "close",
					color: "blue",
				},
				{
					name: "Closed",
				},
			],
		};
	},
	props: {
		namespace: String,
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
		}),
		show_process_liquidation() {
			if (
				this.rfp.closing_erfp.status != 'Closed'
			) {
				return true;
			} else return false;
		},
		current_step() {
			return this.statuses[
				this.statuses.findIndex(
					(status) => status.name == this.rfp.closing_erfp.status
				)
			];
		},
	},
	methods: {
        vatableSales(receipt){
            var vatable_sales = 0;
            if(receipt.vat_registration == 'Vat Registered'){
                vatable_sales = (receipt.gross_amount - receipt.vat_exempt_sales) / 1.12
            }
            return vatable_sales;
        },
        vatAmount(receipt){
            var vatable_sales = this.vatableSales(receipt);
            var vat_amount = 0;
            if(receipt.vat_registration == 'Vat Registered'){
                vat_amount = vatable_sales*.12;
            }
            return vat_amount;
        },
		addReceipt() {
			this.rfp.closing_erfp.receipts.push({
				vat_registration: null,
				date: null,
				customer: this.rfp.vendor.vendor_name,
				tin_no: this.rfp.vendor.tin_number,
				address: this.rfp.vendor.registered_address.first_address,
				city:  this.rfp.vendor.registered_address.city,
				invoice_no: null,
				gross_amount: null,
				vat_exempt_sales: null,
			});
		},
		removeReceipt(receipt_index) {
			this.rfp.closing_erfp.receipts.splice(receipt_index, 1);
		},
		processLiquidation() {
			swal.fire({
				title:
					this.current_step.action +
					" " +
					this.rfp.code +
					" " +
					" Liquidation Journal?",
				icon: "question",
				confirmButtonText: this.current_step.action,
				showLoaderOnConfirm: true,
				showCancelButton: true,
				cancelButtonColor: "#d33",
				allowOutsideClick: false,

				preConfirm: () => {
					return new Promise((resolve, reject) => {
						axios
							.put(
								"/api/closing_erfp/" + this.rfp.closing_erfp.id + "/saveChanges",
								this.rfp.closing_erfp
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
							app.$router.go();
						},
					});
				}
			});
		},
	},
};
</script>