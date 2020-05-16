<template>
  <div>
    <!-- Current Clients -->
    <current-clients></current-clients>
    <!-- Selected Client -->
  </div>
</template>

<script>
import currentClients from "./ClientsInformation/CurrentClients"
export default {
  data() {
    return {
 
    };
  },
  components: {
    "current-clients": currentClients
  },
  props: {
  },
  watch: {},
  methods: {
  }
};
</script>