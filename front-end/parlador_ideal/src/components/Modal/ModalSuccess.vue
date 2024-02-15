<template>
    <div>
        <div id="success" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    
                    <button @click="activate=false" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="success">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>

                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-green-400 w-12 h-12 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{ message }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="error" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    
                    <button @click="activate=false" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="error">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>

                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-400 w-12 h-12 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <div v-if="!!messageArr">
                            <h3 v-for="(messageActual, i) in messageArr" :key="i" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                {{ messageActual }}
                            </h3>
                        </div>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{ message }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="question" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    
                    <button @click="activate=false" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="question">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <div class="p-4 md:p-5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto mb-4 text-red-400 w-12 h-12 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{ message }}
                        </h3>
                       
                        
                        <button data-modal-hide="question" type="button" class="text-white bg-orange-400 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Sim
                        </button>
                        <button data-modal-hide="question" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-white bg-red-700 rounded-lg  ">
                            Não
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { newModal } from './index'

export default {
    name: "successModal",
    props: [
        'activate',
        'message',
        'messageArr',
        'onModalName'
    ],
    data() {
        return {
            createModal: '',
        }
    },
    watch: {
        activate() {
            if (this.activate) {
                this.openModal()
            }
            else {
                this.closeModal()
            }
                
        }
    },
    methods: {
        openModal() {
            newModal(this.onModalName).showModal()
        },
        closeModal() {
            newModal(this.onModalName).closeModal()
            this.$emit('closeModal', false)
        }
    }
}
</script>
