<template>
    <div>
        <table class="table table-sm">
            <thead></thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">Total Budget Remaining</td>
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
                                disabled
                                class="form-control"
                                :value="remaining_budget"
                            ></money>
                        </b-input-group>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;" :style="{'color': variant}">Total Budget Requested</td>
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
                                disabled
                                class="form-control"
                                 :style="{'color': variant}"
                                :value="getTotalBudgetRequest"
                            ></money>
                        </b-input-group>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState({
            remaining_budget(state) {
                if(this.namespace == "create-budget-request"){
                return state[this.namespace].parent.total_remaining_budget;
                }else{
                    return state[this.namespace].item.parent.total_remaining_budget
                }
            },
            getTotalBudgetRequest(state, getters) {
                return getters[this.namespace + "/getTotalBudgetRequest"];
            },
            reached_budget_limit(state, getters) {
                return getters[this.namespace + "/reached_budget_limit"];
            },
        }),
        variant() {
            if (this.reached_budget_limit) {
                return "red";
            } else {
                return "green";
            }
        },
    },
    props: {
        namespace: String,
    },
};
</script>
