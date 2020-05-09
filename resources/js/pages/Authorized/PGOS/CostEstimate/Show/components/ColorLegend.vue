<template>
    <div class="float-right">
        <span v-for="(legend, legend_index) in legends" :key="legend_index" class="mr-3">
            <i class="fas fa-square" :class="legend.color"></i> <strong>{{legend.status}}</strong>
        </span>
    </div>
</template>

<script>
export default {
    data(){
        return{
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
        }
    }
}
</script>