<template>
<div>
    <label>Pre Releasing Sub Process</label>    
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Process</th>
				<th>Officer</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<tr
				v-for="(sub_process, sub_process_index) in rfp.check_writes[0].sub_process"
				:key="sub_process_index"
			>
				<td>{{ sub_process.names[0] }}</td>
				<td>
					{{sub_process.assigned}}
			
				</td>
				<td>
					Unaccomplished
				</td>
			</tr>
		</tbody>
	</table>
</div>

</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
export default {
	data() {
		return {
			sub_processes: [
				{
					name: "Check Write",
					status: "For Check Writing",
					responsible: null,
				},
				{
					name: "Authorized",
					status: "For Authorization",
					responsible: null,
				},
				{
					name: "Check Print",
					status: "For Printing",
					responsible: null,
				},
				{
					name: "FWD to Releasing",
					status: "For Releasing",
					responsible: null,
				},
			],
		};
    },
    props:{
        namespace: String
    },
    computed:{
        ...mapState({
            rfp(state){
                return state[this.namespace].item
            },  
            check_write(){
                return this.rfp.check_write;
            }
        })
    }
};
</script>