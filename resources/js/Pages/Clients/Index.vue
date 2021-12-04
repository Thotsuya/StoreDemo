<template>
    <app-layout title="Clientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
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

                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Nuevo Cliente</button>
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">No. de Cliente</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Límite de Crédito</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="client in clients.data">
                            <td class="border px-4 py-2">{{ client.client_number }}</td>
                            <td class="border px-4 py-2">{{ client.name }}</td>
                            <td class="border px-4 py-2">C$ {{ client.limit }}</td>
                            <td class="border px-4 py-2">
                                <Link :href="route('clients.edit',client)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</Link>
                                <button @click="openDeleteModal(client)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination class="mt-6" :links="clients.links" />

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <Create
                        @close-modal="closeModal"
                        ></Create>
                    </div>

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="deleteModal">
                        <DeleteClient
                            :client="client"
                            @close-modal="closeDeleteModal"
                        ></DeleteClient>
                    </div>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import Create from "@/Pages/Clients/Create";
import DeleteClient from "@/Pages/Clients/Destroy";
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";

export default {

    props:['clients'],

    data(){
        return {
            isOpen: false,
            client: [],
            deleteModal: false
        }
    },

    components:{
        AppLayout,
        Create,
        Link,
        Pagination,
        DeleteClient
    },

    methods:{

        openModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false
        },

        openDeleteModal(client){
            this.client = client;
            this.deleteModal = true;
        },

        closeDeleteModal(){
            this.deleteModal = false
        }

    }

}

</script>
