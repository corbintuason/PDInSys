<template>
  <b-card bg-variant="light" header="Light" class="text-center">
    <template v-slot:header>
      <h1 class="component-title">My Schedule</h1>
    </template>
    <b-card-body>
      <calendar :plugins="calendarPlugins"></calendar>
    </b-card-body>
  </b-card>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
export default {
  data() {
    return {
      items: null,
      fields: null,
            calendarPlugins: [ dayGridPlugin ]
    };
  },

  components:{
    "calendar": FullCalendar
  },
  methods: {
      loadItemsFields(){
           this.items = [
        ],
        this.fields = [

        ];
      }
  },
  mounted() {
      this.loadItemsFields();
  }
};
</script>