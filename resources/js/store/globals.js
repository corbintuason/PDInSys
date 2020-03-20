import Vue from 'vue';
import Vuex from 'vuex';

import axios from "axios";
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        offices: [{
            name: "PGOS",
            groups: [
                {
                    name: "Sales and Operations Group",
                    departments: [
                        "Accounts and Business Development", "Project Execution"
                    ]
                },
                {
                    name: "Creatives Group",
                    departments: [
                        "Copy and Digital Department", "Design and Multimedia"
                    ]
                }
            ],
            modules:[
                {
                    section: "Accounts and Clients",
                    features:[
                        {
                            name: "View Accounts",
                        },
                        {
                            name: "Account and Client Accreditation",
                            roles: ["Creator", "Approver"],
                        }
                    ]
                },
                {
                    section: "Project Development",
                    features:[
                        {
                            name: "Project List and Status"
                        },
                        {
                            name: "Create Project",
                            roles: ["Creator", "Reviewer", "Approver"],
                        },
                        {
                            name: "CE and Budget Management",
                            roles: ["Creator", "Reviewer", "Approver", "Clearance"],
                        },
                        {
                            name: "Project Clearance and Report"
                        },
                    ]
                },
                {
                    section: "Project Execution",
                    features:[
                        {
                            name: "Vendors Pool",
                        },
                        {
                            name: "Manpower Pool"
                        },
                        {
                            name: "Warehouse Management"
                        },
                        {
                            name: "Project Templates"
                        }
                    ]
                }
                
            ]
        },
        {
            name: "PGAS",
            groups: [
                {
                    name: "Administrative Support Group",
                    departments: ["Assets and Property Management", "Human Resource"]
                }, {
                    name: "Accounting and Finance Group",
                    departments: ["Accounts Receivable Department", "Accounts Payable Department"],
                }
            ],
            modules:[
                {
                    section: "Admin",
                    features:[
                        {
                            name: "Companies"
                        },
                        {
                            name: "ADM Advisories"
                        },
                        {
                            name: "Assets"
                        },
                        {
                            name: "Vehicles"
                        },
                        {
                            name: "Warehouses"
                        }
                    ]
                },
                {
                    section: "Accounting",
                    features:[
                        {
                            name: "Accounts"
                        },
                        {
                            name: "Vendors"
                        },
                        {
                            name: "AFG Advisories"
                        },
                        {
                            name: "Billing and Collection Monitor"
                        },
                        {
                            name: "Budget Allocation"
                        },
                        {
                            name: "Projected Financial Statements"
                        },
                        {
                            name: "Sales, Purchase, and Allowance"
                        },
                        {
                            name: "Sales Report"
                        },
                        {
                            name: "Payments"
                        }
                    ]
                },
                {
                    section: "Human Resource",
                    features:[
                        {
                            name: "HR Advisories"
                        },
                        {
                            name: "Mandate"
                        },
                        {
                            name: "PDIS"
                        },
                        {
                            name: "Sprout HR"
                        }
                    ]
                }
            ]
        }
        ],
    },
});