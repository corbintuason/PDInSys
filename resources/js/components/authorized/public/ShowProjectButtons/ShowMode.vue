<template>
    <b-button-group v-if="current_step != null && has_ability" class="float-right">
        <b-button
            @click="changeShowRejectModal"
            class="float-right"
            variant="outline-danger"
            >Reject</b-button
        >

        <!-- Edit Project -->
        <b-button
            v-if="editable"
            @click="editButton"
            class="float-right"
            variant="outline-dark"
            >Edit</b-button
        >
        <b-button
            @click="changeShowReturnModal"
            variant="outline-dark"
            >Return</b-button
        >
        <b-button
            @click="updateStatus"
            variant="outline-success"
            >{{current_step.name}}</b-button
        >

        <return-item :namespace="namespace"></return-item>
        <reject-item :namespace="namespace"></reject-item>
    </b-button-group>
</template>

<script>
import form from "../../../../mixins/form";
import steps from "../../../../mixins/steps";
import returnItem from "../ReturnItem";
import rejectItem from "../RejectItem";
import { mapMutations, mapState, mapActions } from "vuex";
export default {
    data() {
        return {
            has_ability: null
        };
    },
    props: {
        namespace: String,
        editable: Boolean
    },
    mixins: [form, steps],
    components: {
        "return-item": returnItem,
        "reject-item": rejectItem,
    },
    computed: {
        ...mapState({
            user(state){
                return state["auth"].user;
            },
            name(state) {
                return state[this.namespace].name;
            },
            item(state) {
                return state[this.namespace].item;
            },
            model(state){
                return state[this.namespace].model;
            },
            steps(state, getters) {
                return getters[this.namespace + "/steps"];
            },
            mode(state, getters) {
                return state[this.namespace].mode;
            },
            endpoints(state, getters) {
                return getters[this.namespace + "/getEndpoints"];
            },
            current_step(state, getters) {
                return getters[this.namespace + "/getCurrentStep"];
            },
            // hasRole(state, getters){
            //     return getters["auth/hasRole"](this.item.current_handler);
            // }
            // hasAbility(state, getters){
            //     console.log(this.item.current_handler, "???");
            //     return getters["auth/hasAbility"](this.item.current_handler, this.item.id);    
            // }
        }),
    },
    methods: {
       	loadHasAbility(){
               console.log("Hi im checking ability");
               console.log(this.item.current_handler);
			axios.put('/api/bouncer/hasAbility', {
                ability: this.item.current_handler.ability,
                model: this.model,
                model_id: this.item.id
            }).then(response => {
                console.log("response?");
                console.log(response.data.value);
				this.has_ability = response.data.value;
				console.log(this.has_ability)
            })
		},
        ...mapMutations({
            changeMode(commit, payload) {
                return commit(this.namespace + "/changeMode", "Edit");
            },
            changeShowReturnModal(commit, payload) {
                return commit(this.namespace + "/changeShowReturnModal", true);
            },
            changeShowRejectModal(commit, payload) {
                return commit(this.namespace + "/changeShowRejectModal", true);
            },
        }),
        ...mapActions({
                updateStatus(dispatch, payload) {
                return dispatch(this.namespace+"/updateItem", payload);
            },
        }),
        // updateStatus() {
        //     var swal_html = this.loadSwalContents(
        //         this.steps,
        //         this.user,
        //         this.item
        //     );
        //     const swal_object = {
        //         title: this.current_step.name + " " + this.item.code,
        //         html: swal_html,
        //         confirmButtonText: this.current_step.name,
        //         endpoints: this.endpoints,
        //     };
        //     this.fireUpdateSwal(swal_object, this.item);
        // },

        editButton() {
            swal.fire({
                title: "Would you like to switch to Edit Mode?",
                icon: "question",
                confirmButtonText: "Edit",
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "Successfully switched to Edit Mode",
                        icon: "success",
                        onClose: () => {
                            this.changeMode();
                        },
                    });
                }
            });
        },
        rejectButton() {},

        returnItem() {},
    },
    mounted() {
        this.loadHasAbility();
    },
};
</script>
