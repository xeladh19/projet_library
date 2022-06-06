import axios from "axios";
import { defineStore } from "pinia";
import { useRouter } from "vue-router";

export const useBikesOrdersStore = defineStore('bikesOrders', {
    id:"bikesOrders",
    state: () => ({
        bikesOrders:    {},
        bikeOrder:      {
            id:                         null,
            size:                       null,
            color:                      null,
            remark:                     null,
            amount:                     null,
            type:                       null,
            estimated_delivery_date:    null,
            delivery_date:              null,
            comment:                    null,
            status:                     null,
            bikes_id:                   null,
            grouped_orders_id:          null,
            bikes_catalog_id:           null,
            catalog:                    {},
        },
        errors:         {},
        router:         useRouter(),
    }),
    getters: {
        getOrders: (state) => {
            return state.bikesOrders;
        },
        getOrder: (state) => {
            return state.bikeOrder;
        },
        getErrors: (state) => {
            return state.errors;
        },
        getBikesFromGroupedOrder: (state) => (id = NULL) => {
            let bikes = [];
            if(state.bikesOrders.length > 0 && id){
                state.bikesOrders.forEach(function(item){
                    if(item.grouped_orders_id == id){
                        bikes.push(item);
                    }
                });    
            }
            return bikes // filter code
        },
        getSellingBikesFromGroupedOrder: (state) => (id = NULL) => {
            let bikes = [];
            if(state.bikesOrders.length > 0 && id){
                state.bikesOrders.forEach(function(item){
                    if(item.grouped_orders_id == id && item.type == 'selling'){
                        bikes.push(item);
                    }
                });    
            }
            return bikes // filter code
        }
    },
    actions: {
        // Api request to get all bikes orders
        async loadBikesOrders(){
            this.bikesOrders = await axios.get('/api/bike-orders').then(reponsePHP => (this.bikesOrders = reponsePHP.data));
        },
        // Api request to get one bike order
        async show(id){
            this.errors = [];
            this.bikeOrder = await axios.get('/api/bike-orders/show/' + id).then(reponsePHP => (this.bikeOrder = reponsePHP.data));
        },
        // Api request for create bike order
        async create(form){
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/bike-orders/create', form).then( (responsePHP) => {
                this.bikesOrders.push(responsePHP.data);
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
        // Api request for update bike order
        async update(){
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/bike-orders/update/' + this.bikeOrder.id, this.bikeOrder).then( (responsePHP) => {
                const bike                      = responsePHP.data;
                const foundIndex                = this.bikesOrders.findIndex(bikesOrders => bikesOrders.id === bike.id);
                this.bikesOrders[foundIndex]    = bike;
                this.bikeOrder                  = bike;
            }).catch((error) => {
                if(typeof error.response != "undefined" && error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                else{
                    console.log(error)
                }
            });
        },
        // Api request for destroy bike order
        async destroy(id){
            // Send request
            await axios.post('/api/bike-orders/destroy/' + id, { bikeOrderId: id }).then( (responsePHP) => {
                let removeBikeOrder = this.bikesOrders.map(function(item) { return item.id; }).indexOf(id);
                this.bikesOrders.splice(removeBikeOrder, 1);
                this.router.go(-1); 
            }).catch((error) => {
                console.log(error)
            });
        },
    },
})