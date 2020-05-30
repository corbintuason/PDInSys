<template>
    <div>
        <div class="pgas-header text-center">
            <a class="text-white">
                <strong>PGAS</strong>
            </a>
        </div>
        <div>
            <ul
                v-if="pgas.length > 0"
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >
                <!-- Accounts and Clients -->
                <li
                    class="nav-item has-treeview"
                    v-for="(section, section_index) in pgas"
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
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>{{ feature.name }}</p>
                                </router-link>
                            </li>
                        </ul>
                    </template>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            pgas: [],
        };
    },
    computed: {
        ...mapState("auth", {
            user(state) {
                return state.user;
            },
        }),
    },
    methods: {
        loadPGAS() {
            this.pgas.push(
                {
                    section: "Mandate",
                    render: this.renderSection([
                        {
                            ability: "view-all",
                            model: "App\\Mandate",
                        },
                        {
                            ability: "create",
                            model: "App\\Mandate",
                        },
                    ]),
                    features: [
                        {
                            name: "Mandate List",
                            link: "mandate_index",
                            render: this.renderFeature({
                                ability: "view-all",
                                model: "App\\Mandate",
                            }),
                        },
                        {
                            name: "Create Mandate",
                            link: "mandate_create",
                            render: this.renderFeature({
                                ability: "create",
                                model: "App\\Mandate",
                            }),
                        },
                    ],
                },
                {
                    section: "Vendor",
                    render: this.renderSection([
                        {
                            ability: "view-all",
                            model: "App\\Vendor",
                        },
                        {
                            ability: "create",
                            model: "App\\Vendor",
                        },
                    ]),
                    features: [
                        {
                            name: "Vendor List",
                            link: "vendor_index",
                            render: this.renderFeature({
                                ability: "view-all",
                                model: "App\\Vendor",
                            }),
                        },
                        {
                            name: "Create Vendor",
                            link: "vendor_create",
                            render: this.renderFeature({
                                ability: "create",
                                model: "App\\Vendor",
                            }),
                        },
                    ],
                }
            );
        },
        renderSection(abilities) {
            return this.user.abilities.some((ability) => {
                return abilities.some((pgos_ability) => {
                    return (
                        pgos_ability.ability == ability.name &&
                        pgos_ability.model == ability.entity_type
                    );
                });
            });
        },
        renderFeature(ability) {
            return this.user.abilities.some((user_ability) => {
                return (
                    user_ability.ability == ability.name &&
                    user_ability.model == ability.entity_type
                );
            });
        },
    },
    mounted() {
        console.log("hi", this.user);
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
