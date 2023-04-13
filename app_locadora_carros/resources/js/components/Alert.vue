<template>
    <div :class="estilo" role="alert">
        Mensagem de alerta
    </div>  
</template>
    
    <script>
        export default {
            props: ['tipo'],
            computed: {
                estilo() {
                    return 'alert alert-'+this.tipo
                }
            }
        }
    </script>