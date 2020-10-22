<template>
    <div class="float-right">
        <span v-for="(status, status_index) in statuses" :key="status_index" class="mr-3">
            <i class="fas fa-square" :class="status.color"></i> <strong><i>{{status.name}}</i></strong>
        </span>
    </div>
</template>

<script>
export default {
    data(){
        return{}
    },
    props:{
        statuses: Array
    }
}
</script>