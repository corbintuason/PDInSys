import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        offices: [
            {
                name: "PGOS",
                groups: [
                    {
                        name: "Sales and Operations Group",
                        departments: [
                            {
                                name: "Accounts and Business Development",
                                positions: [
                                    {
                                        name:
                                            "Head - Accounts & Business Development",
                                    },
                                    { name: "Senior Accounts Manager" },
                                    { name: "Accounts Manager" },
                                ],
                            },
                            {
                                name: "Project Execution",
                                positions: [
                                    {
                                        name:
                                            "Head - Project Execution Department",
                                    },
                                    {
                                        name:
                                            "Assoc. Head - Project Execution Department",
                                    },
                                    { name: "Project Manager" },
                                ],
                            },
                        ],
                    },
                    {
                        name: "Creatives Group",
                        departments: [
                            {
                                name: "Copy and Digital Department",
                                positions: [
                                    { name: "Senior Creative Writer" },
                                    { name: "Junior Creative Writer" },
                                ],
                            },
                            {
                                name: "Design and Multimedia",
                                positions: [
                                    { name: "Senior Graphic Artist" },
                                    { name: "Junior Graphic Artist" },
                                ],
                            },
                        ],
                    },
                ],
                modules: [
                    {
                        section: "Accounts and Clients",
                        features: [
                            {
                                name: "View Accounts",
                                roles: ["View Only", "View and Edit"],
                            },
                            {
                                name: "Account and Client Accreditation",
                                roles: ["Creator", "Approver"],
                            },
                        ],
                    },
                    {
                        section: "Project Development",
                        features: [
                            {
                                name: "Project List and Status",
                            },
                            {
                                name: "Create Project",
                                roles: ["Creator", "Reviewer", "Approver"],
                            },
                            {
                                name: "CE and Budget Management",
                                roles: [
                                    "Creator",
                                    "Reviewer",
                                    "Approver",
                                    "Clearance",
                                ],
                            },
                            {
                                name: "Project Clearance and Report",
                            },
                        ],
                    },
                    {
                        section: "Project Execution",
                        features: [
                            {
                                name: "Vendors Pool",
                            },
                            {
                                name: "Manpower Pool",
                            },
                            {
                                name: "Warehouse Management",
                            },
                            {
                                name: "Project Templates",
                            },
                        ],
                    },
                ],
            },
            {
                name: "PGAS",
                groups: [
                    {
                        name: "Administrative Support Group",
                        departments: [
                            {
                                name: "Assets and Property Management",
                                positions: [
                                    {
                                        name:
                                            "Head - Assets & Property Management ",
                                    },
                                    { name: "Administrative Officer" },
                                    { name: "Administrative Assistant" },
                                    { name: "Messenger / Admin Staff" },
                                    { name: "Warehouse Officer" },
                                    { name: "Fabrication Assistant" },
                                    { name: "Executive Driver" },
                                    { name: "Company Driver" },
                                ],
                            },
                            {
                                name: "Human Resource",
                                positions: [
                                    {
                                        name:
                                            "Head - Human Resource Department",
                                    },
                                    { name: "Human Resource Officer" },
                                ],
                            },
                        ],
                    },
                    {
                        name: "Accounting and Finance Group",
                        departments: [
                            {
                                name: "Accounts Receivable Department",
                                positions: [
                                    { name: "Accounts Receivable Officer" },
                                    { name: "Accounts Payable Assistant" },
                                ],
                            },
                            {
                                name: "Accounts Payable Department",
                                positions: [
                                    { name: "Accounts Payable Officer" },
                                    { name: "Accounts Payable Assistant" },
                                ],
                            },
                        ],
                    },
                ],
                modules: [
                    {
                        section: "Admin",
                        features: [
                            {
                                name: "Companies",
                            },
                            {
                                name: "ADM Advisories",
                            },
                            {
                                name: "Assets",
                            },
                            {
                                name: "Vehicles",
                            },
                            {
                                name: "Warehouses",
                            },
                        ],
                    },
                    {
                        section: "Accounting",
                        features: [
                            {
                                name: "Accounts",
                            },
                            {
                                name: "Vendors",
                            },
                            {
                                name: "AFG Advisories",
                            },
                            {
                                name: "Billing and Collection Monitor",
                            },
                            {
                                name: "Budget Allocation",
                            },
                            {
                                name: "Projected Financial Statements",
                            },
                            {
                                name: "Sales, Purchase, and Allowance",
                            },
                            {
                                name: "Sales Report",
                            },
                            {
                                name: "Payments",
                            },
                        ],
                    },
                    {
                        section: "Human Resource",
                        features: [
                            {
                                name: "HR Advisories",
                            },
                            {
                                name: "Mandate",
                            },
                            {
                                name: "PDIS",
                            },
                            {
                                name: "Sprout HR",
                            },
                        ],
                    },
                ],
            },
        ],
        job_levels: [
            "1A",
            "1B",
            "1C",
            "1D",
            "2A",
            "2B",
            "2C",
            "2D",
            "3A",
            "3B",
            "3C",
            "3D",
            "4A",
            "4B",
            "4C",
            "4D",
            "5A",
            "5B",
            "5C",
            "5D",
            "6",
            "7A",
            "7B",
            "7C",
            "8A",
            "8B",
            "8C",
            "8D",
        ],
        statuses: {
            account: {
                front_steps: ["Create", "Approve"],
                db_steps: ["For Approval", "Approved"],
            },
        },
        ewt_details: [
            {
                name: "EWT Sample 1",
                descriptions: [
                    {
                        name: "EWT Description 1",
                        percents: [
                            {
                                name: "1%",
                            },
                            {
                                name: "2%",
                            },
                        ],
                    },
                    {
                        name: "EWT Description 2",
                        percents: [
                            {
                                name: "3%",
                            },
                            {
                                name: "4%",
                            },
                        ],
                    },
                ],
            },
        ],
    },
});
