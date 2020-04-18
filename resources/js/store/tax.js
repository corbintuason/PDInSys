import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        ewt_details: [
            // WI010 , WI011 / WC010 , WC011
            {
                name: "WI010",
                descriptions: [
                    {
                        name:
                            "Professional fees (Lawyers, CPA's, Engineers, etc.) -  if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI011",
                descriptions: [
                    {
                        name:
                            "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income is more than 3M or VAT registered regardlessof amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC010",
                descriptions: [
                    {
                        name:
                            "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC011",
                descriptions: [
                    {
                        name:
                            "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI020 , WI021 / WC020 , WC021
            {
                name: "WI020",
                descriptions: [
                    {
                        name:
                            "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if the gross income for the current year did not exceed P3M	",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI021",
                descriptions: [
                    {
                        name:
                            "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC020",
                descriptions: [
                    {
                        name:
                            "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC021",
                descriptions: [
                    {
                        name:
                            "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            //  WI030 , WI031 / WC030 , WC030
            {
                name: "WI030",
                descriptions: [
                    {
                        name:
                            "Professional athletes including basketball players, pelotaris and jockeys - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI031",
                descriptions: [
                    {
                        name:
                            "Professional athletes including basketball players, pelotaris and jockeys - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC030",
                descriptions: [
                    {
                        name:
                            "Professional athletes including basketball players, pelotaris and jockeys - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC031",
                descriptions: [
                    {
                        name:
                            "Professional athletes including basketball players, pelotaris and jockeys - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI040 , WI041 / WC040 , WC041
            {
                name: "WI040",
                descriptions: [
                    {
                        name:
                            "All directors and producers involved in movies, stage, television and musical productions - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI041",
                descriptions: [
                    {
                        name:
                            "All directors and producers involved in movies, stage, television and musical productions - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC040",
                descriptions: [
                    {
                        name:
                            "All directors and producers involved in movies, stage, television and musical productions - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC041",
                descriptions: [
                    {
                        name:
                            "All directors and producers involved in movies, stage, television and musical productions - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI050 , WI051 / WC050 , WC051
            {
                name: "WI050",
                descriptions: [
                    {
                        name:
                            "Management and technical consultants - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI051",
                descriptions: [
                    {
                        name:
                            "Management and technical consultants - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC050",
                descriptions: [
                    {
                        name:
                            "Management and technical consultants - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC051",
                descriptions: [
                    {
                        name:
                            "Management and technical consultants - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI060 , WI061 / WC060 , WC061
            {
                name: "WI060",
                descriptions: [
                    {
                        name:
                            "Business and Bookkeeping agents and agencies - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI061",
                descriptions: [
                    {
                        name:
                            "Business and Bookkeeping agents and agencies - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC060",
                descriptions: [
                    {
                        name:
                            "Business and Bookkeeping agents and agencies - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC061",
                descriptions: [
                    {
                        name:
                            "Business and Bookkeeping agents and agencies - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI070 , WI071 / WC070 , WC071
            {
                name: "WI070",
                descriptions: [
                    {
                        name:
                            "Insurance agents and insurance adjusters - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI071",
                descriptions: [
                    {
                        name:
                            "Insurance agents and insurance adjusters - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC070",
                descriptions: [
                    {
                        name:
                            "Insurance agents and insurance adjusters - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC071",
                descriptions: [
                    {
                        name:
                            "Insurance agents and insurance adjusters - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI080 , WI081 / WC080 , WC081
            {
                name: "WI080",
                descriptions: [
                    {
                        name:
                            "Other Recipients of Talent Fees - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI081",
                descriptions: [
                    {
                        name:
                            "Other Recipients of Talent Fees - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC080",
                descriptions: [
                    {
                        name:
                            "Other Recipients of Talent Fees - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC081",
                descriptions: [
                    {
                        name:
                            "Other Recipients of Talent Fees - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI090 , WI091
            {
                name: "WI090",
                descriptions: [
                    {
                        name:
                            "Fees of Director who are not employees of the company - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI091",
                descriptions: [
                    {
                        name:
                            "Fees of Director who are not employees of the company - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            //  WI100
            {
                name: "WI100",
                descriptions: [
                    {
                        name:
                            "Rentals Oon gross rental or lease for the continued use or possession of personal property in excess of P10,000 annually and real property used in business which the payor or obligor has not taken title or is not taking title, or in which has no equity; poles, satellites, transmission facilities and billboards",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            //  WC100
            {
                name: "WC100",
                descriptions: [
                    {
                        name:
                            "Rentals Oon gross rental or lease for the continued use or possession of personal property in excess of P10,000 annually and real property used in business which the payor or obligor has not taken title or is not taking title, or in which has no equity; poles, satellites, transmission facilities and billboards",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            //  WI110
            {
                name: "WI110",
                descriptions: [
                    {
                        name:
                            "Cinemathographic film rentals and other payments to resident indivduals and corporate cinematographic film owners, lessors and distributors",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            //  WC110
            {
                name: "WC110",
                descriptions: [
                    {
                        name:
                            "Cinemathographic film rentals and other payments to resident indivduals and corporate cinematographic film owners, lessors and distributors",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            //  WI120
            {
                name: "WI120",
                descriptions: [
                    {
                        name: "Income payments to certain contractors",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            //  WC120
            {
                name: "WC120",
                descriptions: [
                    {
                        name: "Income payments to certain contractors",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            //  WI130
            {
                name: "WI130",
                descriptions: [
                    {
                        name:
                            "Income distribution to the beneficiaries of estate and trusts",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            //  WI139 , WI140
            {
                name: "WI139",
                descriptions: [
                    {
                        name:
                            "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI140",
                descriptions: [
                    {
                        name:
                            "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC139",
                descriptions: [
                    {
                        name:
                            "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC140",
                descriptions: [
                    {
                        name:
                            "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI150 , WI151 / WC150 , WC151
            {
                name: "WI150",
                descriptions: [
                    {
                        name:
                            "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income is more than 3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI151",
                descriptions: [
                    {
                        name:
                            "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC150",
                descriptions: [
                    {
                        name:
                            "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WC151",
                descriptions: [
                    {
                        name:
                            "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI152 / WI153
            {
                name: "WI152",
                descriptions: [
                    {
                        name:
                            "Payment by the General Professional Partnership (GPPs) to its partners - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            {
                name: "WI153",
                descriptions: [
                    {
                        name:
                            "Payment by the General Professional Partnership (GPPs) to its partners - if gross income exceeds P720,000",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI158
            {
                name: "WI158",
                descriptions: [
                    {
                        name: "Income payments made by credit card companies",
                        percents: [
                            {
                                name: "1% OF 1/2 of gross amount",
                            },
                        ],
                    },
                ],
            },
            // WC158
            {
                name: "WC158",
                descriptions: [
                    {
                        name: "Income payments made by credit card companies",
                        percents: [
                            {
                                name: "1% OF 1/2 of gross amount",
                            },
                        ],
                    },
                ],
            },
            // WI159
            {
                name: "WI159",
                descriptions: [
                    {
                        name:
                            "Additional Income Payments to govt personnel from importers, shipping and airline companies or their agents for overtime services",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI640
            {
                name: "WI640",
                descriptions: [
                    {
                        name:
                            "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of goods other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC640
            {
                name: "WC640",
                descriptions: [
                    {
                        name:
                            "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of goods other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            //  WI157
            {
                name: "WI157",
                descriptions: [
                    {
                        name:
                            "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of services other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            //  WC157
            {
                name: "WC157",
                descriptions: [
                    {
                        name:
                            "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of services other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            // WI158
            {
                name: "WI158",
                descriptions: [
                    {
                        name:
                            "Income Payment made by top withholding agents to their local/resident suppliers of goods other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC158
            {
                name: "WC158",
                descriptions: [
                    {
                        name:
                            "Income Payment made by top withholding agents to their local/resident suppliers of goods other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI160
            {
                name: "WI160",
                descriptions: [
                    {
                        name:
                            "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            // WC160
            {
                name: "WC160",
                descriptions: [
                    {
                        name:
                            "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
                        percents: [
                            {
                                name: "2%",
                            },
                        ],
                    },
                ],
            },
            // WI515
            {
                name: "WI515",
                descriptions: [
                    {
                        name:
                            "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WC515
            {
                name: "WC515",
                descriptions: [
                    {
                        name:
                            "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income for the current year did not exceed P3M",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WI516
            {
                name: "WI516",
                descriptions: [
                    {
                        name:
                            "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income is more than P3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WC516
            {
                name: "WC516",
                descriptions: [
                    {
                        name:
                            "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income is more than P3M or VAT registered regardless of amount",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI530
            {
                name: "WI530",
                descriptions: [
                    {
                        name: "Gross payments to embalmers by funeral parlors",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI535
            {
                name: "WI535",
                descriptions: [
                    {
                        name:
                            "Payments made by pre-need companies to funeral parlors",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC535
            {
                name: "WC535",
                descriptions: [
                    {
                        name:
                            "Payments made by pre-need companies to funeral parlors",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI540
            {
                name: "WI540",
                descriptions: [
                    {
                        name: "Tolling fees paid to refineries",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WC540
            {
                name: "WC540",
                descriptions: [
                    {
                        name: "Tolling fees paid to refineries",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WI610
            {
                name: "WI610",
                descriptions: [
                    {
                        name:
                            "Income payments made to suppliers of agricultural supplier products in excess of cumulative amount of P300,000 within the same taxable year",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC610
            {
                name: "WC610",
                descriptions: [
                    {
                        name:
                            "Income payments made to suppliers of agricultural supplier products in excess of cumulative amount of P300,000 within the same taxable year",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI630
            {
                name: "WI630",
                descriptions: [
                    {
                        name:
                            "Income payments on purchases of minerals, mineral products and quarry resources, such as but not limited to silver, gold, granite, gravel, sand, boulders and other mineral products except purchases by Bangko Sentral ng Pilipinas",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WC630
            {
                name: "WC630",
                descriptions: [
                    {
                        name:
                            "Income payments on purchases of minerals, mineral products and quarry resources, such as but not limited to silver, gold, granite, gravel, sand, boulders and other mineral products except purchases by Bangko Sentral ng Pilipinas",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WI632
            {
                name: "WI632",
                descriptions: [
                    {
                        name:
                            "Income payments on purchases of minerals, mineral products and quarry resources by Bangko Sentral ng Pilipinas ((BSP) from gold miners/suppliers under PD 1899, as amended by RA No. 7076",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC632
            {
                name: "WC632",
                descriptions: [
                    {
                        name:
                            "Income payments on purchases of minerals, mineral products and quarry resources by Bangko Sentral ng Pilipinas ((BSP) from gold miners/suppliers under PD 1899, as amended by RA No. 7076",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI650
            {
                name: "WI650",
                descriptions: [
                    {
                        name:
                            "On gross amount of refund given by MERALCO to customers with active contracts as classified by MERALCO",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WC650
            {
                name: "WC650",
                descriptions: [
                    {
                        name:
                            "On gross amount of refund given by MERALCO to customers with active contracts as classified by MERALCO",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI651
            {
                name: "WI651",
                descriptions: [
                    {
                        name:
                            "On gross amount of refund given by MERALCO to customers with terminated contracts as classified by MERALCO",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WC651
            {
                name: "WC651",
                descriptions: [
                    {
                        name:
                            "On gross amount of refund given by MERALCO to customers with terminated contracts as classified by MERALCO",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI660
            {
                name: "WI660",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WC660
            {
                name: "WC660",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI661
            {
                name: "WI661",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WC661
            {
                name: "WC661",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI662
            {
                name: "WI662",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by other  by other electric Distribution Utilities (DU)",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WC662
            {
                name: "WC662",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by other  by other electric Distribution Utilities (DU)",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI663
            {
                name: "WI663",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by other electric Distribution Utilities (DU)",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WC663
            {
                name: "WC663",
                descriptions: [
                    {
                        name:
                            "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by other electric Distribution Utilities (DU)",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
            // WI680
            {
                name: "WI680",
                descriptions: [
                    {
                        name:
                            "Income payments made by political parties and candidates of local and national elections on all their purchases of goods and services relkated to campaign expenditures, and income payments made by individuals or juridical persons for their purchases of goods and services intented to be given as campaign contribution to political parties and candidates",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WC680
            {
                name: "WC680",
                descriptions: [
                    {
                        name:
                            "Income payments made by political parties and candidates of local and national elections on all their purchases of goods and services relkated to campaign expenditures, and income payments made by individuals or juridical persons for their purchases of goods and services intented to be given as campaign contribution to political parties and candidates",
                        percents: [
                            {
                                name: "5%",
                            },
                        ],
                    },
                ],
            },
            // WC690
            {
                name: "WC690",
                descriptions: [
                    {
                        name:
                            "Income payments received by Real Estate Investment Trust (REIT)",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WI710
            {
                name: "WI710",
                descriptions: [
                    {
                        name:
                            "Interest income denied from any other debt instruments not within the coverage of deposit substitutes and Revenue Regulations 14-2012",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WC710
            {
                name: "WC710",
                descriptions: [
                    {
                        name:
                            "Interest income denied from any other debt instruments not within the coverage of deposit substitutes and Revenue Regulations 14-2012",
                        percents: [
                            {
                                name: "15%",
                            },
                        ],
                    },
                ],
            },
            // WI720
            {
                name: "WI720",
                descriptions: [
                    {
                        name: "Income payments on locally produced raw sugar",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
            // WC720
            {
                name: "WC720",
                descriptions: [
                    {
                        name: "Income payments on locally produced raw sugar",
                        percents: [
                            {
                                name: "1%",
                            },
                        ],
                    },
                ],
            },
        ],
    },
});
