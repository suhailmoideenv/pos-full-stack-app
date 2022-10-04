<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Assign Sizes</span>
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
                    <span class="w-value">Assign Sizes</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="assignSizes">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col" >
                                <label for="exampleFormControlInput1">Select Item</label>
                                <select id="inputState" class="form-control" @change="set_item_value($event)">
                                    <option style="color: black;" value="null">Please Select Item</option>
                                    <option style="color: black;" v-for="(item,index) in items" :key="index"  :value="item.id">{{ item.name }}</option>
                                </select>
                                <small v-if="errors.item_id" class="text-danger">{{errors.item_id[0]}}</small>
                            </div>

                            <div class="col" >
                                <label for="exampleFormControlInput1">Select Size</label>
                                <select id="inputState" class="form-control" @change="set_size_value($event)">
                                    <option style="color: black;" value="null">Please Select Size</option>
                                    <option style="color: black;" v-for="(size,index) in sizes" :key="index"  :value="size.id">{{ size.name }}</option>
                                </select>
                                <small v-if="errors.size_id" class="text-danger">{{errors.size_id[0]}}</small>
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
                          <div class="th-content">Size</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Adding Price</div>
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
                      <tr v-for="(assigned_size, index) in assigned_sizes" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ assigned_size.size_name }}</td>
                        <td class="text-center">{{ assigned_size.size_price }}</td>
                        <td class="text-center">
                            <div v-if="assigned_size.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(assigned_size.items_id, assigned_size.sizes_id, assigned_size.active)" data-toggle="modal" data-target="#editAdminModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyAssignedSizes(assigned_size.items_id, assigned_size.sizes_id)">
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
                  <h5 class="modal-title">Edit Assigned Size</h5>
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
                  <button id="btn-edit" class="float-left btn btn-success" @click="editAssignedSize" data-dismiss="modal">Edit</button>

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
      items: [],
      sizes: [],
      assigned_sizes: [],

      id: null,
      item_id: null,
      size_id: null,
      active: null,

      edit_item_id: null,
      edit_size_id: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
        this.fetchItems();
        this.fetchSizes();
  },

  methods: {
    reset() {
      this.items = [];
      this.sizes = [];
      this.assigned_sizes = [];
      this.id = null;
      this.item_id = null;
      this.size_id = null;

      //for edit purpose
      this.edit_item_id = null;
      this.edit_size_id = null;
      this.edit_active = null;
    },

    setToUpdate(item_id, size_id, active) {
      this.edit_item_id = item_id;
      this.edit_size_id = size_id;
      this.edit_active = active;
    },

    fetchItems() {
      axios
        .get("/admin/fetch/assign-sizes-all-items")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.items = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchSizes() {
      axios
        .get("/admin/fetch/assign-sizes-all-add-ons")
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

    set_item_value(event) {
        this.assigned_sizes = [];
        var selected_item_id = event.target.value;

        if(selected_item_id == "null")
        {
            this.item_id = null;
        }
        else
        {
            this.item_id = event.target.value;
            this.fetchAllAssignedSizes();
        }
    },

    set_size_value(event) {
        this.size_id = event.target.value;
    },

    fetchAllAssignedSizes() {
      axios
        .post("/admin/fetch/create-sizes",{
            item_id: this.item_id
        })
        .then((res) => {

        if (res.status == 200) {
            this.assigned_sizes = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    //create user method
    assignSizes() {
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
                .post("/admin/create/create-sizes", {
                  item_id: this.item_id,
                  size_id: this.size_id
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully assigned a Size",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchItems();
                    this.fetchSizes();
                  }
                  else if (res.status == 200 && res.data == "already assigned") {
                    Swal.fire({
                      position: "top-end",
                      icon: "warning",
                      title: "Already assigned this size to this item",
                      showConfirmButton: false,
                      timer: 1500,
                    });
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

    editAssignedSize() {

      axios
        .put("/admin/update/create-sizes", {
          item_id: this.edit_item_id,
          size_id: this.edit_size_id,
          active: this.edit_active
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Assigned Size update Successfull!", "success");
            this.reset();
            this.fetchItems();
            this.fetchSizes();

          } else {
            Swal.fire("Error", "Assigned Size update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Assigned Size update unsuccessfull!", "error");
        });
    },

    destroyAssignedSizes(item_id, size_id) {
      Swal.fire({
        title: "(Delete an Assigned Size) Are you sure?",
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
            .post("/admin/destroy/create-sizes", {
              item_id: item_id,
              size_id: size_id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Assigned Size has been deleted.", "success");

                this.reset();
                this.fetchItems();
                this.fetchSizes();
              } else {
                Swal.fire("Error", "Assigned Size destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Assigned Size destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
