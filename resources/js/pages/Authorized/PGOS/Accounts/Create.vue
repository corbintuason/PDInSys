<template>
<div>
    <admin-nav></admin-nav>

</div>
</template>

<script>
import adminNav from "../../../../components/authorized/navigation/AdminNav";
export default{
    data(){
        return{

        }
    },
    components:{
        "admin-nav": adminNav
    }
}
</script>