<template>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Login</h1>
            <form @submit.prevent="login">
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Email adresiniz"
                        required
                    />
                </div>
                <div class="form-group mb-3">
                    <label for="password">Şifre:</label>
                    <input
                        v-model="password"
                        type="password"
                        id="password"
                        class="form-control"
                        placeholder="Şifreniz"
                        required
                    />
                </div>
                <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            </form>
            <p v-if="errorMessage" class="text-danger mt-3 text-center">{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { loginUser } from './../apiService.js';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const router = useRouter();

const login = () => {
    loginUser(email.value, password.value)
        .then(data => {
            if (data.status === true) {
                router.push('/manager/messages');
            } else {
                errorMessage.value = 'Giriş başarısız.';
            }
        })
        .catch(() => {
            errorMessage.value = 'Giriş yapılamadı. Lütfen tekrar deneyin.';
        });
};
</script>
