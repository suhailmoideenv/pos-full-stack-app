<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Categories</span>
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
                    <span class="w-value">Create a Category</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createCategory">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Category Name</label>
                                <input type="text" :class=" errors.category_name? 'form-control is-invalid' : 'form-control'" placeholder="Category name" v-model="category_name"/>
                                <small v-if="errors.category_name" class="text-danger">{{ errors.category_name[0] }}</small>
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
                  <span class="w-value">Categories View</span>
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
                          <div class="th-content">Category</div>
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
                      <tr v-for="(category, index) in categories" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ category.name }}</td>
                        <td class="text-center">
                            <div v-if="category.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(category.id, category.name, category.active)" data-toggle="modal" data-target="#editAdminModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyCategory(category.id)">
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
                  <h5 class="modal-title">Edit Category</h5>
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
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Category Name</label>
                          <div class="col-sm-8">
                            <input type="full_name" id="c-location" class="form-control" v-model="edit_category_name" placeholder="ex: category"/>
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
                  <button id="btn-edit" class="float-left btn btn-success" @click="editCategory" data-dismiss="modal">Edit</button>

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
      categories: [],

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
    this.fetchCategories();
  },

  methods: {
    reset() {
      this.categories = [];
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

    fetchCategories() {
      axios
        .get("/admin/fetch/categories")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.categories = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    //create user method
    createCategory() {
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
                .post("/admin/create/categories", {
                  category_name: this.category_name
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert a Category",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchCategories();
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

    editCategory() {

      axios
        .put("/admin/update/categories", {
          id: this.edit_id,
          category_name: this.edit_category_name,
          active: this.edit_active
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Category update Successfull!", "success");
            this.reset();
            this.fetchCategories();

          } else {
            Swal.fire("Error", "Category update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Category update unsuccessfull!", "error");
        });
    },

    destroyCategory(id) {
      Swal.fire({
        title: "(Delete a Category) Are you sure?",
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
            .post("/admin/destroy/categories", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Category has been deleted.", "success");

                // this.reset();
                this.fetchCategories();
              } else {
                Swal.fire("Error", "Category destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Category destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
