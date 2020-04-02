<template>
  <b-card class="text-center happening-now-card">
    <template v-slot:header>
      <h1 class="component-title">Happening Now</h1>
    </template>
    <b-card-text>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Project Title</th>
                <th>Description</th>
              </tr>
            </thead>
          </table>
          <b-alert show variant="danger">This feature is unavailable</b-alert>
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

<style lang="scss" scoped>
.happening-now-card {
  border-radius: 10px;
  box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
  transition: all 0.2s ease-out;

  &:hover {
    transform: translateY(4px);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
  }
}
</style>