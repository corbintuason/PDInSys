<template>
    <div class="float-right">
        <span v-for="(legend, legend_index) in legends" :key="legend_index" class="mr-3">
            <i class="fas fa-square" :class="legend.color"></i> <strong><i>{{legend.status}}</i></strong>
        </span>
    </div>
</template>

<script>
export default {
    data(){
        return{}
    },
    props:{
        legends: Array
    }
}
</script>