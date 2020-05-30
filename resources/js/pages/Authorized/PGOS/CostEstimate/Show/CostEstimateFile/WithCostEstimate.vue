<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">
                {{ cost_estimate_name }}
            </h1>
        </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-6">
                    <a href="#" @click="downloadCostEstimate">
                        <b-alert show variant="success">
                            <img
                                :src="'/img/icons/Excel.png'"
                                alt="excel-icon"
                                style="width: 40px;"
                            />
                            {{ cost_estimate_name }}
                        </b-alert>
                    </a>
                </div>
            </div>
        </b-card-body>
        <template v-slot:footer>
            <b-button class="float-right" variant="outline-primary" :to="{name: 'project_budget_request_index'}">View Budget Requests</b-button>
        </template>
    </b-card>
</template>
<script>
export default {
    data() {
        return {};
    },
    props: {
        cost_estimate: Object,
        cost_estimate_name: String,
    },
    methods: {
        downloadCostEstimate() {
            axios({
                url: "/api/download_cost_estimate/" + this.cost_estimate.id,
                method: "GET",
                responseType: "blob", // important
            }).then((response) => {
                console.log("response", response);
                const url = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute(
                    "download",
                    this.cost_estimate_name + ".xlsx"
                );
                document.body.appendChild(link);
                link.click();
            });
        },
        viewBudgetRequests(){
            
        }
    },

};
</script>
