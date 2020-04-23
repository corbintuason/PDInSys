<template>
    <div>
        <!-- Accts and Biz Dev and Proj. Execution -->
        <div class="row mt-3">
            <!-- Accts and Biz -->
            <div class="col-md-6">
                <accounts-business-development-team :project="project"></accounts-business-development-team>
            </div>
            <!-- Project Execution Team -->
            <div class="col-md-6">
                <project-execution-team></project-execution-team>
            </div>
        </div>

        <div class="row">
            <!-- Accts and Biz -->
            <div class="col-md-6">
                <copy-digital-team></copy-digital-team>
            </div>
            <!-- Project Execution Team -->
            <div class="col-md-6">
                <design-multimedia-team></design-multimedia-team>
            </div>
        </div>

        <!-- Copy and Digital and Design and Multimedia -->
    </div>
</template>

<script>
import accountsBusinessDevelopmentTeam from "./ProjectCoreTeam/AccountsBusinessDevelopmentTeam";
import projectExecutionTeam from "./ProjectCoreTeam/ProjectExecutionTean";
import copyAndDigitalTeam from "./ProjectCoreTeam/CopyAndDigitalTeam";
import designAndMultimediaTeam from "./ProjectCoreTeam/DesignAndMultimediaTeam";
export default {
    data() {
        return {};
    },
    components: {
        "accounts-business-development-team": accountsBusinessDevelopmentTeam,
        "project-execution-team": projectExecutionTeam,
        "copy-digital-team": copyAndDigitalTeam,
        "design-multimedia-team": designAndMultimediaTeam,
    },
    props: {
        project: Object,
    },
};
</script>
