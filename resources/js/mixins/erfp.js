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
    },
    methods: {

    },
};
