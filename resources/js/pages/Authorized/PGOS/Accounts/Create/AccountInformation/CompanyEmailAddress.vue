<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Company Email Address</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-6">
            <b-input-group
              v-for="(value, value_index) in form.company_email_address"
              :key="value_index"
            >
              <b-input type="text" v-model="form.company_email_address[value_index]"></b-input>
              <b-input-group-append>
                <b-button
                  variant="outline-danger"
                  :disabled="value_index==0"
                  @click="removeRow(form.company_email_address, value_index)"
                >
                  <i class="fas fa-trash"></i>
                </b-button>
              </b-input-group-append>
            </b-input-group>
            <b-button
              variant="outline-primary"
              block
              @click="addRow(form.company_email_address)"
            >Add Email Address</b-button>
          </div>
        </div>
      </div>
    </div>
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