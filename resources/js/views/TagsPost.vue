<template>
    <paginator
        :url="`/api/etiquetas/${this.tag}`"
        component-name="posts-lists">
    </paginator>  
</template>

<script>
export default {
    props:['tag']
}    
</script>