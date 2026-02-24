<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📚 Добавить новую запись</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <!-- Поле Название -->
              <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input 
                  type="text" 
                  id="name"
                  v-model="form.name" 
                  class="form-control" 
                  placeholder="Введите название"
                  required
                >
              </div>

              <!-- Поле Описание -->
              <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea 
                  id="description"
                  v-model="form.description" 
                  class="form-control" 
                  rows="3"
                  placeholder="Введите описание (необязательно)"
                ></textarea>
              </div>

              <!-- Кнопка -->
              <button 
                type="submit" 
                class="btn btn-primary w-100"
                :disabled="loading"
              >
                <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                {{ loading ? 'Сохранение...' : '💾 Сохранить' }}
              </button>
            </form>

            <!-- Сообщение -->
            <div v-if="message" class="alert mt-3" :class="messageClass">
              {{ message }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        description: ''
      },
      loading: false,
      message: '',
      messageType: ''
    }
  },
  computed: {
    messageClass() {
      return this.messageType === 'success' ? 'alert-success' : 'alert-danger';
    }
  },
  methods: {
    async submitForm() {
      this.loading = true;
      this.message = '';
      
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        const response = await axios.post('/items', this.form, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
          }
        });
        
        this.message = '✅ Запись успешно создана!';
        this.messageType = 'success';
        this.form.name = '';
        this.form.description = '';
        
      } catch (error) {
        console.error(error);
        this.message = '❌ ' + (error.response?.data?.message || 'Ошибка при сохранении');
        this.messageType = 'error';
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>