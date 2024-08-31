<!-- resources/js/Components/DataTableComponent.vue -->
<template>
    <div>
        <!-- Filters -->
        <slot name="filters"></slot>
        <!-- DataTable -->
        <DataTable
            :ajax="props.url"
            :data="records"
            :columns="columns"
            :options="options"
        >
            <slot name="actions">
            </slot>
        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

// Define props
const props = defineProps({
    url: {
        type: String,
        required: true,
    },
    columns: {
        type: Array,
        required: true,
    },
});

// Reactive state
const records = ref([]);
const options = {
    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    serverSide:true,
    processing: true,
    serverMethod: 'GET',
    pageLength: 10,
};
</script>
