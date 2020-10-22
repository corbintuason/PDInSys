export default {
    data() {
        return {};
    },
    methods:{
       hasAbility(ability, model, model_id){
           axios.put('/api/bouncer/hasAbility', {
                ability: ability,
                model: model,
                model_id: model_id
            }).then(response => {
                console.log("response?");
                console.log(response.data.value);
                return response.data.value;
            })
        }
    }
};
