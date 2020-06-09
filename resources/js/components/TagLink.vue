<template>
    <router-link :to="{ name: 'tags_post', params: { tag: tag.url }}">#{{ tag.name }}</router-link> 
</template>
<script>
export default {
    props:['tag']
}
</script>