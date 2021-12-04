<template>
    <app-layout title="Editar Cliente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Cliente
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
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Nombre del Cliente" v-model="clientForm.name">
                        <div v-if="$page.props.errors.name" class="text-red-500">{{ $page.props.errors.name }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Límite de Crédito:</label>
                        <input type="number" class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Nombre del Cliente" v-model="clientForm.credit_limit">
                        <div v-if="$page.props.errors.credit_limit" class="text-red-500">{{ $page.props.errors.credit_limit }}</div>
                    </div>

                    <div class="mb-4">
                        <button @click="updateClient" class="w-full bg-green-500 text-white rounded-md py-2 transition ease-in-out duration-200 hover:bg-green-700">Guardar Cambios</button>
                    </div>

                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 mt-4">
                    <div>
                        Direcciones Registradas
                    </div>
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 py-4 border-b border-gray-100">
                                <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full transition ease-in-out duration-200">Registrar Nueva Dirección</button>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full">
                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Direccion</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Ciudad</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Calle</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Distrito</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Acciones</div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                        <tr v-for="address in client.addresses" :key="address.id">
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="font-medium text-gray-800">{{ address.address }}</div>
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ address.city }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="font-medium text-gray-800">{{ address.street }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="font-medium text-gray-800">{{ address.district }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div @click="deleteAddress(address)" class="text-center cursor-pointer font-medium text-red-500 transition ease-in-out duration-200 hover:text-red-700">Eliminar</div>
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

        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
            <CreateAddress
                :client="client"
                @close-modal="closeModal"
            ></CreateAddress>
        </div>

    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'
import CreateAddress from '@/Pages/Clients/Addresses/Create'

export default {

    props:['client'],

    data(){
        return {
            isOpen: false,
            clientForm: this.$inertia.form({
                'name': this.client.name,
                'credit_limit' : this.client.credit_limit
            }),

        }
    },

    components:{
        AppLayout,
        Link,
        CreateAddress
    },

    methods:{

        openModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false
        },

        updateClient(){
            this.clientForm.put(route('clients.update',this.client))
        },

        deleteAddress(address){
            this.$inertia.delete(route('address.destroy',address.id),{

            })
        }

    }

}

</script>
