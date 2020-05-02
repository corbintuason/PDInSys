<template>
	<div v-if="mandate!=null">
		<!-- Education Work Section -->
		<general-info :mode="mode" :mandate="mandate"></general-info>
		<hr />
	</div>
</template>

<script>
import generalInfo from "./GeneralInfo/GeneralInfo"
export default {
    data(){
        return{

        }
    },
    props:{
      mandate: Object,
      mode: String,
    },
    components:{
      "general-info": generalInfo,
    }
}
</script>

<style>
</style>