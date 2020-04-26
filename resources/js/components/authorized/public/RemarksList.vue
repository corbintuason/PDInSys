<template>
    <b-modal id="remarks-list" size="xl" hide-footer>
        <template v-slot:modal-header>
            Remarks List
        </template>
        <div class="row">
            <div class="col-md-12">
                <b-card v-for="(remark, remark_index) in remarks" :key="remark_index">
                    <template v-slot:header>
                        <b-avatar class="mr-3"></b-avatar>
                        <span class="mr-auto"> {{remark.returned_by }}<i> {{remark.created_at}} </i></span>
                    </template>
                    <div class="row">
                        <div class="col-md-12">
                            <b-alert v-for="(actual_remark, actual_remark_index) in remark.remarks" :key="actual_remark_index" variant="secondary" show>
                               {{actual_remark}}</b-alert
                            >
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
    </b-modal>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            active_item: null,
        };
    },
    props: {
        remarks: Array,
    },
    methods: {},
    created() {},
};
</script>
