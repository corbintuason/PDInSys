<template>
	<b-card class="mt-3">
		<template v-slot:header>
			<h1 class="component-title">Change Logs</h1>
		</template>
		<b-card-body>
			<b-alert show variant="primary" v-for="(log, log_index) in logs" :key="log_index">
				<div>
					<h5>
						<strong>{{log.log_name}}</strong>
					</h5>
				</div>
				<div class="ml-3 mt-3 mb-3">
					<strong>{{log.description}}</strong>
				</div>
				<div class="text-right">
					<strong>{{log.created_at}}</strong>
				</div>
			</b-alert>
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