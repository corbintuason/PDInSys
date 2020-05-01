<template>
	<b-container fluid>
		<!-- User Interface controls -->
		<b-row>
			<b-col md="6" lg="6" class="my-1">
				<b-form-group label-for="perPageSelect" class="mb-0 col-md-2">
					<b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select>
				</b-form-group>
			</b-col>

			<b-col sm="5" md="6" class="my-1 text-right">
				<b-form-group class="mb-0 col-md-12">
					<b-button variant="primary">
						<i class="fas fa-sync"></i>
					</b-button>
				</b-form-group>
			</b-col>

			<b-col lg="6" class="my-1">
				<b-form-group label-size="sm" class="mb-0 col-md-5">
					<b-input-group size="sm">
						<b-form-input v-model="filter" type="search" id="filterInput" placeholder="Type to Search"></b-form-input>
						<b-input-group-append>
							<b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
						</b-input-group-append>
					</b-input-group>
				</b-form-group>
			</b-col>
			<b-col lg="6" class="my-1 text-right">
				<!-- <b-form-group class="col-md-12">
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
				</b-form-group>-->
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
				<b-button variant="primary" @click="row.toggleDetails" class="mr-2 text-white">
					<i class="far fa-eye"></i>
				</b-button>
				<b-button variant="info" @click="row.toggleDetails" class="mr-2 text-white">
					<i class="fas fa-pencil-alt"></i>
				</b-button>
				<b-button variant="danger" @click="row.toggleDetails" class="mr-2 text-white">
					<i class="fas fa-trash-alt"></i>
				</b-button>
			</template>
			<template v-slot:cell(code)="data">
				<!-- {{data}} -->
				<router-link
					:to="{
                        name: data.item.item_params.link,
                        params: { id: data.item.item_params.id }
                    }"
				>{{ data.item.code }}</router-link>
			</template>
		</b-table>
		<div class="row">
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
            perPage: 10,
            pageOptions: [10, 15],
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
// * {
//     font-family: "Nunito";
// }
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
