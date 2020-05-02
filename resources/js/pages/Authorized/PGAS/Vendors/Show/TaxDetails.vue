<template>
	<div v-if="vendor!=null">
		<!-- Education Work Section -->
		<tax-details :mode="mode" :vendor="vendor"></tax-details>
		<hr />
	</div>
</template>

<script>
import taxDetails from "./TaxDetails/TaxDetails"
export default {
    data(){
        return{

        }
    },
    props:{
      vendor: Object,
      mode: String
    },
    components:{
      "tax-details": taxDetails,
    }
}
</script>

<style>
</style>