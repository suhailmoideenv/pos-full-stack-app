
require('./bootstrap');

import "datatables.net-bs4";
import "datatables.net-bs4/css/dataTables.bootstrap4.css";
import "jszip";
import "pdfmake";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.css";
import "datatables.net-buttons/js/buttons.colVis";
import "datatables.net-buttons/js/buttons.flash";
import "datatables.net-buttons/js/buttons.html5";
import "datatables.net-buttons/js/buttons.print";

import "vuejs-datatable/dist/themes/bootstrap-4.esm";
import { VuejsDatatableFactory } from "vuejs-datatable";

// register jw pagination component globally
import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);


//?drop down search
import vSelect from "vue-select";
Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";
//?drop down search end


Vue.use(VuejsDatatableFactory);


// main.js
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';
window.Swal = swal;

import VueHtmlToPaper from "vue-html-to-paper";


import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


Vue.use(VueSweetalert2);

window.Vue = require('vue').default;
import VueRouter from "vue-router";
Vue.use(VueRouter)



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('one-vue', require('./components/One.vue'));


import Dashboard from './components/admins/Dashboard'
import ItemsConfigurations from './components/admins/ItemsConfigurations'
import OtherConfigurations from './components/admins/OtherConfigurations'
import Reports from './components/admins/Reports'
import Admins from './components/admins/Admins.vue'
import AddCategories from './components/admins/AddCategories'
import AddItem from './components/admins/AddItem'
import AddAddOns from './components/admins/AddAddOns'
import AddSizes from './components/admins/AddSizes'
import AddTables from './components/admins/AddTables'
import AssignAddOns from './components/admins/AssignAddOns'
import AssignSizes from './components/admins/AssignSizes'
import MenuStock from './components/admins/MenuStock'
import CustomerOrder from './components/admins/CustomerOrder'
import PendingOrder from './components/admins/PendingOrder'
import KitchenOrder from './components/admins/KitchenOrder'
import CounterCheckout from './components/admins/CounterCheckout'
import TableBooking from './components/admins/TableBooking'
import AddDrivers from './components/admins/AddDrivers'
import AddCustomers from './components/admins/AddCustomers'
import PendingOrders from './components/admins/PendingOrders'
import CustomerSettlements from './components/admins/CustomerSettlements'
import DriverSettlements from './components/admins/DriverSettlements'
import CustomerOrderReport from './components/admins/CustomerOrderReport'


import CreateUser from './components/pages/CreateUser'


const routes = [



    //admin routes
    { path:'/home', component:Dashboard},  //to load Dashboard page
    { path:'/admin/items-configurations', component:ItemsConfigurations},  //to load ItemsConfigurations page
    { path:'/admin/other-configurations', component:OtherConfigurations},  //to load OtherConfigurations page
    { path:'/admin/reports', component:Reports},  //to load Reports page
    { path: '/admin/admin-users', component : Admins},  //to load Admins page
    { path: '/admin/create-categories', component : AddCategories},  //to load AddCategories page
    { path: '/admin/create-items', component : AddItem},  //to load AddItem page
    { path: '/admin/create-add-ons', component : AddAddOns},  //to load AddAddOns page
    { path: '/admin/create-sizes', component : AddSizes},  //to load AddSizes page
    { path: '/admin/create-tables', component : AddTables},  //to load AddTables page
    { path: '/admin/assign-add-ons', component : AssignAddOns},  //to load AssignAddOns page
    { path: '/admin/assign-sizes', component : AssignSizes},  //to load AssignSizes page
    { path: '/admin/menu-stock', component : MenuStock},  //to load MenuStock page
    { path: '/admin/customer-order', component : CustomerOrder},  //to load CustomerOrder page
    { path: '/admin/pending-order', component : PendingOrder},  //to load PendingOrder page
    { path: '/admin/kitchen-order', component : KitchenOrder},  //to load KitchenOrder page
    { path: '/admin/counter-checkout', component : CounterCheckout},  //to load CounterCheckout page
    { path: '/admin/table-booking', component : TableBooking},  //to load TableBooking page
    { path: '/admin/add-drivers', component : AddDrivers},  //to load AddDrivers page
    { path: '/admin/add-customers', component : AddCustomers},  //to load AddCustomers page
    { path: '/admin/pending-orders', component : PendingOrders},  //to load PendingOrders page
    { path: '/admin/customer-settlements', component : CustomerSettlements},  //to load CustomerSettlements page
    { path: '/admin/driver-settlements', component : DriverSettlements},  //to load DriverSettlements page
    { path: '/admin/customer-order-report', component : CustomerOrderReport},  //to load CustomerOrderReport page
    

  ];


const router = new VueRouter({
    mode:'history',
    routes,
})

const options={
    // name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
}

Vue.use(VueHtmlToPaper, options);


const app = new Vue({
    el: '#app',
    router,
    components:{
        CreateUser,
        Dashboard,
    },

    mounted() {
        console.log('mounted');
      }
});
