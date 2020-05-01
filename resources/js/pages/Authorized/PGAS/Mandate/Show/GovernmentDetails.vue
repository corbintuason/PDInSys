<template>
	<div v-if="mandate!=null">
		<!-- Education Work Section -->
		<government-details :mode="mode" :mandate="mandate"></government-details>
		<hr />
	</div>
</template>

<script>
import governmentDetails from "./GovernmentDetails/GovernmentDetails"
export default {
    data(){
        return{

        }
    },
    props:{
      mandate: Object,
      mode: String
    },
    components:{
      "government-details": governmentDetails,
    }
}
</script>

<style>
</style>