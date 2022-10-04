<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Sizes</span>
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
                    <span class="w-value">Create a Size</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createSize">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Size Name</label>
                                <input type="text" :class=" errors.size_name? 'form-control is-invalid' : 'form-control'" placeholder="Size name" v-model="size_name"/>
                                <small v-if="errors.size_name" class="text-danger">{{ errors.size_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Adding Price(AED)</label>
                                <input type="number" class="form-control" :class="errors.adding_price? 'form-control is-invalid': 'form-control'" placeholder="Adding Price" v-model="adding_price" step=".01"/>
                                <small v-if="errors.adding_price" class="text-danger">{{errors.adding_price[0]}}</small>
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
                  <span class="w-value">Sizes View</span>
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
                          <div class="th-content">Id</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Size Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Adding Price(AED)</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Active</div>
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
                      <tr v-for="(size, index) in sizes" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ size.id }}</td>
                        <td class="text-center">{{ size.name }}</td>
                        <td class="text-center">{{ size.adding_price }}</td>
                        <td class="text-center">
                            <div v-if="size.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(size.id, size.name, size.adding_price, size.active)" data-toggle="modal" data-target="#editAdminModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroySize(size.id)">
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
          <div class="modal fade bd-example-modal-lg" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <!-- <div  class="modal fade modal-xl" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true"> -->
            <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Size</h5>
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
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Size Name</label>
                          <div class="col-sm-8">
                            <input type="full_name" id="c-location" class="form-control" v-model="edit_size_name" placeholder="Add On Name"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Adding Price(AED)</label>
                          <div class="col-sm-8">
                            <input type="number" id="c-location" class="form-control" v-model="edit_adding_price" placeholder="Adding Price" step=".01"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Active State</label>

                          <div class="col-sm-8">
                              <select id="inputState" class="form-control" @change="get_select_active_state_edit($event)">
                                <option :selected="edit_active==1" value="1" style="color: black;">Active</option>
                                <option :selected="edit_active==0" value="0" style="color: black;">Deactive</option>
                              </select>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="btn-edit" class="float-left btn btn-success" @click="editSize" data-dismiss="modal">Edit</button>

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
      sizes: [],

      id: null,
      size_name: null,
      adding_price: null,
      active: null,

      edit_id: null,
      edit_size_name: null,
      edit_adding_price: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchSizes();
  },

  methods: {
    reset() {
      this.sizes = [];
      this.id = null;
      this.size_name = null;
      this.adding_price = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_size_name = null;
      this.edit_adding_price = null;
    },

    setToUpdate(id, name, adding_price, active) {
      this.edit_id = id;
      this.edit_size_name = name;
      this.edit_adding_price = adding_price;
      this.edit_active = active;
    },

    fetchSizes() {
      axios
        .get("/admin/fetch/sizes")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.sizes = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    //create user method
    createSize() {
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
                .post("/admin/create/sizes", {
                  size_name: this.size_name,
                  adding_price: this.adding_price,
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert a Size",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchSizes();
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

    editSize() {

      axios
        .put("/admin/update/sizes", {
          id: this.edit_id,
          size_name: this.edit_size_name,
          adding_price: this.edit_adding_price,
          active:this.edit_active,
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Size update Successfull!", "success");
            this.reset();
            this.fetchSizes();

            // $("#update_close_btn").click();
          } else {
            Swal.fire("Error", "Size update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Size update unsuccessfull!", "error");
        });
    },

    destroySize(id) {
      Swal.fire({
        title: "(Delete a Size) Are you sure?",
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
            .post("/admin/destroy/sizes", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Size has been deleted.", "success");

                // this.reset();
                this.fetchSizes();
              } else {
                Swal.fire("Error", "Size destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Size destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
