<script setup lang="ts">
import { Form, Field, ErrorMessage } from "vee-validate";
import { PropType, ref, computed } from "vue";

const props = defineProps({
    required: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
    },
    modelValue: {
        type: String,
    },
    id: {
        type: String,
    },
    name: {
        type: String,
    },
    type: {
        type: String,
    },
    placeholder: {
        type: String,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <label for="name" class="block text-sm font-medium text-gray-700">{{
        label
    }}</label>

    <div class="mt-1">
        <Field
            :modelValue="modelValue"
            @update:modelValue="$emit('update:modelValue', $event)"
            :id="id"
            :name="name!"
            :type="type"
            :autocomplete="name"
            :required="required"
            :disabled="disabled"
            :placeholder="placeholder"
            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm"
        />
        <ErrorMessage
            class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
            :name="name!"
        />
    </div>
</template>
