<template>
    <paginator
        :url="`/api/categorias/${this.category}`"
        component-name="posts-lists">
    </paginator>
</template>

<script>
export default {
    props:['category']
}
</script>