<template>
  <b-card bg-variant="light" header="Light" class="text-center">
    <template v-slot:header>
      <h1 class="component-title">My Schedule</h1>
    </template>
    <b-card-body>
    </b-card-body>
  </b-card>
</template>

<script>
export default {
  data() {
    return {
      items: null,
      fields: null
    };
  },

  components:{
  },
  methods: {
      loadItemsFields(){
           this.items = [
        ],
        this.fields = [

        ];
      }
  },
  mounted() {
      this.loadItemsFields();
  }
};
</script>