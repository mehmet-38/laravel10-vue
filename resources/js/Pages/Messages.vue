<template>
    <div class="container mt-4">
        <button @click="fetchMessages" class="btn btn-secondary mb-3">Yenile</button>

        <div class="message-list border p-3 mb-3">
            <div v-for="message in messages" :key="message.id"
                 class="message-item d-flex justify-content-between border mb-2 p-2">
                <div class="user-name">
                    <strong>{{ message.user.name }}</strong>
                </div>
                <div class="message-text">
                    {{ message.message }}
                </div>
            </div>
        </div>

        <div class="message-input-area d-flex">
            <input type="text" v-model="newMessage" placeholder="Mesajınızı yazın..." class="form-control me-2"/>
            <button @click="sendMessage"
                    class="btn btn-primary"
                    :disabled="newMessage.length < 10">
                Gönder
            </button>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import {getMessages, postMessage} from './../apiService.js';

const messages = ref([]);
const newMessage = ref('');

const fetchMessages = () => {
    getMessages()
        .then(data => {
            messages.value = data;
        })
        .catch(error => {
            console.error("Mesajları yüklerken bir hata oluştu:", error);
        });
};

const sendMessage = () => {
    if (newMessage.value.trim() === '') {
        return;
    }

    postMessage(newMessage.value)
        .then(data => {
            messages.value.unshift(data);
            newMessage.value = '';
        })
        .catch(error => {
            console.error("Mesaj gönderirken bir hata oluştu:", error);
        });
};

onMounted(() => {
    fetchMessages();
});
</script>

<style scoped>
.message-list {
    height: 500px;
    overflow-y: scroll;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.message-item {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.message-input-area {
    max-width: 600px;
    width: 100%;
}
</style>
