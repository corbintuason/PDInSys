<template>
	<div v-if="vendor!=null">
		<!-- Education Work Section -->
		<bank-details :mode="mode" :vendor="vendor"></bank-details>
		<hr />
	</div>
</template>

<script>
import bankDetails from "./BankDetails/BankDetails"
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
      "bank-details": bankDetails,
    }
}
</script>

<style>
</style>