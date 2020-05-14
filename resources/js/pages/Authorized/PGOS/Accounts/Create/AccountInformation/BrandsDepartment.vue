<template>
  <div>
    <div id="brand_department">
      <b-form-group label-class="font-weight-bold" label="Brands and Departments">
        <div class = "row">
             <brands :form="form"></brands>
             <departments :form="form"></departments>
        </div>
      </b-form-group>
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