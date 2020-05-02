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
                                permission: "view-view-accounts",
                            },
                            {
                                name: "Account and Client Accreditation",
                                permission:
                                    "view-account-and-client-accreditation",
                                roles: [
                                    {
                                        name: "Creator",
                                        role: "account-creator",
                                    },
                                    {
                                        name: "Approver",
                                        role: "account-approver",
                                    },
                                ],
                            },
                        ],
                    },
                    {
                        section: "Project Development",
                        features: [
                            {
                                name: "Project List and Status",
                                permission: "view-project-list-and-status",
                            },
                            {
                                name: "Create Project",
                                permission: "view-create-project",
                                roles: [
                                    {
                                        name: "Creator",
                                        role: "project-creator",
                                    },
                                    {
                                        name: "Reviewer",
                                        role: "project-reviewer",
                                    },
                                    {
                                        name: "Approver",
                                        role: "project-approver",
                                    },
                                    {
                                        name: "Assigner",
                                        role: "project-assigner",
                                    },
                                ],
                            },
                            // {
                            //     name: "CE and Budget Management",
                            //     roles: [
                            //         "Creator",
                            //         "Reviewer",
                            //         "Approver",
                            //         "Clearance",
                            //     ],
                            // },
                            // {
                            //     name: "Project Clearance and Report",
                            // },
                        ],
                    },
                    // {
                    //     section: "Project Execution",
                    //     features: [
                    //         {
                    //             name: "Vendors Pool",
                    //         },
                    //         {
                    //             name: "Manpower Pool",
                    //         },
                    //         {
                    //             name: "Warehouse Management",
                    //         },
                    //         {
                    //             name: "Project Templates",
                    //         },
                    //     ],
                    // },
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
            mandate: {
                front_steps: [
                    {
                        name: "Create",
                        responsible: "Creator",
                    },
                    {
                        name: "Approve",
                        responsible: "Approver",
                    },
                ],
                db_steps: ["For Approval", "Approved"],
            },
            vendor: {
                front_steps: ["Create", "Approve"],
                db_steps: ["For Approval", "Approved"],
            },
            project: {
                front_steps: [
                    {
                        name: "Create",
                        responsible: "Creator",
                    },
                    {
                        name: "Review",
                        responsible: "Reviewer",
                    },
                    {
                        name: "Approve",
                        responsible: "Approver",
                    },
                    {
                        name: "Assigned",
                        responsible: "Assigners",
                    },
                ],
                db_steps: [
                    "For Review",
                    "For Approval",
                    "Approved",
                    "Assigned",
                ],
            },
        },
        positions: [
            {
                name: "President, CEO",
                positions: [
                    // PGOS
                    {
                        name: "VP For General Operations",
                        positions: [
                            {
                                name: "AVP For Sales & Operations",
                                positions: [
                                    {
                                        name: "Sales and Operations Director",
                                        positions: [
                                            {
                                                name:
                                                    "Head of Accounts & Biz Development",
                                                positions: [
                                                    {
                                                        name:
                                                            "Associate Head - ABD",
                                                        positions: [
                                                            {
                                                                name:
                                                                    "Sr. Account Manager",
                                                                positions: [
                                                                    {
                                                                        name:
                                                                            "Account Manager",
                                                                    },
                                                                ],
                                                            },
                                                        ],
                                                    },
                                                ],
                                            },
                                            {
                                                name: "Project Execution Head",
                                                positions: [
                                                    {
                                                        name:
                                                            "Associate Head - PE",
                                                        positions: [
                                                            {
                                                                name:
                                                                    "Project Manager",
                                                                positions: [
                                                                    {
                                                                        name:
                                                                            "Project Coordinator",
                                                                    },
                                                                ],
                                                            },
                                                        ],
                                                    },
                                                ],
                                            },
                                        ],
                                    },
                                ],
                            },
                            {
                                name: "AVP For Creatives",
                                positions: [
                                    {
                                        name: "Creative Director",
                                        positions: [
                                            {
                                                name:
                                                    "Associate CD - Copy and Digital",
                                                positions: [
                                                    {
                                                        name:
                                                            "Sr. Creative Writer",
                                                    },
                                                ],
                                            },
                                            {
                                                name:
                                                    "Associate CD - Design and Multimedia",
                                                positions: [
                                                    {
                                                        name:
                                                            "Sr. Graphic Artist",
                                                    },
                                                ],
                                            },
                                        ],
                                    },
                                ],
                            },
                        ],
                    },
                    {
                        name: "VP For General Admin.",
                        positions: [
                            {
                                name: "AVP For Administrative Support Group",
                                positions: [
                                    {
                                        name:
                                            "Assets & Property Management Head",
                                        positions: [
                                            {
                                                name:
                                                    "Assets & Property Management Officer",
                                                positions: [
                                                    {
                                                        name:
                                                            "Administrative Support Assistant",
                                                    },
                                                ],
                                            },
                                        ],
                                    },
                                    {
                                        name: "Human Resource Head",
                                        positions: [
                                            {
                                                name: "Human Resource Officer",
                                            },
                                        ],
                                    },
                                ],
                            },
                            {
                                name: "AVP For Accounting & Finance Group",
                                positions: [
                                    {
                                        name: "Accounting & Finance Head",
                                        positions: [
                                            {
                                                name:
                                                    "Accounts Receivable Officer",
                                                positions: [
                                                    {
                                                        name:
                                                            "Accounting & Finance Assistant",
                                                    },
                                                ],
                                            },
                                            {
                                                name:
                                                    "Accounts Payable Officer",
                                            },
                                        ],
                                    },
                                ],
                            },
                        ],
                    },
                ],
            },
        ],
    },
});
