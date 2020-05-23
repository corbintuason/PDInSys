import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
export default({
    namespaced: true,
    state: {
        user: JSON.parse(localStorage.getItem("user")) || null,
        token: localStorage.getItem("access_token") || null,
    },
    getters: {
        loggedIn(state) {
            return state.token != null;
        },
        unread_notifications(state){
            console.log("whu");
            return state.user.notifications.filter(notification => {
                		return notification.read_at == null;
                	});
        },
        hasAbility(state) {
            return (name, entity_type) =>
                state.user.abilities.some((item) => {
                    return (
                        item.name === name && item.entity_type == entity_type
                    );
                });
        },
        hasRole(state) {
            return (role) =>
                state.user.roles.some((user_role) => {
                    return user_role.name == role;
                });
        },

        isCurrentHandler(state) {
            return (current_handler) =>
                state.user.roles.includes(current_handler);
        },
    },
    mutations: {
        pushNotification(state, notification) {
            state.all_notifications.push(notification.notification);
        },
        storeNotifications(state, notifications) {
            state.all_notifications = notifications;
        },
        storeUser(state, user) {
            state.user = user;
        },
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        },
    },
    actions: {
        markAsRead(context){
            axios.get("/mark-all-read/").then(response => {
                context.dispatch('storeUser');
				// this.all_notifications = response.data.notifications;
			});
        },
        storeUser(context) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + context.state.token;
                axios
                    .get("/api/init")
                    .then((response) => {
                        const user = response.data;
                        localStorage.setItem("user", JSON.stringify(user));
                        context.commit("storeUser", user);
                        context.commit(
                            "storeNotifications",
                            user.notifications
                        );
                        resolve(user);
                    })
                    .catch((e) => {
                        //(e);
                        reject(e);
                    });
            });
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/login", {
                        pdem_email: credentials.pdem_email,
                        password: credentials.password,
                    })
                    .then((response) => {
                        console.log("you should not appear here");
                        console.log(response);
                        const token = response.data.access_token;
                        console.log("token?", token);
                        localStorage.setItem("access_token", token);
                        context.commit("retrieveToken", token);
                        resolve(response);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        },
        destroyToken(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios
                        .post("/api/logout")
                        .then((response) => {
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("user");
                            context.commit("destroyToken");
                            resolve(response);
                        })
                        .catch((e) => {
                            //(e);
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("user");
                            context.commit("destroyToken");
                            reject(e);
                        });
                });
            }
        },
        pushNotification(context, notification) {
            context.commit("pushNotification", notification);
        },
    },
});
