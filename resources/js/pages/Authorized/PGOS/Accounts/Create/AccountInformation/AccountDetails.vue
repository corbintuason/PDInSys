<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Account Details</h1>
      <div class="component-sub-content">

        <div class="row">
          <div class="col-md-6">
            <!-- Single Layer -->
            <b-form-group
              v-for="(builder, builder_index) in account_builder"
              :key="builder_index"
              :label="builder.label"
              label-class="font-weight-bold"
            >
              <!-- Non Address -->
              <template v-if="builder.model != 'registered_address'">
                <b-form-input
                  v-if="builder.form == 'input'"
                  :type="builder.type"
                  v-model="form[builder.model]"
                  :placeholder="builder.placeholder"
                ></b-form-input>
              </template>
              <!-- Address -->
              <template v-else>
                <b-form-input
                  v-for="(section, section_index) in builder.sections"
                  :key="section_index"
                  :type="section.type"
                  v-model="form['registered_address'][section.model]"
                  :placeholder="section.placeholder"
                ></b-form-input>
              </template>
            </b-form-group>
            <!-- Double Layer -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
export default{
  data(){
    return{
         name: '',
      age: 0,
      submitStatus: null,
      account_builder:[
        {
          model: "registered_name",
          label: "Registered Name",
          form: "input",
          type: "text",
        },
        {
          label: "Registered Address",
          model: "registered_address",
          sections:[
            {
              type: "text",
              model: "no_st_bldg",
              placeholder: "No. / Street / Bldg"
            },
            {
              type: "text",
              model: "barangay",
              placeholder: "Barangay"
            },
            {
              type: "text",
              model: "city",
              placeholder: "City"
            },
            {
              type: "text",
              model: "zip_code",
              placeholder: "Zip Code"
            }
          ]
        },

        {
          model: "registered_tin",
          label: "Registered TIN",
          form: "input",
          type: "text",
          placeholder: "XXX-XXX-XXX-XXXXX"
        }
      ]
    }
  },
    validations: {
    name: {
     required,
      minLength: minLength(4)
    }
  },
 methods:{
    	status(validation) {
    	return {
      	error: validation.$error,
        dirty: validation.$dirty
      }
    },
        submit() {
      console.log('submit!')
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        // do your submit logic here
        this.submitStatus = 'PENDING'
        setTimeout(() => {
          this.submitStatus = 'OK'
        }, 500)
      }
    }
 },
  props:{
    form: Object
  }
}
</script>

<style>
input {
  border: 1px solid silver;
  border-radius: 4px;
  background: white;
  padding: 5px 10px;
}

.dirty {
  border-color: #5a5;
  background: #efe;
}

.dirty:focus {
  outline-color: #8e8;
}

.error {
  border-color: red;
  background: #fdd;
}

.error:focus {
  outline-color: #f99;
}
</style>