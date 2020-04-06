<template>
  <div>
    <b-card class="text-center all-employee-card">
      <template v-slot:header>
        <h1 class="component-title">Employees</h1>
      </template>
      <b-card-text>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-sm table-striped">
              <tbody>
                <tr>
                  <tb>Project Title</tb>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scss>
.all-employee-card {
  border-radius: 10px;
  box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
  transition: all 0.2s ease-out;

  &:hover {
    transform: translateY(4px);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
  }
}
</style>