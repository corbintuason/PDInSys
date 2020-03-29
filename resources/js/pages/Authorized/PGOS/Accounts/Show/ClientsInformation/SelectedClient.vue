<template>
  <b-modal id="selected-client" size="lg">
    <template v-slot:modal-title>{{selected_client.salutation}} {{selected_client.last_name}}, {{selected_client.first_name}}</template>
    <div class="d-block text-center">
      <h3></h3>
    </div>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    selected_client: Object
  }
};
</script>