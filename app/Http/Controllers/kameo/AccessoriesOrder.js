import axios from "axios";
import { defineStore } from "pinia";
import { useRouter } from "vue-router";

export const useAccessoriesOrdersStore = defineStore('accessoriesOrders', {
    id:"accessoriesOrders",
    state: () => ({
        accessoriesOrders:      {},
        accessoryOrder:         {
            id:                         null,
            size:                       null,
            type:                       null,
            amount:                     null,
            description:                null,
            estimated_delivery_date:    null,
            delivery_date:              null,
            billing_type:               null,
            status:                     null,
            grouped_orders_id:          null,
            accessories_catalog_id:     null,
            accessories_id:             null,
            catalog:                    {},
        },
        errors:                 {},
        router:                 useRouter(),
    }),
    getters: {
        getAccessoryOrder: (state) => {
            return state.accessoryOrder;
        },
        getAccessoriesOrders: (state) => {
            return state.accessoriesOrders;
        },
        getErrors: (state) => {
            return state.errors;
        },
        getAccessoriesFromGroupedOrder: (state) => (id = NULL) => {
            let accessories = [];
            if(state.accessoriesOrders.length>0 && id){
                state.accessoriesOrders.forEach(function(item){
                    if(item.grouped_orders_id == id){
                        accessories.push(item);
                    }
                });    
            }
            return accessories // filter code
        },
        getSellingAccessoriesFromGroupOrder: (state) => (id = NULL) => {
            let accessories = [];
            if(state.accessoriesOrders.length>0 && id){
                state.accessoriesOrders.forEach(function(item){
                    if(item.grouped_orders_id == id && item.type == 'selling'){
                        accessories.push(item);
                    }
                });    
            }
            return accessories // filter code
        }
    },
    actions: {
        // Api request to get all accessories orders
        async loadAccessoriesOrders(){
            await axios.get('/api/accessory-orders').then(reponsePHP => {
                this.accessoriesOrders = reponsePHP.data;
            });
        },
        // Api request to get one accessory order
        async show(id){
            this.errors = [];
            await axios.get('/api/accessory-orders/show/' + id).then(reponsePHP => {
                this.accessoryOrder = reponsePHP.data;
            });
        },
        // Api request for create accessory order
        async create(form){
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/accessory-orders/create', form).then( (responsePHP) => {
                this.accessoriesOrders.push(responsePHP.data);
                this.router.push({name: 'grouped-orders-update', params: { id: responsePHP.data.grouped_orders_id } }); 
            }).catch((error) => {
                if(typeof error.response != "undefined" && error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    console.log(error)
                }
            });
        },
        // Api request for update accessory order
        async update(){
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/accessory-orders/update/' + this.accessoryOrder.id, this.accessoryOrder).then( (responsePHP) => {
                const accessoryOrder                = responsePHP.data;
                const foundIndex                    = this.accessoriesOrders.findIndex(accessoriesOrders => accessoriesOrders.id === accessoryOrder.id);
                this.accessoriesOrders[foundIndex]  = accessoryOrder;
                this.accessoryOrder                 = accessoryOrder;
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    if(typeof error.response != "undefined" && error.response.status === 422){
                        this.errors = error.response.data.errors;
                    }
                    else{
                        console.log(error)
                    }
                }
            });
        },
        // Api request for destroy accessory order
        async destroy(id){
            // Send request
            await axios.post('/api/accessory-orders/destroy/' + id, { accessoryOrderId: id }).then( (responsePHP) => {
                let removAccessoryOrder = this.accessoriesOrders.map(function(item) { return item.id; }).indexOf(id);
                this.accessoriesOrders.splice(removAccessoryOrder, 1);
                this.router.go(-1);
            }).catch((error) => {
                if(typeof error.response != "undefined" && error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    console.log(error)
                }
            });
        },
    },
})