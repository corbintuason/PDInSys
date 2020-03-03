<template>
  <div>
    <div :id="section.id" v-for="(section, section_index) in sections" :key="section_index">
      <h1 class="component-sub-header">{{section.header}}</h1>
      <div class="component-sub-content">
        <div class="row" v-for="(form, form_index) in section.forms" :key="form_index">
          <div class="col-md-6">
            <label>{{form.label}}</label>

            <!-- INPUT CHECKER -->
            <b-input-group v-for="(model, model_index) in form.models" :key="model_index">
              <b-input type="text" v-model="model.value"></b-input>

              <b-input-group-append v-if="form.append!=null">
                <b-button
                  :variant="form.append"
                  @click="removeRow(form, model_index)"
                  :disabled="model_index==0"
                >Delete</b-button>
              </b-input-group-append>
            </b-input-group>

            <!-- IF ADD FORM IS NECESSARY -->
            <b-button
              variant="outline-primary"
              v-if="form.add_row"
              block
              @click="addRow(form)"
            >Add Contact Number</b-button>
          </div>
        </div>
      </div>
      <hr />
    </div>
  </div>
</template>

<script>
import validators from "../../mixins/validators";
import form from "../../mixins/form";
export default {
  data() {
    return {
         sections: [
        {
          id: "account_details",
          header: "Account Details",
          forms: [
            {
              id: "registered_name",
              label: "Registered Name",
              type: "text",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "registered_address",
              label: "Registered Address",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "registered_tin",
              label: "Registered TIN",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "terms_of_payment",
              label: "Terms of Payment",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "payment_milestone",
              label: "Payment Milestone",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "company_tel_number",
              label: "Company Tel Number",
              models: [
                {
                  value: ""
                }
              ]
            },
            {
              id: "company_email_address",
              label: "Company Email Address",
              models: [
                {
                  value: ""
                }
              ]
            }
          ]
        },
        {
          id: "accrediatation_status",
          header: "Accreditation Status",
          forms: [
            {
              add_row: true,
              append: "outline-danger",
              models: [
                {
                  value: ""
                }
              ]
            }
          ]
        },
         {
          id: "billing_collection_notes",
          header: "Other Billing Collection Notes & Remarks",
          forms: [
            {
              add_row: true,
              append: "outline-danger",
              models: [
                {
                  value: ""
                }
              ]
            }
          ]
        },
      ]
    };
  },
  props: {
    sections: Array
  },
  mixins: [validators, form]
};
</script>