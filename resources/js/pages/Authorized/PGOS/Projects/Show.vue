<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" v-if="project!=null" :steps="steps" :item="project" :mode="mode"></item-progress>
   
    <!-- Main Project Details -->

    <show-project v-if="project!=null" :project="project" :steps="steps" :mode="mode" :endpoints="endpoints" :key="show_project_key"></show-project>
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

      // FIRST PANEL: UPLOAD COST ESTIMATE 
        - TITLE: CEPD PROJECT CODE PROJECT NAME

      // 2ND PANEL: 
        - Title: (No signed CES available)
          - Once available (Signed CEs available)
      // Who can open budget?
        - Anyone in the contribution list of ce
        - Prompt after clear, attach signed ce
  -->
  <!-- BUDGET OPENING: Activate when Cost Estimate's Status is Cleared -->


    <!-- Change Logs  -->
    <change-logs v-if="project!=null" :logs="project.relationships.actions"></change-logs>
    
 
  </div>
</template>

<script>
import changeLogs from "../../../../components/public/ChangeLogs";
import showProject from "./Show/ShowProject"
export default {
  data() {
    return {
      mode: "Show",
      show_project_key: 0,
      steps: this.$store.state.project.steps,
        endpoints:{
        api: "/api/project/",
        show_route: "project_show"
      },
      project: null,
    };
  },

  components: {
    "show-project": showProject,
    "change-logs": changeLogs
  },
  watch:{
    mode(){
      console.log("there have been changes");
      this.show_project_key++;
      console.log(this.show_project_key);
    }
  },
  methods:{
      loadProject(){
          var project_id = this.$route.params.id
          axios.get("/api/project/" + project_id).then(response => {
              this.project = response.data.data;
          })
      }
  },
  mounted(){
      this.loadProject();

      Fire.$on('switch-mode', mode => {
        if(mode == 'Show'){
          this.loadProject();
         }
        this.mode = mode;
      });
  },
};
</script>