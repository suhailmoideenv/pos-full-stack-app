<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Driver Settlement</span>
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
                    <span class="w-value" v-if="full_payment == null">Create a Driver Settlement</span>
                    <span class="w-value" v-if="full_payment != null">Create a Driver Settlement - Total Payments AED {{ full_payment }}</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createPayment">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Select Driver</label>
                                    <!-- <select id="inputState" class="form-control" :class=" errors.driver_id ? 'form-control is-invalid' : 'form-control' " @change="set_driver_id($event)">
                                        <option value="null" style="color: black;">Please Select Driver</option>
                                        <option style="color: black;" v-for="(driver,index) in drivers" :key="index" :value="driver.id" >{{driver.name}}</option>
                                    </select>
                                <small v-if="errors.driver_id" class="text-danger">{{errors.driver_id[0]}}</small> -->
                                <v-select class="style-chooser" style="color: black;" label="name" v-model="driver_id" :options="drivers" :reduce="drivers => drivers.id" :value="drivers.id"  @input="getFullPayment" placeholder="Select"></v-select>
                            </div>

                            <div class="col">
                               <label for="exampleFormControlInput1">Amount(AED)</label>
                               <input type="text" :class=" errors.amount? 'form-control is-invalid' : 'form-control'" placeholder="AED: XXX.XX" v-model="amount"/>
                               <small v-if="errors.amount" class="text-danger">{{ errors.amount[0] }}</small>
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
                <span class="w-numeric-title">Driver Settlements Report</span>
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
                        <div class="th-content">Amount(AED)</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Date</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Driver</div>
                      </th>
                      <th class="text-center">
                        <div class="th-content">Created Date</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(driver_settlement, index) in pageOfItems" :key="index">
                      <td class="text-center">{{ driver_settlement.id }}</td>
                      <td class="text-center">{{ driver_settlement.amount }}</td>
                      <td class="text-center">{{ driver_settlement.date }}</td>
                      <td class="text-center">{{ driver_settlement.driver_name }}</td>
                      <td class="text-center">{{ driver_settlement.created }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="card-footer pb-0 pt-3">
        <jw-pagination :items="driver_settlements" @changePage="onChangePage"></jw-pagination>
      </div>

    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      drivers: [],
      driver_settlements: [],
      pageOfItems: [],

      id: null,
      full_payment: null,
      driver_id: null,
      amount: null,
      date: null,
      active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchDrivers();
    this.getDriverSettlements();
  },

  methods: {
    reset() {
      this.drivers = [];
      this.driver_settlements = [];
      this.pageOfItems = [];
      this.id = null;
      this.full_payment = null;
      this.driver_id = null;
      this.amount = null;
      this.date = null;

      //for edit purpose
    },

    onChangePage(pageOfItems) {
        // update page of items
        this.pageOfItems = pageOfItems;
    },

    set_driver_id(event){
        this.driver_id = event.target.value;
    },

    getFullPayment() {
        axios.post("/admin/fetch/driver-full-payment",{
            driver_id: this.driver_id,
        }).then(res => {
                if (res.status == 200) {
                    console.log(res);
                    this.full_payment = res.data;
                }
            }).catch(err => {
                console.log("error:" + err);
            });
    },

    fetchDrivers() {
      axios
        .get("/admin/fetch/drivers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.drivers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    createPayment(){

        this.errors = [];
        
        axios.post("/admin/create/driver-settlement-payment",{
            driver_id: this.driver_id,
            amount: this.amount,
            date: this.date,

            }).then(res =>{
                if(res.status == 200 && res.data == 1){
                    Swal.fire({
                        position: "top-end",
                                icon: "success",
                                title: "Successfully Insert a Settlement",
                                showConfirmButton: false,
                                timer: 1500
                });

                this.reset();
                this.fetchDrivers();       
                this.getDriverSettlements();

                }
            }).catch(err =>{
                
                if(err.response.status == 422){
                    this.errors = err.response.data.errors;
                    Swal.fire("Error", "Settlement Submit Unsuccessfull!", "error");
            }
        });
            
    },

    printSection() {
        this.$htmlToPaper("printSection");
    },

    getDriverSettlements() {
      axios
        .get("/admin/fetch/get-driver-settlements")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.driver_settlements = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },
    
  },
};
</script>