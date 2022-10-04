<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Orders View</span>
                  <span class="w-numeric-title">Go to columns for details.</span>
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
                          <div class="th-content">Count</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Order Id</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Customer Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Building Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Room No</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Area</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Telephone</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Driver</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Sub Total</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Order Type</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Payment Method</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Status</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Edit</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Destroy</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(order, index) in orders" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ order.id }}</td>
                        <td class="text-center">{{ order.customer_name }}</td>
                        <td class="text-center">{{ order.customer_building_name }}</td>
                        <td class="text-center">{{ order.customer_room_no }}</td>
                        <td class="text-center">{{ order.customer_area }}</td>
                        <td class="text-center">{{ order.customer_telephone }}</td>
                        <td class="text-center">{{ order.driver_name }}</td>
                        <td class="text-center">{{ order.subtotal }}</td>
                        <td class="text-center">
                            <div>
                                <span class="shadow-none badge badge-success">{{ order.order_type }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div>
                                <span class="shadow-none badge badge-success">{{ order.pyament_method }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div v-if="order.status == 0">
                                <span class="shadow-none badge badge-warning">Pending</span>
                            </div>
                            <div v-if="order.status == 1">
                                <span class="shadow-none badge badge-success">Completed</span>
                            </div>
                            <div v-if="order.status == 2">
                                <span class="shadow-none badge badge-danger">Canceled</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(order.id, order.customers_id, order.driver_name, order.order_types_id)" data-toggle="modal" data-target="#editOrdersModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyDriver(order.id)">
                            <i class="fa fa-pencil" aria-hidden="true"></i>Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

            <div class="modal fade bd-example-modal-lg" id="editOrdersModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tabsModalLabel">Orders Info</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab"
                                        href="#home" role="tab" aria-controls="home"
                                        aria-selected="true">Order Products</a>
                                </li>
                                <li class="nav-item" v-if="display_customer_selection == 1">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab"
                                        href="#profile" role="tab" aria-controls="profile"
                                        aria-selected="false">Select Customer</a>
                                </li>
                                <li class="nav-item" v-if="display_driver_selection == 1">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab"
                                        href="#contact" role="tab" aria-controls="contact"
                                        aria-selected="false">Select Driver</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"><div class="th-content">Count</div></th>
                                                    <th class="text-center"><div class="th-content">Item Name</div></th>
                                                    <th class="text-center"><div class="th-content">Quantity</div></th>
                                                    <th class="text-center"><div class="th-content">Price</div></th>
                                                    <th class="text-center"><div class="th-content">Size</div></th>
                                                    <th class="text-center"><div class="th-content">Status</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(order_item,index) in order_items" :key="index">

                                                    <td class="text-center">{{(index+1)}}</td>
                                                    <td class="text-center">{{order_item.item_name}}</td>
                                                    <td class="text-center">{{order_item.quantity}}</td>
                                                    <td class="text-center">{{order_item.price}}</td>
                                                    <td class="text-center">{{order_item.size_name}}</td>
                                                    <td class="text-center">
                                                        <div v-if="order_item.completed == 1">
                                                            <span class="shadow-none badge badge-success">Completed</span>
                                                        </div>
                                                        <div v-if="order_item.canceled == 1">
                                                            <span class="shadow-none badge badge-danger">Canceled</span>
                                                        </div>
                                                        <div v-if="order_item.deleted == 1">
                                                            <span class="shadow-none badge badge-danger">Deleted</span>
                                                        </div>
                                                        <div v-if="order_item.completed == 0 && order_item.canceled == 0">
                                                            <span class="shadow-none badge badge-warning">Pending</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">

                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <input type="text" :class=" errors.building_name? 'form-control is-invalid' : 'form-control'" placeholder="Search Customer..." v-model="search_customer" @keyup="searchCustomer"/>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">
                                                <div class="th-content">Count</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Name</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Telephone No</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Building Name</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Flat/Room No</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Area</div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(customer, index) in customers" :key="index">
                                                    <td class="text-center">{{ index + 1 }}</td>
                                                    <td class="text-center">{{ customer.name }}</td>
                                                    <td class="text-center">{{ customer.telephone }}</td>
                                                    <td class="text-center">{{ customer.building_name }}</td>
                                                    <td class="text-center">{{ customer.room_number }}</td>
                                                    <td class="text-center">{{ customer.area }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-success mb-2" data-dismiss="modal" @click="selectCustomer(customer.id)">
                                                            Select
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">

                                    <div class="row mb-4">
                                        <div class="col-4">
                                            <input type="text" :class=" errors.building_name? 'form-control is-invalid' : 'form-control'" placeholder="Search Driver..." v-model="search_driver" @keyup="searchDriver"/>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">
                                                <div class="th-content">Count</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Name</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Email</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Telephone No</div>
                                                </th>
                                                <th class="text-center">
                                                <div class="th-content">Vehicle No</div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(driver, index) in drivers" :key="index">
                                                    <td class="text-center">{{ index + 1 }}</td>
                                                    <td class="text-center">{{ driver.name }}</td>
                                                    <td class="text-center">{{ driver.email }}</td>
                                                    <td class="text-center">{{ driver.telephone }}</td>
                                                    <td class="text-center">{{ driver.vehicle_no }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-success mb-2" data-dismiss="modal" @click="selectDriver(driver.id)">
                                                            Select
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Done</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orders: [],
      order_items: [],
      customers: [],
      drivers: [],

      id: null,
      search_customer: null,
      search_driver: null,

      edit_order_id: null,
      edit_customer_id: null,
      edit_order_types_id: null,

      errors: [],

      //TO show and hide create form
      display_customer_selection: 0,
      display_driver_selection: 0,

    };
  },

  mounted() {
    this.fetchOrders();
  },

  methods: {
    reset() {
      this.orders = [];
      this.order_items = [];
      this.customers = [];
      this.drivers = [];

      this.id = null;
      this.search_customer = null;
      this.search_driver = null;

      //for edit purpose
      this.edit_order_id = null;
      this.edit_customer_id = null;
      this.edit_order_types_id = null;

      this.display_customer_selection = 0;
      this.display_driver_selection = 0;
    },

    setToUpdate(order_id, customer_id, driver_name, order_types_id) {
      this.edit_order_id = order_id;
      this.edit_customer_id = customer_id;
      this.edit_order_types_id = order_types_id;

      if(customer_id == null)
      {
        this.display_customer_selection = 1;
      }
      else if(customer_id != null)
      {
        this.display_customer_selection = 0;
      }
      if(driver_name == null)
      {
        this.display_driver_selection = 1;
      }
      else if(driver_name != null)
      {
        this.display_driver_selection = 0;
      }

      this.fetchOrderItems(this.edit_order_id);
      this.fetchCustomers();
      this.fetchDrivers();

    },

    fetchOrders() {
      axios
        .get("/admin/fetch/orders")
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

    fetchOrderItems(order_id)
    {
        axios
        .post("/admin/fetch/orders-orderItems",{
            order_id: order_id
        })
        .then((res) => {

        if (res.status == 200) {
            console.log(res.data);
            this.order_items = res.data;
        }
        })
        .catch((err) => {});
    },

    fetchCustomers() {
      axios
        .get("/admin/fetch/customers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.customers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchDrivers() {
      axios
        .get("/admin/fetch/drivers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.drivers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    searchCustomer()
    {
        axios
        .post("/admin/fetch/search-customers",{
            search_customer: this.search_customer
        })
        .then((res) => {

        if (res.status == 200) {
            this.customers = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    searchDriver()
    {
        axios
        .post("/admin/fetch/search-drivers",{
            search_driver: this.search_driver
        })
        .then((res) => {

        if (res.status == 200) {
            this.drivers = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    selectCustomer(customer_id) {
      Swal.fire({
        title: "(Set This Customer) Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.isConfirmed) {

          axios
            .post("/admin/set/orders-setcustomer", {
              customer_id: customer_id,
              order_id: this.edit_order_id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Done!", "Customer has been assigned.", "success");
                this.reset();
                this.fetchOrders();
              } else {
                Swal.fire("Error", "Something went wrong!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                Swal.fire("Error", "Something went wrong!", "error");
              }
            });
        }
      });
    },

    selectDriver(driver_id) {
      Swal.fire({
        title: "(Set This Driver) Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.isConfirmed) {

          axios
            .post("/admin/set/orders-setdriver", {
              driver_id: driver_id,
              order_id: this.edit_order_id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Done!", "Driver has been assigned.", "success");
                this.reset();
                this.fetchOrders();
              } else {
                Swal.fire("Error", "Something went wrong!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                Swal.fire("Error", "Something went wrong!", "error");
              }
            });
        }
      });
    },

    destroyDriver(id) {
      Swal.fire({
        title: "(Delete a Driver) Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {

          axios
            .post("/admin/destroy/drivers", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Driver has been deleted.", "success");

                // this.reset();
                this.fetchDrivers();
              } else {
                Swal.fire("Error", "Driver destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Driver destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
