<template>
    <li class="ml-3">
        <b-img
            :src="user.data.official_photo"
            rounded="circle"
            width="35px"
            height="35px"
            alt="Photo"
            v-if="user.data.official_photo != null"
        ></b-img>
        <b-img
            src="/img/avatar/user.png"
            rounded="circle"
            width="35px"
            height="35px"
            alt="Photo"
            v-else
        ></b-img>
    </li>
</template>

<script>
export default{
    data() {
        return {
            user: this.$store.state.user,
        };
    },
}
</script>