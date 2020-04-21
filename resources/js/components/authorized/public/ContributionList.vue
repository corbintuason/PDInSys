<template>
    <b-list-group>
        <b-list-group-item
            v-for="(involved_user, involved_user_index) in users"
            :key="involved_user_index"
            :disabled="involved_user.id==null"
            :active="isActive(involved_user_index)"
            href="#"
            @click="toReturn($event, involved_user, involved_user_index)"
            class="d-flex align-items-center"
        >
            <b-avatar class="mr-3"></b-avatar>
            <span class="mr-auto" v-if="involved_user.id!=null"
                ><strong> {{ involved_user.responsibility }}: </strong>
                {{ involved_user.name }}
            </span>
            <span v-else>
                <strong>{{involved_user.responsibility}}</strong>
                <span class="red">No {{involved_user.responsibility}} has been assigned yet.</span>
            </span>
        </b-list-group-item>
    </b-list-group>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            active_item: null,
        };
    },
    props: {
        front_steps: Array,
        involved_users: Array,
    },
    methods: {
        toReturn(event, involved_user, index){
            this.active_item = index;
            this.$emit('return-item', involved_user);
        },
        isActive(index){
            return index === this.active_item
        },
        loadResponsibilities() {
            this.front_steps.forEach((step) => {
                var same_responsibility = this.involved_users.find(
                    (user) => user.type == step.responsible
                );
                if (same_responsibility != null) {
                    axios
                        .get("/api/user/" + same_responsibility.id)
                        .then((response) => {
                            this.users.push({
                                id: response.data.data.id,
                                responsibility: step.responsible,
                                name: response.data.meta.full_name,
                            });
                        });
                } else {
                    this.users.push({
                        id: null,
                        responsibility: step.responsible,
                        name: null,
                    });
                }
            });
        },
    },
    created() {
        this.loadResponsibilities();
    },
};
</script>
