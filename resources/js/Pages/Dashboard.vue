<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import { PaperAirplaneIcon, EnvelopeIcon, SignalIcon } from '@heroicons/vue/24/solid';
import { computed } from 'vue';
import { useLang } from '@/languages';

const page = usePage();
const form = useForm({
    to: null,
    subject: null,
    content: null,
    attachment: null,
});

const submit = () => {
    form.post(route('email.send'), {
        onFinish: () => form.reset(),
        forceFormData: isAdmin.value,
    });
};

const isAdmin = computed(() => page.props.auth.roles.includes('admin'));
const { __ } = useLang(page.props.lang);
</script>

<template>
    <Head :title="__('send_new_email')" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">{{ __('send_new_email') }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="p-6 text-gray-900 dark:text-gray-100" @submit.prevent="submit">
                        <div class="w-full mb-3">
                            <InputLabel for="to" :value="__('email')" />
                            <TextInput
                                id="to"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.to"
                                required
                                autofocus
                                autocomplete="to"
                            >
                                <template #prefix>
                                    <EnvelopeIcon class="w-4 h-4" />
                                </template>
                            </TextInput>

                            <InputError class="mt-2" :message="form.errors.to" />
                        </div>
                        <div class="w-full mb-3">
                            <InputLabel for="subject" :value="__('subject')" />
                            <TextInput
                                id="subject"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.subject"
                                required
                            >
                                <template #prefix>
                                    <SignalIcon class="w-4 h-4" />
                                </template>
                            </TextInput>

                            <InputError class="mt-2" :message="form.errors.subject" />
                        </div>
                        <div class="w-full mb-3" v-if="isAdmin">
                            <InputLabel for="attachment" :value="__('attachment')" />
                            <FileInput
                                id="attachment"
                                type="file"
                                class="mt-1 block w-full"
                                v-model="form.attachment"
                            />

                            <InputError class="mt-2" :message="form.errors.attachment" />
                        </div>
                        <div class="w-full mb-3 editor">
                            <QuillEditor
                                id="content"
                                v-model:content="form.content"
                                contentType="html"
                            ></QuillEditor>
                            <InputError class="mt-2" :message="form.errors.content" />
                        </div>
                        <div class="w-full">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <template #suffix>
                                    <PaperAirplaneIcon class="w-3 h-3 ml-2" />
                                </template>
                                {{ __('send') }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.editor:deep(.ql-editor) {
    min-height: 200px;
}
</style>
