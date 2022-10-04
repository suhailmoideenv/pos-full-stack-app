<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Tables</span>
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
                    <span class="w-value">Create a Table</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createTable">
                      <div style="margin: 50px">

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Table Name</label>
                                <input type="text" :class=" errors.table_name? 'form-control is-invalid' : 'form-control'" placeholder="Table name" v-model="table_name"/>
                                <small v-if="errors.table_name" class="text-danger">{{ errors.table_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Pax Count</label>
                                <input type="number" class="form-control" :class="errors.pax_count? 'form-control is-invalid': 'form-control'" placeholder="Pax Count" v-model="pax_count"/>
                                <small v-if="errors.pax_count" class="text-danger">{{errors.pax_count[0]}}</small>
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
                  <span class="w-value">Tables View</span>
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
                          <div class="th-content">Table Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Pax Count</div>
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
                      <tr v-for="(table, index) in tables" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ table.id }}</td>
                        <td class="text-center">{{ table.name }}</td>
                        <td class="text-center">{{ table.pax_count }}</td>
                        <td class="text-center">
                            <div v-if="table.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                            </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                        </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(table.id, table.name, table.pax_count, table.active)" data-toggle="modal" data-target="#editAdminModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>

                        <td class="text-center">
                          <button class="btn btn-danger mb-2" @click="destroyTable(table.id)">
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
                  <h5 class="modal-title">Edit Table</h5>
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
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Table Name</label>
                          <div class="col-sm-8">
                            <input type="full_name" id="c-location" class="form-control" v-model="edit_table_name" placeholder="Table Name"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Pax Count</label>
                          <div class="col-sm-8">
                            <input type="number" id="c-location" class="form-control" v-model="edit_pax_count" placeholder="Pax Count"/>
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
                  <button id="btn-edit" class="float-left btn btn-success" @click="editTable" data-dismiss="modal">Edit</button>

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
      tables: [],

      id: null,
      table_name: null,
      pax_count: null,
      active: null,

      edit_id: null,
      edit_table_name: null,
      edit_pax_count: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchTables();
  },

  methods: {
    reset() {
      this.tables = [];
      this.id = null;
      this.table_name = null;
      this.pax_count = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_table_name = null;
      this.edit_pax_count = null;
    },

    setToUpdate(id, name, pax_count, active) {
      this.edit_id = id;
      this.edit_table_name = name;
      this.edit_pax_count = pax_count;
      this.edit_active = active;
    },

    fetchTables() {
      axios
        .get("/admin/fetch/tables")
        .then((res) => {
          if (res.status == 200) {
            console.log(res);
            this.tables = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    //create user method
    createTable() {
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
                .post("/admin/create/tables", {
                  table_name: this.table_name,
                  pax_count: this.pax_count,
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert a Table",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchTables();
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

    editTable() {

      axios
        .put("/admin/update/tables", {
          id: this.edit_id,
          table_name: this.edit_table_name,
          pax_count: this.edit_pax_count,
          active:this.edit_active,
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Table update Successfull!", "success");
            this.reset();
            this.fetchTables();

            // $("#update_close_btn").click();
          } else {
            Swal.fire("Error", "Table update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Table update unsuccessfull!", "error");
        });
    },

    destroyTable(id) {
      Swal.fire({
        title: "(Delete a Table) Are you sure?",
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
            .post("/admin/destroy/tables", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Table has been deleted.", "success");

                // this.reset();
                this.fetchTables();
              } else {
                Swal.fire("Error", "Table destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Table destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
  },
};
</script>
