<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { useLang } from '@/languages';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};

const { __ } = useLang(usePage().props.lang);
</script>

<template>
    <GuestLayout>
        <Head :title="__('confirm_password')" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('confirm_password_text') }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" :value="__('password')" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ __('confirm') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
