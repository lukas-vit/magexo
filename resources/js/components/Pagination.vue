<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
    meta: {
        type: Object,
        required: true,
    },
    fetchEmployeesByPage: {
        type: Function,
        required: true,
    },
});

const previousPage = () => {
    if (props.meta.current_page > 1) {
        props.fetchEmployeesByPage(props.meta.current_page - 1);
    }
};

const nextPage = () => {
    if (props.meta.current_page < props.meta.last_page) {
        props.fetchEmployeesByPage(props.meta.current_page + 1);
    }
};

const getStartIndex = () => {
    if (props.meta) {
        return (props.meta.current_page - 1) * props.meta.per_page + 1;
    }
    return 0;
};

const getEndIndex = () => {
    if (props.meta) {
        return Math.min(
            props.meta.current_page * props.meta.per_page,
            props.meta.total
        );
    }
    return 0;
};
</script>

<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <button
                @click="previousPage"
                :disabled="meta.current_page === 1"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Previous
            </button>
            <button
                @click="nextPage"
                :disabled="meta.current_page === meta.last_page"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Next
            </button>
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium">{{ getStartIndex() }}</span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium">{{ getEndIndex() }}</span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium">{{ meta.total }}</span>
                    {{ " " }}
                    results
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                    aria-label="Pagination"
                >
                    <button
                        @click="previousPage"
                        :disabled="meta.current_page === 1"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <div
                        v-for="page in meta.last_page"
                        :key="page"
                        :class="{
                            active: page === meta.current_page,
                        }"
                    >
                        <button
                            v-if="page === meta.current_page"
                            class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                            @click="props.fetchEmployeesByPage(page)"
                        >
                            {{ page }}
                        </button>
                        <button
                            v-else
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            @click="props.fetchEmployeesByPage(page)"
                        >
                            {{ page }}
                        </button>
                    </div>
                    <button
                        @click="nextPage"
                        :disabled="meta.current_page === meta.last_page"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>
