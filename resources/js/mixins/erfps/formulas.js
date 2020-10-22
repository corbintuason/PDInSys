export default{
    data(){
        return{

        }
    },
    computed:{
        
    },
    methods: {
        total_sales(type) {
            console.log("hey", type);
                if (this.vat_amount(type) == 0) {
                    return 0;
                } else {
                    var exemption;
                    if (type == "Full Payment") {
                        exemption = this.rfp.term_of_payment.full_payment;
                    } else if (type == "Down Payment") {
                        exemption = this.rfp.term_of_payment.down_payment;
                    }
                    var total_sales = this.vatable_sales(type) + exemption.vat_exempt_sales + exemption.other_taxes + this.vat_amount(type);
                    console.log("Checking total sales", total_sales)
                    return total_sales;
                }
            

        },
        vat_amount(type) {
                var vat_amount = 0;
                if (this.rfp.vendor.type_vat == 'VAT Registered') {
                    vat_amount = this.vatable_sales(type) * 0.12;
                }
                return vat_amount;
        },

        vatable_sales(type) {
                var vatable_sales = 0;
                if(this.rfp.vendor.type_vat == 'VAT Registered'){
                    var term_of_payment;
                    if(type == 'Full Payment'){
                        term_of_payment = this.rfp.term_of_payment.full_payment;
                    }else if (type == 'Down Payment'){
                        term_of_payment = this.rfp.term_of_payment.down_payment;
                    }
                    vatable_sales = (this.gross_amount(type) - term_of_payment.vat_exempt_sales - term_of_payment.other_taxes) / 1.12;

                }
                return vatable_sales;
        },

        total_due(type) {
        var total_sales = this.total_sales(type);
        var vat_amount = this.vat_amount(type);
        var term_of_payment;
        if(type == 'Full Payment'){
            term_of_payment = this.rfp.term_of_payment.full_payment;
        }else if (type == 'Down Payment'){
            term_of_payment = this.rfp.term_of_payment.down_payment;
        }
          return total_sales - vat_amount - term_of_payment.other_taxes;
        },

        witholding_tax(type) {
            var used_percentage = this.rfp.vendor.ewt_details[0].percent;
            var used_amount = this.total_due(type);
            if (type == 'Full Payment') {
                if (this.rfp.term_of_payment.full_payment.override > 0)
                    used_percentage = this.rfp.term_of_payment.full_payment.override / 100;
            } else if (type == "Down Payment") {
                if (this.rfp.term_of_payment.down_payment.override > 0)
                    used_percentage = this.rfp.term_of_payment.down_payment.override / 100;
            }

            if (this.rfp.vendor.type_vat != 'VAT Registered') {
                used_amount = this.gross_amount(type);
            }
            return used_amount * used_percentage;
            

        },

        gross_amount(type) {
                var gross_amount = 0;
                if (type == "Full Payment") {
                    // billing amount - gross amount of down payment
                    gross_amount = this.total_billing_amount - this.gross_amount("Down Payment")
                } else if (type == "Down Payment") {
                    // Billing Amount * (Down_payment_percent/1000);
                    gross_amount = this.total_billing_amount * ((this.rfp.term_of_payment.down_payment.percent) / 100);
                }
                return gross_amount;
            

        },

        amount_due(type) {
            var amount_due = 0;
            if (this.rfp.vendor.type_vat == 'VAT Registered') {
                amount_due = this.total_due(type) - this.witholding_tax(type);
            }
            return amount_due;
        },

        total_amount_due(type) {
            return this.amount_due(type) + this.vat_amount(type);

        },

        net_amount(type) {
            var gross_amount = this.gross_amount(type);
            var witholding_tax = this.witholding_tax(type);
            return gross_amount - witholding_tax;
        },


    },
}