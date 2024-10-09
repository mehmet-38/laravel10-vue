<template>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <h1 class="mb-4 text-center">Canlı Chat Platformu</h1>

        <div class="d-flex gap-3">
            <button class="btn btn-primary btn-lg" @click="goToLogin">Giriş Yap</button>
            <button class="btn btn-success btn-lg" @click="goToRegister">Kayıt Ol</button>
        </div>
    </div>
</template>

<script setup>
import {useRouter} from "vue-router";

const router = useRouter();

const goToRegister = () => {
    router.push("/register");
};

const goToLogin = () => {
    router.push("/login");
};
</script>
