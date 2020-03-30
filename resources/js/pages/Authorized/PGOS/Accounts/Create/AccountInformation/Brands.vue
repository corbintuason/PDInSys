<template>
  <div class="col-md-6">
    <b-input-group v-for="(value, value_index) in form.brands" :key="value_index">
      <b-input type="text" v-model="form.brands[value_index]"></b-input>
      <b-input-group-append>
        <b-button
          variant="outline-danger"
          :disabled="value_index==0"
          @click="removeRow(form.brands, value_index)"
        >
          <i class="fas fa-trash"></i>
        </b-button>
      </b-input-group-append>
    </b-input-group>
    <b-button
      variant="outline-primary"
      block
      @click="addRow(form.brands)"
    >Add Brand</b-button>
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
    form: Object
  }
};
</script>