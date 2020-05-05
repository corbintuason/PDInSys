<template>
	<div>
		<b-card>
			<template v-slot:header>
				<h1 class="component-title">{{progress_bar_header}}</h1>
			</template>
			<b-card-body>
				<div class="row">
					<div v-if="steps.length > 0" class="col-md-12">
						<step-progress
							v-if="progress_steps.length > 0"
							:steps="progress_steps"
							:current-step="current_step"
							icon-class="fa fa-check"
						></step-progress>
					</div>
				</div>
			</b-card-body>
			<template v-slot:footer>
				<b-button-group class="float-right" v-if="mode!='Create'">
					<b-button @click="showRemarksList" variant="outline-secondary">Remarks List</b-button>
					<b-button variant="outline-secondary" @click="showContributionList">Contribution List</b-button>
				</b-button-group>
			</template>
		</b-card>

		<div v-if="mode != 'Create'">
			<b-modal id="contribution-list" size="xl" hide-footer>
				<template v-slot:modal-header>Contribution List</template>
				<contribution-list :steps="steps" :contributors="item.relationships.contributors"></contribution-list>
			</b-modal>
			<remarks-list :remarks="item.relationships.remarks"></remarks-list>
		</div>
	</div>
</template>

<script>
import contributionList from "./ContributionList";
import remarksList from "./RemarksList";
import steps from "../../../mixins/steps"
export default {
    data() {
        return {
            progress_steps: [],
            current_step: null,
        };
    },
    props: {
        steps: Array,
        mode: String,
        item: Object,
    },
    mixins:[steps],
    components: {
        "contribution-list": contributionList,
        "remarks-list": remarksList
    },
    computed:{
        progress_bar_header(){
            return (this.item!=null) ? this.item.code : "Progress Bar";
        }
    },
    methods: {
        loadSteps() {
            this.steps.forEach((step) => {
                console.log("vibe check", step);
                this.progress_steps.push(step.name);
            });
            if(this.mode != 'Create'){
            var current_step = this.getCurrentStep(this.item, this.steps);
            if(current_step!= null){
            var status_index = this.progress_steps.indexOf(current_step.name);
            this.current_step = status_index;
            }else{
                this.current_step = this.progress_steps.length
            }
          
            }else{
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
        this.loadSteps();
    },
};
</script>

<style>
</style>
