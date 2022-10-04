<template>
    
    <div>
      <div id="app" class="app app-content-full-height app-without-sidebar app-without-header">

        <div id="" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">

          <div class="pos pos-vertical card" id="pos">

            <div class="pos-container card-body">

              <div class="pos-header">
                <div class="logo">
                  <a href="#" @click="fetchPendingOrderItems()">
                    <div class="logo-img"><i class="bi bi-x-diamond" style="font-size: 1.5rem;"></i></div>
                    <div class="logo-text">Pending Orders</div>
                  </a>
                </div>
                <div class="time" id="time">{{this.time}}</div>
              </div>


              <div class="pos-content">

                <div class="pos-content-container h-100 p-0" data-scrollbar="true" data-height="100%" v-if="this.show_pending_view == 1">

                  <div class="pos-content-container p-3" data-scrollbar="true" data-height="100%">
                    <div class="row gx-3">
                      <div class="col-xl-3 col-lg-4 col-md-6 pb-3" v-for="(order_item,index) in order_items" :key="index">
                        <div class="pos-checkout-table in-use card" @click="fetchPendingOrderDetails(order_item.id)">
                          <a href="#" class="pos-checkout-table-container"
                            data-toggle="select-table">
                            <div class="pos-checkout-table-header">
                              <div class="status"><i class='bi bi-circle-fill' style='color: yellow'></i></div>
                              <!-- <div class="fw-bold">Table</div> -->
                              <div class="fw-bold display-6">{{order_item.id}}</div>
                              <div class="text-white text-opacity-50">Order Type - {{order_item.order_type}}</div>
                              <div class="text-white text-opacity-50">Customer - {{order_item.customer_name}}</div>
                            </div>
                            <div class="pos-checkout-table-info small">
                              <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                  <div class="w-20px"><i
                                      class="text-white text-opacity-50"></i>
                                  </div>
                                  <div class="w-60px">Total</div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                  <div class="w-100%"><i
                                      class="text-white text-opacity-50">AED {{order_item.subtotal}}</i>
                                  </div>
                                  <div class="w-100%"></div>
                                </div>
                              </div>
                            </div>
                          </a>

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
                  
                </div>

                <div class="pos-content-container h-100 p-0" data-scrollbar="true" data-height="100%" v-if="this.show_pending_view == 2">

                  <div class="pos-task" v-for="(order_item,index) in order_items" :key="index">
                    <div class="pos-task-info">
                      <div class="h3 mb-1">{{order_item.table_name}}</div>
                      <div class="mb-3">Order No: #{{order_item.id}}</div>
                      <div class="mb-2" v-if="order_item.status == 0">
                        <span class="badge bg-warning text-black fs-14px">Pending</span>
                      </div>
                      <div class="mt-3">
                        <div class="btn-group d-flex">
                          <a class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('cash', order_item.id, order_item.subtotal)">
                              <i class="bi bi-cash-stack fa-lg"></i><br />
                              <span class="small">Cash</span>
                          </a> 
                          <a target="_blank" class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('card', order_item.id, order_item.subtotal)">
                              <i class="bi-credit-card-2-back-fill fa-lg"></i><br />
                              <span class="small">Card</span>
                          </a>
                          <a target="_blank" class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('credit', order_item.id, order_item.subtotal)">
                              <i class="bi bi-send-check fa-lg"></i><br />
                              <span class="small">Credit</span>
                          </a>
                        </div>
                      </div>
                      <!-- <div>07:13 time</div> -->
                    </div>
                    <div class="pos-task-body">
                      <div class="fs-16px mb-3">
                        Completed: ({{order_item.order_completed_count}}/{{order_item.orders_items_count}})
                      </div>
                      <div class="row gx-4">
                        <div class="col-lg-3" v-for="(order_item_detail,index) in order_item.order_item_details" :key="index">
                          <div class="pos-task-product">
                            <div class="pos-task-product-img">
                              <div class="cover">
                                <img style="width: 100%; height: 100%; border-radius: 5px;" class="img" :src="`/storage/items/${order_item_detail.item_image}`"/>
                              </div>
                              <div class="caption" v-if="order_item_detail.completed == 1">
                                <div>Completed</div>
                              </div>
                              <div class="caption" v-if="order_item_detail.canceled == 1">
                                <div style="color: red;">Canceled</div>
                              </div>
                            </div>
                            <div class="pos-task-product-info">
                              <div class="flex-1">
                                <div class="d-flex mb-2">
                                  <div class="h5 mb-0 flex-1">{{order_item_detail.item_name}}</div>
                                  <div class="h5 mb-0">x{{order_item_detail.quantity}}</div>
                                </div>
                                <div>
                                  - {{order_item_detail.size_name}}<br />
                                  <div v-for="(item_has_add_on_detail,index) in order_item_detail.item_has_add_on_details" :key="index">
                                  - {{item_has_add_on_detail.add_on_name}}
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="pos-task-product-action">
                              <a href="#" class="btn btn-success" @click="completeKitchenItem(order_item_detail.id, order_item.id)">Complete</a>
                              <a href="#" class="btn btn-outline-default" @click="cancelKitchenItem(order_item_detail.id, order_item.id)">Cancel</a>
                            </div>
                          </div>
                        </div>
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

        <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

      </div>

      <!-- Bill Start -->
      <div style="display: none;" v-for="(bill_detail, index) in bill_details" :key="index" id="printSection">
          <span v-html="printStuff"></span>
          <div class="col-6 mx-auto invoiceshadow">

              <div class="row">
                  <div class="col-md-12 text-center">
                      <h4 class="text-uppercase">HADDIYA COFFE HOUSE & RESTAURANT</h4>
                      <h5>TAX INVOICE</h5>
                      <h5>BEHIND DNATA, NERA CLOCK TOWER </h5>
                      <h5>DEIRA, DUBAI, U.A.E </h5>
                      <h5>PH:04 239 4455, 052 579 2173</h5>
                      <h5>TRN: 100255517300003 </h5>
                  </div>
              </div>

              <div class="col-md-12 ">
                  <div class="invoice"><span class="font-weight-bold text-uppercase">Order #:</span><span class="ml-1">
                          {{ bill_detail.id }}</span></div>
                  <div class="date"><span class="font-weight-bold text-uppercase">Date: </span><span class="ml-1">
                          {{ bill_detail.created_at }}</span></div>
              </div>

              <div class="col-md-12">
                  <div class="invoice"><span class="font-weight-bold text-uppercase">Order Type: </span><span class="ml-1">
                          {{ bill_detail.order_type }}</span></div>
                  <div class="date"><span class="font-weight-bold text-uppercase">Payment Type: </span><span class="ml-1">
                          {{ bill_detail.payment_type }}</span></div>
                  <div class="date"><span class="font-weight-bold text-uppercase">Address: </span><span class="ml-1">
                          {{ bill_detail.customer_address }}</span></div>
                  <div class="invoice"><span class="font-weight-bold text-uppercase">Customer:</span><span class="ml-1">
                          {{ bill_detail.customer_name }}</span></div>
                  <div class="phone"><span class="font-weight-bold text-uppercase">Phone:</span><span
                          class="ml-1">{{ bill_detail.customer_telephone }}</span></div>
                  <div class="adrees"><span class="font-weight-bold text-uppercase">Room No:</span><span class="ml-1">
                          {{ bill_detail.customer_room_number }}</span></div>

              </div>
          
              <div class="table-responsive">

                  <table class="table">
                      <thead>
                          <tr>
                              <th>
                                  <h5 class="text-center">Item</h5>
                              </th>
                              <th>
                                  <h5 class="text-center">Size</h5>
                              </th>
                              <th>
                                  <h5 class="text-center">Qty</h5>
                              </th>
                              <th>
                                  <h5 class="text-center">Total(AED)</h5>
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="(bill_item, index) in bill_detail.items" :key="index">
                              <td class="col text-center">{{ bill_item.item_name }}</td>
                              <td class="col text-center">{{ bill_item.item_size }}</td>
                              <td class="col text-center">{{ bill_item.item_quantity }}</td>
                              <td class="col text-center">{{ bill_item.item_price }}</td>
                          </tr>
                          <tr>
                              <td class="col text-center">
                                  <h4>Grand Total</h4>
                              </td>
                              <td class="col text-center visually-hidden"></td>
                              <td class="col text-center visually-hidden"></td>
                              <td class="col text-center">{{ bill_detail.subtotal }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="row">
                  <div class="col-md-12 text-center">
                      <h6 class="text-uppercase">Thank you | visit again</h6>
                  </div>
              </div>
              
          </div>
      </div>
      <!-- Bill End -->

    </div>

</template>


<script>
export default {
  data() {
    return {
      order_items: [],
      bill_details: [],

      show_pending_view: 1,

      time: null,
      id: null,
      category_name: null,
      active: null,

      edit_id: null,
      edit_category_name: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchPendingOrderItems();
  },

  created() {
      setInterval(this.getNow, 1000);
  },

  methods: {
    reset() {
      this.order_items = [];
      this.bill_details = [];

      this.show_pending_view = 1;

      this.id = null;
      this.category_name = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_category_name = null;
    },

    setToUpdate(id, name, active) {
      this.edit_id = id;
      this.edit_category_name = name;
      this.edit_active = active;
    },

    getDataToBill(order_id)
    {
        axios
          .post("/admin/fetch/data-to-bill-kitchen",{
              order_id: order_id
          })
          .then((res) => {

          if (res.status == 200) {
              this.bill_details = res.data;
              console.log(res.data);

              Swal.fire({
                  title: 'Print the bill?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Print!'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      this.printSection();
                  }
              })
          }
        })
        .catch((err) => {});
        
    },

    printSection() {
        this.$htmlToPaper("printSection");
    },

    getNow(){
        const today = new Date();
        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        const dateTime = date +' '+ time;
        this.time = dateTime;
    },

    fetchPendingOrderItems() {

      this.show_pending_view = 1;

      axios
        .get("/admin/admin/fetch-pending-orders")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.order_items = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchPendingOrderDetails(order_id) {

      this.show_pending_view = 2;

      axios
        .post("/admin/fetch/pending-kitchen-order-details",{
            order_id: order_id,
            pending_order_status: 1,
        })
        .then((res) => {

        if (res.status == 200) {
            this.order_items = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    submitOrder(payment_method, order_id, total)
    {
        Swal.fire({
            title: "(Submit the Order) Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, submit it!",
            showLoaderOnConfirm: true,
        }).then((result) => {
        if (result.isConfirmed) {

          axios
            .post("/admin/admin/submit-pending-orders", {
                payment_method: payment_method,
                order_id: order_id,
                total: total,
            })
            .then((res) => {
              if (res.status == 200) {
                Swal.fire("Success!", "Successfully Submitted", "success");

                this.reset();
                this.fetchPendingOrderItems();
                // window.open('/bill', '_blank');

                    Swal.fire({
                        title: 'Print the bill?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Print!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.printSection();
                        }
                    })
              } 
              else {
                Swal.fire("Error", res.data, "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Order Submit Unsuccessfull!", "error");
              }
            });
        }
      });


    },

  },
};
</script>