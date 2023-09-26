<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

defineOptions({
    inheritAttrs: false,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="relative mb-6">
        <div
            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-600 dark:text-gray-200"
            v-if="$slots.prefix"
        >
            <slot name="prefix"></slot>
        </div>
        <input
            v-bind="$attrs"
            type="file"
            :value="modelValue"
            class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
            :class="$slots.prefix ? 'pl-10' : ''"
            ref="input"
            @input="$emit('update:modelValue', $event.target.files[0])"
        />
    </div>
</template>
