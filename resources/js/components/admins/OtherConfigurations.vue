<template>
    
    <div class="row">

        
        <div class="col-4 my-3">
             <router-link to="/admin/create-tables">
                    <div class="card component-card_1">
                        <div class="card-body">
                            <div class="icon-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h5 class="card-title">Tables</h5>
                            <p class="card-text">Create and Update Tables</p>
                        </div>
                    </div>
                </router-link>
        </div>

        <div class="col-4 my-3">
            <router-link to="/admin/add-drivers">
                <div class="card component-card_1">
                    <div class="card-body">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h5 class="card-title">Add Drivers</h5>
                        <p class="card-text">Register Drivers to Deliveries</p>
                    </div>
                </div>
          </router-link>
        </div>

        <div class="col-4 my-3">
            <router-link to="/admin/add-customers">
                <div class="card component-card_1">
                    <div class="card-body">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h5 class="card-title">Add Customers</h5>
                        <p class="card-text">Register New Customers</p>
                    </div>
                </div>
          </router-link>
        </div>

        <div class="col-4 my-3">
            <router-link to="/admin/pending-orders">
                <div class="card component-card_1">
                    <div class="card-body">
                        <div class="icon-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h5 class="card-title">Pending Orders</h5>
                        <p class="card-text">View All Pending Orders</p>
                    </div>
                </div>
          </router-link>
        </div>
        
    </div>

</template>