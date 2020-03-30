<template>
  <b-card class="mt-3">
    <template v-slot:header>
      <h1 class="component-title">Change Logs</h1>
    </template>
    <b-card-body>
        <b-alert show variant="primary" v-for="(log, log_index) in logs" :key="log_index">{{log}}</b-alert>
    </b-card-body>
  </b-card>
</template>

<script>
export default{
    data(){
        return{

        }
    },
    props:{
        logs: Array
    }
}
</script>