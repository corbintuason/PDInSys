<template>
    <div>
        <item-progress class="mt-3" :namespace="namespace"></item-progress>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">Vendor Accreditation</h1>
            </template>

            <b-card-text>
                <b-tabs v-model="tabIndex" content-class="mt-3" fill>
                    <b-tab title="Vendor Details">
                        <vendor-details :vendor="vendor"></vendor-details>
                    </b-tab>
                    <b-tab title="Tax Details" active>
                        <tax-details :vendor="vendor"></tax-details>
                    </b-tab>
                    <b-tab title="Bank Details">
                        <bank-details :vendor="vendor"></bank-details>
                    </b-tab>
                    <b-tab title="Accreditation Attachments">
                        <accreditation-details
                            :vendor="vendor"
                        ></accreditation-details>
                    </b-tab>
                </b-tabs>
            </b-card-text>

            <template v-slot:footer>
                <!-- For Approval Status -->
                <div class="row">
                    <div class="col-md-6">
                        <b-button-group class="mt-1">
                            <b-button @click="tabIndex--"
                                >Previous Tab</b-button
                            >
                            <b-button @click="tabIndex++">Next Tab</b-button>
                        </b-button-group>
                    </div>
                    <div class="col-md-6 text-right">
                        <b-button
                            :disabled="isDisabled"
                            variant="success"
                            class="float-right"
                            @click="createVendor"
                            >Create Vendor</b-button
                        >
                    </div>
                </div>
            </template>
        </b-card>
    </div>
</template>

<script>
import vendorDetails from "./components/VendorDetails";
import bankDetails from "./components/BankDetails";
import taxDetails from "./components/TaxDetails";
import accreditationDetails from "./components/AccreditationDetails";
import form from "../../../../../mixins/form";
import { vendorModule } from "../../../../../store/modules/vendor";
import { mapGetters, mapState } from "vuex";

export default {
    mixins: [form],
    data() {
        return {
            name: "Create Vendor",
            namespace: "vendor-create",
            tabIndex: 0,
            vendor: {
                vendor_name: "",
                trade_name: "",
                registered_address: {
                    no_st_bldg: "",
                    barangay: "",
                    city: "",
                    zip_code: "",
                },
                type_business: "",
                line_business: "",
                contact_person: {
                    last_name: "",
                    first_name: "",
                    middle_name: "",
                },
                contact_number: "",
                email_address: "",
                tin_number: "",
                type_vat: "",
                ewt_details: [
                    {
                        detail: null,
                    },
                ],
                bank_details: [
                    {
                        bank_name: "",
                        bank_address: [
                            {
                                bank_branch: "",
                                bank_city: "",
                            },
                        ],
                        account_name: "",
                        account_number: "",
                    },
                ],
                other_attachments: [""],
            },
        };
    },

    components: {
        "vendor-details": vendorDetails,
        "bank-details": bankDetails,
        "tax-details": taxDetails,
        "accreditation-details": accreditationDetails,
    },
    computed: {
        ...mapState({
            steps(state) {
                console.log(state);
                return state["vendor-create"].steps;
            },
        }),
        isDisabled() {
            if (this.vendor.vendor_name == "" || this.vendor.trade_name == "") {
                return true;
            }
            if (
                this.vendor.registered_address == "" ||
                this.vendor.contact_person == ""
            ) {
                return true;
            }
            if (
                this.vendor.type_business == "" ||
                this.vendor.line_business == ""
            ) {
                return true;
            }
            if (
                this.vendor.contact_number == "" ||
                this.vendor.email_address == ""
            ) {
                return true;
            }
            if (this.vendor.tin_number == "") {
                return true;
            }
        },
    },
    methods: {
        createVendor() {
            var swal_object = {
                title: "Create Vendor",
                icon: "question",
                confirmButtonText: "Create Vendor",
                text: "Please check the details provided.",
                item: this.vendor,
                endpoints: {
                    api: "/api/vendor",
                    show_route: "vendor_show",
                },
            };
            console.log("meron naman laman?", this.vendor);
            this.fireCreateSwal(swal_object);
        },
    },
    beforeCreate() {
        this.$store.registerModule("vendor-create", vendorModule);
        this.$store.dispatch("vendor-create" + "/changeMode", "Create");
    },
    mounted() {},
};
</script>

<style></style>
