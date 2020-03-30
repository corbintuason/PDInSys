<template>
  <b-card class="text-center">
    <template v-slot:header>
      <h1 class="component-title">Happening Now</h1>
    </template>
    <b-card-text>
      <div class= "row">
        <div class = "col-md-12">
          <table class="table table-sm">
            <thead>
              <tr>
                <th> Project Title</th>
                <th> Description </th>

              </tr>
            </thead>
          </table>
          <b-alert show variant="danger">This feature is unavailable </b-alert>
        </div>
      </div>
    </b-card-text>
  </b-card>
</template>

<script>
export default {
  data() {
    return {
    };
  },

  components:{
  },
  methods: {
      loadItemsFields(){

      }
  },
  mounted() {
  }
};
</script>