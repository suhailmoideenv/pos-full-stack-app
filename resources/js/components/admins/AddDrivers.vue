<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Drivers</span>
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
                    <span class="w-value">Create a Driver</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createDriver">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Driver Name</label>
                                <input type="text" :class=" errors.driver_name? 'form-control is-invalid' : 'form-control'" placeholder="Driver name" v-model="driver_name"/>
                                <small v-if="errors.driver_name" class="text-danger">{{ errors.driver_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Driver Email</label>
                                <input type="email" :class=" errors.driver_email? 'form-control is-invalid' : 'form-control'" placeholder="Driver email" v-model="driver_email"/>
                                <small v-if="errors.driver_email" class="text-danger">{{ errors.driver_email[0] }}</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Driver Telephone</label>
                                <input type="text" :class=" errors.driver_tele? 'form-control is-invalid' : 'form-control'" placeholder="Driver telephone" v-model="driver_tele"/>
                                <small v-if="errors.driver_tele" class="text-danger">{{ errors.driver_tele[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Driver Vehicle No.</label>
                                <input type="text" :class=" errors.driver_vehicle_no? 'form-control is-invalid' : 'form-control'" placeholder="Driver vehicle no" v-model="driver_vehicle_no"/>
                                <small v-if="errors.driver_vehicle_no" class="text-danger">{{ errors.driver_vehicle_no[0] }}</small>
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
                  <span class="w-value">Drivers View</span>
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
                          <div class="th-content">Email</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Telephone No</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Vehicle No</div>
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
                      <tr v-for="(driver, index) in drivers" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ driver.name }}</td>
                        <td class="text-center">{{ driver.email }}</td>
                        <td class="text-center">{{ driver.telephone }}</td>
                        <td class="text-center">{{ driver.vehicle_no }}</td>
                        <td class="text-center">
                            <div v-if="driver.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(driver.id, driver.name, driver.email, driver.telephone, driver.vehicle_no, driver.active)" data-toggle="modal" data-target="#editDriverModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyDriver(driver.id)">
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
                  <h5 class="modal-title">Edit Driver</h5>
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
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Driver Name</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_driver_name" placeholder="ex: driver name"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Driver Email</label>
                          <div class="col-sm-8">
                            <input type="email" id="c-location" class="form-control" v-model="edit_driver_email" placeholder="ex: driver email"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Driver Telephone</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_driver_tele" placeholder="ex: driver tele"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Driver Vehicle No.</label>
                          <div class="col-sm-8">
                            <input type="text" id="c-location" class="form-control" v-model="edit_driver_vehicle_no" placeholder="ex: driver vehicle no"/>
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
                  <button id="btn-edit" class="float-left btn btn-success" @click="editDriver" data-dismiss="modal">Edit</button>

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
      drivers: [],

      id: null,
      driver_name: null,
      driver_email: null,
      driver_tele: null,
      driver_vehicle_no: null,
      active: null,

      edit_id: null,
      edit_driver_name: null,
      edit_driver_email: null,
      edit_driver_tele: null,
      edit_driver_vehicle_no: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchDrivers();
  },

  methods: {
    reset() {
      this.drivers = [];
      this.id = null;
      this.driver_name = null;
      this.driver_email = null;
      this.driver_tele = null;
      this.driver_vehicle_no = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_driver_name = null;
      this.edit_driver_email = null;
      this.edit_driver_tele = null;
      this.edit_driver_vehicle_no = null;
    },

    setToUpdate(id, name, email, tele, vehicle_no, active) {
      this.edit_id = id;
      this.edit_driver_name = name;
      this.edit_driver_email = email;
      this.edit_driver_tele = tele;
      this.edit_driver_vehicle_no = vehicle_no;
      this.edit_active = active;
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

    //create user method
    createDriver() {
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
                .post("/admin/create/drivers", {
                  driver_name: this.driver_name,
                  driver_email: this.driver_email,
                  driver_tele: this.driver_tele,
                  driver_vehicle_no: this.driver_vehicle_no,
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert a Driver",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchDrivers();
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

    editDriver() {

      axios
        .put("/admin/update/drivers", {
          id: this.edit_id,
          driver_name: this.edit_driver_name,
          driver_email: this.edit_driver_email,
          driver_tele: this.edit_driver_tele,
          driver_vehicle_no: this.edit_driver_vehicle_no,
          active: this.edit_active
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Driver update Successfull!", "success");
            this.reset();
            this.fetchDrivers();

          } else {
            Swal.fire("Error", "Driver update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Driver update unsuccessfull!", "error");
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
          // Swal.fire(
          // 'Deleted!',
          // 'Your file has been deleted.',
          // 'success'
          // )

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
