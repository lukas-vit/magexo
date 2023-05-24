<script setup>
import { ref } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    employees: {
        type: Array,
        required: true,
    },
    fetchEmployees: {
        type: Function,
        required: true,
    },
});

const showModal = ref(false);
const selectedEmployee = ref({});

const confirmDelete = (employee) => {
    showModal.value = true;
    selectedEmployee.value = employee;
};

//delete employee
const deleteEmployee = (id) => {
    axios
        .delete(`/api/employees/${id}`)
        .then((response) => {
            toast.success("Employee deleted successfully!");
            showModal.value = false;
            props.fetchEmployees();
        })
        .catch((error) => {
            console.error(error);
        });
};
</script>

<template>
    <Modal
        v-if="showModal"
        :showModal="showModal"
        :employee="selectedEmployee"
        @modal-close="showModal = false"
        @deleteEmployee="deleteEmployee(selectedEmployee.id)"
    />
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
            <router-link
                :to="{ name: 'edit-employee', params: { id: employee.id } }"
                class="text-primary hover:text-primary-darker"
                ><PencilSquareIcon class="h-6 w-6" aria-hidden="true" /><span
                    class="sr-only"
                    >, {{ employee.name }}</span
                ></router-link
            >
        </td>
        <td
            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm sm:pr-0"
        >
            <button
                @click="confirmDelete(employee)"
                class="text-red-600 hover:text-primary-darker mt-1"
            >
                <TrashIcon class="h-6 w-6" aria-hidden="true" /><span
                    class="sr-only"
                    >, {{ employee.name }}</span
                >
            </button>
        </td>
    </tr>
</template>
