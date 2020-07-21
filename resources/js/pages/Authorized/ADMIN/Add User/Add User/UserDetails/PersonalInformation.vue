<template>
    <div id="personal_information">
        <div class="component-sub-header">Personal Information</div>
        <div class="component-sub-content">
            <div class="row">
                <div class="col-md-4 mt-3" style="text-align: center;">
                    <!-- If there is no image uploaded -->
                    <div
                        v-if="new_user.official_photo == null"
                        style="
                            width: 300px;
                            height: 300px;
                            border: 1px solid;
                            display: inline-block;
                        "
                    ></div>
                    <img
                        v-else
                        style="width: 300px; height: 300px;"
                        :src="new_user.official_photo"
                    />
                    <b-form-file
                        style="width: 300px; text-align: left;"
                        @change="onFileChange"
                    ></b-form-file>
                </div>
                <div class="col-md-8">
                    <label for="last_name">Last Name</label>
                    <b-input
                        id="last_name"
                        :state="required(new_user.last_name)"
                        v-model="new_user.last_name"
                    ></b-input>
                    <b-form-invalid-feedback
                        :state="required(new_user.last_name)"
                        >This is a required field</b-form-invalid-feedback
                    >

                    <!-- FIRST NAME  -->

                    <label for="first_name">First Name</label>
                    <b-input
                        id="first_name"
                        :state="required(new_user.first_name)"
                        v-model="new_user.first_name"
                    ></b-input>
                    <b-form-invalid-feedback
                        :state="required(new_user.first_name)"
                        >This is a required field</b-form-invalid-feedback
                    >

                    <!-- MIDDLE NAME  -->

                    <label for="middle_name">Middle Name</label>
                    <b-input
                        id="middle_name"
                        :state="required(new_user.middle_name)"
                        v-model="new_user.middle_name"
                    ></b-input>
                    <b-form-invalid-feedback
                        :state="required(new_user.middle_name)"
                        >This is a required field</b-form-invalid-feedback
                    >

                    <b-form-group
                        label="Employment Date"
                        label-class="font-weight-bold"
                    >
                        <b-input-group>
                            <b-form-datepicker
                                v-model="new_user.employment_date"
                            ></b-form-datepicker>
                        </b-input-group>
                    </b-form-group>

                    <b-form-group
                        label="Employment Date"
                        label-class="font-weight-bold"
                    >
                        <b-input-group>
                            <b-form-datepicker
                                v-model="new_user.birth_date"
                            ></b-form-datepicker>
                        </b-input-group>
                    </b-form-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import validators from "../../../../../../mixins/validators";
export default {
    data() {
        return {};
    },
    mixins: [validators],
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
    },
};
</script>
