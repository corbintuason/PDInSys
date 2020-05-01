<template>
	<div v-if="mandate!=null">
		<!-- Education Work Section -->
		<other-information :mode="mode" :mandate="mandate"></other-information>
		<hr />
	</div>
</template>

<script>
import otherInformation from "./OtherInformation/OtherInformation"
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
      "other-information": otherInformation,
    }
}
</script>

<style>
</style>