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
                description:
                    "Professional fees (Lawyers, CPA's, Engineers, etc.) -  if the gross income for the current year did not exceed P3M",
                percent: 0.5,
            },
            {
                name: "WI011",
                description:
                    "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income is more than 3M or VAT registered regardlessof amount",
                percent: 0.1,
            },
            {
                name: "WC010",
                description:
                    "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income for the current year did not exceed P720,000",
                percent: 0.1,
            },
            {
                name: "WC011",
                description:
                    "Professional fees (Lawyers, CPA's, Engineers, etc.) - if gross income exceeds P720,000",
                percent: 0.15,
            },
            // // WI020 , WI021 / WC020 , WC021
            {
                name: "WI020",
                description:
                    "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if the gross income for the current year did not exceed P3M	",
                percent: 0.05,
            },
            {
                name: "WI021",
                description:
                    "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income is more than 3M or VAT registered regardless of amount",
                percent: 0.1,
            },
            {
                name: "WC020",
                description:
                    "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income for the current year did not exceed P720,000",
                percent: 0.1,
            },
            {
                name: "WC021",
                description:
                    "Professional entertainer such as, but not limited to actors and actresses, singers, lyricist, composers, emcees - if gross income exceeds P720,000",
                percent: 0.15,
            },
            // //  WI030 , WI031 / WC030 , WC030
            {
                name: "WI030",
                description:
                    "Professional athletes including basketball players, pelotaris and jockeys - if the gross income for the current year did not exceed P3M",
                percent: 0.05,
            },
            {
                name: "WI031",
                description:
                    "Professional athletes including basketball players, pelotaris and jockeys - if gross income is more than 3M or VAT registered regardless of amount",
                percent: 0.1,
            },
            {
                name: "WC030",
                description:
                    "Professional athletes including basketball players, pelotaris and jockeys - if gross income for the current year did not exceed P720,000",
                percent: "10%",
            },
            {
                name: "WC031",
                description:
                    "Professional athletes including basketball players, pelotaris and jockeys - if gross income exceeds P720,000",
                percent: "15%",
            },
            // // WI040 , WI041 / WC040 , WC041
            {
                name: "WI040",
                description:
                    "All directors and producers involved in movies, stage, television and musical productions - if the gross income for the current year did not exceed P3M",
                percent: "5%",
            },
            {
                name: "WI041",
                description:
                    "All directors and producers involved in movies, stage, television and musical productions - if gross income is more than 3M or VAT registered regardless of amount",
                percent: "10%",
            },
            {
                name: "WC040",
                description:
                    "All directors and producers involved in movies, stage, television and musical productions - if gross income for the current year did not exceed P720,000",
                percent: "10%",
            },
            {
                name: "WC041",
                description:
                    "All directors and producers involved in movies, stage, television and musical productions - if gross income exceeds P720,000",
                percent: "15%",
            },
            // // WI050 , WI051 / WC050 , WC051
            {
                name: "WI050",
                description:
                    "Management and technical consultants - if the gross income for the current year did not exceed P3M",
                percent: "5%",
            },
            {
                name: "WI051",
                description:
                    "Management and technical consultants - if gross income is more than 3M or VAT registered regardless of amount",
                percent: "10%",
            },
            {
                name: "WC050",
                description:
                    "Management and technical consultants - if gross income for the current year did not exceed P720,000",
                percent: "10%",
            },
            {
                name: "WC051",
                description:
                    "Management and technical consultants - if gross income exceeds P720,000",
                percent: "15%",
            },
            // // WI060 , WI061 / WC060 , WC061
            {
                name: "WI060",
                description:
                    "Business and Bookkeeping agents and agencies - if the gross income for the current year did not exceed P3M",
                percent: "5%",
            },
            {
                name: "WI061",
                description:
                    "Business and Bookkeeping agents and agencies - if gross income is more than 3M or VAT registered regardless of amount",
                percent: "10%",
            },
            {
                name: "WC060",
                description:
                    "Business and Bookkeeping agents and agencies - if gross income for the current year did not exceed P720,000",
                percent: "10%",
            },
            {
                name: "WC061",
                description:
                    "Business and Bookkeeping agents and agencies - if gross income exceeds P720,000",
                percent: "15%",
            },
            // // WI070 , WI071 / WC070 , WC071
            {
                name: "WI070",
                description:
                    "Insurance agents and insurance adjusters - if the gross income for the current year did not exceed P3M",
                percent: "5%",
            },
            {
                name: "WI071",
                description:
                    "Insurance agents and insurance adjusters - if gross income is more than 3M or VAT registered regardless of amount",
                percent: "10%",
            },
            {
                name: "WC070",
                description:
                    "Insurance agents and insurance adjusters - if gross income for the current year did not exceed P720,000",
                percent: "10%",
            },
            {
                name: "WC071",
                description:
                    "Insurance agents and insurance adjusters - if gross income exceeds P720,000",
                percent: "15%",
            },
            // // WI080 , WI081 / WC080 , WC081
            // {
            //     name: "WI080",
            //     descriptions: [
            //         {
            //             name:
            //                 "Other Recipients of Talent Fees - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WI081",
            //     descriptions: [
            //         {
            //             name:
            //                 "Other Recipients of Talent Fees - if gross income is more than 3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC080",
            //     descriptions: [
            //         {
            //             name:
            //                 "Other Recipients of Talent Fees - if gross income for the current year did not exceed P720,000",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC081",
            //     descriptions: [
            //         {
            //             name:
            //                 "Other Recipients of Talent Fees - if gross income exceeds P720,000",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI090 , WI091
            // {
            //     name: "WI090",
            //     descriptions: [
            //         {
            //             name:
            //                 "Fees of Director who are not employees of the company - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WI091",
            //     descriptions: [
            //         {
            //             name:
            //                 "Fees of Director who are not employees of the company - if gross income is more than 3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI100
            // {
            //     name: "WI100",
            //     descriptions: [
            //         {
            //             name:
            //                 "Rentals Oon gross rental or lease for the continued use or possession of personal property in excess of P10,000 annually and real property used in business which the payor or obligor has not taken title or is not taking title, or in which has no equity; poles, satellites, transmission facilities and billboards",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WC100
            // {
            //     name: "WC100",
            //     descriptions: [
            //         {
            //             name:
            //                 "Rentals Oon gross rental or lease for the continued use or possession of personal property in excess of P10,000 annually and real property used in business which the payor or obligor has not taken title or is not taking title, or in which has no equity; poles, satellites, transmission facilities and billboards",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI110
            // {
            //     name: "WI110",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cinemathographic film rentals and other payments to resident indivduals and corporate cinematographic film owners, lessors and distributors",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WC110
            // {
            //     name: "WC110",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cinemathographic film rentals and other payments to resident indivduals and corporate cinematographic film owners, lessors and distributors",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI120
            // {
            //     name: "WI120",
            //     descriptions: [
            //         {
            //             name: "Income payments to certain contractors",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WC120
            // {
            //     name: "WC120",
            //     descriptions: [
            //         {
            //             name: "Income payments to certain contractors",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI130
            // {
            //     name: "WI130",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income distribution to the beneficiaries of estate and trusts",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI139 , WI140
            // {
            //     name: "WI139",
            //     descriptions: [
            //         {
            //             name:
            //                 "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WI140",
            //     descriptions: [
            //         {
            //             name:
            //                 "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income is more than 3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC139",
            //     descriptions: [
            //         {
            //             name:
            //                 "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income for the current year did not exceed P720,000",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC140",
            //     descriptions: [
            //         {
            //             name:
            //                 "Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income exceeds P720,000",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI150 , WI151 / WC150 , WC151
            // {
            //     name: "WI150",
            //     descriptions: [
            //         {
            //             name:
            //                 "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income is more than 3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WI151",
            //     descriptions: [
            //         {
            //             name:
            //                 "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC150",
            //     descriptions: [
            //         {
            //             name:
            //                 "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income exceeds P720,000",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WC151",
            //     descriptions: [
            //         {
            //             name:
            //                 "Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income for the current year did not exceed P720,000",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI152 / WI153
            // {
            //     name: "WI152",
            //     descriptions: [
            //         {
            //             name:
            //                 "Payment by the General Professional Partnership (GPPs) to its partners - if gross income for the current year did not exceed P720,000",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // {
            //     name: "WI153",
            //     descriptions: [
            //         {
            //             name:
            //                 "Payment by the General Professional Partnership (GPPs) to its partners - if gross income exceeds P720,000",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI158
            // {
            //     name: "WI158",
            //     descriptions: [
            //         {
            //             name: "Income payments made by credit card companies",
            //             percents: [
            //                 {
            //                     name: "1% OF 1/2 of gross amount",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC158
            {
                name: "WC158",
                description: "Insurance agents and insurance adjusters - if gross income exceeds P720,000",
                percent: 0.01,
            },
            // // WI159
            // {
            //     name: "WI159",
            //     descriptions: [
            //         {
            //             name:
            //                 "Additional Income Payments to govt personnel from importers, shipping and airline companies or their agents for overtime services",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI640
            // {
            //     name: "WI640",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of goods other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC640
            // {
            //     name: "WC640",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of goods other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WI157
            // {
            //     name: "WI157",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of services other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // //  WC157
            // {
            //     name: "WC157",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by NGAs, LGU, & etc to its local/resident suppliers of services other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI158
            // {
            //     name: "WI158",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by top withholding agents to their local/resident suppliers of goods other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC158
            // {
            //     name: "WC158",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by top withholding agents to their local/resident suppliers of goods other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI160
            // {
            //     name: "WI160",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC160
            // {
            //     name: "WC160",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
            //             percents: [
            //                 {
            //                     name: "2%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI515
            // {
            //     name: "WI515",
            //     descriptions: [
            //         {
            //             name:
            //                 "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC515
            // {
            //     name: "WC515",
            //     descriptions: [
            //         {
            //             name:
            //                 "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income for the current year did not exceed P3M",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI516
            // {
            //     name: "WI516",
            //     descriptions: [
            //         {
            //             name:
            //                 "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income is more than P3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC516
            // {
            //     name: "WC516",
            //     descriptions: [
            //         {
            //             name:
            //                 "Commissions, rebates, discounts and other similar considerations paid/granted to independent and/or exclusive sales representatives and marketing agents and sub-agents of companies, including multi-level marketing companies - if the gross income is more than P3M or VAT registered regardless of amount",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI530
            // {
            //     name: "WI530",
            //     descriptions: [
            //         {
            //             name: "Gross payments to embalmers by funeral parlors",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI535
            // {
            //     name: "WI535",
            //     descriptions: [
            //         {
            //             name:
            //                 "Payments made by pre-need companies to funeral parlors",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC535
            // {
            //     name: "WC535",
            //     descriptions: [
            //         {
            //             name:
            //                 "Payments made by pre-need companies to funeral parlors",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI540
            // {
            //     name: "WI540",
            //     descriptions: [
            //         {
            //             name: "Tolling fees paid to refineries",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC540
            // {
            //     name: "WC540",
            //     descriptions: [
            //         {
            //             name: "Tolling fees paid to refineries",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI610
            // {
            //     name: "WI610",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments made to suppliers of agricultural supplier products in excess of cumulative amount of P300,000 within the same taxable year",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC610
            // {
            //     name: "WC610",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments made to suppliers of agricultural supplier products in excess of cumulative amount of P300,000 within the same taxable year",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI630
            // {
            //     name: "WI630",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments on purchases of minerals, mineral products and quarry resources, such as but not limited to silver, gold, granite, gravel, sand, boulders and other mineral products except purchases by Bangko Sentral ng Pilipinas",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC630
            // {
            //     name: "WC630",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments on purchases of minerals, mineral products and quarry resources, such as but not limited to silver, gold, granite, gravel, sand, boulders and other mineral products except purchases by Bangko Sentral ng Pilipinas",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI632
            // {
            //     name: "WI632",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments on purchases of minerals, mineral products and quarry resources by Bangko Sentral ng Pilipinas ((BSP) from gold miners/suppliers under PD 1899, as amended by RA No. 7076",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC632
            // {
            //     name: "WC632",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments on purchases of minerals, mineral products and quarry resources by Bangko Sentral ng Pilipinas ((BSP) from gold miners/suppliers under PD 1899, as amended by RA No. 7076",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI650
            // {
            //     name: "WI650",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of refund given by MERALCO to customers with active contracts as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC650
            // {
            //     name: "WC650",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of refund given by MERALCO to customers with active contracts as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI651
            // {
            //     name: "WI651",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of refund given by MERALCO to customers with terminated contracts as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC651
            // {
            //     name: "WC651",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of refund given by MERALCO to customers with terminated contracts as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI660
            // {
            //     name: "WI660",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC660
            // {
            //     name: "WC660",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI661
            // {
            //     name: "WI661",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC661
            // {
            //     name: "WC661",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by MERALCO",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI662
            // {
            //     name: "WI662",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by other  by other electric Distribution Utilities (DU)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC662
            // {
            //     name: "WC662",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Residential and General Service customers whose monthly electricity consumption exceeds 200 kwh as classified by other  by other electric Distribution Utilities (DU)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI663
            // {
            //     name: "WI663",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by other electric Distribution Utilities (DU)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC663
            // {
            //     name: "WC663",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross amount of interest on the refund of meter deposits whether paid directly to the customers or applied against customer's billings of Non-Residential customers whose monthly electricity consumption exceeds 200 kwh as classified by other electric Distribution Utilities (DU)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI680
            // {
            //     name: "WI680",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments made by political parties and candidates of local and national elections on all their purchases of goods and services relkated to campaign expenditures, and income payments made by individuals or juridical persons for their purchases of goods and services intented to be given as campaign contribution to political parties and candidates",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC680
            // {
            //     name: "WC680",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments made by political parties and candidates of local and national elections on all their purchases of goods and services relkated to campaign expenditures, and income payments made by individuals or juridical persons for their purchases of goods and services intented to be given as campaign contribution to political parties and candidates",
            //             percents: [
            //                 {
            //                     name: "5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC690
            // {
            //     name: "WC690",
            //     descriptions: [
            //         {
            //             name:
            //                 "Income payments received by Real Estate Investment Trust (REIT)",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI710
            // {
            //     name: "WI710",
            //     descriptions: [
            //         {
            //             name:
            //                 "Interest income denied from any other debt instruments not within the coverage of deposit substitutes and Revenue Regulations 14-2012",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC710
            // {
            //     name: "WC710",
            //     descriptions: [
            //         {
            //             name:
            //                 "Interest income denied from any other debt instruments not within the coverage of deposit substitutes and Revenue Regulations 14-2012",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI720
            // {
            //     name: "WI720",
            //     descriptions: [
            //         {
            //             name: "Income payments on locally produced raw sugar",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC720
            // {
            //     name: "WC720",
            //     descriptions: [
            //         {
            //             name: "Income payments on locally produced raw sugar",
            //             percents: [
            //                 {
            //                     name: "1%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC180
            // {
            //     name: "WC180",
            //     descriptions: [
            //         {
            //             name:
            //                 "Interest on Foreign loans payable to Non-Resident Foreign Corporation (NRFCs)",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC190
            // {
            //     name: "WC190",
            //     descriptions: [
            //         {
            //             name:
            //                 "Interest and other income payments on foreign currency transactions/loans payable of Offshore Banking Units (OBUs)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC191
            // {
            //     name: "WC191",
            //     descriptions: [
            //         {
            //             name:
            //                 "Interest and other income payments on foreign currency transactions/loans payable of Foreign Currency Deposits Units (FCDUs)",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI202
            // {
            //     name: "WI202",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash dividend payment by domestic corporation to citizens ans residents aliens/NRFCs",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC212
            // {
            //     name: "WC212",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash dividend payment by domestic corporation to citizens ans residents aliens/NRFCs",
            //             percents: [
            //                 {
            //                     name: "30%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI203
            // {
            //     name: "WI203",
            //     descriptions: [
            //         {
            //             name:
            //                 "Property dividend payment by domestic corporation to citizens and resident aliens/NRFCs",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC213
            // {
            //     name: "WC213",
            //     descriptions: [
            //         {
            //             name:
            //                 "Property dividend payment by domestic corporation to citizens and resident aliens/NRFCs",
            //             percents: [
            //                 {
            //                     name: "30%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC222
            // {
            //     name: "WC222",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash dividend payment by domestic corporation to NFRCs whose countries allowed tax deemed paid credit (subject to tax sparing rule)",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC223
            // {
            //     name: "WC223",
            //     descriptions: [
            //         {
            //             name:
            //                 "Property dividend payment by domestic corporation to NFRCs whose countries allowed tax deemed paid credit (subject to tax sparing rule)",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI224
            // {
            //     name: "WI224",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash dividend payment by domestic corporation to non-resident alien engaged in Trade or Business within the Philippines (NRAETB) ",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI225
            // {
            //     name: "WI225",
            //     descriptions: [
            //         {
            //             name:
            //                 "Property dividend payment by domestic corporation to NRAETB",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI226
            // {
            //     name: "WI226",
            //     descriptions: [
            //         {
            //             name:
            //                 "Share of NRAETB in the distributable net income after tax of a partnership (except GPPs) of which he is a partner, or share in the net income after tax of an association, joint account or a joint venture taxable as a corporation of which he is a member or a co-venturer",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC230
            // {
            //     name: "WC230",
            //     descriptions: [
            //         {
            //             name: "On other payments to NRFCs",
            //             percents: [
            //                 {
            //                     name: "30%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI240
            // {
            //     name: "WI240",
            //     descriptions: [
            //         {
            //             name:
            //                 "Distributive share of individual partners in a taxable partnership, association, joint account or joint venture or consortium",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI250
            // {
            //     name: "WI250",
            //     descriptions: [
            //         {
            //             name:
            //                 "All kinds of royalty payments to citizens, resident aliens and NRAETB (other than WI380 and WI341), domestic and resident foreign corporations",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC250
            // {
            //     name: "WC250",
            //     descriptions: [
            //         {
            //             name:
            //                 "All kinds of royalty payments to citizens, resident aliens and NRAETB (other than WI380 and WI341), domestic and resident foreign corporations",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI260
            // {
            //     name: "WI260",
            //     descriptions: [
            //         {
            //             name:
            //                 "On prizes exceeding P10,000 and other winnings paid to individuals",
            //             percents: [
            //                 {
            //                     name: "20%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC280
            // {
            //     name: "WC280",
            //     descriptions: [
            //         {
            //             name:
            //                 "Branch profit remittance by all corporations except PEZA/SBMA/CDA registered",
            //             percents: [
            //                 {
            //                     name: "15%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC290
            // {
            //     name: "WC290",
            //     descriptions: [
            //         {
            //             name:
            //                 "On the gross rentals, lease and charter fees derived by non-resident owner or lessor of foreign vessels",
            //             percents: [
            //                 {
            //                     name: "4.5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC300
            // {
            //     name: "WC300",
            //     descriptions: [
            //         {
            //             name:
            //                 "On gross rentals, charter and other fees derived by non-resident lessor or aircraft, machineries and equipment",
            //             percents: [
            //                 {
            //                     name: "7.5%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI310
            // {
            //     name: "WI310",
            //     descriptions: [
            //         {
            //             name:
            //                 "On payments to oil exploration service contractors/sub-contractors",
            //             percents: [
            //                 {
            //                     name: "8%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC310
            // {
            //     name: "WC310",
            //     descriptions: [
            //         {
            //             name:
            //                 "On payments to oil exploration service contractors/sub-contractors",
            //             percents: [
            //                 {
            //                     name: "8%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI330
            // {
            //     name: "WI330",
            //     descriptions: [
            //         {
            //             name:
            //                 "Payments to non-resident alien not engage in trade or business within the Philippines (NRANETB) except on sale of shares in domestic corporation and real property",
            //             percents: [
            //                 {
            //                     name: "25%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI340
            // {
            //     name: "WI340",
            //     descriptions: [
            //         {
            //             name:
            //                 "On payments to non-residnet individual/foreign corporate cinematographic film owners, lessors or distributors",
            //             percents: [
            //                 {
            //                     name: "25%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC340
            // {
            //     name: "WC340",
            //     descriptions: [
            //         {
            //             name:
            //                 "On payments to non-residnet individual/foreign corporate cinematographic film owners, lessors or distributors",
            //             percents: [
            //                 {
            //                     name: "25%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI341
            // {
            //     name: "WI341",
            //     descriptions: [
            //         {
            //             name:
            //                 "Royalties paid to NRAETB on cinematographic films and similar works",
            //             percents: [
            //                 {
            //                     name: "25%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI350
            // {
            //     name: "WI350",
            //     descriptions: [
            //         {
            //             name:
            //                 "Final tax on interest or other payments upon tax-free covenant bonds, mortgages, deeds of trust or other obligations under Sec. 57C of the NIRC of 1997, as amended",
            //             percents: [
            //                 {
            //                     name: "30%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI380
            // {
            //     name: "WI380",
            //     descriptions: [
            //         {
            //             name:
            //                 "Royalties paid to citizens, resident aliens and nraetb on books, other literary works and musical compositions",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI410
            // {
            //     name: "WI410",
            //     descriptions: [
            //         {
            //             name:
            //                 "Informers cash reward to individuals/juridical persons",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC410
            // {
            //     name: "WC410",
            //     descriptions: [
            //         {
            //             name:
            //                 "Informers cash reward to individuals/juridical persons",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WI700
            // {
            //     name: "WI700",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash on property dividend paid by a Real Estate Investment Trust  ",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
            // // WC700
            // {
            //     name: "WC700",
            //     descriptions: [
            //         {
            //             name:
            //                 "Cash on property dividend paid by a Real Estate Investment Trust  ",
            //             percents: [
            //                 {
            //                     name: "10%",
            //                 },
            //             ],
            //         },
            //     ],
            // },
        ],
    },
});
