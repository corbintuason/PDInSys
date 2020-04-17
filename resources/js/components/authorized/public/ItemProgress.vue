<template>
<div>
    <b-card>
      <template v-slot:header>
        <h1 class="component-title">Progress Bar</h1>
      </template>
      <b-card-text>
        <step-progress :steps="my_steps" :current-step="current_step" icon-class="fa fa-check"></step-progress>
      </b-card-text>
    </b-card>
</div>
</template>

<script>
export default{
    data(){
        return{};
    },
    props:{
        my_steps: Array,
        current_step: Number
    }
}
</script>