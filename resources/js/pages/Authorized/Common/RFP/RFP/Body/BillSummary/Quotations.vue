<template>
	<b-alert show variant="success">
		<strong>Updated Quotation:</strong>
		<a href="#" @click="downloadQuotation(rfp.quotation_file)" style="color:black">{{
			rfp.quotation_file
		}}</a>
		<!-- <label>Quotation</label>

		<div class="row">
			<div class="col-md-12" v-if="mode == 'Create'">
				<b-form-file
					accept=".pdf"
					v-model="rfp.quotation"
					:state="rfp.quotation != null"
					placeholder="Choose a file or Quotation it here..."
					drop-placeholder="Drop file here..."
				></b-form-file>
			</div>

			<table v-else-if="mode == 'Show'" class="table table-sm">
				<thead>
					<tr>
						<th>File Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<a
								href="#"
								@click="downloadQuotation(rfp.quotation_file)"
								>{{ rfp.quotation_file }}</a
							>
						</td>
						<td>
							<b-form-file
								accept=".pdf"
								v-model="rfp.quotation"
								placeholder="Choose a file or Quotation it here..."
								drop-placeholder="Drop file here..."
							></b-form-file>
						</td>
					</tr>
				</tbody>
			</table>
		</div> -->
	</b-alert>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";

export default {
	data() {
		return {};
	},
	props: {
		namespace: String,
	},
	computed: {
		...mapState({
			mode(state) {
				return state[this.namespace].mode;
			},
			rfp(state) {
				return state[this.namespace].item;
			},
		}),
	},
	methods: {
		downloadQuotation(quotation) {
			var request = {
				path: quotation,
			};
			axios({
				method: "post",
				url: "/api/erfp/downloadQuotation",
				responseType: "arraybuffer",
				data: request,
			}).then((response) => {
				let blob = new Blob([response.data], {
					type: "application/pdf",
				});
				let link = document.createElement("a");
				link.href = window.URL.createObjectURL(blob);
				console.log(response);
				link.download = this.rfp.quotation_file;
				link.click();
			});
		},
	},
};
</script>