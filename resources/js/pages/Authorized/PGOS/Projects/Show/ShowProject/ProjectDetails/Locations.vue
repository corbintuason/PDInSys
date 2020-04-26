<template>
    <div>
        <label> Locations </label>
        <b-input-group
            v-for="(location, location_index) in project.locations"
            :key="location_index"
        >
            <b-input
                type="text"
                :disabled="mode=='Show'"
                v-model="project.locations[location_index]"
            ></b-input>
            <b-input-group-append v-if="mode=='Edit'">
                <b-button
                    variant="outline-danger"
                    :disabled="location_index == 0"
                    @click="removeRow(project.locations, value_index)"
                >
                    <i class="fas fa-trash"></i>
                </b-button>
            </b-input-group-append>
        </b-input-group>
        <b-button
            v-if="mode=='Edit'"
            variant="outline-primary"
            block
            @click="addRow(project.locations)"
            >Add Location</b-button
        >
    </div>
</template>
<script>
import form from "../../../../../../../mixins/form";
export default{
    data(){
        return{}
    },
    props:{
        project: Object,
        mode: String
    },
    mixins:[form]
}

</script>