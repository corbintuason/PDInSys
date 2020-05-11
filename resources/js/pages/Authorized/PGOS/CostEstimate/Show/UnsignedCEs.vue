<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h1 class="component-title">Unsigned CEs</h1>
            </template>
            <b-card-body>
                <div v-if="unsigned_ces.length > 0">
           
                      <div
                        v-for="(detail, detail_index) in unsigned_ces"
                        :key="detail_index"
                        class="cost-estimate-details mb-0"
                        :style="{
                            'border-left':
                                '10px solid ' + colorEquivalent(detail),
                            'border-right':
                                '10px solid ' + colorEquivalent(detail),
                        }"
                    >
                    <unsigned-ce :detail="detail" :steps="steps"></unsigned-ce>

                    </div>
                             <div class="row">
                        <div class="col-md-12">
                            <color-legend :legends="legends"></color-legend>
                        </div>
                    </div>
                </div>
                <b-alert show v-else variant="danger"> <strong>No Cost Estimate Details have been made yet.</strong></b-alert>
            </b-card-body>
        </b-card>

        <!-- 
            - Remove for signing, replace with Cleared. Color is orange
            - For Clearance: Change color to blue
            - For Approval: Change color to yellow
            - Remove Signed

            - If status is cleared, remove reject button
            - If status is cleared, remove return button

            - When signing a ce, show swal to upload a

            // SIgned CEs:
            - Budget For Review.. so on and so for
            - Return, next proces step

            // Ce Creation:
            - SUB TOTAL 1, ASF RATE 1, PROJECT COST 1 
            - SUB TOTAL 2, ASF RATE 2, PROJECT COST 2
            - SUB TOTAL COST: Total of Sub 1 and Sub 2
            - 
            - TOTAL PROJECT COST, VAT, GRAND TOTAL 
         -->
    </div>
</template>

<script>
import showProcessButtons from "../../../../../components/authorized/public/ShowProcessButtons";
import colorLegend from "../Show/components/ColorLegend";
import unsigneddCE from "./UnsignedCEs/UnsignedCE"
export default {
    data() {
        return {
            steps: this.$store.state.costEstimate.steps,
            mode: "Show",
            item_model: "Cost Estimate Detail",
            peza_ar_options: [
                {
                    value: "VAT",
                    text: "VAT",
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
                   legends: [{
                status: "For Review",
                color: "red"
            }, {
                status: "For Approval",
                color: "orange"
            }, {
                status: "For Clearance",
                color: "yellow"
            }, {
                status: "For Signing",
                color: "blue"
            },{
                status: "Signed",
                color: "green"
            }]
        };
    },
    props: {
        project: Object,
        unsigned_ces: Array,
    },
    components: {
        "color-legend": colorLegend,
        showProcessButtons: showProcessButtons,
        "unsigned-ce": unsigneddCE
    },
    computed: {
        colorEquivalent() {
            return (detail) => {
                if (detail.status == "For Review") {
                    return "red";
                } else if (detail.status == "For Approval") {
                    return "orange";
                } else if (detail.status == "For Clearance") {
                    return "yellow";
                } else if (detail.status == "For Signing") {
                    return "blue";
                } else if (detail.status == "Signed") {
                    return "green";
                }
            };
        },
    },
    methods: {
    },
    mounted() {

},
};
</script>
