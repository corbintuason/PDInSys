<template>
  <div>
    <div id="brand_department">
      <h1 class="component-sub-header">Brands and Departments</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-6">
            <label>Brands</label>
            <b-list-group>
              <b-list-group-item
                v-for="(brand, brand_index) in form.brands"
                :key="brand_index"
                href="#"
                @click="selectBrand(brand)"
              >{{brand.name}}</b-list-group-item>
              <b-list-group-item variant="primary">
                <h4 class="mb-0">
                  <b-input type="text" :placeholder="brand_placeholder" v-model="temp_brand"></b-input>
                </h4>
              </b-list-group-item>
              <b-button variant="outline-primary" @click="addBrand">Add Brand</b-button>
            </b-list-group>
          </div>

          <div v-if="selected_brand!=null" class="col-md-6">
            <departments :selected_brand="selected_brand" :form="form"></departments>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import departments from "./Departments";
import form from "../../../../../../mixins/form";
export default {
  data() {
    return {
      brand_placeholder: "Brand Name",
      selected_brand: null,
      temp_brand: null
    };
  },
  mixins: [form],
  props: {
    form: Object
  },
  components: {
    departments: departments
  },
  methods: {
    addBrand(){
      this.form.brands.push({
        id: this.form.brands.length,
        name: this.temp_brand,
        departments:[],
      });
    },
    selectBrand(brand) {
      this.selected_brand = brand;
    }
  }
};
</script>