<template>
    <ul v-if="positions!=null">
        <li
            v-for="(position, position_index) in positions"
            :key="position_index"
        >
            <a @click="selectPosition(position)">
                {{ position.name }}
            </a>
            <tree-menu :positions="position.positions" :select-position="selectPosition"></tree-menu>
        </li>
    </ul>
</template>
<script>
export default {
    props:{
      positions: Array,
      selectPosition: Function
    },
    name: "tree-menu",
    methods: {
   
    },
};
</script>
