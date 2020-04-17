<template>
    <div>
        <div class="sidebar-header">
            <div class="pgos-header text-center">
                <a class="text-white">
                    <strong>PGOS</strong>
                </a>
            </div>
            <div>
                <ul
                    v-if="pgos.length > 0"
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Accounts and Clients -->
                    <li
                        class="nav-item has-treeview"
                        v-for="(section, section_index) in pgos"
                        :key="section_index"
                    >
                        <template v-if="section.render">
                            <a href="#" class="nav-link">
                                <i
                                    class="fas fa-cog"
                                    style="margin-right: 10px;"
                                ></i>
                                <p>
                                    {{ section.section }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul
                                class="nav nav-treeview sidebar-links"
                                style="display: none;"
                            >
                                <li
                                    v-for="(feature,
                                    feature_index) in section.features"
                                    :key="feature_index"
                                    class="nav-item"
                                >
                                    <router-link
                                        v-if="feature.render"
                                        :to="{ name: feature.link }"
                                        class="nav-link"
                                    >
                                        <i
                                            class="far fa-dot-circle nav-icon"
                                        ></i>
                                        <p>{{ feature.name }}</p>
                                    </router-link>
                                </li>
                            </ul>
                        </template>
                    </li>
                </ul>
            </div>
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
        loadPGOS() {
            this.pgos.push(
                {
                    section: "Accounts and Clients",
                    render: this.renderSection([
                        "view-view-accounts",
                        "view-account-and-client-accreditation",
                    ]),
                    features: [
                        {
                            name: "View Accounts",
                            link: "account_index",
                            render: this.renderFeature('view-view-accounts')
                        },
                        {
                            name: "Account & Client Accred.",
                            link: "account_create",
                            render: this.renderFeature('view-account-and-client-accreditation')
                        },
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
               features.includes(feature.name)
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
        this.loadPGOS();
    },
};
</script>

<style lang="scss" scoped>
.pgos-header {
    background: #3f4b94;
    margin: 15px 5px 15px 5px;
    padding: 7px;
    border-radius: 5px;
}
</style>
