<template>
	<div v-if="vendor!=null">
		<!-- Education Work Section -->
		<vendor-details :mode="mode" :vendor="vendor"></vendor-details>
		<hr />
	</div>
</template>

<script>
import vendorDetails from "./VendorDetails/VendorDetails"
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
      "vendor-details": vendorDetails,
    }
}
</script>

<style>
</style>