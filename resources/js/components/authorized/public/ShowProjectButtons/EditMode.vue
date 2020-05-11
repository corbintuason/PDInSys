<template>
<b-button-group class="float-right">
    <b-button variant="outline-danger" @click="discardChanges">Discard Changes</b-button>
        <b-button variant="outline-success" @click="saveChanges">{{action_name}}</b-button>
</b-button-group>
</template>

<script>
import form from "../../../../mixins/form";
import steps from "../../../../mixins/steps";
export default{
    data(){
        return{
            next_step: this.getNextStep(this.current_step, this.steps)
        }
    },
    props:{
        item: Object,
        item_model: String,
        steps: Array,
        endpoints: Object,
        action_name: String,
        uploadable: Boolean,
        current_step: Object
    },
    action_name() {
            return this.current_step
                ? this.current_step.name + " " + this.item_model
                : "awit";
    },
    mixins:[form, steps],
    methods:{
        saveChanges(){
            var swal_object = {
                title: "Save Changes to " + this.item.code + "?",
                text: "Doing so will also set its status to " + this.next_step.database_equivalent[0],
                confirmButtonText: "Save Changes",
                endpoints: this.endpoints,
                item: this.item
            };
            if(this.uploadable){
            this.fireSaveChangesWithFileSwal(swal_object);
            }else{
                this.fireSaveChangesSwal(swal_object);
            }
        },
        discardChanges(){
            Fire.$emit("switch-mode-"+this.item.id, 'Show');
        }
    }
}
</script>