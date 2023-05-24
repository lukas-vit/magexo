<script setup>
const props = defineProps({
    employees: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <tr v-for="employee in employees" :key="employee.id">
        <td
            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"
        >
            {{ employee.name }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ employee.email }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ employee.designation }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ employee.department }}
        </td>
        <td
            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm sm:pr-0"
        >
            <a href="#" class="text-primary hover:text-primary-darker"
                >Edit<span class="sr-only">, {{ employee.name }}</span></a
            >
        </td>
    </tr>
</template>
