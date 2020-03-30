<template>
  <div>
    <div id="brand_department">
      <h1 class="component-sub-header">Brands and Departments</h1>
      <div class="component-sub-content">
        <div class = "row">
             <brands :mode="mode" :account="account"></brands>
             <departments :mode="mode" :account="account"></departments>
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
    account: Object,
    mode: String
  },
      components: {
      "brands": brands,
      "departments": departments
    }
};
</script>