<template>
    <div>
        <!-- CE Detail Code -->
        <div class="row">
            <b-form-group
                label-cols-sm="4"
                label="CE Number"
                label-class="font-weight-bold"
                class="col-md-4"
            >
                <b-form-input
                    type="text"
                    :value="detail.code"
                    readonly
                ></b-form-input>
            </b-form-group>
        </div>

        <!-- CE Detail Code -->
        <div class="row">
            <div class="col-md-4">
                <table class="table table-sm table-bordered">
                    <thead></thead>
                    <tbody>
                        <tr class="table-primary">
                            <th>SUB TOTAL COST</th>
                            <td>{{ detail.sub_total }}</td>
                        </tr>
                        <tr class="table-secondary">
                            <th>Agency Service Fee ({{ detail.asf_rate }}%)</th>
                            <td>{{ detail.asf_sub_total }}</td>
                        </tr>
                        <tr class="table-danger">
                            <th>
                                Total Project Cost (Vat Excluded)
                            </th>
                            <td>
                                {{ detail.total_project_cost }}
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <th>VAT ({{ detail.tax }}%)</th>
                            <td>{{ detail.project_vat }}</td>
                        </tr>
                        <tr class="table-danger">
                            <th>
                                Grand Total (Vat Included)
                            </th>
                            <td>{{ detail.grand_total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <th class="table-secondary">
                                Internal Budget
                            </th>
                            <td class="table-warning">
                                <b-input-group size="sm">
                                    <template v-slot:prepend>
                                        <b-input-group-text

                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <b-input v-model="signed_ce_detail.internal_budget" type="number"></b-input>
                                </b-input-group>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <th>Internal Savings</th>
                            <td>{{internal_savings}}</td>
                        </tr>
                        <tr class="table-danger">
                            <th>Incentive</th>
                            <td>                                    <b-input v-model="signed_ce_detail.incentive" type="number"></b-input>
</td>
                        </tr>
                        <tr class="table-secondary">
                            <th>Total Savings</th>
                            <td>{{total_savings}}</td>
                        </tr>
                        <tr class="table-danger">
                            <th>P&L</th>
                            <td>{{p_and_l}}</td>
                        </tr>
                    </tbody>
                </table>
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
    computed:{
        internal_savings(){
            return this.detail.sub_total - this.signed_ce_detail.internal_budget;
        },
        total_savings(){
            return this.internal_savings - this.signed_ce_detail.incentive;
        },
             p_and_l(){
            return (this.total_savings/this.detail.sub_total)*100 +"%";
        }
    },
    components:{
    },
    props: {
        detail: Object,
        mode: String,
        steps: Array,
        signed_ce_detail: Object
    },
    methods:{
        loadEditDetail(){
            var test = this.signed_ce_detail.internal_budget;
            this.edit_detail = {
                internal_budget: test
            };
        }
    },
    mounted(){
        // this.loadEditDetail();
    }
};
</script>
