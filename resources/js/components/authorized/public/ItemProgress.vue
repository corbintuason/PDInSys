<template>
	<div>
		<b-card>
			<template v-slot:header>
				<h1 class="component-title">Progress Bar</h1>
			</template>
			<b-card-body>
				<div class="row">
					<div v-if="steps.length > 0" class="col-md-12">
						<step-progress
							:steps="steps"
							:current-step="current_step"
							icon-class="fa fa-check"
							active-color="green"
							passive-color="gray"
						></step-progress>
					</div>
				</div>
			</b-card-body>
			<template v-slot:footer>
				<b-button-group class="float-right" v-if="mode!='Create'">
					<b-button @click="showRemarksList" variant="secondary">Remarks List</b-button>
					<b-button variant="secondary" @click="showContributionList">Contribution List</b-button>
				</b-button-group>
			</template>
		</b-card>

		<div v-if="mode != 'Create'">
			<b-modal id="contribution-list" size="xl" hide-footer>
				<template v-slot:modal-header>Contribution List</template>
				<contribution-list :front_steps="front_steps" :contributors="contributors"></contribution-list>
			</b-modal>
			<remarks-list :remarks="remarks"></remarks-list>
		</div>
	</div>
</template>

<script>
import contributionList from "./ContributionList";
import remarksList from "./RemarksList";

export default {
    data() {
        return {
            steps: [],
            current_step: null,
        };
    },
    props: {
        front_steps: Array,
        db_steps: Array,
        mode: String,
        item: Object,
        contributors: Array,
        api_link: String,
        remarks: Array
    },
    components: {
        "contribution-list": contributionList,
        "remarks-list": remarksList
    },
    methods: {
        loadSteps() {
            this.front_steps.forEach((front_step) => {
                this.steps.push(front_step.name);
            });
            this.getCurrentStep();
        },
        showContributionList() {
            this.$bvModal.show("contribution-list");
        },
        showRemarksList() {
            console.log("awit gaming ah");
            this.$bvModal.show("remarks-list");
        },
        getCurrentStep() {
            console.log("asdf");
            if (this.mode != "Create") {
                var status_index = this.db_steps.indexOf(this.item.status) + 1;
                this.current_step = status_index;
            } else {
                this.current_step = 0;
            }
        },
    },
    mounted() {
        this.loadSteps();
    },
};
</script>

<style>
</style>
