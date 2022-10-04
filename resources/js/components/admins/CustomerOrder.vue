<template>
    <div>
        <div id="app" class="app app-content-full-height app-without-sidebar app-without-header">

        <div id="" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3" style="height: 80vh;">

            <div class="pos card" id="pos">
                <div class="pos-container card-body">

                    <div class="pos-menu">

                        <!-- <div class="logo">
                            <a>
                                <div class="logo-img"><i class="bi bi-x-diamond" style="font-size: 2.1rem;"></i></div>
                                <div class="logo-text">SI POS</div>
                            </a>
                        </div>

                        <hr/> -->

                        <div class="pos-content mt-2">
                            <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item" @click="fetchAllItems()">
                                        <a class="nav-link active" href="#" data-filter="all">
                                            <div class="card">
                                                <div class="card-body">
                                                    <i class="bi bi-bag-check"></i><br/> All Dishes
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" v-for="(category, index) in categories" :key="index" @click="fetchItemsByCategory(category.id)">
                                        <a class="nav-link" href="#" data-filter="meat">
                                            <div class="card" style="align-content: center;">
                                                <div class="card-body">
                                                    <i class="bi bi-bag-check"></i><br/> {{category.name}}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>


                    <div class="pos-content">
                        <div class="pos-content-container h-100 p-4" data-scrollbar="true" data-height="100%">

                            <div class="row">
                                <div class="col mb-3">
                                    <input type="text" :class=" errors.search_item? 'form-control is-invalid' : 'form-control'" placeholder="Search..." @keyup="searchItems()" v-model="search_item"/>
                                    <small v-if="errors.search_item" class="text-danger">{{ errors.search_item[0] }}</small>
                                </div>
                                <!-- <div class="col mb-3">
                                    <v-select class="style-chooser" style="color: black;" label="name" v-model="item_id" :options="items" :reduce="items => items.id" :value="items.id" placeholder="Select Pending Order"></v-select>
                                    <a class="btn btn-outline-theme rounded-0 col mb-12">
                                        <span class="small">Pending Orders</span>
                                    </a>
                                </div> -->
                            </div>

                            <div class="row gx-4">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 pb-4" v-for="(item, index) in items" :key="index">

                                    <div class="card h-100">
                                        <div class="card-body h-100 p-1">
                                            <a href="#" class="pos-product" data-bs-toggle="modal"
                                                data-bs-target="#modalPosItem" @click="getItemDetails(item.id, item.image, item.name, item.description, item.price)">
                                                <img style="width:100%;height:150px;min-height: 0rem;" class="img"
													:src="`/storage/items/${item.image}`"/>
                                                <div class="info">
                                                    <div class="title">{{item.name}}</div>
                                                    <div class="desc">{{item.description}}</div>
                                                    <div class="price">$ {{item.price}}</div>
                                                </div>
                                            </a>
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


                    <div class="pos-sidebar" id="pos-sidebar">
                        <div class="h-100 d-flex flex-column p-0">

                              <div class="pos-sidebar-header">
                                <div class="back-btn">
                                    <button type="button" data-toggle-class="pos-mobile-sidebar-toggled"
                                        data-toggle-target="#pos" class="btn">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                </div>
                               
                                    <div class="icon"><img src="/img/pos/icon-table.svg" alt="img"/></div>
                                    <div class="title" style="margin-left: 3">
                                        <select id="" class="form-control" @change="get_select_order_type($event)">
                                            <option style="color: black;" value="null">Select Order Type</option>
                                            <option style="color: black;" value="dine_in">Dine In</option>
                                            <option style="color: black;" value="take_away">Take Away</option>
                                            <option style="color: black;" value="delivery">Delivery</option>
                                        </select>
                                    </div>
                                    <div class="order">Order: <b>#{{this.order_id}}</b></div>
                                
                        
                            </div>
                             <div class="pos-sidebar-header" v-if="delivery_boy_selection == 1">
                               
                               
                                    <div class="icon"><img src="/img/pos/deliver_boy.png" alt="img"/></div>
                                    <div class="title" style="margin-left: 3">
                                        <input type="text" class="form-control" placeholder="Driver Name" v-model="driver_name" readonly/>
                                    </div>
                                    <div class="icon"><img data-toggle="modal" data-target="#driverModal" src="/img/pos/plus.png" alt="img" @click="fetchDrivers"/></div>
                                
                            </div>
                             <div class="pos-sidebar-header" v-if="dine_in_selection == 1">
                               
                               
                                    <div class="icon"><img src="/img/pos/table.png" alt="img"/></div>
                                    <div class="title" style="margin-left: 3">
                                        <select id="inputState" class="form-control" @change="set_table_value($event)">
                                            <option style="color: black;" value="null">Select Table</option>
                                            <option style="color: black;" v-for="(table,index) in tables" :key="index"  :value="table.id">{{ table.name }}</option>
                                        </select>
                                    </div>
                                
                            </div>
                            <div class="pos-sidebar-header">
                               
                               
                                    <div class="icon"><img src="/img/pos/customer.png" alt="img"/></div>
                                    <div class="title" style="margin-left: 3">
                                        <input type="text" class="form-control" placeholder="Customer Name" v-model="customer_name" readonly/>
                                        <!-- <select id="" class="form-control">
                                            <option style="color: black;" value="null">Select Customer</option>
                                            <option style="color: black;">Customer 1</option>
                                            <option style="color: black;">Customer 2</option>
                                            <option style="color: black;">Customer 3</option>
                                        </select> -->
                                    </div>
                                    <div class="icon"><img data-toggle="modal" data-target="#customerModal" src="/img/pos/plus.png" alt="img" @click="fetchCustomers"/></div>
                               

                                
                            </div>


                            <!-- <div class="pos-sidebar-nav">
                                <ul class="nav nav-tabs nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-bs-toggle="tab"
                                            data-bs-target="#newOrderTab">New Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-bs-toggle="tab"
                                            data-bs-target="#orderHistoryTab">Order History (0)</a>
                                    </li>
                                </ul>
                            </div> -->
                            <hr />


                            <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">

                                <div class="tab-pane fade h-100 show active" id="newOrderTab">

                                    
                                    <div class="pos-order" v-for="(cart_item,index) in cart_items" :key="index">
                                        <div class="pos-order-product">
                                            <!-- <img class="img" :src="`/storage/items/${cart_item.item_image}`"/> -->
                                            <div class="flex-1">
                                                <div class="h6 mb-1">{{cart_item.item_name}}</div>
                                                <!-- <div class="small">${{cart_item.item_price}}</div> -->
                                                <div class="small mb-2">- size: {{cart_item.item_size_name}}</div>
                                                <div class="d-flex">
                                                    <!-- <a href="#" class="btn btn-outline-theme btn-sm"><i
                                                            class="fa fa-minus"></i></a> -->
                                                    <input type="text"
                                                        class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center"
                                                        v-model="cart_item.item_quantity" />
                                                    <!-- <a href="#" class="btn btn-outline-theme btn-sm"><i
                                                            class="fa fa-plus"></i></a> -->
                                                    <a href="#" class="btn btn-outline-theme btn-sm"><i
                                                            class="bi bi-upload fs-22px  mx-auto my-auto" @click="updateCartItem(cart_item.item_id, cart_item.item_quantity, cart_item.item_price)"></i></a>
                                                    <a href="#" class="btn btn-outline-theme btn-sm"><i
                                                            class="bi bi-trash fs-22px  mx-auto my-auto" @click="deleteCartItem(cart_item.item_id)"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pos-order-price">
                                            ${{cart_item.item_sub_total}}
                                        </div>
                                    </div>

                                </div>


                                <div class="tab-pane fade h-100" id="orderHistoryTab">
                                    <div
                                        class="h-100 d-flex align-items-center justify-content-center text-center p-20">
                                        <div>
                                            <div class="mb-3 mt-n5">
                                                <svg width="6em" height="6em" viewBox="0 0 16 16" class="text-gray-300"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z" />
                                                    <path
                                                        d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z" />
                                                </svg>
                                            </div>
                                            <h5>No order history found</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="pos-sidebar-footer">
                                <div class="d-flex align-items-center mb-2">
                                    <div>Total</div>
                                    <div class="flex-1 text-end h4 mb-0">${{cart_total}}</div>
                                </div>
                                <div class="mt-3" @click="submitOrder('null')">
                                    <div class="btn-group d-flex">
                                        <a class="btn btn-outline-theme rounded-0 w-150px">
                                            <i class="bi bi-arrow-clockwise"></i><br />
                                            <span class="small">Place Order</span>
                                        </a> 
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="btn-group d-flex">
                                        <a class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('cash')">
                                            <i class="bi bi-cash-stack fa-lg"></i><br />
                                            <span class="small">Cash</span>
                                        </a> 
                                        <a target="_blank" class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('card')">
                                            <i class="bi-credit-card-2-back-fill fa-lg"></i><br />
                                            <span class="small">Card</span>
                                        </a>
                                        <a target="_blank" class="btn btn-outline-theme rounded-0 w-150px" @click="submitOrder('credit')">
                                            <i class="bi bi-send-check fa-lg"></i><br />
                                            <span class="small">Credit</span>
                                        </a>
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


            <a href="#" class="pos-mobile-sidebar-toggler" data-toggle-class="pos-mobile-sidebar-toggled"
                data-toggle-target="#pos">
                <i class="bi bi-bag"></i>
                <span class="badge">5</span>
            </a>

        </div>


        <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

        </div>


        <div class="modal modal-pos fade" id="modalPosItem">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0">
                    <div class="card">
                        <div class="card-body p-0">
                            <a href="#" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0 m-4"></a>
                            <div class="modal-pos-product">
                                <div class="modal-pos-product-img">
                                    <img style="max-width: 100%" class="img" :src="`/storage/items/${this.item_image}`"/>
                                </div>
                                <div class="modal-pos-product-info">
                                    <div class="h4 mb-2">{{this.item_name}}</div>
                                    <div class="text-white text-opacity-50 mb-2">
                                        {{this.item_description}}
                                    </div>
                                    <div class="h4 mb-3">${{this.item_price}}</div>
                                    <div class="d-flex mb-3">
                                        <!-- <a href="#" class="btn btn-outline-theme"><i class="fa fa-minus"></i></a> -->
                                        <input type="text"
                                            class="form-control w-50px fw-bold mx-2 bg-white bg-opacity-25 border-0 text-center"
                                            name="qty" id="quantity" v-model="quantity"/>
                                        <!-- <a href="#" class="btn btn-outline-theme"><i class="fa fa-plus"></i></a> -->
                                    </div>
                                    <hr class="mx-n4" />
                                    <div class="mb-2">
                                        <div class="fw-bold">Size: {{this.selected_size}}</div>
                                        <div class="option-list">
                                            <div class="option" v-for="(size, index) in sizes" :key="index">
                                                <input type="radio" id="size" name="size" class="option-input"/>
                                                <label class="option-label" for="size3" @click="setSize(size.sizes_id, size.size_name)">
                                                    <span class="option-text">{{size.size_name}}</span>
                                                    <span class="option-price">+{{size.size_adding_price}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="fw-bold">Add Ons:</div>
                                        <div v-if="display_selected_add_ons.length != 0">
                                            <div class="fw-bold" v-for="(display_selected_add_on, index) in display_selected_add_ons" :key="index">{{display_selected_add_on.name}}</div>
                                        </div>
                                        <div class="option-list">
                                            <div class="option" v-for="(add_on, index) in add_ons" :key="index">
                                                <input type="checkbox" class="option-input" id="addon" name="addon"/>
                                                <label class="option-label" for="addon1" @click="selectAddOns(add_on.add_ons_id, add_on.add_on_name)">
                                                    <span class="option-text">{{add_on.add_on_name}}</span>
                                                    <span class="option-price">+{{add_on.add_on_adding_price}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mx-n4" />
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="#" class="btn btn-default h4 mb-0 d-block rounded-0 py-3"
                                                data-bs-dismiss="modal">Cancel</a>
                                        </div>
                                        <div class="col-8">
                                            <a href="#"
                                                class="btn btn-success d-flex justify-content-center align-items-center rounded-0 py-3 h4 m-0" data-bs-dismiss="modal" @click="addToCart()">Add
                                                to cart <i class="bi bi-plus fa-2x ms-2 my-n3"></i></a>
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
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Customer</h5>
                    <button type="button" style="color:white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content">

                        <div class="row mb-4">
                            <div class="col-4">
                                <input type="text" :class=" errors.building_name? 'form-control is-invalid' : 'form-control'" placeholder="Search Customer..." v-model="search_customer" @keyup="searchCustomer"/>
                            </div>
                        </div>

                        <form id="addContactModalTitle">

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
                                        <div class="th-content">Telephone No</div>
                                        </th>
                                        <th class="text-center">
                                        <div class="th-content">Building Name</div>
                                        </th>
                                        <th class="text-center">
                                        <div class="th-content">Flat/Room No</div>
                                        </th>
                                        <th class="text-center">
                                        <div class="th-content">Area</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, index) in customers" :key="index">
                                            <td class="text-center">{{ index + 1 }}</td>
                                            <td class="text-center">{{ customer.name }}</td>
                                            <td class="text-center">{{ customer.telephone }}</td>
                                            <td class="text-center">{{ customer.building_name }}</td>
                                            <td class="text-center">{{ customer.room_number }}</td>
                                            <td class="text-center">{{ customer.area }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-success mb-2" data-dismiss="modal" @click="selectCustomer(customer.id, customer.name)">
                                                    Select
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">New Customer</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Driver</h5>
                    <button type="button" style="color:white;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content">

                        <div class="row mb-4">
                            <div class="col-4">
                                <input type="text" :class=" errors.building_name? 'form-control is-invalid' : 'form-control'" placeholder="Search Driver..." v-model="search_driver" @keyup="searchDriver"/>
                            </div>
                        </div>

                        <form id="addContactModalTitle">

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
                                                <a class="btn btn-success mb-2" data-dismiss="modal" @click="selectDriver(driver.id, driver.name)">
                                                    Select
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Bill Start -->
        <div style="display: none;" v-for="(bill_detail, index) in bill_details" :key="index" id="printSection">
            <span v-html="printStuff"></span>
            <div class="col-12 mx-auto invoiceshadow">

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="text-uppercase">HADDIYA COFFE HOUSE & RESTAURANT</h4>
                        <h5>TAX INVOICE</h5>
                        <h5>BEHIND DNATA, NERA CLOCK TOWER </h5>
                        <h5>DEIRA, DUBAI, U.A.E </h5>
                        <h5>PH:04 239 4455, 052 579 2173</h5>
                        <h5>TRN: 100255517300003 </h5>
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="invoice"><span class="font-weight-bold text-uppercase">Order #:</span><span class="ml-1">
                            {{ bill_detail.id }}</span></div>
                    <div class="date"><span class="font-weight-bold text-uppercase">Date: </span><span class="ml-1">
                            {{ bill_detail.created_at }}</span></div>
                </div>

                <div class="col-md-12">
                    <div class="invoice"><span class="font-weight-bold text-uppercase">Order Type: </span><span class="ml-1">
                            {{ bill_detail.order_type }}</span></div>
                    <div class="date"><span class="font-weight-bold text-uppercase">Payment Type: </span><span class="ml-1">
                            {{ bill_detail.payment_type }}</span></div>
                    <div class="date"><span class="font-weight-bold text-uppercase">Address: </span><span class="ml-1">
                            {{ bill_detail.customer_address }}</span></div>
                    <div class="invoice"><span class="font-weight-bold text-uppercase">Customer:</span><span class="ml-1">
                            {{ bill_detail.customer_name }}</span></div>
                    <div class="phone"><span class="font-weight-bold text-uppercase">Phone:</span><span
                            class="ml-1">{{ bill_detail.customer_telephone }}</span></div>
                    <div class="adrees"><span class="font-weight-bold text-uppercase">Room No:</span><span class="ml-1">
                            {{ bill_detail.customer_room_number }}</span></div>

                </div>
            
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h5 class="text-center">Item</h5>
                                </th>
                                <th>
                                    <h5 class="text-center">Size</h5>
                                </th>
                                <th>
                                    <h5 class="text-center">Qty</h5>
                                </th>
                                <th>
                                    <h5 class="text-center">Total(AED)</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(bill_item, index) in bill_detail.items" :key="index">
                                <td class="col text-center">{{ bill_item.item_name }}</td>
                                <td class="col text-center">{{ bill_item.item_size }}</td>
                                <td class="col text-center">{{ bill_item.item_quantity }}</td>
                                <td class="col text-center">{{ bill_item.item_price }}</td>
                            </tr>
                            <tr>
                                <td class="col text-center">
                                    <h4>Grand Total</h4>
                                </td>
                                <td class="col text-center visually-hidden"></td>
                                <td class="col text-center visually-hidden"></td>
                                <td class="col text-center">{{ bill_detail.subtotal }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6 class="text-uppercase">Thank you | visit again</h6>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Bill End -->

        


    </div>
</template>

<script>
export default {
  data() {
    return {
      //order details arrays
      customers: [],
      drivers: [],
      categories: [],
      items: [],
      sizes: [],
      add_ons: [],
      selected_add_ons: [],
      display_selected_add_ons: [],
      tables: [],
      cart_items: [],
      bill_details: [],

      search_item: null,

      //view sections variables
      selected_order_type: null,
      delivery_boy_selection: 0,
      dine_in_selection: 0,
      bill_show: 0,

      //order details variables
      table_id: null,
      cart_total: null,
      order_id: null,
      item_id: null,
      item_name: null,
      item_image: null,
      item_description: null,
      item_price: null,
      quantity: 1,
      set_delete: 0,
      active: null,

      //driver details variables
      driver_id: null,
      driver_name: null,
      search_driver: null,

      //customer details variables
      customer_id: null,
      customer_name: null,
      search_customer: null,

      already_have: 0,

      selected_size_id: null,
      selected_size: "Not Selected",

      edit_id: null,
      edit_active: null,

      errors: [],

      //TO show and hide create form
      show_create_form: 0,
    };
  },

  mounted() {
    this.fetchCategories();
    this.fetchAllItems();
    this.fetchTables();
    this.fetchOrderId();
    this.fetchCart();
    this.fetchCartTotal();
  },

  methods: {
    reset() {
        this.drivers = [];
        this.customers = [];
        this.categories = [];
        this.items = [];
        this.sizes = [];
        this.add_ons = [];
        this.selected_add_ons = [];
        this.display_selected_add_ons = [];
        this.tables = [];
        this.cart_items = [];
        this.bill_details = [];

        this.selected_order_type = null;
        this.delivery_boy_selection = 0;
        this.dine_in_selection = 0;
        this.bill_show = 0;

        this.table_id = null;
        this.cart_total = null;
        this.order_id = null;
        this.item_id = null;
        this.item_name = null;
        this.item_image = null;
        this.item_description = null;
        this.item_price = null;
        this.quantity = 1;
        this.set_delete = 0;

        this.driver_id = null;
        this.driver_name = null;
        this.search_driver = null;

        this.customer_id = null;
        this.customer_name = null;

        this.already_have = 0;

        this.selected_size_id = null;
        this.selected_size = null;

        //for edit purpose
        this.edit_id = null;
        this.edit_active = null;
    },

    getDataToBill()
    {
        axios
            .get("/admin/fetch/data-to-bill")
            .then((res) => {
            if (res.status == 200) {
                console.log(res.data);
                this.bill_details = res.data;
            }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
        
    },

    printSection() {
        this.$htmlToPaper("printSection");
    },

    getItemDetails(item_id, item_image, item_name, item_description, item_price)
    {
        this.quantity = 1;
        this.selected_add_ons = [];
        this.display_selected_add_ons = [];
        this.item_id = item_id;
        this.item_image = item_image;
        this.item_name = item_name;
        this.item_description = item_description;
        this.item_price = item_price;
        this.selected_size_id = null;
        this.selected_size = null;
        this.fetchSizes(this.item_id);
        this.fetchAddOns(this.item_id);
    },

    get_select_order_type(event) {
        this.selected_order_type = event.target.value;

        if(this.selected_order_type == "delivery")
        {
            this.dine_in_selection = 0;
            this.delivery_boy_selection = 1;
        }
        else if(this.selected_order_type == "dine_in")
        {
            this.delivery_boy_selection = 0;
            this.dine_in_selection = 1;
        }
        else
        {
            this.delivery_boy_selection = 0;
            this.dine_in_selection = 0;
        }
    },

    setSize(size_id, size_name)
    {
        this.selected_size_id = size_id;
        this.selected_size = size_name;
    },

    selectAddOns(add_on_id)
    {
        for(var i=0; i < this.selected_add_ons.length; i++)
        {
            if(this.selected_add_ons[i] == add_on_id)
            {
                console.log("Already have");
                delete this.selected_add_ons[i];
                console.log(this.selected_add_ons);
                this.already_have = 1;
                this.getSelectedAddOns(this.selected_add_ons);
                return;
            }
            else
            {
                console.log("Not have");
                console.log(this.selected_add_ons);
                this.already_have = 0;
            }
        }

        if(this.already_have == 0)
        {
            this.selected_add_ons.push(add_on_id);
            console.log(this.selected_add_ons);
        }

        this.getSelectedAddOns(this.selected_add_ons);
    },

    searchItems()
    {
        axios
        .post("/admin/fetch/customer-order-search-items",{
            search_item: this.search_item
        })
        .then((res) => {

        if (res.status == 200) {
            this.items = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    getSelectedAddOns(selected_add_ons)
    {
        axios
        .post("/admin/fetch/customer-order-fetch-selected-add-ons",{
            display_selected_add_ons: selected_add_ons
        })
        .then((res) => {

        if (res.status == 200) {
            this.display_selected_add_ons = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    fetchDrivers() {
      axios
        .get("/admin/fetch/drivers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.drivers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchCustomers() {
      axios
        .get("/admin/fetch/customers")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.customers = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    selectDriver(id, name)
    {
        this.driver_id = id;
        this.driver_name = name;
    },

    selectCustomer(id, name)
    {
        this.customer_id = id;
        this.customer_name = name;
    },

    searchDriver()
    {
        axios
        .post("/admin/fetch/search-drivers",{
            search_driver: this.search_driver
        })
        .then((res) => {

        if (res.status == 200) {
            this.drivers = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    searchCustomer()
    {
        axios
        .post("/admin/fetch/search-customers",{
            search_customer: this.search_customer
        })
        .then((res) => {

        if (res.status == 200) {
            this.customers = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    fetchCart() {
      axios
        .get("/admin/fetch/customer-order-fetch-cart")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.cart_items = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchCartTotal() {
      axios
        .get("/admin/fetch/customer-order-fetch-cart-total")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.cart_total = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchCategories() {
      axios
        .get("/admin/fetch/customer-order-categories")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.categories = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchAllItems() {
      axios
        .get("/admin/fetch/customer-order-all-items")
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

    fetchTables() {
      axios
        .get("/admin/fetch/customer-order-fetch-tables")
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

    fetchOrderId() {
      axios
        .get("/admin/fetch/customer-order-fetch-order-id")
        .then((res) => {
          if (res.status == 200) {
            console.log(res.data);
            this.order_id = res.data;
          }
        })
        .catch((err) => {
          console.log("error:" + err);
        });
    },

    fetchItemsByCategory(category_id)
    {
        axios
        .post("/admin/fetch/customer-order-items-by-category",{
            category_id: category_id
        })
        .then((res) => {

        if (res.status == 200) {
            this.items = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    fetchSizes(item_id)
    {
        axios
        .post("/admin/fetch/customer-order-sizes-by-item",{
            item_id: item_id
        })
        .then((res) => {

        if (res.status == 200) {
            this.sizes = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    fetchAddOns(item_id)
    {
        axios
        .post("/admin/fetch/customer-order-add-ons-by-item",{
            item_id: item_id
        })
        .then((res) => {

        if (res.status == 200) {
            this.add_ons = res.data;
            console.log(res.data);
        }
        })
        .catch((err) => {});
    },

    set_table_value(event) {
      this.table_id = event.target.value;
    },

    addToCart()
    {
        axios
        .post("/admin/fetch/customer-order-add-to-cart",{
            item_id: this.item_id,
            item_price: this.item_price,
            quantity: this.quantity,
            size_id: this.selected_size_id,
            selected_add_ons: this.selected_add_ons
        })
        .then((res) => {
          if (res.status == 200) {
            // Swal.fire("Success", "Item Added to the Cart!", "success");
            // this.reset();
            this.fetchCategories();
            this.fetchAllItems();
            this.fetchTables();
            this.fetchOrderId();
            this.fetchCart();
            this.fetchCartTotal();

            // $("#update_close_btn").click();
          } else {
            Swal.fire("Error", "Item Added to the Cart Unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Item Added to the Cart Unsuccessfull!", "error");
        });
    },

    updateCartItem(id, quantity, price)
    {
        axios
        .put("/admin/update/customer-order-update-cart",{
            item_id: id,
            quantity: quantity,
            item_price: price
        })
        .then((res) => {
          if (res.status == 200) {
            // Swal.fire("Success", "Cart Updated!", "success");
            this.reset();
            this.fetchCategories();
            this.fetchAllItems();
            this.fetchTables();
            this.fetchOrderId();
            this.fetchCart();
            this.fetchCartTotal();

            // $("#update_close_btn").click();
          } else {
            Swal.fire("Error", "Cart Updated Unsuccessfull!", "error");
          }
        })
        .catch((err) => {
          if (err.response.status == 422)
            // this.uerrors = err.response.data.errors;
            Swal.fire("Error", "Cart Updated Unsuccessfull!", "error");
        });
    },

    deleteCartItem(id) {
      Swal.fire({
        title: "(Delete this Item) Are you sure?",
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
            .post("/admin/destroy/cart-item", {
              item_id: id,
            })
            .then((res) => {
              if (res.status == 200) {
                // Swal.fire("Deleted!", "Item deleted from Cart", "success");

                // this.reset();
                this.fetchCategories();
                this.fetchAllItems();
                this.fetchTables();
                this.fetchOrderId();
                this.fetchCart();
                this.fetchCartTotal();
              } else {
                Swal.fire("Error", "Item deleted from Cart Unsuccessfull!", "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Item deleted from Cart Unsuccessfull!", "error");
              }
            });
        }
      });
    },

    submitOrder(payment_method)
    {
        Swal.fire({
            title: "(Submit the Order) Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, submit it!",
            showLoaderOnConfirm: true,
        }).then((result) => {
        if (result.isConfirmed) {

          axios
            .post("/admin/submit/customer-order-submit-order", {
                payment_method: payment_method,
                table_id: this.table_id,
                driver_id: this.driver_id,
                customer_id: this.customer_id,
                selected_order_type: this.selected_order_type
            })
            .then((res) => {
              if (res.status == 200) {
                Swal.fire("Success!", "Successfully Submitted", "success");

                this.reset();
                this.fetchCategories();
                this.fetchAllItems();
                this.fetchTables();
                this.fetchOrderId();
                this.fetchCart();
                this.fetchCartTotal();
                this.getDataToBill();
                // window.open('/bill', '_blank');

                    Swal.fire({
                        title: 'Print the bill?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Print!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.printSection();
                        }
                    })
              } 
              else {
                Swal.fire("Error", res.data, "error");
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                // this.errors = err.response.data.errors;
                Swal.fire("Error", "Order Submit Unsuccessfull!", "error");
              }
            });
        }
      });


    },
    
  },
};
</script>