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
import {mapState} from "vuex";
export default{
    data(){
        return{
        }
	},
	computed:{
		...mapState({
			sorted_logs(state){
				return state[this.namespace].item.actions.sort((a, b) => (a.created_at < b.created_at) ? 1 : -1)
			}
		})
	},
    props:{
        namespace: String
	},
	methods:{
	},
	mounted(){
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