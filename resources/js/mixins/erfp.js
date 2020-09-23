export default {
    data() {
        return {};
    },
    computed: {
        disableForm() {
          if(this.mode == 'Show'){
              // Statuses that forms are editable
              if(this.rfp.status=='For Validation'){
                return false;
              }else return true;
          } else {
              return false;
          }
        },
        total_billing_amount(){
            var total_billing_amount = 0;
            this.rfp.erfpables.forEach(erfpable => {
                total_billing_amount+=erfpable.billing_amount;
            });
            return total_billing_amount;
        }
    },
};
