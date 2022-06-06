<template>
    <h2 id="dynamicMainTitle" style="color: #3cb395;" class="text-uppercase">Détail d'une commande</h2>
    <div class="row" id="mainDynamicZone" >
        <div class="col-sm-12">
            <button @click="$router.go(-1)" style="width: 35px; height: 35px; padding: 0px;" type="button" class="btn"><i class="fa fa-arrow-left"></i></button>
            <button @click="generatePurchaseOrderIsOpen = true" style="height: 35px; padding: 10px; float: right; margin-right: 5px;" type="button" class="btn">Bon de commande</button>
            <button @click="generateInvoiceIsOpen = true" style="height: 35px; padding: 10px; float: right; margin-right: 5px;" type="button" class="btn">Générer facture</button>
            
        </div>
        <div class="col-md-12">
            <div class="widget p-cb">
                <div>
                    <div v-show="!!ordersStore.getOrder.company.name">
                        <h4>Informations sur la société</h4>
                        <label class="form-label" style="color: #3cb395;">Nom de la société</label>
                        <p>{{ ordersStore.getOrder.company.name }}</p>
                    </div>
                    <hr>
                    <div v-if="!!ordersStore.getOrder.user" class="row">
                        <h4>Utilisateur</h4>
                        <div v-show="!!ordersStore.getOrder.user.firstname" class="col-sm-6">
                            <label class="form-label" style="color: #3cb395;">Prénom</label>
                            <p>{{ ordersStore.getOrder.user.firstname }}</p>
                        </div>
                        <div v-show="!!ordersStore.getOrder.user.lastname" class="col-sm-6">
                            <label class="form-label" style="color: #3cb395;">Nom</label>
                            <p>{{ ordersStore.getOrder.user.lastname }}</p>
                        </div>
                        <div v-show="!!ordersStore.getOrder.user.email" class="col-sm-6">
                            <label class="form-label" style="color: #3cb395;">E-mail</label>
                            <p>{{ ordersStore.getOrder.user.email }}</p>
                        </div>
                        <div v-show="!!ordersStore.getOrder.user.phone" class="col-sm-6">
                            <label class="form-label" style="color: #3cb395;">Téléphone</label>
                            <p>{{ ordersStore.getOrder.user.phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="widget p-cb">
                <div>
                    <h4>Contenu de la commande</h4>

                    <h4 class="text-primary">Vélos</h4>
                    <div v-show="bikesOrdersStore.getBikesFromGroupedOrder(ordersStore.getOrder.id).length === 0">
                        <p style="font-weight: bold; text-transform: uppercase; color: #3cb295; text-align: center; margin-top: 50px;">Aucun vélo pour cette commande</p>
                    </div>
                    <div v-show="bikesOrdersStore.getBikesFromGroupedOrder(ordersStore.getOrder.id).length > 0" class="scroll-container">
                        <div v-for="bike in bikesOrdersStore.getBikesFromGroupedOrder(ordersStore.getOrder.id)" :key="bike.id" class="scroll-card">
                            <div class="card">
                                <img class="card-img-top" src="https://kameo.test/images/logo.png" alt="Card image cap">
                                <div class="card-body">
                                 <router-link :to="{ name: 'bike-orders-update', params: { id: bike.id } }" tag="button" class="btn btn-xs">
                                    <i class="fa fa-pencil-alt"></i>
                                </router-link>
                                    <h5 class="card-title">Commande {{ bike.id }}</h5>
                                    <p class="card-text">
                                        Marque :                {{ bike.catalog.brand }}<br>
                                        Modèle :                {{ bike.catalog.model }}<br>
                                        Taille :                {{ bike.size }}<br>
                                        Type de contrat :       {{ bike.type }} <br>
                                        Montant :               {{ bike.amount }} €<br>
                                        ID Stock :              {{ bike.bikes_id }} <br>
                                        Statut :                {{ bike.status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <h4 class="text-primary">Accessoires</h4>
                    <div v-show="accessoriesOrdersStore.getAccessoriesFromGroupedOrder(ordersStore.getOrder.id).length === 0">
                        <p style="font-weight: bold; text-transform: uppercase; color: #3cb295; text-align: center; margin-top: 50px;">Aucun accessoire pour cette commande</p>
                    </div>
                    <div v-show="accessoriesOrdersStore.getAccessoriesFromGroupedOrder(ordersStore.getOrder.id).length > 0" class="scroll-container">
                        <div v-for="accessory in accessoriesOrdersStore.getAccessoriesFromGroupedOrder(ordersStore.getOrder.id)" :key="accessory.id" class="scroll-card">
                            <div class="card">
                                <img class="card-img-top" src="https://kameo.test/images/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <router-link :to="{ name: 'accessory-orders-update', params: { id: accessory.id } }" tag="button" class="btn btn-xs">
                                        <i class="fa fa-pencil-alt"></i>
                                    </router-link>
                                    <h5 class="card-title">Commande {{ accessory.id }}</h5>
                                    <p class="card-text">
                                        Marque :                {{ accessory.catalog.brand }}<br>
                                        Modèle :                {{ accessory.catalog.model }}<br>
                                        Taille :                {{ accessory.size }}<br>
                                        Type de contrat :       {{ accessory.type }} <br>
                                        Montant :               {{ accessory.amount }} €<br>
                                        ID Stock :              {{ accessory.accessories_id }} <br>
                                        Statut :                {{ accessory.status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <h4 class="text-primary">Bornes</h4>
                    <div v-show="boxesOrdersStore.getBoxesFromGroupedOrder(ordersStore.getOrder.id).length === 0">
                        <p style="font-weight: bold; text-transform: uppercase; color: #3cb295; text-align: center; margin-top: 50px;">Aucune borne pour cette commande</p>
                    </div>
                    <div v-show="boxesOrdersStore.getBoxesFromGroupedOrder(ordersStore.getOrder.id).length > 0" class="scroll-container">
                        <div v-for="box in boxesOrdersStore.getBoxesFromGroupedOrder(ordersStore.getOrder.id)" :key="box.id" class="scroll-card">
                            <div class="card">
                                <img class="card-img-top" src="https://kameo.test/images/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <router-link :to="{ name: 'box-orders-update', params: { id: box.id } }" tag="button" class="btn btn-xs">
                                        <i class="fa fa-pencil-alt"></i>
                                    </router-link>
                                    <h5 class="card-title">Commande {{ box.id }}</h5>
                                    <p class="card-text">
                                        Modèle :            {{ box.catalog.model }}<br>
                                        Installation :      {{ box.installation_price }} €<br>
                                        Location :          {{ box.amount }} €/mois<br>
                                        ID Stock :          {{ box.accessories_id }} <br>
                                        Statut :            {{ box.status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    
    <MediumModal :open="generatePurchaseOrderIsOpen" @close="generatePurchaseOrderIsOpen = !generatePurchaseOrderIsOpen">
        <form @submit.prevent="ordersStore.purchaseOrder(inputChecked)" @change="verifyCondition">
            <h1 class="title text-center text-modal">Générer un bon de commande</h1>
            <p style="color: red; text-transform: uppercase; font-weight: bold; text-align: center;">{{ errorMessage }}</p>
            <ul style="list-style:none" @change="checked">
                <li v-show="bikesOrdersStore.getBikesFromGroupedOrder(route.params.id).length > 0"><h3 class="title text-center text-modal">Vélo(s)</h3>   
                    <table style="width:50%;margin:auto;" >
                        <tr v-for="bike in bikesOrdersStore.getBikesFromGroupedOrder(route.params.id)" :key="bike.id">
                            <td>{{ bike.catalog.brand }}</td>
                            <td>{{ bike.catalog.model }}</td>
                            <td><input type="checkbox" name="bike-orders-check" :value="{name :'bike',id:bike.catalog.id,brand:bike.catalog.brand,model:bike.catalog.model,bike_id: bike.bikes_id}" class="checkbox" v-model="inputChecked"></td>
                        </tr>
                    </table>
                </li>
                <li v-show="accessoriesOrdersStore.getAccessoriesFromGroupedOrder(route.params.id).length > 0"><h3 class="title text-center text-modal" style="padding-top:1em;">Accessoire(s)</h3>
                    <table style="width:50%;margin:auto;">
                        <tr v-for="accessory in accessoriesOrdersStore.getAccessoriesFromGroupedOrder(route.params.id)" :key="accessory.id"  >
                            <td>{{ accessory.catalog.brand }}</td>
                            <td>{{ accessory.catalog.model }}</td>
                            <td><input type="checkbox"  name="accessory-orders-check" :value="{name :'accessory',id:accessory.catalog.id,brand:accessory.catalog.brand,model:accessory.catalog.model,accessory_id: accessory.accessories_id}" class="checkbox" v-model="inputChecked"></td>
                        </tr>
                    </table>
                </li>
            </ul>
    
            <!-- Buttons -->
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-block" type="button" @click="closeGeneratePurchaseOrder">Fermer</button>
                </div>
                <div class="col-sm-6" >
                    <button class="btn btn-block disabled" type="submit" id="generatePurchaseOrder">Générer</button>

                </div>
            </div>
        </form> 
    </MediumModal>

    <MediumModal :open="generateInvoiceIsOpen" @close="generateInvoiceIsOpen = !generateInvoiceIsOpen">
        <form @submit.prevent="ordersStore.generateInvoice(inputChecked)" @change="verifyCondition">
            <h1 class="title text-center text-modal">Générer une facture</h1>
            <p style="color: red; text-transform: uppercase; font-weight: bold; text-align: center;">{{ errorMessage }}</p>
            <ul style="list-style:none" @change="checked">
                <li v-show="bikesOrdersStore.getSellingBikesFromGroupedOrder(route.params.id).length > 0"><h3 class="title text-center text-modal">Vélo(s)</h3>   
                    <table style="width:50%;margin:auto;" >
                        <tr v-for="bike in bikesOrdersStore.getSellingBikesFromGroupedOrder(route.params.id)" :key="bike.id">
                            <td>{{ bike.catalog.brand }}</td>
                            <td>{{ bike.catalog.model }}</td>
                            <td><input type="checkbox" name="bike-orders-check" :value="{name :'bike',id:bike.catalog.id,brand:bike.catalog.brand,model:bike.catalog.model,bike_id: bike.bikes_id}" class="checkbox" v-model="inputChecked"></td>
                        </tr>
                    </table>
                </li>
                <li v-show="accessoriesOrdersStore.getSellingAccessoriesFromGroupOrder(route.params.id).length > 0"><h3 class="title text-center text-modal" style="padding-top:1em;">Accessoire(s)</h3>
                    <table style="width:50%;margin:auto;">
                        <tr v-for="accessory in accessoriesOrdersStore.getSellingAccessoriesFromGroupOrder(route.params.id)" :key="accessory.id"  >
                            <td>{{ accessory.catalog.brand }}</td>
                            <td>{{ accessory.catalog.model }}</td>
                            <td><input type="checkbox"  name="accessory-orders-check" :value="{name :'accessory',id:accessory.catalog.id,brand:accessory.catalog.brand,model:accessory.catalog.model,accessory_id: accessory.accessories_id}" class="checkbox" v-model="inputChecked"></td>
                        </tr>
                    </table>
                </li>
                <!-- <li v-show="boxesOrdersStore.getBoxesFromGroupedOrder(route.params.id).length > 0"><h3 class="title text-center text-modal" style="padding-top:1em;">Borne(s)</h3>
                    <table style="width:50%;margin:auto;">
                        <tr v-for="boxe in boxesOrdersStore.getBoxesFromGroupedOrder(route.params.id)" :key="boxe.id"  >
                            <td>{{ boxe.catalog.model }}</td>
                            <td><input type="checkbox"  name="boxe-orders-check" :value="{name :'boxe',id:boxe.catalog.id,model:boxe.catalog.model,boxe_id: boxe.boxes_id}" class="checkbox" v-model="inputChecked"></td>
                        </tr>
                    </table>
                </li> -->
            </ul>
    
            <!-- Buttons -->
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-block" type="button" @click="closeGenerateInvoice">Fermer</button>
                </div>
                <div class="col-sm-6" >
                    <button class="btn btn-block disabled" type="submit" id="generateInvoice">Générer</button>

                </div>
            </div>
        </form> 
    </MediumModal>
    
</template>

<script setup>

    // Import dependencies
    import { useRoute } from 'vue-router';
    import { ref } from 'vue';

    // Import components
    import MediumModal from '../Modals/Medium.vue';

    // Import stores 
    import { useOrdersStore } from '../../store/Orders';
    import { useBikesOrdersStore } from '../../store/BikesOrders';
    import { useAccessoriesOrdersStore } from '../../store/AccessoriesOrders';
    import { useBoxesOrdersStore } from '../../store/BoxesOrders';
   
    // Define constante
    const ordersStore                   = useOrdersStore();
    const bikesOrdersStore              = useBikesOrdersStore();
    const accessoriesOrdersStore        = useAccessoriesOrdersStore();
    const boxesOrdersStore              = useBoxesOrdersStore();
    const route                         = useRoute();
    const generatePurchaseOrderIsOpen   = ref(false);
    const generateInvoiceIsOpen         = ref(false);
    const inputChecked                  = ref([]);
    const errorMessage                  = ref('');

    // Call functions
    ordersStore.show(route.params.id);

    // Define methods
    const verifyCondition = () => {
        errorMessage.value = '';
        if(inputChecked.value.length > 0){
            inputChecked.value.forEach((input,i) => {
                if(input.name === 'bike'){
                    if(input.bike_id === null){
                        document.getElementById('generatePurchaseOrder').classList.add('disabled');
                        document.getElementById('generateInvoice').classList.add('disabled');
                        errorMessage.value = 'Le vélo ' + input.brand + ' ' + input.model + ' n\'a pas été enregistré dans le stock';
                    }
                    else if(inputChecked.value.length === i + 1 && errorMessage.value === '' && input.bike_id != null){
                        document.getElementById('generatePurchaseOrder').classList.remove('disabled');
                        document.getElementById('generateInvoice').classList.remove('disabled');
                    }
                }
                else if(input.name === 'accessory'){
                    if(input.accessory_id === null){
                        document.getElementById('generatePurchaseOrder').classList.add('disabled');
                        document.getElementById('generateInvoice').classList.add('disabled');
                        errorMessage.value = 'L\'accessoire ' + input.brand + ' ' + input.model + ' n\'a pas été enregistré dans le stock';
                    }
                    else if(inputChecked.value.length === i + 1 && errorMessage.value === '' && input.accessory_id != null){
                        document.getElementById('generatePurchaseOrder').classList.remove('disabled');
                        document.getElementById('generateInvoice').classList.remove('disabled');
                    }
                }
                else if(input.name === 'boxe'){
                    if(input.boxe_id === null){
                        document.getElementById('generatePurchaseOrder').classList.add('disabled');
                        document.getElementById('generateInvoice').classList.add('disabled');
                        errorMessage.value = 'La borne ' + input.model + ' n\'a pas été enregistrée dans le stock';
                    }
                    else if(inputChecked.value.length === i + 1 && errorMessage.value === '' && input.boxe_id != null){
                            document.getElementById('generatePurchaseOrder').classList.remove('disabled');
                            document.getElementById('generateInvoice').classList.remove('disabled');
                    }
                }
                else{
                    if(inputChecked.value.length === i + 1 && errorMessage.value === ''){
                        document.getElementById('generatePurchaseOrder').classList.remove('disabled');
                        document.getElementById('generateInvoice').classList.remove('disabled');
                    }
                }
            });
        }
        else{
            document.getElementById('generatePurchaseOrder').classList.add('disabled');
            document.getElementById('generateInvoice').classList.add('disabled');
        }
    }
    
    function closeGeneratePurchaseOrder(){
        generatePurchaseOrderIsOpen.value = false;
        inputChecked.value = [];
        errorMessage.value = '';
    }

    function closeGenerateInvoice(){
        generateInvoiceIsOpen.value = false;
        inputChecked.value = [];
        errorMessage.value = '';
    }

</script>

<style scoped>

    .disabled {
        cursor:not-allowed;
        pointer-events: none;
        color:#C0C0C0;
        background-color: #FFFFFF;      
    }
    .scroll-container {
        width: 100%;
        height: 100%;
        display: flex;
        overflow-x: scroll;
    }
    .scroll-card{
        width: 250px;
        flex-shrink: 0;
    }
    .card{
        margin-right: 1em;
    }
    .checkbox-round {
        width: 1em;
        height: 1em;
        background-color: white;
        border-radius: 50%;
        vertical-align: middle;
        border: 1px solid #000000;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;    
    }
    .text-modal{
        color:#3CB295;
    }
    .checkbox-round:checked {
        background-color: #3CB295;
    }
  
</style>;