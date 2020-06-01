<template>
<div>
    <div class="row">
        <!-- Document Number -->
        <b-form-group disabled label="Document No." label-class="font-weight-bold" class="col-md-3">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- CE Number -->
          <b-form-group disabled label="CE No." label-class="font-weight-bold" class="col-md-3">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- Version -->
          <b-form-group disabled label="Version" label-class="font-weight-bold" class="col-md-3">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- Date of Submission -->
      <b-form-group disabled label="Date of Submission" label-class="font-weight-bold" class="col-md-3">
            <b-input-group size="sm">
             <b-form-datepicker disabled id="example-datepicker" :value="getDateToday" class="mb-2"></b-form-datepicker>
            </b-input-group>
        </b-form-group>


        <!-- Project Name -->
           <b-form-group label="Project Name" label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
                <b-form-input disabled :value="getParentName"></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- Account Manager -->
           <b-form-group label="Account Manager" disabled label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- BR Coverage Date (Editable) -->
        <b-form-group  label="BR Coverage Date" label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
             <b-form-datepicker :disabled="mode=='Show'" :value="budget_request.start_date" @input="setStartDate" class="mb-2"></b-form-datepicker>
             <b-form-datepicker :disabled="mode=='Show'" :value="budget_request.end_date" @input="setEndDate" class="mb-2"></b-form-datepicker>
            </b-input-group>
        </b-form-group>


        <!-- BR Requestor -->
           <b-form-group disabled label="BR Requestor" label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- AFG Counterpart -->
            <b-form-group disabled label="AFG Counterpart" label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
        <!-- BR Liquidator and Fund Recepient -->
            <b-form-group disabled label="BR Liquidator and Fund Recepient" label-class="font-weight-bold" class="col-md-4">
            <b-input-group size="sm">
                <b-form-input></b-form-input>
            </b-input-group>
        </b-form-group>
    </div>
</div>
</template>

<script>
import common from "../../../../../../../mixins/common"
import {mapState, mapGetters, mapActions, mapMutations} from "vuex"
export default{
    data(){
        return{
        }
    },
    computed:{
        ...mapState("show-budget-request", {
            budget_request: state => state.item,
            mode: state => state.mode
        }),
        ...mapGetters("show-budget-request", ["getParentName"])
    },
    mixins:[common],
    methods:{
        ...mapMutations("show-budget-request", {
                 setStartDate(commit, start_date){
                     console.log("eh?");
                return commit("setStartDate", start_date);
            },
             setEndDate(commit, end_date){
                return commit("setEndDate", end_date);
            }
        })
    },
}
</script>