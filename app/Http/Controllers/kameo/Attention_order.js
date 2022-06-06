import axios from "axios";
import { defineStore } from "pinia";
import { useRouter, useRoute } from "vue-router";

export const useOrdersStore = defineStore('orders', {
    id:"orders",
    state: () => ({
        orders:     {},
        order:      {
            id:                         null,
            companies_id:               null,
            users_id:                   null,
            user:                       {},
            company:                    {},
            bikes:                      {},
            accessories:                {},
            boxes:                      {},
        },
        errors:     {},
        router:     useRouter(),
        route:      useRoute(),
    }),
    getters: {
        getOrders: (state) => {
            return state.orders;
        },
        getOrder: (state) => {
            return state.order;
        },
        getErrors: (state) => {
            return state.errors;
        }
    },
    actions: {
        // Api request for load all orders
        async loadOrders(){
            await axios.get('/api/grouped-orders').then(responsePHP => (this.orders = responsePHP.data));
        },
        // Api request for load one order
        async show(id){
            await axios.get('/api/grouped-orders/show/' + id).then(responsePHP => (this.order = responsePHP.data));
        },
        // Api request for create order
        async create(form){
            // Send request
            await axios.post('/api/grouped-orders/create', form).then( (responsePHP) => {
                this.orders.unshift(responsePHP.data);
                this.router.push({ name: 'grouped-orders-update', params: { id: responsePHP.data.id } }); 
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    console.log(error)
                }
            });
        },
        // Api request for update order
        async update(){
            // Send request
            await axios.post('/api/grouped-orders/update/' + this.order.id, this.order).then( (responsePHP) => {
                const order             = responsePHP.data;
                const foundIndex        = this.orders.findIndex(orders => orders.id === order.id);
                this.orders[foundIndex] = order;
                this.order              = order;
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    console.log(error)
                }
            });
        },
        // Api request for destroy order
        async destroy(id){
            // Send request
            await axios.post('/api/grouped-orders/destroy/' + id, { orderId: id }).then( (responsePHP) => {
                this.router.push({name: 'grouped-orders-list'}); 
            }).catch((error) => {
                console.log(error)
            });
        },
        // API request for generate purchase order
        async purchaseOrder(data){
            // Send request
            await axios.post('/api/purchase-order/generate', data).then( (responsePHP) => {
                window.open(responsePHP.data.fileName);
            }).catch((error) => {
                console.log(error)
            });
        },
        async generateInvoice(data){
            // Send request
            await axios.post('/api/invoice/generate/' + this.route.params.id, data).then( (responsePHP) => {
                // window.open(responsePHP.data.fileName);
            }).catch((error) => {
                console.log(error)
            });
        }
    },
})