<template>
    <b-card class="text-center welcome-card">
        <b-card-text>
            <b-img
                class="mt-4"
                src="/img/avatar/user.png"
                rounded="circle"
                width="60px"
                height="60px"
                alt="Photo"
            ></b-img>
        </b-card-text>

        <b-card-text
            ><div class="mb-2">
                <strong>
                    Welcome Back,
                    {{ user.meta.full_name }}
                </strong>
            </div>
            <div class="mt-1 ml-1">
                <h5 class="text-uppercase font-weight-bold">
                    {{ user.data.group }}
                </h5>
            </div>
        </b-card-text>
    </b-card>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.state.user
        };
    },
    props: {}
};
</script>

<style lang="scss" scoped>
.welcome-card {
    // background: linear-gradient(90deg, #6871b5, #9c8ef3, #6871b5);
    border-radius: 10px;
    box-shadow: 0 2px 43px -4px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.2s ease-out;

    &:hover {
        transform: translateY(4px);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.11) !important;
    }
}
</style>
