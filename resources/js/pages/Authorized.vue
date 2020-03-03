<template>
<div>
      <admin-nav></admin-nav>
      <div class="content-wrapper">
        <div class="content">
          <div class="container-fluid">
              <router-view></router-view>
          </div>
        </div>
      </div>
</div>
</template>

<script>
import adminNav from "../components/authorized/navigation/AdminNav"
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