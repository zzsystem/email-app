<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const page = usePage();
const list = ref([]);

watch(
    () => page.props.flash.message,
    (newVal) => {
        if (newVal !== null) {
            page.props.flash.message = null;
            list.value.push({ message: newVal, success: page.props.flash.success });
            setTimeout(() => list.value.shift(), 3000);
        }
    },
);
</script>

<template>
    <div class="alert-wrapper">
        <TransitionGroup name="slide-fade" tag="div">
            <div
                v-for="(element, index) in list"
                :key="index"
                class="alert rounded"
                :class="element.success ? 'bg-green-600' : 'bg-red-600'"
            >
                {{ element.message }}
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
.alert-wrapper {
    position: fixed;
    right: 10px;
    bottom: 10px;
    display: flex;
    flex-direction: column;
}
.alert {
    min-width: 300px;
    height: 30px;
    display: flex;
    align-items: center;
    color: white;
    font-weight: 600;
    padding: 10px;
    margin-bottom: 10px;
}

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
