<template>
  <div class="col-md-6">
    <b-input-group v-for="(value, value_index) in account.departments" :key="value_index">
      <b-input :disabled="mode=='Show'" type="text" v-model="value.name"></b-input>
    </b-input-group>
  </div>
</template>

<script>
import form from "../../../../../../mixins/form";
export default {
  data() {
    return {};
  },
  mixins: [form],
  props: {
    account: Object,
    mode: String
  }
};
</script>