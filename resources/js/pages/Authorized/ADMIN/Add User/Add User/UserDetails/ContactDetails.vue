<template>
    <div id="contact_details">
        <h1 class="component-sub-header">Contact Details</h1>
        <div class="component-sub-content">
            <div class="row">
                <div class="col-md-6">
     <label for="pd_email">
                PD Email
                <i
                    class="fas fa-question-circle"
                    v-b-tooltip.hover
                    title="PD Email will be used to login in PDIS"
                ></i>
            </label>
            <b-input-group id="pd_email">
                <b-form-input v-model="new_user.pd_email"></b-form-input>
            </b-input-group>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
         <label for="pd_gmail">
                PD Gmail
                <i class="fas fa-question-circle"></i>
            </label>
            <b-form-input
                id="pd_gmail"
                v-model="new_user.pd_gmail"
            ></b-form-input>
                </div>
            </div>

        <div class="row">
            <div class="col-md-6">
  <label for="contact_numbers">Contact Numbers</label>
            <b-input-group
                v-for="(contact_number, index) in new_user.contact_numbers"
                :key="index"
            >
                <b-form-input
                    v-model="new_user.contact_numbers[index]"
                ></b-form-input>
                <b-input-group-append>
                    <b-button
                        variant="outline-danger"
                        :disabled="index < 1"
                        @click="removeRow(new_user.contact_numbers, index)"
                    >
                        <i class="fas fa-window-close"></i>
                    </b-button>
                </b-input-group-append>
            </b-input-group>
            <b-button variant="outline-primary" block @click="addContact"
                >Add Contact Number</b-button
            >
            </div>
        </div>
          
        </div>
    </div>
</template>

<script>
import validators from "../../../../../../mixins/validators";
import form from "../../../../../../mixins/form"
export default {
    data() {
        return {};
    },
    mixins: [validators, form],
    props: {
        new_user: Object,
    },
    methods: {
        /* 
    Required:
      - PARAMETERS:
        - item: Object to be used for verification purposes
      - DESCRIPTION:
        - This function is responsible for validating if the string is empty or not.
    */

        onFileChange(e) {
            const file = e.target.files[0];
            this.new_user.official_photo = URL.createObjectURL(file);
        },

        addContact() {
            this.new_user.contact_numbers.push("");
        },
    },
};
</script>
