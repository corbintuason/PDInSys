<template>
    <div>
        <div id="account_details">
            <h1 class="component-sub-header">Account Details</h1>
            <div class="component-sub-content">
              <!-- Registered Name - Brands & Departments -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                    <b-form-group
                        class="col"
                        label="Registered Name"
                        label-class="font-weight-bold"
                    >
                        <b-form-input
                            type="text"
                            v-model="form.registered_name"
                        ></b-form-input>
                    </b-form-group>
                    </div>
                     <div class="row">
                    <b-form-group
                        class="col"
                        label="Registered Address"
                        label-class="font-weight-bold"
                    >

                        <b-form-input
                            placeholder="No./Street/Bldg"
                            type="text"
                            v-model="form.registered_address.no_st_bldg"
                        ></b-form-input>
                        
                        <b-form-input
                            placeholder="Barangay"
                            type="text"
                            v-model="form.registered_address.barangay"
                        ></b-form-input>
                        
                        <b-form-input
                            placeholder="City"
                            type="text"
                            v-model="form.registered_address.city"
                        ></b-form-input>
                        
                        <b-form-input
                            placeholder="ZIP Code"
                            type="text"
                            v-model="form.registered_address.zip_code"
                        ></b-form-input>
                    </b-form-group>
                    </div>
        
                  </div>
               
              <div class="col-md-6">
            <brands-departments
                        :form="form"
                    ></brands-departments>
              <company-tel-number :form="form"></company-tel-number>
  <company-email-address :form="form"></company-email-address>
<accreditation-status :form="form"></accreditation-status>
       
              </div>
        
                </div>
  
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";
import brandsDepartments from "./BrandsDepartment";
import companyTelNumber from "./CompanyTelNumber";
import companyEmailAddress from "./CompanyEmailAddress";
import accreditationStatus from "./AccreditationStatus";
export default {
    data() {
        return {
            name: "",
            age: 0,
            submitStatus: null,
            account_builder: [
                {
                    model: "registered_name",
                    label: "Registered Name",
                    form: "input",
                    type: "text",
                },
                {
                    label: "Registered Address",
                    model: "registered_address",
                    sections: [
                        {
                            type: "text",
                            model: "no_st_bldg",
                            placeholder: "No. / Street / Bldg",
                        },
                        {
                            type: "text",
                            model: "barangay",
                            placeholder: "Barangay",
                        },
                        {
                            type: "text",
                            model: "city",
                            placeholder: "City",
                        },
                        {
                            type: "text",
                            model: "zip_code",
                            placeholder: "Zip Code",
                        },
                    ],
                },

                {
                    model: "registered_tin",
                    label: "Registered TIN",
                    form: "input",
                    type: "text",
                    placeholder: "XXX-XXX-XXX-XXXXX",
                },
            ],
        };
    },
    components: {
        "brands-departments": brandsDepartments,
        "company-tel-number": companyTelNumber,
        "company-email-address": companyEmailAddress,
        "accreditation-status": accreditationStatus,
    },
    validations: {
        name: {
            required,
            minLength: minLength(4),
        },
    },
    methods: {
        status(validation) {
            return {
                error: validation.$error,
                dirty: validation.$dirty,
            };
        },
        submit() {
            console.log("submit!");
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = "ERROR";
            } else {
                // do your submit logic here
                this.submitStatus = "PENDING";
                setTimeout(() => {
                    this.submitStatus = "OK";
                }, 500);
            }
        },
    },
    props: {
        form: Object,
    },
};
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
