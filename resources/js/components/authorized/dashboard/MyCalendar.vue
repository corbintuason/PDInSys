<template>
    <div>
        <b-card class="calendar-card">
            <div class="column content--column">
                <FullCalendar
                    defaultView="dayGridMonth"
                    :plugins="calendarPlugins"
                    :custom-buttons="customButtons"
                    :header="header"
                    :height="500"
                    :footer="footer"
                />
            </div>
        </b-card>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";

export default {
    components: { FullCalendar },
    data() {
        return {
            calendarEvents: [{ title: "Event Now", start: new Date() }],
            calendarPlugins: [dayGridPlugin],
            height: 0,
            aspectRatio: 0,
            contentHeight: 0,
            selectable: true,
            header: {
                right: "dayGridMonth,dayGridWeek,dayGridDay",
                left: "title"
            },
            footer: {
                center: "prev,today,next"
            }
        };
    }
};
</script>

<style lang="scss">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";

.calendar-card {
    border-radius: 10px;
}
</style>
