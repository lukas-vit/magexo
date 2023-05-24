<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const employees = ref([]);
const meta = ref({});

const fetchEmployees = () => {
    axios
        .get("/api/employees")
        .then((response) => {
            console.log(response.data);
            employees.value = response.data.data;
            meta.value = response.data.meta;
        })
        .catch((error) => {
            console.error(error);
        });
};

const fetchEmployeesByPage = (page) => {
    axios
        .get("/api/employees", {
            params: {
                page,
            },
        })
        .then((response) => {
            employees.value = response.data.data;
            meta.value = response.data.meta;
        })
        .catch((error) => {
            console.error(error);
        });
};

onMounted(() => {
    fetchEmployees();
});
</script>

<template>
    <div class="min-h-full">
        <main class="-mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div
                    class="border-b border-gray-200 bg-white px-4 py-8 sm:px-6"
                >
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto pt-3">
                                <h1
                                    class="text-base font-semibold leading-6 text-gray-900"
                                >
                                    Employee listings
                                </h1>
                                <p class="mt-2 text-sm text-gray-700">
                                    A list of all the employees in your company
                                    including their name, email, designation and department.
                                </p>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <router-link
                                    to="/employee/add"
                                    class="block rounded-md bg-primary px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-primary-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                                    >
                                    Create new employee
                                </router-link>
                            </div>
                        </div>
                        <div class="mt-8 flow-root">
                            <div
                                class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                            >
                                <div
                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <TableHead />
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <EmployeeList
                                                :employees="employees" :fetchEmployees="fetchEmployees"
                                            />
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <Pagination :meta="meta" :fetchEmployeesByPage="fetchEmployeesByPage" />
            </div>
        </main>
    </div>
</template>
