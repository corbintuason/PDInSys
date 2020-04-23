<template>

<b-card>
    <template v-slot:header> {{name}} </template>
</b-card>

</template>

<script>
export default{
    data(){
        return{
            name: "Project Execution Team"
        }
    },
    computed:{

    }
}
</script>