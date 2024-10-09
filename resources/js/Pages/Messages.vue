<template>
    <div class="container mt-4">
        <!-- Mesajları yenileme butonu -->
        <button @click="fetchMessages" class="btn btn-secondary mb-3">Yenile</button>

        <!-- Mesajların bulunduğu kaydırılabilir alan -->
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

        <!-- Mesaj gönderme alanı -->
        <div class="message-input-area d-flex">
            <input type="text" v-model="newMessage" placeholder="Mesajınızı yazın..." class="form-control me-2"/>
            <button @click="sendMessage"
                    class="btn btn-primary"
                    :disabled="newMessage.length < 10"
            >Gönder
            </button>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';

// Mesajlar state
const messages = ref([]);

// Yeni mesaj için input
const newMessage = ref('');

// Mesajları backend'den almak için fonksiyon
const fetchMessages = async () => {
    try {
        const response = await axios.get('/api/manager/messages');
        messages.value = response.data;
    } catch (error) {
        console.error('Mesajlar yüklenemedi:', error);
    }
};

// Yeni mesaj göndermek için fonksiyon
const sendMessage = async () => {
    if (newMessage.value.trim() === '') {
        return; // Mesaj boşsa gönderme
    }

    try {
        const response = await axios.post('/api/manager/messages', {
            message: newMessage.value,
        });

        // Yeni gönderilen mesajı listeye ekliyoruz
        messages.value.unshift(response.data);

        // Input alanını temizle
        newMessage.value = '';
    } catch (error) {
        console.error('Mesaj gönderilemedi:', error);
    }
};

// Sayfa yüklendiğinde mesajları getirme
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
