<template>
	<div>
		<!-- Row 1: Vendor Name, Date Today -->
		<div class="row">
			<!-- Vendor Name -->
			<b-form-group
				:disabled="mode=='Show'"
				label="Registered Vendor Name:"
				label-class="font-weight-bold"
				label-cols="3"
				class="col-md-8"
			>
			<!-- Search Trade Name -->
				<b-input-group size="sm">
					<b-form-input
						v-model="search_vendor"
						debounce="300"
						@focus="is_vendor_search_focused = true"
						@blur="is_vendor_search_focused = false"
						@update="searchVendor"
						@input="isSearchingVendor = true;"
					></b-form-input>

					<!-- <template v-if="isSearchingVendor" v-slot:append>
						<b-input-group-text>
							<clip-loader></clip-loader>
						</b-input-group-text>
					</template> -->
				</b-input-group>
				<b-alert class="overlap" v-if="isSearchingVendor" show variant="primary"> <i> Searching </i>...</b-alert>

				<!-- Search Results -->
				<div class="overlap" v-if="displayVendors">
					<b-list-group v-if="searched_vendors.length >0">
						<b-list-group-item
							v-for="(vendor, vendor_index) in searched_vendors"
							:key="vendor_index"
							href="#"
							@click="selectVendor(vendor)"
						>{{vendor.vendor_name}}</b-list-group-item>
					</b-list-group>
					<b-alert v-else show variant="danger">No Results found for {{search_vendor}}</b-alert>
				</div>
			</b-form-group>

			<!-- Date Today -->

			<b-form-group
				label="Date of RFP:"
				label-class="font-weight-bold"
				label-cols="4"
				class="col-md-4"
			>
				<b-input-group size="sm">
					<b-datepicker disabled :value="getDateToday" initial-date></b-datepicker>
				</b-input-group>
			</b-form-group>
		</div>

		<!-- Row 2: Registered Trade Name -->
		<div class="row">
			<b-form-group
				label="Registered Trade Name:"
				label-class="font-weight-bold"
				label-cols="3"
				class="col-md-8"
			>
				<b-input-group size="sm">
					<b-form-input disabled :value="vendor ? vendor.trade_name : ''"></b-form-input>
				</b-input-group>
			</b-form-group>
		</div>
		<!-- Row 3: Registered Vendor Address -->
		<div class="row">
			<b-form-group
				label="Registered Vendor Address:"
				label-class="font-weight-bold"
				label-cols="3"
				class="col-md-8"
				description="Unit No., Floor, Bldg, No. Street, Village/Subdivision"
			>
				<b-input-group size="sm">
					<b-form-input disabled :value="first_address"></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- Brgy -->
			<b-form-group class="col-md-3" description="Barangay">
				<b-input-group size="sm">
					<b-form-input disabled :value="vendor ? vendor.registered_address.barangay : ''"></b-form-input>
				</b-input-group>
			</b-form-group>

			<!-- City/Municipality -->
			<b-form-group class="col-md-3" description="City/Municipality">
				<b-input-group size="sm">
					<b-form-input disabled :value="vendor ? vendor.registered_address.city : ''"></b-form-input>
				</b-input-group>
			</b-form-group>

			<!-- City/Municipality -->
			<b-form-group class="col-md-3" description="Province">
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- City/Municipality -->
			<b-form-group class="col-md-3" description="ZIP Code">
				<b-input-group size="sm">
					<b-form-input disabled :value="vendor ? vendor.registered_address.zip_code : ''"></b-form-input>
				</b-input-group>
			</b-form-group>
		</div>

		<!-- Row 4: Tin No. -->
		<div class="row">
			<b-form-group
				label="Registered Vendor TIN No:"
				label-class="font-weight-bold"
				label-cols="3"
				class="col-md-8"
			>
				<b-input-group size="sm">
					<b-form-input disabled :value="vendor ? vendor.tin_number : ''"></b-form-input>
				</b-input-group>
			</b-form-group>
		</div>
		<!-- Row 5: Requestor (Logged-in User), Group, Department -->
		<div class="row">
			<!-- Name -->
			<b-form-group
				label="Requestor"
				label-class="font-weight-bold"
				label-cols="2"
				class="col-md-4"
				description="Full Name"
			>
				<b-input-group size="sm">
					<b-form-input disabled :value="user.data.full_name"></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- Group -->
			<b-form-group class="col-md-4" description="Group">
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- Group -->
			<b-form-group class="col-md-4" description="Department">
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
		</div>
		<!-- Row 6: Budget Code/ Project Name, CEPD (if applicable), verseion (if applicable)  -->
		<div class="row">
			<b-form-group
				label="Budget Code / Project Name"
				label-class="font-weight-bold"
				label-cols="3"
				class="col-md-4"
			>
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- CEPD -->
			<b-form-group label="CEPD" label-class="font-weight-bold" label-cols="3" class="col-md-4">
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
			<!-- Version -->
			<b-form-group label="Version" label-class="font-weight-bold" label-cols="3" class="col-md-4">
				<b-input-group size="sm">
					<b-form-input disabled></b-form-input>
				</b-input-group>
			</b-form-group>
		</div>
	</div>
</template>

<script>
import {mapState, mapActions, mapMutations, mapGetters} from "vuex"
import common from "../../../../../../mixins/common"
export default{
    data(){
        return{
            isSearchingVendor: false,
            search_vendor: "",
            is_vendor_search_focused: false,
            searched_vendors: [],
        }
	},
	props:{
		namespace: String
	},
	mixins:[common],
    computed:{
        ...mapState("auth", {
                user: state => state.user
		}),
		...mapState({
            mode(state){
                return state[this.namespace].mode
			},
			rfp(state){
				return state[this.namespace].item
			},
			vendor(state){
				return state[this.namespace].item.vendor
			},
            loading(state){
                return state[this.namespace].loading
            }
		}),
		
        displayVendors(){
            // this.is_vendor_searched_focused has a bug that does not respect the overflowing elements
            if(this.vendor == null){
                if(!this.isSearchingVendor && this.search_vendor.length > 0){
                    return true;
                }else{
                    return false;
                }
            } else {
                return false;
            }
       
        },
        first_address(){
                        // "Unit No., Floor, Bldg, No. Street, Village/Subdivision"
                        // {"no_st_bldg":"qwe","barangay":null,"city":"qwe","zip_code":"qwe","brgy":"qwe"}
            if(this.vendor!=null){
                var registered_address = this.vendor.registered_address;
                return registered_address.no_st_bldg;
            }else{
                return "";
            }
        },
       
    },
    methods:{
           ...mapActions({
                 selectVendor(dispatch, vendor){
                return dispatch(this.namespace+"/selectVendor", vendor);
            }
        }),
        searchVendor(){
            this.selectVendor(null);
            axios.get('/api/vendor', {
                params:{
                    vendor_name: this.search_vendor,
                    status: "Approved"
                }
            }).then(response => {
                this.searched_vendors = response.data.data;
                this.isSearchingVendor = false;
                console.log(this.searched_vendors);
            });
        },
     
    }
}
</script>


<style>
.overlap {
	position: absolute;
	z-index: 100;
}
</style>