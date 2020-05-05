export default {
    methods: {
        // Returns an array of all the Front Steps Only
        getFrontSteps(steps) {
            var front_steps = [];
            steps.forEach((step) => {
                front_steps.push(step.name);
            });
            return front_steps;
        },

        // Returns the current step of an item
        getCurrentStep(item, steps) {
            var status = item.status;
            var current_step = steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        
        // Finds the Step
        findStep(step, steps){
            return steps.find(progress_step => {
                return step.name == progress_step.name
            });
        },
        // Returns the Next Step 
        getNextStep(current_step, steps) {
            var next_step_index = steps.findIndex(object =>  object.name == current_step.name)+1;
            var next_step = steps.find((val, index) => index == next_step_index);
            return next_step;
        },
    },
};
