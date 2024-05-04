<template>
    <div class="relative">
        <span class="absolute left-0 inset-y-0 flex items-center pl-2">
            <span class="text-sm font-medium text-gray-500">$</span>
        </span>
        <input
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-6 text-right"
            :value="formattedValue"
            @input="updateValue"
            @blur="formatValue"
            ref="input"
            type="text"
        />
    </div>
</template>
<script setup>
import { watchEffect, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: Number,
        required: true,
    },
    required: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['update:modelValue']);

let formattedValue = ref(props.modelValue.toFixed(2).replace('.', ','));

const updateValue = (event) => {
    const value = parseFloat(event.target.value.replace(',', '.'));
    if (!isNaN(value)) {
        formattedValue.value = value;
        emit('update:modelValue', value);
    }
}

const formatValue = () => {
    formattedValue.value = parseFloat(formattedValue.value).toFixed(2).replace('.', ',');
}


watchEffect(() => {
    formattedValue.value = props.modelValue;
    emit('update:modelValue', props.modelValue)
});
</script>
