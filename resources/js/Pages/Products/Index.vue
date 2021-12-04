<template>
    <app-layout title="Productos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Productos
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

                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 transition ease-in-out duration-200">Crear Nuevo Producto</button>
                    <table class="table-fixed w-full">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">No. de Producto</th>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products.data">
                            <td class="border px-4 py-2">{{ product.product_number }}</td>
                            <td class="border px-4 py-2">{{ product.name }}</td>
                            <td class="border px-4 py-2">{{ product.short_description }}</td>
                            <td class="border px-4 py-2 text-center">
                                <Link :href="route('products.edit',product)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</Link>
                                <button @click="openDeleteModal(product)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <pagination class="mt-6" :links="products.links" />

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <CreateProduct
                            @close-modal="closeModal"
                        />
                    </div>

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="deleteModal">
                        <DeleteProduct
                            :product="product"
                            @close-modal="closeDeleteModal"
                        />
                    </div>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";
import CreateProduct from "@/Pages/Products/Create"
import DeleteProduct from "@/Pages/Products/Destroy"

export default {

    props:['products'],

    data(){
        return {
            isOpen: false,
            deleteModal: false,
            product: []
        }
    },

    components:{
        AppLayout,
        Pagination,
        Link,
        CreateProduct,
        DeleteProduct
    },

    methods:{

        openModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false
        },

        openDeleteModal(product){
            this.product = product;
            this.deleteModal = true;
        },

        closeDeleteModal(){
            this.deleteModal = false
        }

    }

}

</script>
