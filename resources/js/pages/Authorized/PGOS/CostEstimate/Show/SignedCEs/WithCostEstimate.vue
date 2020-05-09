<template>
 <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">
                Signed CEs
            </h1>
        </template>
        <b-card-body>
            <!-- If there are any signed CEs -->
            <!-- <with-signed-ces></with-signed-ces> -->
            <!-- If there are no signed CEs -->
            <without-signed-ces></without-signed-ces>
        </b-card-body>
        <template v-slot:footer>

        </template>
    </b-card>
</template>

<script>
import withoutSignedCEs from "./WithCostEstimate/WithoutSignedCEs"
export default{
    data(){
        return{}
    },
    components:{
        "without-signed-ces": withoutSignedCEs
    }
}
</script>