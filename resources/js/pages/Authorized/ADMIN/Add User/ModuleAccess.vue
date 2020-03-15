<template>
<div>
    <div class = "row">
        <div class = "col-md-12">
                <b-table striped hover :fields="fields" :items="items" table-variant="warning" ></b-table>
        </div>
    </div>
</div>
</template>
<script>
export default{
    data(){
        return{
            fields: [{
                key: "module",
                label: "Module"
            },{
                key: "role",
                label: "Role"
            }],
            items:[
                {
                    module: "ACCOUNTS AND CLIENTS",
                    style: "font-style:bold"
                },
                {
                    module: "View Accounts"
                },
                {
                    module: "Account and Client Accreditation"
                }
                //  Account and Client Acc. Roles:
                // - Create, Approve,
                ,
                {
                    module: "PROJECT DEVELOPMENT"
                },
                {
                    module: "Project List and Status"
                },
                {
                    module: "Create Project"
                }
                // Roles:
                // Create, Review, Approve
            ],
        }
    },
    
}
</script>
