<script setup>
import * as yup from "yup";
import { Form } from "vee-validate";

const props = defineProps({
    employee: {
        type: Object,
        default: () => ({
            id: null,
            name: "",
            email: "",
            designation: "",
            department: "",
        }),
    },
    onSubmit: {
        type: Function,
        default: () => console.log("Submit function not defined"),
    },
    buttonValue: {
        type: String,
        default: "Submit",
    },
});

const schema = yup.object({
    email: yup
        .string(100, "Email must be less than 100 characters")
        .required("Email is required")
        .email("Please enter a valid email"),
    name: yup
        .string(100, "Name must be less than 100 characters")
        .required("Name is required"),
    designation: yup
        .string(100, "Designation must be less than 100 characters")
        .required("Designation is required"),
    department: yup
        .string(100, "Department must be less than 100 characters")
        .required("Department is required"),
});
</script>

<template>
    <Form @submit="onSubmit" :validation-schema="schema">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto pt-3">
                        <h1
                            class="text-base font-semibold leading-6 text-gray-900"
                        >
                            Create new employee
                        </h1>
                    </div>
                </div>
                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-3">
                        <div>
                            <Input
                                id="name"
                                name="name"
                                label="Name"
                                type="text"
                                :required="true"
                                v-model="props.employee.name"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <Input
                            id="email"
                            name="email"
                            label="Email"
                            type="email"
                            :required="true"
                            v-model="props.employee.email"
                        />
                    </div>

                    <div class="sm:col-span-3">
                        <Input
                            id="designation"
                            name="designation"
                            label="Designation"
                            type="text"
                            :required="true"
                            v-model="props.employee.designation"
                        />
                    </div>

                    <div class="sm:col-span-3">
                        <Input
                            id="department"
                            name="department"
                            label="Department"
                            type="text"
                            :required="true"
                            v-model="props.employee.department"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <router-link
                to="/"
                class="text-sm font-semibold leading-6 text-gray-900"
            >
                Cancel
            </router-link>
            <button
                type="submit"
                @click="onSubmit"
                class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
            >
                {{ props.buttonValue }}
            </button>
        </div>
    </Form>
</template>
