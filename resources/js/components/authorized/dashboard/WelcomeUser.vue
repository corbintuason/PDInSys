<template>
 <b-card class="text-center">
    <b-card-text>
      <img src="img_avatar.png" style="border-radius:50%; border-style:solid; " alt="Avatar">
    </b-card-text>

    <b-card-text>Welcome Back {{ user.name }}!</b-card-text>
  </b-card>
</template>

<script>
export default{
    data(){
        return{

        }
    },
    props:{
      user: Object
    }
}
</script>