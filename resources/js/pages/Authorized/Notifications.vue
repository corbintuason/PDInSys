<template>
    <div>
        <div class="row mt-3">
            <div class="col-md-12">
                <b-card
                    class="text-center notification-card"
                    header-bg-variant="primary"
                    header-text-variant="white"
                >
                    <template v-slot:header>
                        <h1 class="component-title">Notification Center</h1>
                    </template>
                    <b-card-text>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Item</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(notification, notification_index) in user.notifications" :key="notification_index">
                                            <td>{{notification.data.notification_table.project_name}}</td>
                                                                                    <td>{{notification.data.notification_table.item}}</td>
                                                                                                                                <td>{{notification.data.notification_table.status}}</td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </b-card-text>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            user: this.$store.state.user
        }
    },
    methods:{
        
    },
}
</script>