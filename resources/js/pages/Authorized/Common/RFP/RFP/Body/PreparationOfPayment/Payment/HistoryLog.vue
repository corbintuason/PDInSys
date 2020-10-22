<template>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Process</th>
				<th>Officer</th>
				<th>Date and Time</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(log, log_index) in payment.history_logs" :key="log_index">
				<td>{{log.process}}</td>
				<td>{{log.officer}}</td>
				<td>
					<span v-if="log.date_time == null" class="red">Unprocessed</span>
					<span v-else class="green">{{log.date_time}}</span>

				</td>
			</tr>
			<!-- <tr>
						<td>Disbursement</td>
						<td>Bengie</td>
						<td>For Disbursement</td>
						<td>	<b-button
								variant="outline-primary"
								v-if="hasAbility"
								@click="releaseCashClick"
								>{{ current_step.action }}</b-button
							></td>
					</tr>
					<tr>
						<td>Acknowledgement</td>
						<td>Creator</td>
						<td>For Acknowledgement</td>
						<td>	<b-button
								variant="outline-primary"
								v-if="hasAbility"
								@click="releaseCashClick"
								>Acknowledge</b-button
							></td>
					</tr> -->
		</tbody>
	</table>
</template>

<script>
export default{
	data(){
		return{

		}
	},
	props:{
		payment: Object
	}
}
</script>