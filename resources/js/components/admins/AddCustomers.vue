<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Customers</span>
                  <span class="w-numeric-title">Go to columns for details.</span><br /><br />
                  <button class="btn btn-primary" @click="show_create_form = !show_create_form">
                    <span v-if="show_create_form == 0">Show Create Form</span>
                    <span v-if="show_create_form == 1">Hide Create Form</span>
                  </button>
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
                    <span class="w-value">Create a Customer</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createCustomer">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Customer Name</label>
                                <input type="text" :class=" errors.customer_name? 'form-control is-invalid' : 'form-control'" placeholder="Customer name" v-model="customer_name"/>
                                <small v-if="errors.customer_name" class="text-danger">{{ errors.customer_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Customer Telephone</label>
                                <input type="text" :class=" errors.customer_tele? 'form-control is-invalid' : 'form-control'" placeholder="Customer Telephone" v-model="customer_tele"/>
                                <small v-if="errors.customer_tele" class="text-danger">{{ errors.customer_tele[0] }}</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Builiding Name</label>
                                <input type="text" :class=" errors.building_name? 'form-control is-invalid' : 'form-control'" placeholder="Building Name" v-model="building_name"/>
                                <small v-if="errors.building_name" class="text-danger">{{ errors.building_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Flat/Room No.</label>
                                <input type="text" :class=" errors.room_no? 'form-control is-invalid' : 'form-control'" placeholder="Flat/Room no" v-model="room_no"/>
                                <small v-if="errors.room_no" class="text-danger">{{ errors.room_no[0] }}</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Area</label>
                                <input type="text" :class=" errors.area? 'form-control is-invalid' : 'form-control'" placeholder="Area" v-model="area"/>
                                <small v-if="errors.area" class="text-danger">{{ errors.area[0] }}</small>
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

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Customers View</span>
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
                      <tr v-for="(customer, index) in customers" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ customer.name }}</td>
                        <td class="text-center">{{ customer.telephone }}</td>
                        <td class="text-center">{{ customer.building_name }}</td>
                        <td class="text-center">{{ customer.room_number }}</td>
                        <td class="text-center">{{ customer.area }}</td>
                        <td class="text-center">
                            <div v-if="customer.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(customer.id, customer.name, customer.telephone, customer.building_name, customer.room_number, customer.area, customer.active)" data-toggle="modal" data-target="#editDriverModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyCustomer(customer.id)">
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

          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="editDriverModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <!-- <div  class="modal fade modal-xl" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true"> -->
            <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Customer</h5>
                  <button type="button" lass="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content">
                      <form id="addContactModalTitle">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Customer Name</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_customer_name" placeholder="ex: customer name"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Customer Telephone</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_customer_tele" placeholder="ex: customer telephone"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Building Name</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_building_name" placeholder="ex: building name"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Flat/Room No.</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_room_no" placeholder="ex: flat/room no"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Area</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_area" placeholder="ex: area"/>
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-center">Active State</label>
                            <div class="col-sm-8">
                                <select id="inputState" class="form-control" @change="get_select_active_state_edit($event)">
                                    <option :selected="edit_active==1" value="1">Active</option>
                                    <option :selected="edit_active==0" value="0">Deactive</option>
                                </select>
                            </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="btn-edit" class="float-left btn btn-success" @click="editCustomer" data-dismiss="modal">Edit</button>

                  <button class="btn btn-secondary" data-dismiss="modal">
                    <i class="flaticon-delete-1"></i> Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!--  End Model -->
        </div>


      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      customers: [],

      id: null,
      customer_name: null,
      customer_tele: null,
      building_name: null,
      room_no: null,
      area: null,
      active: null,

      edit_id: null,
      edit_customer_name: null,
      edit_customer_tele: null,
      edit_building_name: null,
      edit_room_no: null,
      edit_area: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchCustomers();
  },

  methods: {
    reset() {
      this.customers = [];
      this.id = null;
      this.customer_name = null;
      this.customer_tele = null;
      this.building_name = null;
      this.room_no = null;
      this.area = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_customer_name = null;
      this.edit_customer_tele = null;
      this.edit_building_name = null;
      this.edit_room_no = null;
      this.edit_area = null;
    },

    setToUpdate(id, name, tele, building, room, area, active) {
      this.edit_id = id;
      this.edit_customer_name = name;
      this.edit_customer_tele = tele;
      this.edit_building_name = building;
      this.edit_room_no = room;
      this.edit_area = area;
      this.edit_active = active;
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

    //create user method
    createCustomer() {
      this.errors = [];

      let timerInterval;
      this.$swal({
          title: 'Please Wait',
          timer: 5000,
          timerProgressBar: true,
          didOpen: () => {
              this.$swal.showLoading();
              const b = this.$swal.getHtmlContainer().querySelector('b');
              timerInterval = setInterval(() => {
                  b.textContent = this.$swal.getTimerLeft();
              }, 100);

              axios
                .post("/admin/create/customers", {
                  customer_name: this.customer_name,
                  customer_tele: this.customer_tele,
                  building_name: this.building_name,
                  room_no: this.room_no,
                  area: this.area,
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert a Customer",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchCustomers();
                  }
                })
                .catch((err) => {
                  if (err.response.status == 422) {
                    this.errors = err.response.data.errors;
                  }
              });

          },
          willClose: () => {
              clearInterval(timerInterval);
          }
      });
      
    },

    get_select_active_state_edit(event) {
      this.edit_active = event.target.value;
    },

    editCustomer() {

      axios
        .put("/admin/update/customers", {
          id: this.edit_id,
          customer_name: this.edit_customer_name,
          customer_tele: this.edit_customer_tele,
          building_name: this.edit_building_name,
          room_no: this.edit_room_no,
          area: this.edit_area,
          active: this.edit_active
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Customer update Successfull!", "success");
            this.reset();
            this.fetchCustomers();

          } else {
            Swal.fire("Error", "Customer update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Customer update unsuccessfull!", "error");
        });
    },

    destroyCustomer(id) {
      Swal.fire({
        title: "(Delete a Customer) Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          // Swal.fire(
          // 'Deleted!',
          // 'Your file has been deleted.',
          // 'success'
          // )

          axios
            .post("/admin/destroy/customers", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Customer has been deleted.", "success");

                // this.reset();
                this.fetchCustomers();
              } else {
                Swal.fire("Error", "Customer destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Customer destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
