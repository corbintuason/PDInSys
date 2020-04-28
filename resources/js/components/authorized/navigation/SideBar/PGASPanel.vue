<template>
	<div>
		<div class="pgas-header text-center">
			<a class="text-white">
				<strong>PGAS</strong>
			</a>
		</div>
		<div>
			<ul
				class="nav nav-pills nav-sidebar flex-column"
				data-widget="treeview"
				role="menu"
				data-accordion="false"
			>
				<!-- Admin -->
				<li class="nav-item has-treeview">
					<a v-if="renderSection('Admin')" href="#" class="nav-link">
						<i class="fas fa-user" style="margin-right:10px"></i>
						<p>
							Admin
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li v-if="renderFeature('Admin', 'Companies')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Companies</p>
							</a>
						</li>
						<li v-if="renderFeature('Admin', 'ADM Advisories')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>ADM Advisories</p>
							</a>
						</li>
						<li v-if="renderFeature('Admin', 'Assets')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Assets</p>
							</a>
						</li>
						<li v-if="renderFeature('Admin', 'Vehicles')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Vehicles</p>
							</a>
						</li>
						<li v-if="renderFeature('Admin', 'Warehouses')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Warehouses</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- Accounting -->
				<li class="nav-item has-treeview">
					<a v-if="renderSection('Accounting')" href="#" class="nav-link">
						<i class="fas fa-user" style="margin-right:10px"></i>
						<p>
							Accounting
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li v-if="renderFeature('Accounting', 'Accounts')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Accounts</p>
							</a>
						</li>
						<li v-if="renderFeature('Accounting', 'Vendors')" class="nav-item">
							<router-link :to="{ name: 'vendor_index'}" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Vendors</p>
							</router-link>
						</li>
						<li v-if="renderFeature('Accounting', 'AFG Advisories')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>AFG Advisories</p>
							</a>
						</li>
						<li v-if="renderFeature('Accounting', 'Billing and Collection Monitor')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Billing and Collection Monitor</p>
							</a>
						</li>
						<li v-if="renderFeature('Accounting', 'Budget Allocation')" class="nav-item">
							<router-link :to="{ name: 'budget_allocation_index'}" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Budget Allocation</p>
							</router-link>
						</li>
						<li v-if="renderFeature('Accounting', 'Projected Financial Statements')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Projected Financial Statement</p>
							</a>
						</li>
						<li
							v-if="renderFeature('Accounting', 'Sales, Purchase, and Allowance Register')"
							class="nav-item"
						>
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Sales, Purchase, and Allowance Register</p>
							</a>
						</li>
						<li v-if="renderFeature('Accounting', 'Sales Report')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Sales Report</p>
							</a>
						</li>
						<li v-if="renderFeature('Accounting', 'Payments')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Payments</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- Human Resource -->
				<li class="nav-item has-treeview">
					<a v-if="renderSection('Human Resource')" href="#" class="nav-link">
						<i class="fas fa-user" style="margin-right:10px"></i>
						<p>
							Human Resource
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li v-if="renderFeature('Human Resource', 'HR Advisories')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>HR Advisories</p>
							</a>
						</li>
						<li v-if="renderFeature('Human Resource', 'Mandate')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Manpower Pool</p>
							</a>
						</li>
						<li v-if="renderFeature('Human Resource', 'PDIS')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>PDIS</p>
							</a>
						</li>
						<!-- Add or Modify User collapse -->
						<li v-if="renderFeature('Human Resource', 'Sprout HR')" class="nav-item">
							<a href="#" class="nav-link">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Sprout HR</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.state.user,
            pgos: [],
        };
    },
    methods: {
        loadPGAS() {
            this.pgas.push(
                {
                    section: "Admin",
                    render: this.renderSection([
                    ]),
                    features: [
                        {
                            name: "Companies",
                            link: "company_index",
                        },
                        {
                            name: "ADM Advisories",
                            link: "account_create",
                        },
                        {
                          name: "Assets",
                          link: "asset_index"
                        },
                        {
                          name: "Vehicles",
                          link: "vehicle_index"
                        }
                    ],
                },
                {
                    section: "Project Development",
                    render: this.renderSection([
                        "view-all-projects",
                        "create-projects",
                    ]),
                    features: [
                        {
                            name: "Project List & Status",
                            link: "project_index",
                            render: this.renderFeature("view-all-projects"),
                        },
                        {
                            name: "Create Project",
                            link: "project_create",
                            render: this.renderFeature("create-projects"),
                        },
                        {
                            name: "CE & Bdgt. Mgmt.",
                            link: "",
                            render: this.renderFeature("ce-bdgt-mgmt"),
                        },
                        {
                            name: "Project Reports",
                            link: "",
                            render: this.renderFeature("project-reports"),
                        },
                    ],
                },
                {
                    section: "Project Execution",
                    features: [
                        {
                            name: "Vendors Pool",
                            link: "",
                            render: this.renderFeature("view-all-vendors"),
                        },
                        {
                            name: "Manpower Pool",
                            link: "",
                            render: this.renderFeature("view-all-manpower"),
                        },
                        {
                            name: "Warehouse Management",
                            link: "",
                            render: this.renderFeature("view-all-warehouse"),
                        },
                        {
                            name: "Project Templates",
                            link: "",
                            render: this.renderFeature("view-all-templates"),
                        },
                    ],
                }
            );
        },
        renderSection(features) {
            return this.user.abilities.some((feature) =>
                this.user.abilities.includes(feature)
            );
        },
        renderFeature(feature) {
            var render = false;
            console.log(feature);
            this.user.abilities.forEach((ability) => {
                if (ability.name == feature) {
                    render = true;
                }
            });
            return render;
        },
    },
    mounted() {
        this.loadPGAS();
    },
};
</script>

<style lang="scss" scoped>
.pgas-header {
	background: #f7942c;
	margin: 15px 5px 15px 5px;
	padding: 7px;
	border-radius: 5px;
}
</style>