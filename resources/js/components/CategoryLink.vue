<template>
    <router-link :to="{ name:'category_post', params: {category: category.url }}">{{ category.name }}</router-link>
</template>
<script>
export default {
    props: ['category']
}
</script>