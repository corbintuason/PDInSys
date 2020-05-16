export default {
    methods: {
      registerStoreModule (moduleName, storeModule)
      {
        return new Promise((resolve, reject) => {
            const store = this.$store;
            if (!(store && store.state && store.state[moduleName]))
            {
              store.registerModule(moduleName, storeModule);
              resolve();
            } else {
                reject();
            }
        });
 
      }
    }
  }