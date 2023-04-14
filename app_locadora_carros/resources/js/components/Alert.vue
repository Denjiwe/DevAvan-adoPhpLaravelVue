<template>
    <div :class="estilo" role="alert">
        <p>{{titulo}}</p>
        <hr>
        <p>{{ detalhes.mensagem }}</p>
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