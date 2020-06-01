<template>
    <b-modal
        id="remarks-list"
        v-model="show_remarks_list"
        size="xl"
        hide-footer
    >
        <template v-slot:modal-header>
            Remarks List
        </template>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <span
                        v-for="(legend, legend_index) in legends"
                        :key="legend_index"
                        class="mr-3"                         

                    >
                        <i class="fas fa-square" :style="{'color' : legend.color}"></i>
                        <strong
                            ><i>{{ legend.type }}</i></strong
                        >
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div v-if="remarks.length > 0">
                    <b-card
                        v-for="(remark, remark_index) in remarks"
                        :key="remark_index"
                    >
                        <template v-slot:header>
                            <b-avatar class="mr-3"></b-avatar>
                            <span class="mr-auto">
                                {{ remark.remarked_by }}</span
                            >
                        </template>
                        <div class="row">
                            <div class="col-md-12">
                                <b-list-group>
                                    <b-list-group-item    :style="{'background-color': getColor(remark) }"
                                    v-for="(actual_remark,
                                    actual_remark_index) in remark.remarks"
                                    :key="actual_remark_index">
                                        {{actual_remark}}
                                    </b-list-group-item>
                                </b-list-group>
                            </div>
                        </div>
                    </b-card>
                </div>
                <b-alert v-else show variant="danger">
                    <strong> No Remarks Found </strong>
                </b-alert>
            </div>
        </div>
    </b-modal>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
    data() {
        return {
            legends: [
                {
                    type: "Reject",
                    color: "#dc3545",
                    variant: "danger",
                },
                {
                    type: "Return",
                    color: "#ffc107",
                },
                {
                    type: "Skip",
                    color: "#17a2b8",
                },
            ],
        };
    },
    computed: {
        ...mapState({
            remarks(state, getters) {
                return state[this.namespace].item.remarks
                // return getters[this.namespace+"/getRemarks"];
            },
        }),
        show_remarks_list: {
            get() {
                return this.$store.state[this.namespace].show_remarks_modal;
            },
            set(value) {
                this.$store.commit(
                    this.namespace + "/changeShowRemarksModal",
                    value
                );
            },
        },
    },
    methods:{
        getColor(remark){
            return this.legends.find(legend => legend.type == remark.type).color;
        }
    },
    props: {
        namespace: String,
    },
};
</script>

