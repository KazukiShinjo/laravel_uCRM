<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { onMounted } from 'vue';

const props = defineProps({
  customers: Object
})

// ページが表示されたタイミングで実行
onMounted(() => {
  console.log(props.customers);
  console.log(props.customers.last_page);
});
</script>

<template>
    
</template>
