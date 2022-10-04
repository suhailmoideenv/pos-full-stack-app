<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Add Items</span>
                  <span class="w-numeric-title">Go to columns for details.</span><br /><br />
                  
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

        <div class="row col-12">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget-two">
              <div class="widget-content">
                <div class="w-numeric-value">
                  <div class="w-content">
                    <span class="w-value">Create an Item</span>
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

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createItem">
                      <div style="margin: 50px">

                        <div class="row mb-4">

                            <div class="col" >
                                <label for="exampleFormControlInput1">Select Category</label>
                                <select id="inputState" class="form-control" @change="set_category_value($event)">
                                    <option style="color: black;" value="null">Please Select Category</option>
                                    <option style="color: black;" v-for="(category,index) in categories" :key="index"  :value="category.id">{{ category.name }}</option>
                                </select>
                                <small v-if="errors.category_id" class="text-danger">{{errors.category_id[0]}}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Item Name</label>
                                <input type="text" :class=" errors.item_name? 'form-control is-invalid' : 'form-control'" placeholder="Item name" v-model="item_name"/>
                                <small v-if="errors.item_name" class="text-danger">{{ errors.item_name[0] }}</small>
                            </div>

                            <div class="col">
                                <label for="exampleFormControlInput1">Item Quantity</label>
                                <input type="number" class="form-control" :class="errors.item_quantity? 'form-control is-invalid': 'form-control'" placeholder="Item Quantity" v-model="item_quantity"/>
                                <small v-if="errors.item_quantity" class="text-danger">{{errors.item_quantity[0]}}</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Item Price(AED)</label>
                                <input type="number" class="form-control" :class="errors.item_price? 'form-control is-invalid': 'form-control'" placeholder="Item Price" v-model="item_price"/>
                                <small v-if="errors.item_price" class="text-danger">{{errors.item_price[0]}}</small>
                            </div>

                            <div class="col-6">
                                <div class="custom-file mb-4">
                                    <input type="file" :class="errors.image ? 'form-control custom-file-input is-invalid':'form-control custom-file-input'"  id="customFile" @change="onImageChange" >
                                    <label class="custom-file-label" for="customFile">Choose file (Recommended: 150*150px)</label>
                                    <small v-if="errors.image" class="text-danger">{{errors.image[0]}}</small>
                                </div>
                                
                                <div v-if="imagepreview" style="margin-top: -5px; margin-buttom:50px">
                                    <img :src="imagepreview"  style="border-radius: 50%;" alt="" width="150px" height="150px">
                                </div><br> 
                            </div> 

                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="exampleFormControlInput1">Item Description</label>
                                <textarea type="text" :class=" errors.item_description? 'form-control is-invalid': 'form-control'" placeholder="Item description" v-model="item_description"></textarea>
                                <small v-if="errors.item_description" class="text-danger">{{errors.item_description[0]}}</small>
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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      categories: [],

      id: null,
      category_id: null,
      item_name: null,
      item_quantity: null,
      item_price: null,
      item_description: null,
      active: null,

      edit_id: null,
      edit_item_name: null,
      edit_item_quantity: null,
      edit_item_price: null,
      edit_item_description: null,
      edit_active: null,

      edit_active: null,

      pro_image: null,
      image: null,
      imagepreview: null,

      errors: [],
    };
  },

  mounted() {
    this.fetchItems();
    this.fetchCategories();
  },

  methods: {
    reset() {
      this.items = [];
      this.categories = [];
      this.id = null;
      this.category_id = null;
      this.item_name = null;
      this.item_quantity = null;
      this.item_price = null;
      this.item_description = null;
      this.image = null;
      this.imagepreview = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_item_name = null;
      this.edit_item_quantity = null;
      this.edit_item_price = null;
      this.item_description = null;
      this.edit_image = null;
      this.imagepreview_edit = null;
    },

    setToUpdate(id, name, email) {
      this.edit_id = id;
      this.edit_name = name;
      this.edit_email = email;
      // this.active = active;
    },

    fetchCategories() {
      axios
        .get("/admin/fetch/items-getcategories")
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

    fetchItems() {
      axios
        .get("/admin/fetch/items")
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

    set_category_value(event){
        this.category_id = event.target.value;
    },

    //create user method
    createItem() {
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
                .post("/admin/create/items", {
                  category_id: this.category_id,
                  item_name: this.item_name,
                  item_quantity: this.item_quantity,
                  item_price: this.item_price,
                  item_description: this.item_description,
                  image: this.image
                })
                .then((res) => {
                  if (res.status == 200 && res.data == 1) {
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Successfully Insert an Item",
                      showConfirmButton: false,
                      timer: 1500,
                    });

                    this.reset();
                    this.fetchItems();
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

    //image click proccess and image preview
    onImageChange(e) {
      this.image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.imagepreview = e.target.result;
      };

      let files = e.target.files || e.dataTransfer.files;

      if (!files.length) return;

      this.createImage(files[0]);
    },

    //image click proccess and image preview
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    get_select_active_state_edit(event) {
      this.edit_active = event.target.value;
    },

  },
};
</script>
