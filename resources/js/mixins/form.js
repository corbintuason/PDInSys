import { FormSelectPlugin } from "bootstrap-vue";

export default {
    data() {
        return {

        }
    },
    methods: {
        addRow(model) {
            model.push("");
        },
        removeRow(model, index) {
            model.splice(index, 1);
        }
    }
}
