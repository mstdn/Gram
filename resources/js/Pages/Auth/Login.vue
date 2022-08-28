<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetCheckbox from '@/Components/Checkbox.vue';
import JetLabel from '@/Components/Label.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AppLayout title="Login">
        <div class="bg-cover bg-center" style="background-image: url(https://gif.local/images/background.jpg)">
            <JetAuthenticationCard>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-white">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <JetLabel for="email" value="Your Email" />
                        <JetInput id="email" v-model="form.email" type="email" class="w-full" required
                            autofocus />
                        <JetInputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <JetLabel for="password" value="Your Password" />
                        <JetInput id="password" v-model="form.password" type="password" class="w-full"
                            required autocomplete="current-password" />
                        <JetInputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <JetCheckbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600 dark:text-white">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-gray-700">
                        Forgot your password?
                        </Link>

                        <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </JetButton>
                    </div>
                </form>
            </JetAuthenticationCard>
        </div>
    </AppLayout>
</template>
