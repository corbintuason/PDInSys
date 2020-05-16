<template>
	<b-card v-if="sorted_logs!=null" class="mt-3">
		<template v-slot:header>
			<h1 class="component-title">Change Logs</h1>
		</template>
		<b-card-body>
			<b-list-group class="scrollable">
				<b-list-group-item variant="primary" v-for="(log, log_index) in sorted_logs" :key="log_index">
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
          sorted_logs: null
        }
    },
    props:{
        logs: Array
	},
	methods:{
		sortLogs(){
			this.sorted_logs = this.logs.sort((a, b) => (a.created_at < b.created_at) ? 1 : -1)

		}
	},
	mounted(){
		this.sortLogs();
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