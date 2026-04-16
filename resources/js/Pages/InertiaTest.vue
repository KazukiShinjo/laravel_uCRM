<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const newTitle = ref('')
const newContent = ref('') 
</script>

<!-- templateがhtml構文を記載する -->
<template>
  InertiaTestです<br>
  <a href="/">aタグ経由です</a><br>
  <Link href="/">Link経由です</Link>
  <Link :href="route('inertia.index')">名前付きルートの確認です</Link><br>
  <Link :href="route('inertia.show', { id: 1 })">Button</Link>

  <div class="mb-8"></div>
  <input type="text" name="newTtile" v-model="newTitle">{{ newTitle }}<br>
  <input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
  <Link as="button" method="post" :href="route('inertia.store')" 
  :data="{
    title: newTitle,
    content: newContent
  }"
  >
    DBに保存
  </Link>
</template>