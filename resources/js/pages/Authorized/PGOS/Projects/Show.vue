<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :front_steps="front_steps" v-if="project!=null" :db_steps="db_steps" :item="project" :contributors="contributors" :mode="mode" :api_link="api_link" :remarks="remarks"></item-progress>
   
    <!-- Main Project Details -->

    <show-project v-if="project!=null" :project="project" :project_code="project_code" :front_steps="front_steps" :core_team="core_team" :mode="mode" :contributors="contributors"></show-project>

    <!-- Quick Access  -->
  <!-- COST ESTIMATE: Activate when Main AM has been assigned 
    - Made through excel
      - Creator -> Reviewer -> Approver -> Clearance
      - For Review -> For APproval -> For Clearance -> Cleared
            - Creator of CE is automatically the Main AM
      
      - Fields:
        - Upload A CE
          - CE Number (automatic) - CEPD-(Project Code).1
          - CE Version Number (Dont automate)
          - Sub Total (Input) 
          - ASF Rate (Input %)
          - Total Project Cost (Sub Total *  ASF Rate)
          - VAT (12% of Total Project Cost)
          - Radio (Peza, AR Only)
            - If Ticked, Vat will be set to 0
          - Grand Total (Total Project Cost + Vat)
          - NOTE: THIS IS DYNAMIC. ADD A DYNAMIC BUTTON TO ADD ANOTHER CODE

          - CREATE -> Notify Reviewer
          - Restructure file format uplaoded should be ()
              *CEPD(PROJECTCODE) PROJECT NAME*
      
      WHEN REVIEWED
        - Name of the download link of renamed CE File
        - Inputted Details 
        - When Editing (Reviewer Mode):
          - Reupload new file (Remove old file)
          - Change to correct values
          - Reviewed

      ONCE CLEARED, NOTIFY ALL INVOLVED IN THE ITEM
        - CEPD.1v1 have been cleared
      

      
      // Cost Estimate -> roles ["Reviewer", "Approver", "Clearer"]

  -->
  <!-- BUDGET OPENING: Activate when Cost Estimate's Status is Cleared -->
   <b-card>
      <template v-slot:header>Quick Access

        
      </template>
      <template v-slot:footer>
     
     <b-button-group class="float-right">
        <b-button v-for="(access, access_index) in quick_access_buttons" :key="access_index"> {{access}}</b-button>

        </b-button-group>
      </template>
    </b-card>

    <!-- Change Logs  -->
    <change-logs v-if="change_logs!=null" :logs="change_logs"></change-logs>
    
 
  </div>
</template>

<script>
import changeLogs from "../../../../components/public/ChangeLogs";
import showProject from "./Show/ShowProject"
export default {
  data() {
    return {
      mode: "Show",
      api_link: "/api/project",
      front_steps: this.$store.state.globals.statuses.project.front_steps,
      db_steps: this.$store.state.globals.statuses.project.db_steps,

      project: null,
      change_logs: null,
      core_team: null,
      project_code: null,
      contributors: null,
      remarks: null,

      quick_access_buttons:["Cost Estimate", "Budget Opening", "Budget Request", "Request For Payment", "Project Execution Plan", "Job Order", "Supplies Requesition", "Vehicle Requisition", "Asset Movement"]
    };
  },

  components: {
    "show-project": showProject,
    "change-logs": changeLogs
  },
  methods:{
      loadProject(){
          var project_id = this.$route.params.id
          axios.get("/api/project/" +project_id).then(response => {
              this.project = response.data.data;
              this.change_logs = response.data.actions;
              this.core_team = response.data.relationships;
              this.project_code = response.data.meta.code;
              this.contributors = response.data.relationships.contributors
              this.remarks = response.data.relationships.remarks
          })
      }
  },
  mounted(){
      this.loadProject();
  },
};
</script>