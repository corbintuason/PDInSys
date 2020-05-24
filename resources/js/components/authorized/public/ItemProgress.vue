<template>
<<<<<<< HEAD
	<div>
		<b-card>
			<template v-slot:header>
				<div class="row">
					<div class="col-md-6 text-left">
						<h1 class="component-title mt-2">{{progress_bar_header}} {{current_step}}</h1>
					</div>
					<div class="col-md-6 text-right">
						<b-button-group class="float-right" v-if="mode!='Create'">
							<b-button @click="changeShowRemarksModal(true)" variant="outline-secondary">Remarks List</b-button>
							<b-button variant="outline-secondary" @click="showContributionList">Contribution List</b-button>
						</b-button-group>
					</div>
				</div>
			</template>
			<b-card-body>
				<div class="row">
=======
    <div>
        <b-card>
            <template v-slot:header>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h1 class="component-title mt-2">
                            {{ progress_bar_header }}
                        </h1>
                    </div>
                    <div class="col-md-6 text-right">
                        <b-button-group
                            class="float-right"
                            v-if="mode != 'Create'"
                        >
                            <b-button
                                @click="changeShowRemarksModal(true)"
                                variant="outline-secondary"
                                >Remarks List</b-button
                            >
                            <b-button
                                variant="outline-secondary"
                                @click="showContributionList"
                                >Contribution List</b-button
                            >
                        </b-button-group>
                    </div>
                </div>
            </template>
            <b-card-body>
                <div class="row">
>>>>>>> 7430445ef78c82686c18b833a3a9982fdd14e1af
                    <!-- If Item is null, Render Step Progress -->
                    <div v-if="renderStepProgress" class="col-md-12">
                        <step-progress
                            v-if="progress_steps.length > 0"
                            :steps="progress_steps"
                            :current-step="current_step"
                            icon-class="fa fa-check"
                            active-color="green"
                            passive-color="gray"
                        ></step-progress>
                    </div>
                    <b-alert v-else class="col-md-12" show variant="danger">
                        <strong> This item has been rejected.</strong>
                    </b-alert>
                </div>
            </b-card-body>
            <template v-slot:footer></template>
        </b-card>

        <div v-if="mode != 'Create'">
            <b-modal id="contribution-list" size="xl" hide-footer>
                <template v-slot:modal-header>Contribution List</template>
                <contribution-list
                    :steps="steps"
                    :contributors="item.contributors"
                ></contribution-list>
            </b-modal>
            <remarks-list :namespace="namespace"></remarks-list>
        </div>
    </div>
</template>

<script>
import contributionList from "./ContributionList";
import remarksList from "./RemarksList";
import steps from "../../../mixins/steps";
import { mapMutations, mapState } from "vuex";
export default {
    data() {
        return {
            progress_steps: [],
            current_step: null,
        };
    },
    props: {
        namespace: String,
    },
    mixins: [steps],
    components: {
        "contribution-list": contributionList,
        "remarks-list": remarksList,
    },
    computed: {
        ...mapState({
            item(state) {
                return state[this.namespace].item;
            },
            mode(state) {
                return state[this.namespace].mode;
            },
            steps(state) {
                return state[this.namespace].steps;
            },
        }),
<<<<<<< HEAD
        progress_bar_header(){
            return (this.item!=null) ? this.item.code : "Progress Bar";
=======
        progress_bar_header() {
            return this.item != null ? this.item.code : "Progress Bar";
>>>>>>> 7430445ef78c82686c18b833a3a9982fdd14e1af
        },
        renderStepProgress() {
            if (this.item != null) {
                if (this.item.status != "Rejected") {
                    return true;
                } else {
                    return false;
                }
<<<<<<< HEAD
            } return true;
        }
=======
            }
            return true;
        },
>>>>>>> 7430445ef78c82686c18b833a3a9982fdd14e1af
    },
    methods: {
        ...mapMutations({
            changeShowRemarksModal(commit, payload) {
                console.log(
                    "not working?",
                    this.$store.state[this.namespace].show_remarks_modal
                );
                return commit(
                    this.namespace + "/changeShowRemarksModal",
                    payload
                );
            },
        }),
        loadSteps() {
            this.steps.forEach((step) => {
                console.log("vibe check", step);
                this.progress_steps.push(step.name);
            });
            if (this.mode != "Create") {
                var current_step = this.getCurrentStep(this.item, this.steps);
                if (current_step != null) {
                    var status_index = this.progress_steps.indexOf(
                        current_step.name
                    );
                    this.current_step = status_index;
                } else {
                    this.current_step = this.progress_steps.length;
                }
            } else {
                this.current_step = 0;
            }
        },
        showContributionList() {
            this.$bvModal.show("contribution-list");
        },
        showRemarksList() {
            this.$bvModal.show("remarks-list");
        },
    },
    mounted() {
        console.log("did i receive the space", this.namespace);
        this.loadSteps();
    },
};
</script>

<style></style>
