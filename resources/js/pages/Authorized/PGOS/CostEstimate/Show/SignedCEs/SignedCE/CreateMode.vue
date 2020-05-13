<template>
    <div>
        <!-- {{detail}} -->
        <!-- CE Detail Code -->
        <div class="row">
            <b-form-group
                label-cols-sm="4"
                label="CE Number"
                label-class="font-weight-bold"
                class="col-md-3"
            >
                <b-input-group>
                    <template v-slot:append>
                        <b-button
                            variant="outline-dark"
                            @click="downloadSignedCostEstimate"
                            ><i class="fas fa-download"></i
                        ></b-button>
                    </template>
                    <b-form-input
                        type="text"
                        :value="detail.code"
                        readonly
                    ></b-form-input>
                </b-input-group>
            </b-form-group>
        </div>

        <!-- CE Detail Code -->
        <div class="row">
            <div class="col-md-4">
                <table class="table table-bordered">
                    <thead></thead>
                    <tbody
                        v-for="(field,
                        field_index) in detail.detailed_sub_fields"
                        :key="field_index"
                    >
                        <tr class="table-primary">
                            <th style="text-align: center;">
                                SUB TOTAL {{ field_index + 1 }}
                            </th>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="field.sub_total"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td>Agency Service Fee ({{ field.asf_rate }}%)</td>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="field.asf_sub_total"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td>
                                Project Cost (Vat Excluded)
                            </td>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="field.project_cost"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead></thead>
                    <tbody>
                        <tr class="table-primary">
                            <th style="text-align: center;">TOTAL PROJECT COST (VAT Excluded)</th>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="detail.sub_total_cost"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <th style="text-align: center;">
                                VAT ({{ detail.tax }}%)
                            </th>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="detail.project_vat"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-success">
                            <th style="text-align: center;">
                                GRAND TOTAL (Vat Included)
                            </th>
                            <td>
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="detail.grand_total"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="table-primary">
                            <th>
                                INTERNAL BUDGET
                            </th>
                            <td>
                                    <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="signed_ce_detail.internal_budget"
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td>Initial Savings</td>
                            <td>
                                   <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="initial_savings"
                                        disabled
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th>INCENTIVE</th>
                            <td>
                                    <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >

                                    </template>
                                         <template v-slot:append>
                                                                                                                             <b-button variant="danger" @click="restoreIncentive"><i class="fas fa-redo-alt"></i></b-button>

                                    </template>

                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        v-model="signed_ce_detail.incentive"
                                    ></money>
                                </b-input-group>
                          
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td>Total Savings</td>
                            <td>   <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="total_savings"
                                        disabled
                                    ></money>
                                </b-input-group></td>
                        </tr>
                        <tr class="table-danger">
                            <th>P&L</th>
                            <td>{{ p_and_l }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b-button-group class="float-right">
                    <!-- <b-button variant="outline-danger"> Reject Signed CE </b-button> -->
                    <b-button variant="outline-success" @click="createSignedCE"> Create Budget </b-button>
                </b-button-group>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
      
        };
    },
   computed: {
        canProcess() {
            return this.$store.getters.hasRole(
                this.signed_ce_detail.current_handler
            );
        },
        initial_savings: {
            get: function () {
                 var sum_sub_total = 0;
                console.log("the detail", this.detail);
                this.detail.sub_fields.forEach(field => {
                    sum_sub_total+=field.sub_total;
                });
                var initial_savings = sum_sub_total - this.signed_ce_detail.internal_budget;
                return initial_savings;
            },
            setter: function (newVal) {},
        },
        total_savings: {
            get: function () {
                return this.initial_savings - this.signed_ce_detail.incentive;
            },
            setter: function (newVal) {
                console.log("whut", newVal);
            },
        },
        p_and_l: {
            get: function () {
                            var sum_sub_total = 0;
                console.log("the detail", this.detail);
                this.detail.sub_fields.forEach(field => {
                    sum_sub_total+=field.sub_total;
                });

            return  Math.round(this.total_savings/sum_sub_total * 100)+ "%";
            },
            setter: function (newVal) {
                console.log("whut", newVal);
            },
        },
    },
    components: {},
    props: {
        detail: Object,
        signed_ce_detail: Object
    },
    methods: {
        createSignedCE(){
            // this.signed_ce_detail.cost_estimate_detail_id = this.detail.id;
              swal.fire({
                title: "Budget Opening",
                icon: "question",
                text: "Are you sure you want to submit?",
                confirmButtonText: "Yes",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/signed_cost_estimate_detail/" +this.signed_ce_detail.id, this.signed_ce_detail)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to process item`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    console.log(result);
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                      this.$router.go();
                        },
                    });
                }
            });
        },
        restoreIncentive(){
            console.log("assing thru");
          this.signed_ce_detail.incentive = this.detail.initial_incentive  
        },
        downloadSignedCostEstimate() {
            axios({
                url: "/api/download_signed_cost_estimate/" + this.detail.id,
                method: "GET",
                responseType: "blob", // important
            }).then((response) => {
                console.log("response", response);
                const url = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", this.detail.code + ".pdf");
                document.body.appendChild(link);
                link.click();
            });
        },
    },
    mounted() {},
};
</script>
