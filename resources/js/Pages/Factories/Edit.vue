<template>
    <app-layout title="Editar Fábrica">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Fábrica
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
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Fábrica:</label>
                        <input type="text" class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Nombre del Cliente" v-model="factoryForm.name">
                        <div v-if="$page.props.errors.name" class="text-red-500">{{ $page.props.errors.name }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Teléfono de Contacto:</label>
                        <textarea type="number" class="border-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Teléfono de Contacto" v-model="factoryForm.phone_number"></textarea>
                        <div v-if="$page.props.errors.phone_number" class="text-red-500">{{ $page.props.errors.phone_number }}</div>
                    </div>

                    <div class="mb-4">
                        <button @click="update" class="w-full bg-green-500 text-white rounded-md py-2 transition ease-in-out duration-200 hover:bg-green-700">Guardar Cambios</button>
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

    props:['factory'],

    data(){
        return {
            isOpen: false,
            factoryForm: this.$inertia.form({
                'name': this.factory.name,
                'phone_number' : this.factory.phone_number
            }),

        }
    },

    components:{
        AppLayout,
        Link
    },

    methods:{

        update(){
            this.factoryForm.put(route('factories.update',this.factory))
        },


    }

}

</script>
