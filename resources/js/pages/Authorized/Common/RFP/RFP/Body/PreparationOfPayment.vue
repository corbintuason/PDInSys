<template>
<div>
    <div class ="row">
        <!-- Down Payment -->
        <div class="col-md-6">
            <label>Down Payment</label>
            <hr>
            <!-- Check Writing -->
            <div v-if="renderCheckWriting(rfp.term_of_payment.down_payment)" class="check-writing">
            <label>Check Writing Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Check Write</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Authorized</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Check Print</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>FWD To Releasing</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>
            </div>
       
            <!-- Cash Release -->
        <div v-else class="cash-release-dp">
          <label>Cash Release Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Thru</th>
                        <th>BDO Ref. No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Online Release</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-form-input></b-form-input></td>
                    </tr>
                </tbody>
            </table>
            </div>
  
        </div>



        <!-- Full Payment -->
               <div class="col-md-6">
            <label>Full Payment</label>
            <hr>
            <!-- Check Writing -->
            <div v-if="renderCheckWriting(rfp.term_of_payment.full_payment)" class="check-writing">
            <label>Check Writing Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Check Write</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Authorized</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Check Print</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>FWD To Releasing</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>
            </div>
       
            <!-- Cash Release -->
        <div v-else class="cash-release-dp">
          <label>Cash Release Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Thru</th>
                        <th>BDO Ref. No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Online Release</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-form-input></b-form-input></td>
                    </tr>
                </tbody>
            </table>
            </div>
  
        </div>
    </div>



    <!-- <div class="row">
        <div class="col-md-6">
            <label>Check Writing Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Check Write</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Authorized</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Check Print</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>FWD To Releasing</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <label>Check Writing Checklist</label>
                    <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Check Write</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Authorized</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>Check Print</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                    <tr>
                        <td>FWD To Releasing</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <label>Cash Release Checklist</label>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Online Release</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-md-6">
            <label>Cash Release Checklist</label>
                   <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Online Release</td>
                        <td><b-form-select></b-form-select></td>
                        <td><b-datepicker size="sm"></b-datepicker></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> -->
</div>
</template>

<script>
import {mapState, mapActions, mapMutations, mapGetters} from "vuex"

export default{
    data(){
        return{

        }
    },
    props:{
        namespace: String
    },
    computed:{
        ...mapState({
                rfp(state){
                return state[this.namespace].item
			},
        })
    },
    methods:{
        renderCheckWriting(term_of_payment){
            if(term_of_payment.mode_of_payment=="Check"){
                return true;
            }else return false;
        },
    }
}
</script>