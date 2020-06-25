<template>
<b-form-group>
    <b-input-group>
        <template v-slot:prepend>
            <b-input-group-text
                ><strong class="text-success"
                    >&#8369;</strong
                ></b-input-group-text
            >
        </template>
        <!-- <money disabled class="form-control" :value="getTotalBudgetRequest"></money> -->
        <!-- <v-money :style="{'background-color': backgroundColor}" v-model="value" :disabled="disabled" v-bind="money"></v-money> -->
    </b-input-group>
</b-form-group>

</template>

<script>
import { Money } from "v-money";
export default {
    data() {
        return {
            money: {
                decimal: ".",
                thousands: ",",
                precision: 2,
                masked: false,
            },
        };
    },
    props:{
        value: Number,
        disabled: Boolean
    },
    components: {
        "v-money": Money
    },
    computed:{
        backgroundColor(){
            if(this.disabled){
                return "#e9ecef";
            }
        }
    }
};
</script>
