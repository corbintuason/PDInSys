<template>
  <div>
    <div id="brand_department">
      <h1 class="component-sub-header">Brands and Departments</h1>
      <div class="component-sub-content">
        <div class = "row">
             <brands :form="form"></brands>
             <departments :form="form"></departments>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import brands from "./Brands"
import departments from "./Departments"
export default {
  data() {
    return {
    };
  },
  props:{
    form: Object
  },
      components: {
      "brands": brands,
      "departments": departments
    }
};
</script>