<template>
 
</template>

<script>

export default {
    data() {
        return {
     
        };
    },
    computed:{
  
    },
    components: {
        "show-process-buttons": showProcessButtons,
        "color-legend" : colorLegend
    },
    props: {
        cost_estimate_details: Array,
        endpoints: Object,
    },
};
</script>
