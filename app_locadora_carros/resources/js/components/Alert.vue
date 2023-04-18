<template>
    <div :class="estilo" role="alert">
        <p>{{titulo}}</p>
        <hr>
        <template v-if="!detalhes.dados">
            <p>{{ detalhes.mensagem }}</p>
        </template>
        <template v-if="detalhes.dados">   
            <p v-for="campo, chave in detalhes.dados" :key="chave">{{ campo[0] }}</p>
        </template>
    </div>  
</template>
    
    <script>
        export default {
            props: ['tipo', 'titulo', 'detalhes'],
            computed: {
                estilo() {
                    return 'alert alert-'+this.tipo
                }
            }
        }
    </script>