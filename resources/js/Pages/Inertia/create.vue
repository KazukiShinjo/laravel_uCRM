<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import BreezeVaildationErrors from '@/Components/VaildationErrors.vue'

defineProps({
  errors: Object
})

const form = reactive({
  title: null,
  content: null
})

const submitFunction = () => {
  Inertia.post('/inertia', form)
}

</script>

<template>
  <BreezeVaildationErrors :errors="errors" />
  <form @submit.prevent="submitFunction">
    <input name="title" type="text" v-model="form.title"><br>
    <div v-if="errors.title">{{ errors.title }}</div>
    <input name="content" type="text" v-model="form.content"><br>
    <div v-if="errors.content">{{ errors.content }}</div>
    <button>送信</button>
  </form>
</template>