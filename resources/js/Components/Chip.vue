<template>
    <span class="chip">
        {{ item }}
    </span>
</template>

<script>
export default {
    name: 'Chip',
    props: {
        item: {
            type: String,
            required: true
        }
    }
};
</script>

<style scoped lang="scss">
@import '../../sass/_variables.scss';

.chip {
    display: inline-block;
    padding: 0 10px;
    margin: 2px;
    height: 32px;
    font-size: 13px;
    line-height: 32px;
    border-radius: 16px;
    font-weight: 500;
    background-color: $p-color-300;
    color: $p-color-950;
}
</style>