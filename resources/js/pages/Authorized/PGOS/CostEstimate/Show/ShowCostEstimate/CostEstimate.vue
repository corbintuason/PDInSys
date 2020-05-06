<template>
    <b-card>
        <template v-slot:header>
            <h1 class="component-title">{{ name }}</h1>
        </template>
        <b-card-body>
            <show-mode v-if="mode=='Show'" :cost_estimate="cost_estimate"></show-mode>
            <edit-mode v-else-if="mode=='Edit'"></edit-mode>
        </b-card-body>

        <template v-slot:footer>
            <show-project-buttons
                :mode="mode"
                :item="cost_estimate"
                :item_model="'Cost Estimate'"
                :steps="steps"
                :endpoints="endpoints"
            ></show-project-buttons>
        </template>
    </b-card>
</template>

<script>
import showMode from "./ShowMode"
import editMode from "./EditMode"
import showProjectButtons from "../../../../../../components/authorized/public/ShowProjectButtons"
import form from "../../../../../../mixins/form";
export default {
    data() {
        return {
            user: this.$store.state.user,
            new_cost_estimate: null,
            peza_ar_options: [
                {
                    value: null,
                    text: "None",
                },
                {
                    value: "peza",
                    text: "Peza",
                },
                {
                    value: "ar_only",
                    text: "AR Only",
                },
            ],
        };
    },
    components:{
        "show-mode": showMode,
        "edit-mode": editMode,
        "show-project-buttons": showProjectButtons
    },
    mixins: [form],
    props: {
        mode: String,
        cost_estimate: Object,
        project: Object,
        steps: Array,
        endpoints: Object,
    },
    computed: {
        name() {
            return this.ce_code + " " + this.project.name;
        },
        ce_code() {
            return "CEPD-" + this.project.code;
        },
        getTotalProjectCost() {
            return (sub_total, asf_rate) => {
                var asf_rate_percent = asf_rate / 100;
                var sub_percent = sub_total * asf_rate_percent;
                var total_project_cost =
                    Number(sub_total) + Number(sub_percent);
                return total_project_cost;
            };
        },
        getVAT() {
            return (peza_ar) => {
                if (peza_ar != null) {
                    return 12;
                } else {
                    return 0;
                }
            };
        },
        getGrandTotal() {
            return (total_project_cost, vat) => {
                if (vat == 0) {
                    return total_project_cost;
                } else {
                    var cost_tax = total_project_cost * (vat / 100);
                    return total_project_cost + cost_tax;
                }
            };
        },
    },
    methods: {
        createCostEstimate() {
            var swal_html = this.loadSwalContents(this.steps, this.user);
            console.log("pa tingen endpoints", this.endpoints);
            var object = this.new_cost_estimate;
            const formData = new FormData();
            Object.keys(object).forEach((key) => {
                if (key == "details") {
                    console.log("pumasok siya sa details");
                    formData.append(key, JSON.stringify(object[key]));
                } else {
                    formData.append(key, object[key]);
                }
            });
            const swal_object = {
                title: "Create Cost Estimate",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Create Cost Estimate",

                item: formData,
                endpoints: this.endpoints,
            };
            this.fireCreateSwal(swal_object);
        },
        addRow() {
            this.new_cost_estimate.details.push({
                version: null,
                sub_total: null,
                asf_rate: null,
                peza_ar: null,
            });
        },

        generateCENumber(detail_index) {
            var num = detail_index + 1;
            return this.ce_code + "." + num;
        },

        removeRow(index) {
            this.new_cost_estimate.details.splice(index, 1);
        },
        loadNewCostEstimate() {
            this.new_cost_estimate = {
                cost_estimate: null,
                cost_estimate_name: this.name,
                status: "For Review",
                details: [],
            };
            this.addRow();
        },
    },
    mounted() {
        this.loadNewCostEstimate();
    },
};
</script>

<style lang="scss">
.assign-budget {
    border: 2px solid #6c757d;
}
.cost-estimate-details {
    background: #e9ecef;
    border-left: 10px solid #3266a8;
    border-right: 10px solid #3266a8;
    border-radius: 5px;
    padding: 10px;
    margin: 15px;

    .grand-total {
        border: 1px solid green;
    }
}
</style>
