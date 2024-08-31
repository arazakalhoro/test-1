<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted} from "vue";
import DatatableComponent from "@/Components/DatatableComponent.vue";
defineProps({
    users: {
        type: Array
    }
})
const url = route('order.list');
const columns = [
    { data: "reference", name: "reference", title: "Order Ref" },
    { data: "customer", name: "customer", title: "Customer" },
    { data: "status", name: "status", title: "Status" },
    { data: "created_at", name: "created_at", title: "Order Date" },
    { data: "updated_at", name: "updated_at", title: "Modified Date" },
    {
        data: null,
        name: "actions",
        title: "Actions",
        orderable: false,
        searchable: false,
        render: (row) => {
            const id = `view-order-${row.id}`;
            // Placeholder for the Vue component
            return `<div id="${id}"></div>`;
        }
    },
];
const filters = [];
const applyFilters = () => {
    this.$refs.datatable.ajax.reload();
}
const viewOrder = (id) => {
    console.log("Viewing order:", id);
}
const onDataLoaded = (data) => {
    console.log("Data loaded:", data);
}
onMounted(() =>{
})
function callViewOrder(id){
    viewOrder(id);
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DatatableComponent
                            :url="url"
                            :columns="columns"
                            :filters="filters"
                        >
                        </DatatableComponent>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
