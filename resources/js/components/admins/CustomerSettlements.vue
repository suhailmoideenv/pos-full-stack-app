<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Debit Payment</span>
                  <span class="w-numeric-title">Go to columns for details.</span><br /><br />
                  <button class="btn btn-primary" @click="show_create_form = !show_create_form">
                    <span v-if="show_create_form == 0">Show Create Form</span>
                    <span v-if="show_create_form == 1">Hide Create Form</span>
                  </button>
                  <button id="btn-edit" class="float-left btn btn-success mr-2" @click="printSection">Print</button>
                </div>


              </div>
              <div class="w-chart">
                <div id="daily-sales"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row col-12" v-if="show_create_form == 1">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget-two">
              <div class="widget-content">
                <div class="w-numeric-value">
                  <div class="w-content">
                    <span class="w-value" v-if="outstanding_amount == null">Create a Debit Payment</span>
                    <span class="w-value" v-if="outstanding_amount != null">Create a Debit Payment - Outstanding Amount AED {{ outstanding_amount }}</span>
                  </div>
                  <div class="w-icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-dollar-sign">
                      <line x1="12" y1="1" x2="12" y2="23"></line>
                      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                  </div>
                </div>

                <div style="margin: 50px">
                  <div class="widget-content">
                    <!-- Create User Form Start -->

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createDebitPayment">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Select Customer</label>
                                    <!-- <select id="inputState" class="form-control" :class=" errors.customer_id ? 'form-control is-invalid' : 'form-control' " @change="set_customer_id($event)">
                                        <option value="null" style="color: black;">Please Select Customer</option>
                                        <option style="color: black;" v-for="(customer,index) in customers" :key="index" :value="customer.id" >{{customer.name}}</option>
                                    </select>
                                <small v-if="errors.customer_id" class="text-danger">{{errors.customer_id[0]}}</small> -->
                                <v-select class="style-chooser" style="color: black;" label="name" v-model="customer_id" :options="customers" :reduce="customers => customers.id" :value="customers.id"  @input="getOutstandingAmount" placeholder="Select"></v-select>
                            </div>

                            <div class="col">
                               <label for="exampleFormControlInput1">Debit Amount(AED)</label>
                               <input type="text" :class=" errors.debit_amount? 'form-control is-invalid' : 'form-control'" placeholder="AED: XXX.XX" v-model="debit_amount"/>
                               <small v-if="errors.debit_amount" class="text-danger">{{ errors.debit_amount[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Select Date</label>
                                <input type="date" style="color-scheme: dark;" :class=" errors.date? 'form-control is-invalid' : 'form-control'" placeholder="Date" v-model="date"/>
                                <small v-if="errors.date" class="text-danger">{{ errors.date[0] }}</small>
                            </div>

                        </div>

                        <input type="submit" value="submit" class="btn btn-primary"/>
                      </div>
                    </form>
                    <!-- Create User Form End  -->
                  </div>
                </div>

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
                <span class="w-numeric-title">Customer Settlements</span>
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
                        <div class="th-content">Id</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Debit(AED)</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Credit(AED)</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Balance(AED)</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Date</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Customer</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Order</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Created Date</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(customer_settlement, index) in pageOfItems" :key="index">
                      <td class="text-center">{{ customer_settlement.id }}</td>
                      <td class="text-center">{{ customer_settlement.debit_amount }}</td>
                      <td class="text-center">{{ customer_settlement.credit_amount }}</td>
                      <td class="text-center">{{ customer_settlement.balance_amount }}</td>
                      <td class="text-center">{{ customer_settlement.date }}</td>
                      <td class="text-center">{{ customer_settlement.customer_name }}</td>
                      <td class="text-center">{{ customer_settlement.orders_id }}</td>
                      <td class="text-center">{{ customer_settlement.created }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="card-footer pb-0 pt-3">
        <jw-pagination :items="customer_settlements" @changePage="onChangePage"></jw-pagination>
      </div>

    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      customers: [],
      customer_settlements: [],
      pageOfItems: [],

      id: null,
      outstanding_amount: null,
      customer_id: null,
      debit_amount: null,
      date: null,
      active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchCustomers();
    this.getCustomerSettlements();
  },

  methods: {
    reset() {
      this.customers = [];
      this.customer_settlements = [];
      this.pageOfItems = [];
      this.id = null;
      this.outstanding_amount = null;
      this.customer_id = null;
      this.debit_amount = null;
      this.date = null;

      //for edit purpose
    },

    onChangePage(pageOfItems) {
        // update page of items
        this.pageOfItems = pageOfItems;
    },

    set_customer_id(event){
        this.customer_id = event.target.value;
    },

    getOutstandingAmount() {
        axios.post("/admin/fetch/customer-outstanding-amount",{
            customer_id: this.customer_id,
        }).then(res => {
                if (res.status == 200) {
                    console.log(res);
                    this.outstanding_amount = res.data;
                }
            }).catch(err => {
                console.log("error:" + err);
            });
    },

    printSection() {
        this.$htmlToPaper("printSection");
    },

    fetchCustomers() {
      axios
        .get("/admin/fetch/customers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.customers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    createDebitPayment(){

        this.errors = [];
        
        axios.post("/admin/create/debit-payment",{
            customer_id: this.customer_id,
            debit_amount: this.debit_amount,
            date: this.date,

            }).then(res =>{
                if(res.status == 200 && res.data == 1){
                    Swal.fire({
                        position: "top-end",
                                icon: "success",
                                title: "Successfully Insert a Debit Payment",
                                showConfirmButton: false,
                                timer: 1500
                });

                this.reset();
                this.fetchCustomers();
                this.getCustomerSettlements();

                }
            }).catch(err =>{
                
                if(err.response.status == 422){
                    this.errors = err.response.data.errors;
                    Swal.fire("Error", "Debit Payment Submit Unsuccessfull!", "error");
            }
        });
            
    },

    getCustomerSettlements() {
      axios
        .get("/admin/fetch/get-customer-settlements")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.customer_settlements = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },
    
  },
};
</script>