<template>
    <app-layout title="Fábricas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Distribuidores
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

                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Nueva Fábrica</button>
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">No. Fábrica</th>
                            <th class="px-4 py-2">Fábrica</th>
                            <th class="px-4 py-2">Teléfono de Contacto</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="factory in factories.data">
                            <td class="border px-4 py-2">{{ factory.factory_number }}</td>
                            <td class="border px-4 py-2">{{ factory.name }}</td>
                            <td class="border px-4 py-2">{{ factory.phone_number }}</td>
                            <td class="border px-4 py-2 text-center">
                                <Link :href="route('factories.edit',factory)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</Link>
                                <button @click="openDeleteModal(factory)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination class="mt-6" :links="factories.links" />

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <CreateFactory
                            @close-modal="closeModal"
                        ></CreateFactory>
                    </div>

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="deleteModal">
                        <DeleteFactory
                            :factory="factory"
                            @close-modal="closeDeleteModal"
                        ></DeleteFactory>
                    </div>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import CreateFactory from "@/Pages/Factories/Create";
import DeleteFactory from "@/Pages/Factories/Destroy";
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";

export default {

    props:['factories'],

    data(){
        return {
            isOpen: false,
            factory: [],
            deleteModal: false
        }
    },

    components:{
        AppLayout,
        CreateFactory,
        Link,
        Pagination,
        DeleteFactory
    },

    methods:{

        openModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false
        },

        openDeleteModal(factory){
            this.factory = factory;
            this.deleteModal = true;
        },

        closeDeleteModal(){
            this.deleteModal = false
        }

    }

}

</script>
