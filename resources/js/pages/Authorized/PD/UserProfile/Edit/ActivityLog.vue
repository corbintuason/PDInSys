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
        <b-card class="activity-log-card">
            <div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h5>Cost Estimate</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a>March 28,2020</a>
                    </div>
                </div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqu.
                </p>
            </div>
            <div class="text-right">
                <a>2 mins ago</a>
            </div>
        </b-card>

        <b-card class="activity-log-card-alt">
            <div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h5>Project Creation</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a>March 28,2020</a>
                    </div>
                </div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqu.
                </p>
            </div>
            <div class="text-right">
                <a>6 hours ago</a>
            </div>
        </b-card>

        <b-card class="activity-log-card">
            <div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h5>Budget Request</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a>March 27,2020</a>
                    </div>
                </div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqu.
                </p>
            </div>
            <div class="text-right">
                <a>1 day ago</a>
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
            filterOn: []
        };
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
