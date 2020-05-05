<template>
	<b-card class="mt-3">
		<template v-slot:header>
			<h1 class="component-title">Change Logs</h1>
		</template>
		<b-card-body>
			<b-list-group class="scrollable">
				<b-list-group-item v-for="(log, log_index) in logs" :key="log_index">
					<strong>{{log.created_at}} - {{log.log_name}}:</strong>
					{{log.description}}
				</b-list-group-item>
			</b-list-group>
		</b-card-body>
	</b-card>
</template>

<script>
export default{
    data(){
        return{
          
        }
    },
    props:{
        logs: Array
    }
}
</script>
<style>
.scrollable {
	max-height: 300px;
	margin-bottom: 10px;
	overflow: scroll;
	-webkit-overflow-scrolling: touch;
}
</style>