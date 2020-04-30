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
                    <b-button
                        @click="showRemarksList"
                        variant="outline-secondary"
                        >Remarks List</b-button
                    >
                    <b-button
                        variant="outline-secondary"
                        @click="showContributionList"
                        >Contribution List</b-button
                    >
                </b-button-group>
            </template>
        </b-card>

        <div v-if="mode != 'Create'">
             <b-modal id="contribution-list" size="xl" hide-footer>
        <template v-slot:modal-header>
            Contribution List 
        </template>
            <contribution-list
                :steps="steps"
                :contributors="item.relationships.contributors"
            ></contribution-list>
             </b-modal>
        <remarks-list :remarks="item.relationships.remarks"></remarks-list>

        </div>

    </div>
</template>

<script>
import contributionList from "./ContributionList";
import remarksList from "./RemarksList";

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
                this.progress_steps.push(step.name);
            });
            console.log("asdfasfdf");
            console.log(this.progress_steps);
            this.getCurrentStep();
        },
        showContributionList() {
            this.$bvModal.show("contribution-list");
        },
        showRemarksList() {
            this.$bvModal.show("remarks-list");
        },
        getCurrentStep() {
            if (this.mode != "Create") {
                var status = this.item.status;
                var current_step = this.steps.find(step => {
                   return step.database_equivalent.includes(status);
                });
                var status_index = this.progress_steps.indexOf(current_step.name)+1;
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
