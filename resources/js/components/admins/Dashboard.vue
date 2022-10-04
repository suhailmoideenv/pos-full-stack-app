<template>

    <div class="row">

        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TOTAL CUSTOMERS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0">{{ this.customer_count }}</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors"
                                data-height="30"></div>
                        </div>
                    </div>


                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ this.last_week_customer_percentage }}% more than last week<br />
                        <i class="far fa-user fa-fw me-1"></i> {{ this.last_month_customer_percentage }}% more than last month<br />
                        <i class="far fa-times-circle fa-fw me-1"></i> {{ this.latest_customer }} is the latest customer
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">CUSTOMER SALES</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0">AED {{ this.all_order_total }}</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors"
                                data-height="30"></div>
                        </div>
                    </div>


                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-shopping-bag fa-fw me-1"></i> AED {{ this.today_income }} today's income<br />
                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ this.last_week_order_percentage }}% income last week<br />
                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ this.last_month_order_percentage }}% income last month
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TOTAL DRIVERS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0">{{ this.driver_count }}</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors"
                                data-height="30"></div>
                        </div>
                    </div>


                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ this.last_week_driver_percentage }}% more than last week<br />
                        <i class="far fa-user fa-fw me-1"></i> {{ this.last_month_driver_percentage }}% more than last month<br />
                        <i class="far fa-times-circle fa-fw me-1"></i> {{ this.latest_driver }} is the latest driver
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DRIVER SETTLEMENTS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0">AED {{ this.all_driver_settlements }}</h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n3 mb-n2" data-render="apexchart" data-type="donut"
                                data-title="Visitors" data-height="45"></div>
                        </div>
                    </div>


                    <div class="small text-white text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i>Last Settlement - {{ this.latest_settlement }} <br />
                        <i class="far fa-hdd fa-fw me-1"></i> AED {{ this.last_week_settlements }} in last week<br />
                        <i class="far fa-hand-point-up fa-fw me-1"></i> AED {{ this.last_month_settlements }} in last month
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TARGET STATS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <!-- <div class="ratio ratio-21x9 mb-3">
                        <div id="chart-server"></div>
                    </div> -->


                    <div class="row">

                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center">

                                <!-- <div class="w-50px h-50px">
                                    <div data-render="apexchart" data-type="donut" data-title="Visitors"
                                        data-height="50"></div>
                                </div> -->


                                <div class="ps-3 flex-1" v-for="(daily_target_stat, index) in daily_target_stats" :key="index">
                                    <div class="fs-10px fw-bold text-white text-opacity-50 mb-1">DAILY TARGET
                                    </div>
                                    <div class="mb-2 fs-5 text-truncate">{{ daily_target_stat.order_total }} / {{ daily_target_stat.target_amount }} AED</div>
                                    <div class="progress h-3px bg-white-transparent-2 mb-1">
                                        <div class="progress-bar bg-theme" :style="daily_target_stat.target_percentage_style"></div>
                                    </div>
                                    <div class="fs-11px text-white text-opacity-50 mb-2 text-truncate">
                                        Last updated {{ daily_target_stat.last_updated }} min ago
                                    </div>
                                    <div class="d-flex align-items-center small">
                                        <i class="bi bi-circle-fill fs-6px me-2 text-theme"></i>
                                        <div class="flex-1">MORE TO EARN</div>
                                        <div>{{ daily_target_stat.to_earn }} AED</div>
                                    </div>
                                    <div class="d-flex align-items-center small">
                                        <i class="bi bi-circle-fill fs-6px me-2 text-theme text-opacity-50"></i>
                                        <div class="flex-1">TARGET DONE</div>
                                        <div>{{ daily_target_stat.target_percentage }}%</div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="d-flex">

                                <!-- <div class="w-50px pt-3">
                                    <div data-render="apexchart" data-type="donut" data-title="Visitors"
                                        data-height="50"></div>
                                </div> -->


                                <div class="ps-3 flex-1" v-for="(monthly_target_stat, index) in monthly_target_stats" :key="index">
                                    <div class="fs-10px fw-bold text-white text-opacity-50 mb-1">MONTHLY TARGET</div>
                                    <div class="mb-2 fs-5 text-truncate">{{ monthly_target_stat.order_total }} / {{ monthly_target_stat.target_amount }} AED</div>
                                    <div class="progress h-3px bg-white-transparent-2 mb-1">
                                        <div class="progress-bar bg-theme" :style="monthly_target_stat.target_percentage_style"></div>
                                    </div>
                                    <div class="fs-11px text-white text-opacity-50 mb-2 text-truncate">
                                        Last updated {{ monthly_target_stat.last_updated }} min ago
                                    </div>
                                    <div class="d-flex align-items-center small">
                                        <i class="bi bi-circle-fill fs-6px me-2 text-theme"></i>
                                        <div class="flex-1">MORE TO EARN</div>
                                        <div>{{ monthly_target_stat.to_earn }} AED</div>
                                    </div>
                                    <div class="d-flex align-items-center small">
                                        <i class="bi bi-circle-fill fs-6px me-2 text-theme text-opacity-50"></i>
                                        <div class="flex-1">TARGET DONE</div>
                                        <div>{{ monthly_target_stat.target_percentage }}%</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">ORDERS ANALYTICS - {{ this.all_orders_count }}</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <!-- <div class="ratio ratio-21x9 mb-3">
                        <div id="world-map" class="jvectormap-without-padding"></div>
                    </div> -->


                    <div class="row gx-4">

                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <table class="w-100 small mb-0 text-truncate text-white text-opacity-60">
                                <thead>
                                    <tr class="text-white text-opacity-75">
                                        <th class="w-50">CUSTOMER</th>
                                        <th class="w-25 text-end">ORDERS</th>
                                        <th class="w-25 text-end">PCT%</th>
                                    </tr>
                                </thead>
                                <tbody v-for="(orders_analytic, index) in ordersAnalytics.slice(0, 5)" :key="index">
                                    <tr>
                                        <td>{{ orders_analytic.name }}</td>
                                        <td class="text-end">{{ orders_analytic.orders_count }}</td>
                                        <td class="text-end">{{ orders_analytic.percentage }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-lg-6">

                            <div class="card">

                                <div class="card-body py-2">
                                    <div class="d-flex align-items-center">
                                        <!-- <div class="w-70px">
                                            <div data-render="apexchart" data-type="donut" data-height="70">
                                            </div>
                                        </div> -->
                                        <div class="flex-1 ps-2">
                                            <table class="w-100 small mb-0 text-white text-opacity-60">
                                                <tbody>
                                                    <tr v-for="(product_analytic, index) in productsAnalytics.slice(0, 5)" :key="index">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="w-6px h-6px rounded-pill me-2 bg-theme bg-opacity-95">
                                                                </div> {{ product_analytic.name }}
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ product_analytic.percentage }}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TOP PRODUCTS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="table-responsive">
                        <table class="w-100 mb-0 small align-middle text-nowrap">
                            <tbody>
                                <tr v-for="(topProductsAnalytic, index) in topProductsAnalytics.slice(0, 3)" :key="index">
                                    <td>
                                        <div class="d-flex">
                                            <div class="position-relative mb-2">
                                                <img class="bg-center bg-cover bg-no-repeat w-80px h-60px"
                                                    :src="`/storage/items/${topProductsAnalytic.image}`"/>
                                                <!-- </div> -->
                                                <div class="position-absolute top-0 start-0">
                                                    <span
                                                        class="badge bg-theme text-theme-900 rounded-0 d-flex align-items-center justify-content-center w-20px h-20px">{{ index + 1 }}</span>
                                                </div>
                                            </div>
                                            <div class="flex-1 ps-3">
                                                <div class="mb-1"><small
                                                        class="fs-9px fw-500 lh-1 d-inline-block rounded-0 badge bg-white bg-opacity-25 text-white text-opacity-75 pt-5px">{{ topProductsAnalytic.category_name }}</small>
                                                </div>
                                                <div class="fw-500 text-white">{{ topProductsAnalytic.name }}</div>
                                                AED {{ topProductsAnalytic.price }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <table class="mb-2">
                                            <tr>
                                                <td class="pe-3">QTY:</td>
                                                <td class="text-white text-opacity-75 fw-500">{{ topProductsAnalytic.product_quantity_count }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">REVENUE:</td>
                                                <td class="text-white text-opacity-75 fw-500">AED {{ topProductsAnalytic.product_revenue }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><a href="#" class="text-decoration-none text-white"><i
                                                class="bi bi-search"></i></a></td>
                                </tr>
                                <tr v-for="(topProductsAnalytic, index) in topProductsAnalytics.slice(3, 5)" :key="index">
                                    <td>
                                        <div class="d-flex mb-2 align-items-center">
                                            <div class="position-relative">
                                                <img class="bg-center bg-cover bg-no-repeat w-80px h-60px"
                                                    :src="`/storage/items/${topProductsAnalytic.image}`"/>
                                                <!-- </div> -->
                                                <div class="position-absolute top-0 start-0">
                                                    <span
                                                        class="badge bg-black bg-opacity-50 rounded-0 d-flex align-items-center justify-content-center w-20px h-20px">{{ index + 4 }}</span>
                                                </div>
                                            </div>
                                            <div class="flex-1 ps-3">
                                                <div class="mb-1"><small
                                                        class="fs-9px fw-500 lh-1 d-inline-block rounded-0 badge bg-white bg-opacity-25 text-white text-opacity-75 pt-5px">{{ topProductsAnalytic.category_name }}</small>
                                                </div>
                                                <div class="text-white fw-500">{{ topProductsAnalytic.name }}</div>
                                                AED {{ topProductsAnalytic.price }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <table class="mb-2">
                                            <tr>
                                                <td class="pe-3">QTY:</td>
                                                <td class="text-white text-opacity-75 fw-500">{{ topProductsAnalytic.product_quantity_count }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-3">REVENUE:</td>
                                                <td class="text-white text-opacity-75 fw-500">AED {{ topProductsAnalytic.product_revenue }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><a href="#" class="text-decoration-none text-white"><i
                                                class="bi bi-search"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>


        <div class="col-xl-6">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">LAST 10 ORDERS</span>
                        <a href="#" data-toggle="card-expand"
                            class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped table-borderless mb-2px small text-nowrap">
                            <tbody>
                                <tr v-for="(last_ten_order, index) in last_ten_orders.slice(0, 10)" :key="index">
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>
                                            {{ last_ten_order.customer_details }}
                                        </span>
                                    </td>
                                    <td><small>{{ last_ten_order.time_difference }} min ago</small></td>
                                    <td>
                                        <span
                                            class="badge d-block bg-theme text-theme-900 rounded-0 pt-5px w-70px"
                                            style="min-height: 18px">{{ last_ten_order.order_type_name }}</span>
                                    </td>
                                    <td><a href="#" class="text-decoration-none text-white"><i
                                                class="bi bi-search"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>

            </div>

        </div>

    </div>

</template>

<script>
export default {

    data() {
        return {
            customer_count: null,
            last_week_customer_percentage: null,
            last_month_customer_percentage: null,
            latest_customer: null,

            all_order_total: null,
            today_income: null,
            last_week_order_percentage: null,
            last_month_order_percentage: null,

            driver_count: null,
            last_week_driver_percentage: null,
            last_month_driver_percentage: null,
            latest_driver: null,

            all_driver_settlements: null,
            latest_settlement: null,
            last_week_settlements: null,
            last_month_settlements: null,

            daily_target_stats: [],
            monthly_target_stats: [],

            all_orders_count: null,
            orders_analytics: [],
            products_analytics: [],

            top_products: [],

            last_ten_orders: [],
        
        };
    },

    mounted() {
        this.startSession();
        this.getAllCustomers();
        this.getLastWeekCustomerPercentage();
        this.getLastMonthCustomerPercentage();
        this.getLatestCustomer();
        this.getAllOrderTotal();
        this.getTodayIncome();
        this.getLastWeekOrderPercentage();
        this.getLastMonthOrderPercentage();
        this.getAllDrivers();
        this.getLastWeekDriverPercentage();
        this.getLastMonthDriverPercentage();
        this.getLatestDriver();
        this.getAllDriverSettlements();
        this.getLatestDriverSettlements();
        this.getLastWeekSettlements();
        this.getLastMonthSettlements();
        this.getDailyTargetStats();
        this.getMonthlyTargetStats();
        this.getAllOrdersCount();
        this.getOrdersAnalytics();
        this.getProductsAnalytics();
        this.getTopProducts();
        this.getLastTenOrders();
    },

    computed: {
        ordersAnalytics() {
            return _.orderBy(this.orders_analytics, 'percentage', 'desc'); 
        },

        productsAnalytics() {
            return _.orderBy(this.products_analytics, 'percentage', 'desc'); 
        },

        topProductsAnalytics() {
            return _.orderBy(this.top_products, 'product_quantity_count', 'desc'); 
        }
    },

    methods:{
        startSession()
        {
            axios
            .get("/admin/dashboard/startSession")
            .then((res) => {
                if (res.status == 200) {
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getAllCustomers()
        {
            axios
            .get("/admin/dashboard/getAllCustomers")
            .then((res) => {
                if (res.status == 200) {
                    this.customer_count = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastWeekCustomerPercentage()
        {
            axios
            .get("/admin/dashboard/getLastWeekCustomerPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_week_customer_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastMonthCustomerPercentage()
        {
            axios
            .get("/admin/dashboard/getLastMonthCustomerPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_month_customer_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLatestCustomer()
        {
            axios
            .get("/admin/dashboard/getLatestCustomer")
            .then((res) => {
                if (res.status == 200) {
                    this.latest_customer = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getAllOrderTotal()
        {
            axios
            .get("/admin/dashboard/getAllOrderTotal")
            .then((res) => {
                if (res.status == 200) {
                    this.all_order_total = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getTodayIncome()
        {
            axios
            .get("/admin/dashboard/getTodayIncome")
            .then((res) => {
                if (res.status == 200) {
                    this.today_income = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastWeekOrderPercentage()
        {
            axios
            .get("/admin/dashboard/getLastWeekOrderPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_week_order_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastMonthOrderPercentage()
        {
            axios
            .get("/admin/dashboard/getLastMonthOrderPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_month_order_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getAllDrivers()
        {
            axios
            .get("/admin/dashboard/getAllDrivers")
            .then((res) => {
                if (res.status == 200) {
                    this.driver_count = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastWeekDriverPercentage()
        {
            axios
            .get("/admin/dashboard/getLastWeekDriverPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_week_driver_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastMonthDriverPercentage()
        {
            axios
            .get("/admin/dashboard/getLastMonthDriverPercentage")
            .then((res) => {
                if (res.status == 200) {
                    this.last_month_driver_percentage = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLatestDriver()
        {
            axios
            .get("/admin/dashboard/getLatestDriver")
            .then((res) => {
                if (res.status == 200) {
                    this.latest_driver = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getAllDriverSettlements()
        {
            axios
            .get("/admin/dashboard/getAllDriverSettlements")
            .then((res) => {
                if (res.status == 200) {
                    this.all_driver_settlements = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLatestDriverSettlements()
        {
            axios
            .get("/admin/dashboard/getLatestDriverSettlements")
            .then((res) => {
                if (res.status == 200) {
                    this.latest_settlement = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastWeekSettlements()
        {
            axios
            .get("/admin/dashboard/getLastWeekSettlements")
            .then((res) => {
                if (res.status == 200) {
                    this.last_week_settlements = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastMonthSettlements()
        {
            axios
            .get("/admin/dashboard/getLastMonthSettlements")
            .then((res) => {
                if (res.status == 200) {
                    this.last_month_settlements = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getDailyTargetStats()
        {
            axios
            .get("/admin/dashboard/getDailyTargetStats")
            .then((res) => {
                if (res.status == 200) {
                    this.daily_target_stats = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getMonthlyTargetStats()
        {
            axios
            .get("/admin/dashboard/getMonthlyTargetStats")
            .then((res) => {
                if (res.status == 200) {
                    this.monthly_target_stats = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getAllOrdersCount()
        {
            axios
            .get("/admin/dashboard/getAllOrdersCount")
            .then((res) => {
                if (res.status == 200) {
                    this.all_orders_count = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getOrdersAnalytics()
        {
            axios
            .get("/admin/dashboard/getOrdersAnalytics")
            .then((res) => {
                if (res.status == 200) {
                    this.orders_analytics = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getProductsAnalytics()
        {
            axios
            .get("/admin/dashboard/getProductsAnalytics")
            .then((res) => {
                if (res.status == 200) {
                    this.products_analytics = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getTopProducts()
        {
            axios
            .get("/admin/dashboard/getTopProducts")
            .then((res) => {
                if (res.status == 200) {
                    this.top_products = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },

        getLastTenOrders()
        {
            axios
            .get("/admin/dashboard/getLastTenOrders")
            .then((res) => {
                if (res.status == 200) {
                    this.last_ten_orders = res.data;
                    console.log(res);
                }
            })
            .catch((err) => {
                console.log("error:" + err);
            });
        },
  }
}

</script>