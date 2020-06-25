export default {
    data() {
        return {};
    },
    computed: {},
    methods: {
        filterEntries() {
            console.log("ito ba problema", this.budget_request);
            var filtered_entries = [];
            this.budget_request.entries.forEach((entry) => {
                if (
                    !filtered_entries.some(
                        (filtered_entry) =>
                            entry.category == filtered_entry.category
                    )
                ) {
                    filtered_entries.push({
                        category: entry.category,
                        entries: [],
                    });
                }
                var category = filtered_entries.find(
                    (filtered_entry) =>
                        entry.category == filtered_entry.category
                );
                category.entries.push(entry);
            });
            return filtered_entries;
        },
        getCategoryTotal(category) {
            var sum = 0;
            console.log("hahahaha taena", category);
            var specific_entries = this.budget_request.entries.filter(find_category => find_category.category == category);
            specific_entries.forEach((entry) => {
                sum += this.getSubAmount(entry);
            });
            return sum;
        },
        getSubAmount(entry) {
            return (
                entry.quantity *
                entry.unit_price *
                entry.no_of_days *
                entry.no_of_venues
            );
        },
        getLiquidatedAmount(category){
            var category_journal_entries = this.liquidation_journal.entries.filter(category_entry => category_entry.category == category);
            console.log('...', category);
            console.log(category_journal_entries);
            var sum = 0;
            category_journal_entries.forEach(entry => {
                sum+=entry.gross_amount;
            });
            return sum;
        },
        getExcessBudget(category){
            return this.getCategoryTotal(category) - this.getLiquidatedAmount(category);
        }
    },
};
