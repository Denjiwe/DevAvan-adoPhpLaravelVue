<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- inicio do card de pesquisa -->
                <card-component titulo="Pesquisa de Marcas">
                    <template v-slot:body>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp" text-ajuda="Opcional. Pesquise pelo ID da marca">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp" text-ajuda="Opcional. Pesquise pelo nome da marca">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp">
                                </input-container-component>
                            </div>
                        </div>    
                    </template>

                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </template>
                </card-component>
                <!-- inicio do card de pesquisa -->

                <!-- inicio do card de listagem de marcas -->
                <card-component titulo="Listagem de Marcas">
                    <template v-slot:body>
                        <table-component></table-component>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#adicionarModal">Adicionar</button>
                    </template>
                </card-component>
                <!-- fim do card de listagem de marcas -->
            </div>
        </div>

        <modal-component id="adicionarModal" titulo="Adicionar marca">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Marca cadastrada com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a marca" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>
                <div class="mb-4">
                    <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp" text-ajuda="Digite o nome da marca">
                        <input type="text" class="form-control" id="inputId" aria-describedby="nomeHelp" v-model="nomeMarca">
                    </input-container-component>
                </div>
            
                <input-container-component titulo="Imagem" id="inputImagem" id-help="imagemHelp" text-ajuda="Insira a imagem da marca"><br>
                    <input type="file" class="form-control-file" id="inputImagem" aria-describedby="imagemHelp" @change="carregarImagem($event)">
                </input-container-component>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar marca</button>
            </template>
        </modal-component> 
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        computed: {
            token() {

                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=')
                })

                token = token.split('=')[1]
                token = 'Bearer ' + token

                return token
            }
        },
        data() {
            return {
                urlBase: 'http://localhost:8000/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoDetalhes: '',
                transacaoStatus: '',
                marcas:[]
            }
        },
        methods: {
            carregarLista() {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(this.urlBase, config)
                    .then(response=> {
                        this.marcas = response.data
                        console.log(this.marcas)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
            salvar() {
                let formData = new FormData();
                formData.append('nome', this.nomeMarca)
                formData.append('imagem', this.arquivoImagem[0])

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(Response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: '+response.data.id
                        }
                    })
                    .catch(errors=>{
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                        // errors.response.data.message
                    })
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>