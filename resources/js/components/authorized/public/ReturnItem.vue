<template>
    <b-modal id="return-item" size="lg">
        <template v-slot:modal-title> Return {{ item_model }} </template>
        <div class="modal-body">
            Please select the user to return the {{item_model}} to 
            <contribution-list :front_steps="front_steps" :involved_users="item.involved_users" :mode="mode" @return-item="returnItem"></contribution-list>

            <!-- Remarks -->
            <label class="mt-2">Remarks</label>
            <b-form-input type="text" v-model="return_to_user.remarks"></b-form-input>
        </div>
        
        <template v-slot:modal-footer>
            <b-button variant="outline-success" :disabled="return_to_user==null">Return {{item_model}}</b-button>
        </template>
    </b-modal>
</template>

<script>
import contributionList from "./ContributionList";
export default {
    data() {
        return {
            mode: "Return",
            return_to_user:{
                user: null,
                remarks: null
            },
            users:[],
        };
    },
    props: {
        item: Object,
        item_model: String,
        front_steps: Array,
    },
    components:{
        "contribution-list": contributionList
    },
    methods: {
        returnItem(item){
           this.return_to_user.user = item;
        },
        loadInvolvedUsers() {
            console.log("wheez");
            this.item.involved_users.forEach(involved_user => {
                axios.get("/api/user/" + involved_user.id).then(response => {
                    console.log(response);
                    this.users.push({
                        id: response.data.data.id,
                        responsibility: involved_user.type,
                        name: response.data.meta.full_name
                    });
                })
            });
        },
    },
    mounted() {
        this.loadInvolvedUsers();
    },
};
</script>
