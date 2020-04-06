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
            //  WI100 / WC100
            {
                name: "WI100 / WC100",
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
            //  WI110 / WC110
            {
                name: "WI110 / WC110",
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
            //  WI120 / WC120
            {
                name: "WI120 / WC120",
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
                            "	Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if the gross income for the current year did not exceed P3M",
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
                            "	Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income is more than 3M or VAT registered regardless of amount",
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
                            "	Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income for the current year did not exceed P720,000",
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
                            "	Gross Commission of service fees of customs, insurance, stock, immigration and commercial brokers, fees of agents of professional entertainers and real estate service practitioners (RESPs)(i.e. real estate consultants, real estate appraisers and real estate brokers - if gross income exceeds P720,000",
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
                            "	Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income exceeds P720,000",
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
                            "	Professional fees paid to medical practitioners (includes doctors of medicine, doctors of veterinary science & dentist)  by hospitals & clinics or paid directly by HMO and/or other semilar establishments - if gross income for the current year did not exceed P720,000",
                        percents: [
                            {
                                name: "10%",
                            },
                        ],
                    },
                ],
            },
        ],
    },
});
