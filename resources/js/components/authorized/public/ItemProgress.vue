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
                        ></step-progress>
                    </div>
                </div>
                <div class="row mt-2" v-if="mode!='Create'">
                    <div class="col-md-12">
                        <contribution-list
                            ref="contribution_list"
                            :front_steps="front_steps"
                            :involved_users="item.involved_users"
                        ></contribution-list>
                    </div>
                </div>
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
import contributionList from "./ContributionList";
export default {
    data() {
        return {
            steps: [],
            current_step: null
        };
    },
    props: {
        front_steps: Array,
        db_steps: Array,
        mode: String,
        item: Object,
    },
    components: {
        "contribution-list": contributionList,
    },
    methods: {
        loadSteps() {
            this.front_steps.forEach((front_step) => {
                this.steps.push(front_step.name);
            });
            this.getCurrentStep();
        },
        getCurrentStep() {
            console.log("asdf");
            if(this.mode!='Create'){
            var status_index = this.db_steps.indexOf(this.item.status) + 1;
            this.current_step = status_index;
            }else{
                this.current_step = 0;
            }

        },
    },
    mounted() {
        this.loadSteps();
    },
};
</script>
