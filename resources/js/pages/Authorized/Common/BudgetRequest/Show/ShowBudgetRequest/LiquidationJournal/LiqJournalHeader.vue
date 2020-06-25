<template>
    <div>
        <div class="info-box bg-red">
            <span class="info-box-icon"
                ><i class="far fa-calendar-times"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">{{ budget_request.rate }}</span>
                <span class="info-box-number">Deadline is: {{liquidation_deadline}}</span>
                <span class="progress-description">
                    <!-- {{ days_remaining }} Days Remaining -->
                </span> 
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("show-budget-request", {
            budget_request: (state) => state.item,
        }),
        liquidation_deadline() {
            if (this.budget_request.rate == "GMA") {
                var result = new Date(this.budget_request.end_date);
                result.setDate(result.getDate() + 30);
                return result;
            }else if (this.budget_request.rate == 'Provincial'){
                var result = new Date(this.budget_request.end_date);
                result.setDate(result.getDate() + 40);
                return result;
            }
        },
        days_remaining(){
            var date = new Date();
            var diff = new Date(this.liquidation_deadline - date);
            return diff.getUTCDate();
        }
    },
};
</script>
