<template>
	<div>
		<div class="text-center">
			<vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
		</div>
		<hr />
		<div class="component-sub-content mt-4 mb-4">
			<div class="row">
				<div class="col-md-6">
					<!-- BIR2303 -->
					<div class="row col-md-12">
						<div class="col-md-3 mt-1">
							<label for="bir-cert">BIR 2303:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="bir-cert" required></b-form-file>
						</div>
					</div>
					<!-- Billing Statement -->
					<div
						v-if="form.line_business == 'Services' || form.line_business == 'Both' || form.line_business == '' "
						class="row col-md-12 mt-4"
					>
						<div class="col-md-3 mt-1">
							<label for="billing-statement">Sample Billing Statement / Quotation:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="billing-statement"></b-form-file>
						</div>
					</div>
					<div
						v-if="form.line_business == 'Goods' || form.line_business == 'Both' || form.line_business == '' "
						class="row col-md-12 mt-3"
					>
						<div class="col-md-3 mt-1">
							<label for="invoice">Sample Sales Invoice:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="invoice" required></b-form-file>
						</div>
					</div>
					<div
						v-if="form.line_business == 'Goods' || form.line_business == 'Both' || form.line_business == '' "
						class="row col-md-12 mt-4"
					>
						<div class="col-md-3 mt-1">
							<label for="invoice">Sample Collection Receipt:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="invoice" required></b-form-file>
						</div>
					</div>
					<div
						v-if="form.line_business == 'Services' || form.line_business == 'Both' || form.line_business == '' "
						class="row col-md-12 mt-4"
					>
						<div class="col-md-3 mt-1">
							<label for="official-receipt">Sample Official Receipt:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="official-receipt" required></b-form-file>
						</div>
					</div>
				</div>
				<!-- DTI Certificate -->
				<div class="col-md-6">
					<div class="row col-md-12">
						<div class="col-md-3 mt-1">
							<label for="dti-cert">DTI Certificate:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="dti-cert"></b-form-file>
						</div>
					</div>
					<!-- SEC Certificate -->
					<div
						v-if="form.type_business == 'Corporation' || form.type_business == ''"
						class="row col-md-12 mt-4"
					>
						<div class="col-md-3 mt-1">
							<label for="sec-cert">SEC Certificate:</label>
						</div>
						<div class="col-md-8">
							<b-form-file id="sec-cert"></b-form-file>
						</div>
					</div>
					<!-- Other Attachment -->
					<div>
						<div
							class="row col-md-12 mt-4"
							v-for="(value, value_index) in form.other_attachments"
							:key="value_index"
						>
							<div class="col-md-3 mt-1">
								<label for="other-attachment">Other Attachment:</label>
							</div>
							<div class="col-md-8">
								<b-form-file v-model="form.other_attachments[value_index]" id="other-attachment"></b-form-file>
							</div>
							<div class="col-md-1">
								<b-button
									:disabled="value_index==0"
									@click="removeRow(form.other_attachments, value_index)"
									variant="outline-danger"
								>
									<i class="fas fa-trash"></i>
								</b-button>
							</div>
						</div>
						<div class="col-md-12 mt-3">
							<b-button @click="addRow(form.other_attachments)" variant="success" block>
								<i class="fas fa-plus"></i>
								<strong>Add Attachment</strong>
							</b-button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import vueStep from "vue-step";
export default {
	props: {
		form: Object
	},
	data() {
		return {
			nowStep: 4,
			stepList: ["", "", "", ""],	
			other_attachments: [""]
		};
	},
	components: {
		vueStep
	},
	methods: {
		addRow(model) {
            model.push([""]);
        },
        removeRow(model, index) {
            model.splice(index, 1);
        },
	},
};
</script>

<style></style>
