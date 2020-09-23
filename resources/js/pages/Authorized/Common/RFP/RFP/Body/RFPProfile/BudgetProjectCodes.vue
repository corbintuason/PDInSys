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
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(erfp_erfpable, erfp_erfpable_index) in rfp.erfpables" :key="erfp_erfpable_index">
						<td>
							<b-form-group>
								<b-input-group size="sm">
									<b-form-select v-if="mode =='Create'" @input="selectERFPable($event, erfp_erfpable)">
										<template v-slot:first>
											<b-form-select-option disabled :value="null">-- Please select a Project/Budget Code --</b-form-select-option>
										</template>
										<b-form-select-option
											v-for="(erfpable, erfpable_index) in erfpables"
											:key="erfpable_index"
											:value="erfpable"
										>{{erfpable.item}}</b-form-select-option>
									</b-form-select>
									<b-form-input v-else disabled :value="erfp_erfpable.erfpable.name"></b-form-input>
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
									<b-form-select
										v-if="mode=='Create'"
										:disabled="!erfp_erfpable.reviewers.length"
										v-model="erfp_erfpable.reviewer_id"
									>
										<b-form-select-option
											:value="reviewer.id"
											v-for="(reviewer, reviewer_index) in erfp_erfpable.reviewers"
											:key="reviewer_index"
										>{{reviewer.full_name}}</b-form-select-option>
										<!-- <b-form-select-option>First Code</b-form-select-option>
										<b-form-select-option>Second Code</b-form-select-option>-->
									</b-form-select>
									<template v-else>{{erfp_erfpable.id}}</template>
								</b-input-group>
							</b-form-group>
						</td>
						<td>{{erfp_erfpable.status}}</td>
						<td>
							<b-button @click="reviewERFPable(erfp_erfpable)" v-if="erfp_erfpable.status == 'For Review'" variant="outline-success">Review</b-button>
						</td>
						<td>
							<b-button
								variant="outline-danger"
								size="sm"
								v-if="erfp_erfpable_index && mode=='Create'"
								@click="removeItem(erfp_erfpable_index)"
							>
								<i class="far fa-trash-alt"></i>
							</b-button>
						</td>
					</tr>
				</tbody>
			</table>
			<b-button
				v-if="mode=='Create'"
				block
				variant="outline-primary"
				@click="addItem"
			>Add Budget Code / Project</b-button>
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
			mode(state) {
				return state[this.namespace].mode;
            },
		}),
		available_erfpables() {},
	},
	methods: {
        reviewERFPable(erfpable) {
             swal.fire({
                title: "Review ERFPable " + erfpable.name + "?",
                icon: "question",
                confirmButtonText: "Review",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/erfpable/" + erfpable.id, erfpable).then((response) => {
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
                            app.$router.push({
                                name: "rfp_show",
                                params: {
                                    id: result.value.item_id
                                },
                            });
                        },
                    });
                }
            });

        },
		...mapMutations({
			addItem(dispatch) {
				return dispatch(this.namespace + "/addItem");
			},
        }),
        // hasAbility(item){
        //     return this.$store.getters["auth/hasAbility"](item.current_handler, item.id);
        // },
		selectERFPable(erfpable, erfp_erfpable) {
			erfp_erfpable.erfpable_type = erfpable.erfpable_type;
			erfp_erfpable.item = erfpable.item;
			erfp_erfpable.erfpable_id = erfpable.erfpable_id;
			if (erfpable.erfpable_type == "App\\Project") {
				erfp_erfpable.reviewers = this.project_reviewers;
			} else if (erfpable.type == "Budget") {
			}
		},
		removeItem(index) {
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
						erfpable_type: "App\\Project",
						erfpable_id: project.id,
						item: project.code,
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