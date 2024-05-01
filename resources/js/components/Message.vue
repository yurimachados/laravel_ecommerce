<template>
    <div>
        {{ message }}
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
    setup() {
        const message = ref('Hello Vue 3 + TypeScript')

        return {
            message
        }
    }
})
</script>
<style scoped lang="scss">
div {
    color: body-bg;
    background-color: yellow;
}
</style>