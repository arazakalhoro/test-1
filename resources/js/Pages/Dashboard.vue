<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted} from "vue";
defineProps({
    users: {
        type: Array
    }
})
const url = route('order.list');
console.log(url);
const columns = [
    { data: "order_ref", name: "order_ref", title: "Order Ref" },
    { data: "customer", name: "customer", title: "Customer" },
    { data: "status", name: "status", title: "Status" },
    { data: "order_date", name: "order_date", title: "Order Date" },
    { data: "modified_date", name: "modified_date", title: "Modified Date" },
    { data: "actions", name: "actions", title: "Actions", orderable: false, searchable: false },
];
const filters = [];
const applyFilters = () => {
    this.$refs.datatable.ajax.reload();
}
const onDataLoaded = (data) => {
    console.log("Data loaded:", data);
}
onMounted(() =>{
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :columns="columns"
                            :ajax="url"
                            :server-side="true"
                            @loaded="onDataLoaded" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
