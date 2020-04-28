<template>
    <div>
        <!-- Organization Chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="tree">
                    <tree-menu
                        :positions="positions"
                        :select-position="selectPosition"
                    ></tree-menu>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <b-alert
                    v-if="new_user.positions.length < 0"
                    show
                    variant="danger"
                    >No Positions have been selected</b-alert
                >
                <template v-else>
             <b-card
              
                    v-for="(position, position_index) in new_user.positions" :key="position_index"
                    class="mb-0"
                >
                <template v-slot:header>
                    {{position.name}}
                    <span class="float-right"><i class="far fa-times-circle red clickable" @click="removePosition(position_index)"></i></span>
                </template>
                    <b-card-text>
                        <strong>Job Level:</strong>

                        <b-form-select
                            v-model="position.job_level"
                            :options="job_levels"
                        ></b-form-select>
                    </b-card-text>
                </b-card>
                </template>
   
            </div>
            {{ new_user }}
        </div>
    </div>
</template>

<script>
import treeMenu from "./treeMenu";
export default {
    data() {
        return {
            positions: this.$store.state.globals.positions,
            job_levels: this.$store.state.globals.job_levels,
            selected_position: null,
        };
    },
    props: {
        new_user: Object,
    },
    components: {
        treeMenu,
    },
    methods: {
        selectPosition(position) {
            console.log(position);
            this.new_user.positions.push({
                name: position.name,
                job_level: null
            })
        },
        removePosition(index){
            this.new_user.positions.splice(index, 1);
        }
    },
};
</script>

<style>
.clickable{
    cursor: pointer;
}
.tree ul {
    padding-top: 20px;
    position: relative;

    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

.tree li {
    float: left;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;

    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before,
.tree li::after {
    content: "";
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 1px solid orange;
    width: 50%;
    height: 20px;
}
.tree li::after {
    right: auto;
    left: 50%;
    border-left: 1px solid orange;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after,
.tree li:only-child::before {
    display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child {
    padding-top: 0;
}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before,
.tree li:last-child::after {
    border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before {
    border-right: 1px solid orange;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after {
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 1px solid orange;
    width: 0;
    height: 20px;
}

.tree li a {
    border: 1px solid orange;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;

    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;

    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover {
    background: #2a8eba;
    color: white;
    border: 1px solid #94a0b4;
}

.tree li .active{
   background: #2a8eba;
    color: white;
    border: 1px solid #94a0b4;
}
</style>
