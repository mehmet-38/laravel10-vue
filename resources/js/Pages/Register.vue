<template>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Kayıt Ol</h1>
            <form @submit.prevent="register">

                <div class="form-group mb-3">
                    <label for="name">Kullanıcı Adı:</label>
                    <input
                        v-model="name"
                        type="text"
                        id="name"
                        class="form-control"
                        placeholder="Kullanıcı adınızı giriniz"
                        required
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Email adresinizi giriniz"
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
                        placeholder="Şifrenizi giriniz"
                        required
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Şifre Tekrar:</label>
                    <input
                        v-model="password_confirmation"
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Şifrenizi tekrar giriniz"
                        required
                    />
                </div>

                <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>
            </form>

            <p v-if="errorMessage" class="text-danger mt-3 text-center">{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { registerUser } from './../apiService.js';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const errorMessage = ref('');
const router = useRouter();

const register = () => {
    registerUser(name.value, email.value, password.value, password_confirmation.value)
        .then(() => {
            router.push('/login');
        })
        .catch(error => {
            if (error.response && error.response.data.message) {
                errorMessage.value = error.response.data.message;
            } else {
                errorMessage.value = "Kayıt yapılamadı. Lütfen bilgilerinizi kontrol edin.";
            }
        });
};
</script>
