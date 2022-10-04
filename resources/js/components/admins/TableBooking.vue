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
						<div class="pos-content-container h-100 p-4" data-scrollbar="true" data-height="100%">
							<div class="d-md-flex align-items-center mb-4">
								<div class="flex-1">
									<div class="fs-24px mb-1">Available Table (8/20)</div>
									<div class="mb-2 mb-md-0 d-flex">
										<div class="d-flex align-items-center me-3">
											<i class="fa fa-circle fa-fw text-white text-opacity-25 fs-9px me-1"></i>
											Completed
										</div>
										<div class="d-flex align-items-center me-3">
											<i class="fa fa-circle fa-fw text-warning fs-9px me-1"></i> Upcoming
										</div>
										<div class="d-flex align-items-center me-3">
											<i class="fa fa-circle fa-fw text-success fs-9px me-1"></i> In-progress
										</div>
									</div>
								</div>
								<div>
									<div class="input-group date mb-0" data-render="datepicker"
										data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
										<input type="date" v-model="selected_date" class="form-control fw-bold" placeholder="Today's" />
										<!-- <span class="input-group-text input-group-addon bg-none">
											<i class="bi bi-calendar-date-fill fa-lg"></i>
										</span> -->
									</div>
								</div>
							</div>
							<div class="row gx-4">

								<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" v-for="(table,index) in tables" :key="index">
									<a href="#" data-bs-toggle="modal" data-bs-target="#modalPosBooking"
										class="pos-table-booking card" @click="editReservations(table.id)">
										<div class="card-body p-1">
											<div class="pos-table-booking-container">
												<div class="pos-table-booking-header">
													<div class="d-flex align-items-center">
														<div class="flex-1">
															<!-- <div class="title">TABLE</div> -->
															<div class="no">{{table.name}}</div>
															<div class="desc">max {{table.pax_count}} pax</div>
														</div>
														<!-- <div class="pe-1 text-success">
															<i class="bi bi-check2-circle fa-3x"></i>
														</div> -->
													</div>
												</div>
												<div class="pos-table-booking-body">

													<div class="booking" v-for="(reservation_time,index) in reservation_times" :key="index">
														<div class="time">{{reservation_time.time}}</div>
														<div class="info">-</div>
														<div class="status"></div>
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
									</a>
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


	<div class="modal modal-pos fade" id="modalPosBooking">

		<div class="modal-dialog modal-lg">

			<div class="modal-content border-0">

				<div class="card">

					<div class="card-body p-0">

						<div class="modal-header align-items-center">
							<h5 class="modal-title d-flex align-items-end">
								<img src="assets/img/pos/icon-table.svg" alt="" height="25" class="me-2 opacity-5" />
								Table Reservations
								<small class="fs-14px ms-2 text-white text-opacity-50">To clear a reservation select the box and press clear</small>
							</h5>
							<a href="#" data-bs-dismiss="modal" class="ms-auto btn-close"></a>
						</div>


						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group mb-2" v-for="(reservation_time,index) in reserved_by" :key="index">
										<div class="input-group" @click="setReservationTime(reservation_time.id)">
											<div class="input-group-text fw-bold w-90px fs-13px">{{reservation_time.time}}</div>
											<input type="text" class="form-control" :id="reservation_time.id" v-model="reservation_time.reservations" @keyup="getReservation(reservation_time.id)" />
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="modal-footer" v-if="disable_buttons == 0">
							<a href="#" class="btn btn-default w-100px" data-bs-dismiss="modal">Cancel</a>
							<button type="submit" class="btn btn-danger w-100px" @click="clearReservation()">Clear</button>
							<button type="submit" class="btn btn-success w-100px" @click="createReservation()">Book</button>
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

</template>



<script>
export default {
  data() {
    return {
      tables: [],
	  reservation_times: [],
	  reserved_by: [],

      time: null,
	  table_id: null,
      reservation_id: null,
      reservation: null,
	  selected_date: null,
	  disable_buttons: 0,
      active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
	this.fetchTime();
    this.fetchTables();
	this.fetchReservationTimes();
  },

  created() {
      setInterval(this.getNow, 1000);
  },

  methods: {
    reset() {
      this.tables = [];
	  this.reservation_times = [];
	  this.reserved_by = [];

	  this.table_id = null;
      this.reservation_id = null;
      this.reservation = null;
	  this.selected_date = null;
	  this.disable_buttons = 0;

      //for edit purpose
      this.edit_id = null;
      this.edit_category_name = null;
    },

    setToUpdate(id, name, active) {
      this.edit_id = id;
      this.edit_category_name = name;
      this.edit_active = active;
    },

	fetchTime()
	{
		const today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		this.selected_date = yyyy + '-' + mm + '-' + dd;
	},

    getNow(){
        const today = new Date();
        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        const dateTime = date +' '+ time;
        this.time = dateTime;
    },

	editReservations(id)
	{
		this.table_id = id;
		this.fetchBookedReservations(this.table_id);
	},

	setReservationTime(set_reservation_id)
	{
		this.reservation_id = set_reservation_id;
	},

	getReservation(time_id)
	{
		this.reservation = document.getElementById(time_id).value;
	},

	fetchBookedReservations(table_id)
    {
        axios
        .post("/admin/fetch/table-booking-booked-reservation-times",{
            table_id: table_id,
			date: this.selected_date
        })
        .then((res) => {

        if (res.status == 200) {
            this.reserved_by = res.data;
			this.disable_buttons = res.data.disable_buttons;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

	fetchTables() {
      axios
        .get("/admin/fetch/table-booking-tables")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.tables = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

	fetchReservationTimes() {
      axios
        .get("/admin/fetch/table-booking-reservation-times")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.reservation_times = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    createReservation() {
      this.errors = [];

      axios
        .post("/admin/create/table-booking", {
			table_id: this.table_id,
			reservation: this.reservation,
			reservation_id: this.reservation_id,
        })
        .then((res) => {
          if (res.status == 200 && res.data == 1) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Successfully Insert a Reservation",
              showConfirmButton: false,
              timer: 1500,
            });

            this.reset();
			this.fetchTime();
            this.fetchTables();
			this.fetchReservationTimes();
          }
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          }
        });
    },

	clearReservation() {
      Swal.fire({
        title: "(Clear selected reservation) Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Clear it!",
      }).then((result) => {
        if (result.isConfirmed) {
          // Swal.fire(
          // 'Deleted!',
          // 'Your file has been deleted.',
          // 'success'
          // )

          axios
            .post("/admin/delete/table-booking", {
              	table_id: this.table_id,
				reservation_id: this.reservation_id,
            })
            .then((res) => {
              if (res.status == 200 && res.data == 1) {
                Swal.fire("Deleted!", "Reservation has been cleared.", "success");

                this.reset();
				this.fetchTime();
				this.fetchTables();
				this.fetchReservationTimes();
              } else {
                Swal.fire("Error", "Reservation clear unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Reservation clear unsuccessfull!", "error");
              }
            });
        }
      });
    },

  },
};
</script>