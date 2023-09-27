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
            :value="modelValue"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500"
            :class="$slots.prefix ? 'pl-10' : ''"
            ref="input"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>
