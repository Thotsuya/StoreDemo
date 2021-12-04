<template>
    <app-layout title="Editar Orden">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Orden
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                    <div class="bg-green-200 border-t-4 border-green-500 rounded-b text-gray-500 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.props.flash.message">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Cliente:</label>
                        <input type="text" disabled class="bg-gray-200 border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Nombre del Cliente" v-model="orderForm.client.name">
                        <div v-if="$page.props.errors.client_id" class="text-red-500">{{ $page.props.errors.client_id }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Direccion de envio:</label>
                        <div class="flex items-center">
                            <select class="form-select block w-full mt-1" v-model="orderForm.address_id">
                                <option v-for="(address,index) in addresses" :key="address.id" :value="address.id">
                                    {{ address.address }}
                                </option>
                            </select>
                        </div>
                        <div v-if="$page.props.errors.description" class="text-red-500">{{ $page.props.errors.description }}</div>
                    </div>

                    <div class="mb-4">
                        <button @click="update" class="w-full bg-green-500 text-white rounded-md py-2 transition ease-in-out duration-200 hover:bg-green-700">Guardar Cambios</button>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mt-4">
                    <div>
                        Productos
                    </div>
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 py-4 border-b border-gray-100">
                                <button @click="addProduct()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full transition ease-in-out duration-200">Registrar Nuevo Item</button>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full">
                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Producto</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Cantidad</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Acciones</div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            <tr v-for="(product,index) in orderForm.products">
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <select class="form-select block w-full mt-1" v-model="product.product_id">
                                                            <option v-for="(producto,index) in products" :key="producto.id" :value="producto.id">
                                                                {{ producto.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <input type="number" class="font-medium text-gray-800 w-full rounded-md border-gray-300" v-model="product.amount">
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div @click="deleteProduct(index)" class="text-center cursor-pointer font-medium text-red-500 transition ease-in-out duration-200 hover:text-red-700">Eliminar</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>




        </div>


    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {

    props:['products','order','addresses'],

    data(){
        return {
            orderForm: this.$inertia.form({
                'client': this.order.client,
                'address_id': this.order.address_id ? this.order.address_id : 1,
                'description': '',
                'products': []
            }),

        }
    },

    components:{
        AppLayout,
        Link
    },

    mounted() {
        if(this.order.products.length){
            this.order.products.forEach((element, index) => {

                this.orderForm.products.push({
                    'product_id': element.id,
                    'amount': element.pivot.amount
                })
            })
        }
    },

    methods:{

        addProduct(){
            this.orderForm.products.push({
                'product_id': 1,
                'amount': 1
            })
        },

        deleteProduct(product){
            this.orderForm.products.splice(product,1)
        },

        update(){
            this.orderForm.put(route('orders.update',this.order))
        },


    }

}

</script>

<style scoped>
.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    background-repeat: no-repeat;
    background-color: #fff;
    border-color: #e2e8f0;
    border-width: 1px;
    border-radius: 0.25rem;
    padding-top: 0.5rem;
    padding-right: 2.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    background-position: right 0.5rem center;
    background-size: 1.5em 1.5em;
}

.form-select::-ms-expand {
    color: #a0aec0;
    border: none;
}

@media not print {
    .form-select::-ms-expand {
        display: none;
    }
}

@media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
    .form-select {
        padding-right: 0.75rem;
    }
}

.form-select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    border-color: #63b3ed;
}
</style>
