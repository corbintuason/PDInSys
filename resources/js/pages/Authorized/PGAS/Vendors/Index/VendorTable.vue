<template>
    <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
            <b-col md="6" lg="6" class="my-1"
                ><b-form-group label-for="perPageSelect" class="mb-0 col-md-2">
                    <b-form-select
                        v-model="perPage"
                        id="perPageSelect"
                        size="sm"
                        :options="pageOptions"
                    ></b-form-select> </b-form-group
            ></b-col>

            <b-col sm="5" md="6" class="my-1 text-right">
                <b-form-group class="mb-0 col-md-12">
                    <b-button variant="primary"
                        ><i class="fas fa-sync"></i
                    ></b-button>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group label-size="sm" class="mb-0 col-md-5">
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Type to Search"
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''"
                                >Clear</b-button
                            >
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col lg="6" class="my-1 text-right">
                <b-form-group class="col-md-12">
                    <router-link
                        class="text-white"
                        :to="{ name: 'vendor_create' }"
                    >
                        <b-button variant="success"
                            ><i class="fas fa-plus">
                                Create Vendor
                            </i></b-button
                        >
                    </router-link>
                </b-form-group>
            </b-col>
        </b-row>

        <!-- Main table element -->
        <b-table
            show-empty
            striped
            hover
            stacked="md"
            :items="items"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filterIncludedFields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            @filtered="onFiltered"
        >
            <template v-slot:cell(action)="row">
                <b-button
                    variant="primary"
                    @click="row.toggleDetails"
                    class="mr-2 text-white"
                >
                    <i class="far fa-eye"></i>
                </b-button>
                <b-button
                    variant="info"
                    @click="row.toggleDetails"
                    class="mr-2 text-white"
                >
                    <i class="fas fa-pencil-alt"></i>
                </b-button>
                <b-button
                    variant="danger"
                    @click="row.toggleDetails"
                    class="mr-2 text-white"
                >
                    <i class="fas fa-trash-alt"></i>
                </b-button>
            </template>
            <template v-slot:cell(item_details.name)="data">
                <!-- `data.value` is the value after formatted by the Formatter -->
                <router-link
                    :to="{
                        name: data.item.item_params.link,
                        params: { id: data.item.item_params.id }
                    }"
                >
                    {{ data.item.item_name }}
                </router-link>
            </template>
        </b-table>
        <div class="row">
            <!-- <div class="col-md-2 col-sm-2 text-left">
                <b-button variant="dark" size="sm" v-b-modal.modal-1>
                    View Logs
                </b-button>
                <b-modal id="modal-1" title="Vendors Log">
                    <div class="row mb-3">
                        <div class="col-md-2 text-left">
                            <b-form-select
                                v-model="perPage"
                                id="perPageSelect"
                                size="sm"
                                :options="pageOptions"
                            ></b-form-select>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="text-right col-md-7">
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
                    <b-card class="log-card">
                        <div class="row">
                            <div class="col-md-8 text-left">ABC 123</div>
                            <div class="col-md-4 text-right">
                                10 seconds ago
                            </div>
                        </div>
                    </b-card>
                    <b-card class="log-card-alt">
                        <div class="row">
                            <div class="col-md-8 text-left">DEF 456</div>
                            <div class="col-md-4 text-right">
                                3 hrs ago
                            </div>
                        </div>
                    </b-card>
                    <b-card class="log-card">
                        <div class="row">
                            <div class="col-md-8 text-left">HIJ 789</div>
                            <div class="col-md-4 text-right">
                                1 day ago
                            </div>
                        </div>
                    </b-card>
                    <b-card class="log-card-alt">
                        <div class="row">
                            <div class="col-md-8 text-left">KLM 123</div>
                            <div class="col-md-4 text-right">
                                2 weeks ago
                            </div>
                        </div>
                    </b-card>
                    <b-card class="log-card">
                        <div class="row">
                            <div class="col-md-8 text-left">NOP 456</div>
                            <div class="col-md-4 text-right">
                                1 month ago
                            </div>
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
                </b-modal>
            </div> -->
            <div class="col-md-9"></div>
            <b-col class="my-1" sm="3" md="3">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
        </div>
    </b-container>
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
    },
    props: {
        items: Array,
        fields: Array
    },
    computed: {
        sortOptions() {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key };
                });
        }
    },
    mounted() {
        // Set the initial number of items
        this.totalRows = this.items.length;
    },
    methods: {
        info(item, index, button) {
            this.infoModal.title = `Row index: ${index}`;
            this.infoModal.content = JSON.stringify(item, null, 2);
            this.$root.$emit("bv::show::modal", this.infoModal.id, button);
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        }
    }
};
</script>

<style lang="scss">
.log-card {
    border-left: 7px solid #3f4b94;
    border-radius: 5px;
    box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.2s ease-out;

    &:hover {
        transform: translateY(4px);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
    }
}
.log-card-alt {
    border-left: 7px solid #f7942c;
    border-radius: 5px;
    box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.2s ease-out;

    &:hover {
        transform: translateY(4px);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
    }
}
</style>
