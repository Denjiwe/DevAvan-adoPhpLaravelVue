<template>
    <div>
        <label :for="id" class="form-label">{{ titulo }}</label>
            <slot></slot>
        <div :id="idHelp" class="form-text">{{ textAjuda }}</div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'titulo', 'textAjuda', 'idHelp']
    }
</script>