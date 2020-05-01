<template>
	<div v-if="mandate!=null">
		<!-- Education Work Section -->
		<education-work :mode="mode" :mandate="mandate"></education-work>
		<hr />
	</div>
</template>

<script>
import educationWork from "./EducationWork/EducationWork"
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
      "education-work": educationWork,
    }
}
</script>

<style>
</style>