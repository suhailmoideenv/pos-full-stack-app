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
						<div class="pos">
							<div class="pos-container">

								<div class="pos-content h-100">
									<div class="pos-content-container p-3" data-scrollbar="true" data-height="100%">
										<div class="row gx-3">
											<div class="col-xl-3 col-lg-4 col-md-6 pb-3" v-for="(table_detail,index) in table_details" :key="index">
												<div class="pos-checkout-table in-use card">
													<a href="#" class="pos-checkout-table-container"
														data-toggle="select-table">
														<div class="pos-checkout-table-header">
															<div class="status"><i class="bi bi-circle-fill"></i></div>
															<!-- <div class="fw-bold">Table</div> -->
															<div class="fw-bold display-6">{{table_detail.name}}</div>
															<div class="text-white text-opacity-50">max {{table_detail.pax_count}} pax</div>
															<div class="text-white text-opacity-50">{{table_detail.order_count}} orders</div>
														</div>
														<div class="pos-checkout-table-info small">
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<div class="w-20px"><i
																			class="text-white text-opacity-50"></i>
																	</div>
																	<div class="w-60px">Total Revenue</div>
																</div>
															</div>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<div class="w-100%"><i
																			class="text-white text-opacity-50">AED {{table_detail.sub_total}}</i>
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
      table_details: [],

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
    this.fetchAllTableDetails();
  },

  created() {
      setInterval(this.getNow, 1000);
  },

  methods: {
    reset() {
      this.table_details = [];
      this.id = null;
      this.category_name = null;

      //for edit purpose
      this.edit_id = null;
      this.edit_category_name = null;
    },

	getNow(){
        const today = new Date();
        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        const dateTime = date +' '+ time;
        this.time = dateTime;
    },

    setToUpdate(id, name, active) {
      this.edit_id = id;
      this.edit_category_name = name;
      this.edit_active = active;
    },

	fetchAllTableDetails() {
      axios
        .get("/admin/fetch/counter-checkout-fetch-all-tables")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.table_details = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

  },
};
</script>