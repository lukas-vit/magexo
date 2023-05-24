<script setup>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";

const router = useRouter();
const id = router.currentRoute.value.params.id;

const employee = ref({});

const fetchEmployee = () => {
    axios
        .get(`/api/employees/${id}`)
        .then((response) => {
            employee.value = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
};

const updateEmployee = (employee) => {
    if (
        !employee.name ||
        !employee.email ||
        !employee.designation ||
        !employee.department
    ) {
        return;
    }
    axios
        .put(`/api/employees/${id}`, employee)
        .then((response) => {
            router.push({ name: "Home" }).then (() => {
                toast.success("Employee updated successfully!");
            });
        })
        .catch((error) => {
            toast.error(error.response.data.message);
            console.error(error);
        });
};

onMounted(() => {
    fetchEmployee();
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
                        <EmployeeForm
                            :employee="employee"
                            :onSubmit="updateEmployee"
                            buttonValue="Update"
                        />
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
