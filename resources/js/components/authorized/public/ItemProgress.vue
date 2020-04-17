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
                <b-card-text>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <b-list-group>
                                <b-list-group-item
                                    v-for="(front_step, front_step_index) in front_steps" :key="front_step_index"
                                    class="d-flex align-items-center"
                                >
                                    <b-avatar class="mr-3"></b-avatar>
                                    <span class="mr-auto"><strong> {{front_step.responsible}}: </strong></span>
                                </b-list-group-item>
                            </b-list-group>
                        </div>
                    </div>
                </b-card-text>
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
          steps: []
        };
    },
    props: {
        front_steps: Array,
        current_step: Number,
    },
    methods:{
      loadSteps(){
        this.front_steps.forEach(front_step => {
          this.steps.push(front_step.name);
        });
      }
    },
    mounted(){
      this.loadSteps();
    }
};
</script>
