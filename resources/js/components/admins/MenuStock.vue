<template>
    
    <div>

        <div id="app" class="app app-content-full-height app-without-sidebar app-without-header">

		<div id="" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">

			<div class="pos pos-vertical card" id="pos">

				<div class="pos-container card-body">

					<div class="pos-header">
						<div class="logo">
							<a href="pos_counter_checkout.html">
								<div class="logo-img"><i class="bi bi-x-diamond" style="font-size: 1.5rem;"></i></div>
								<div class="logo-text">SI POS</div>
							</a>
						</div>
						<div class="time" id="time">{{this.time}}</div>
						<div class="nav">
							<!-- <div class="nav-item">
								<a href="pos_kitchen_order.html" class="nav-link">
									<i class="bi bi-bootstrap-reboot nav-icon"></i>
								</a>
							</div>
							<div class="nav-item">
								<a href="pos_table_booking.html" class="nav-link">
									<i class="bi bi-calendar-date nav-icon"></i>
								</a>
							</div>
							<div class="nav-item">
								<a href="pos_menu_stock.html" class="nav-link">
									<i class="bi bi-pie-chart nav-icon"></i>
								</a>
							</div> -->
						</div>
					</div>


					<div class="pos-content">
						<div class="pos-content-container h-100 p-3" data-scrollbar="true" data-height="100%">

							<div class="col-3 mb-3">
                  <input type="text" :class=" errors.search_item? 'form-control is-invalid' : 'form-control'" placeholder="Search..." @keyup="searchItems()" v-model="search_item"/>
                  <small v-if="errors.search_item" class="text-danger">{{ errors.search_item[0] }}</small>
              </div>

							<div class="row gx-3">
								<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 pb-3" v-for="(item, index) in items" :key="index">
									<div class="card h-100">
										<div class="card-body h-100 p-1">
											<div class="pos-product">
												<img class="img"
													:src="`/storage/items/${item.image}`"/>
												<div class="info">
													<div class="title text-truncate">{{item.name}}&reg;</div>
													<div class="desc text-truncate">{{item.description}}</div>
													<div class="d-flex align-items-center mb-3">
														<div class="w-100px">Stock:</div>
														<div class="flex-2">
															<input type="text" class="form-control" v-model="item.quantity"/>
														</div>
													</div>
													<div class="d-flex align-items-center mb-3">
														<div class="w-100px">Price:</div>
														<div class="flex-2">
															<input type="text" class="form-control" v-model="item.price"/>
														</div>
													</div>
													<div class="d-flex align-items-center mb-3">
														<div class="w-100px">Availability:</div>
														<div class="flex-1">
															<div class="form-check form-switch">
																<input v-if="item.active == 1" class="form-check-input" type="checkbox"
																	name="qty" id="product-availability" checked @click="getAvailability()"/>
																<input v-else class="form-check-input" type="checkbox"
																	name="qty" id="product-availability" @click="getAvailability()"/>
																<label class="form-check-label" for="product1"></label>
															</div>
														</div>
													</div>
													<div>
														<a href="#" @click="editItem(item.id, item.quantity, item.price, item.active)" class="btn btn-success d-block mb-2"><i
																class="fa fa-check fa-fw"></i> Update</a>
														<a href="#" @click="destroyItem(item.id)" class="btn btn-default d-block"><i
																class="fa fa-times fa-fw"></i> Delete</a>
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

    </div>

</template>




<script>
export default {
  data() {
    return {
      items: [],

      search_item: null,

	  time: null,
      id: null,
      add_on_name: null,
      adding_price: null,
      active: null,

      edit_id: null,
      edit_add_on_name: null,
      edit_adding_price: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchItems();
  },

  created() {
      setInterval(this.getNow, 1000);
  },

  methods: {
    reset() {
      this.items = [];
	  this.search_item = null;
      this.id = null;
      this.add_on_name = null;
      this.adding_price = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_add_on_name = null;
      this.edit_adding_price = null;
	  this.edit_active = null;
    },

	getNow(){
        const today = new Date();
        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        const dateTime = date +' '+ time;
        this.time = dateTime;
    },

	searchItems()
    {
        axios
        .post("/admin/fetch/customer-order-search-items",{
            search_item: this.search_item,
            menu_stock_status: 1,
        })
        .then((res) => {

        if (res.status == 200) {
            this.items = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    fetchItems() {
      axios
        .get("/admin/fetch/menu-stock-items")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.items = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

	getAvailability()
	{
		var item_checked = document.getElementById('product-availability').checked;
		this.edit_active = item_checked;
	},

	editItem(item_id, item_quantity, item_price, item_active) {

		if(this.edit_active == null)
		{
			if(item_active == 1)
			{
				this.edit_active = "true";
			}
			else
			{
				this.edit_active = "false";
			}
		}

      axios
        .put("/admin/update/menu-stock-items", {
          id: item_id,
		  quantity: item_quantity,
		  price: item_price,
          active:this.edit_active,
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire("Success", "Item update Successfull!", "success");
            this.reset();
            this.fetchItems();

            // $("#update_close_btn").click();
          } else {
            Swal.fire("Error", "Item update unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Item update unsuccessfull!", "error");
        });
    },

	destroyItem(id) {
      Swal.fire({
        title: "(Delete a Item) Are you sure?",
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
            .post("/admin/destroy/menu-stock-items", {
              id: id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Item On has been deleted.", "success");

                // this.reset();
                this.fetchItems();
              } else {
                Swal.fire("Error", "Item On destroy unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Item On destroy unsuccessfull!", "error");
              }
            });
        }
      });
    },
    
  },
};
</script>