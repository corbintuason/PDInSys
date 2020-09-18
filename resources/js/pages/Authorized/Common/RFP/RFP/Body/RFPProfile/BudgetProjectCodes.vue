<template>
	<div>
		<div class="row">
			<label>Select Budget Codes / Projects</label>
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Budget Code / Project Name</th>
						<th>CEPD</th>
						<th>Version</th>
						<th>Reviewer</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(erfp_erfpable, erfp_erfpable_index) in rfp.erfpables" :key="erfp_erfpable_index">
						<td>
							<b-form-group>
								<b-input-group size="sm">
									<b-form-select @input="selectERFPable($event, erfp_erfpable)">
										<template v-slot:first>
											<b-form-select-option disabled :value="null">-- Please select a Project/Budget Code --</b-form-select-option>
										</template>
										<b-form-select-option
											v-for="(erfpable, erfpable_index) in erfpables"
											:key="erfpable_index"
											:value="erfpable"
										>{{erfpable.item}}</b-form-select-option>
									</b-form-select>
								</b-input-group>
							</b-form-group>
						</td>
						<td>
							<!-- CEPD -->
							<b-form-group>
								<b-input-group size="sm">
									<b-form-input disabled></b-form-input>
								</b-input-group>
							</b-form-group>
						</td>
						<td>
							<!-- Version -->
							<b-form-group>
								<b-input-group size="sm">
									<b-form-input disabled></b-form-input>
								</b-input-group>
							</b-form-group>
						</td>
						<td>
							<b-form-group>
								<b-input-group size="sm">
									<b-form-select :disabled="!erfp_erfpable.reviewers.length">
                                        <b-form-select-option :value="reviewer.id" v-for="(reviewer, reviewer_index) in erfp_erfpable.reviewers" :key="reviewer_index">
                                            {{reviewer.full_name}}
                                        </b-form-select-option>
										<!-- <b-form-select-option>First Code</b-form-select-option>
										<b-form-select-option>Second Code</b-form-select-option>-->
									</b-form-select>
								</b-input-group>
							</b-form-group>
						</td>
                        <td>
                            <b-button variant="outline-danger" size="sm" v-if="erfp_erfpable_index" @click="removeItem(erfp_erfpable_index)"><i class="far fa-trash-alt"></i></b-button>
                        </td>
					</tr>
				</tbody>
			</table>
			<b-button block variant="outline-primary" @click="addItem">Add Budget Code / Project</b-button>
		</div>
	</div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
export default {
	data() {
		return {
			project_reviewers: null,
			budget_reviewers: null,
			erfpables: [],
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
        available_erfpables(){
            
        }
	},
	methods: {
		...mapMutations({
			addItem(dispatch) {
				return dispatch(this.namespace + "/addItem");
			},
		}),
		selectERFPable(erfpable, erfp_erfpable) {
            erfp_erfpable.type = erfpable.type;
            erfp_erfpable.item = erfpable.item;
			if (erfpable.type == "Project") {
                erfp_erfpable.reviewers = this.project_reviewers;
			} else if (erfpable.type == "Budget") {
			}
        },
        removeItem(index){
            this.rfp.erfpables.splice(index, 1);
        },
		getReviewers() {},
		loadProjectReviewers() {
			axios
				.get("/api/user", {
					params: {
						positions: [
							"Sales and Operations Director",
							"Project Execution Head",
						],
					},
				})
				.then(
					(response) => (this.project_reviewers = response.data.data)
				);
		},
		loadBudgetReviewers() {},

		loadERFPAbles() {
			// Create Array
			//Load Projects First
			axios.get("/api/project").then((response) => {
				response.data.data.forEach((project) => {
					this.erfpables.push({
						type: "Project",
						item: project.code,
						id: project.id,
					});
				});
			});
		},
	},
	mounted() {
		this.loadProjectReviewers();
		this.loadBudgetReviewers();
		this.loadERFPAbles();
	},
};
</script>