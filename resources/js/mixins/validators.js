export default{
    data(){
        return{

        }
    },
    methods:{
        validated(item){
            if(item.validators!=null){
                var statuses = [];
                item.validators.forEach(validator => {
                    var status;
                    if(validator.name == 'required'){
                        status = this.required(item.model);
                    }
                    else if(validator.name =='email'){
                        status = this.email(item.model);
                    }
                    statuses.push(status);
                });
                console.log("statuses");
                console.log(statuses);
                console.log(statuses.filter(status => status == true).length > 0);
    
                if (statuses.filter(status => status == true).length > 0){
                    return true
                }else{
                    return false
                }
            }

            
           
        },
        required(item){
            return item.length > 0;
        },
        email(email){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            console.log('email test');
            console.log(re.test(String(email).toLowerCase()));
            return re.test(String(email).toLowerCase());
        }
    }
}
