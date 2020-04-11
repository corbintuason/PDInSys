<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-2 text-left">
                <b-form-select
                    v-model="perPage"
                    id="perPageSelect"
                    size="sm"
                    :options="pageOptions"
                ></b-form-select>
            </div>
            <div class="col-md-5"></div>
            <div class="text-right col-md-5">
                <b-input-group>
                    <b-form-input
                        type="search"
                        id="filterInput"
                        placeholder="Type to Search"
                    ></b-form-input>
                    <b-input-group-append>
                        <b-button variant="primary">Clear</b-button>
                    </b-input-group-append>
                </b-input-group>
            </div>
        </div>
        <b-card v-for="(activity, activity_index) in activities" :key="activity_index"  class="activity-log-card">
            <div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h5>{{activity.log_name}}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a>{{activity.created_at}}</a>
                    </div>
                </div>

                <p>
                   {{activity.description}}
                </p>
            </div>
        </b-card>
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            totalRows: 1,
            currentPage: 1,
            perPage: 5,
            pageOptions: [5, 10, 15],
            sortBy: "",
            sortDesc: false,
            sortDirection: "asc",
            filter: null,
            filterOn: [],
            activities: null,
        };
    },
    methods:{
            loadActivities() {
            axios.get("/api/activities").then(response => {
                this.activities = response.data;
            })
        },
    },
    mounted(){
        this.loadActivities();
    }
};
</script>

<style lang="scss" scoped>
.activity-log-card {
    border-left: 7px solid #f7942c;
    border-radius: 5px;
}
.activity-log-card-alt {
    border-left: 7px solid #3f4b94;
    border-radius: 5px;
}
</style>
