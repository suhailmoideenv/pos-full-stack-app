<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Customer Order Report</span><br />
                  
                  <button class="btn btn-success" @click="printSection">Print</button>
                  
                </div>

              </div>
              <div class="w-chart">
                <div id="daily-sales"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="printSection">
        <span v-html="printStuff"></span>
        <div class="widget-two">
          <div class="widget-content">
            <div class="w-numeric-value">
              <div class="w-content">
                <span class="w-value">Hadiyya POS</span>
                <span class="w-numeric-title">Customer Order Report</span>
              </div>
            </div>
          </div>

          <div style="margin: 50px">
            <div class="widget-content">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">
                        <div class="th-content">Order Id</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Customer</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Table</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Payment Type</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Order Type</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Status</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Created Date</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(order, index) in pageOfItems" :key="index">
                      <td class="text-center">{{ order.id }}</td>
                      <td class="text-center">{{ order.customer_name }}</td>
                      <td class="text-center">{{ order.tables_name }}</td>
                      <td class="text-center">{{ order.payment_type }}</td>
                      <td class="text-center">{{ order.order_type }}</td>
                      <td class="text-center">{{ order.status }}</td>
                      <td class="text-center">{{ order.created }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="card-footer pb-0 pt-3">
        <jw-pagination :items="orders" @changePage="onChangePage"></jw-pagination>
      </div>

    </div>
  </div>
</template>


<script>

export default {
  data() {
    return {
      orders: [],
      errors: [],
      pageOfItems: [],
      search: null,
    };
  },

  mounted() {
    this.fetchCustomerOrders();
  },

  methods: {
    reset() {
      this.errors = [];
      this.orders = [],
      this.pageOfItems = [];
      this.search = null;
    },

    onChangePage(pageOfItems) {
        // update page of items
        this.pageOfItems = pageOfItems;
    },

    printSection() {
        this.$htmlToPaper("printSection");
    },

    fetchCustomerOrders() {
      axios
        .get("/admin/fetch/customer-orders-report")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.orders = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },
    
  },
};
</script>