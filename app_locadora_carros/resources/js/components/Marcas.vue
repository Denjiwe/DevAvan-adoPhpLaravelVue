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
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp" text-ajuda="Opcional. Pesquise pelo nome da marca">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" v-model="busca.nome">
                                </input-container-component>
                            </div>
                        </div>    
                    </template>

                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end" @click="pesquisar()">Pesquisar</button>   
                    </template>
                </card-component>
                <!-- inicio do card de pesquisa -->

                <!-- inicio do card de listagem de marcas -->
                <card-component titulo="Listagem de Marcas">
                    <template v-slot:body>
                        <table-component
                            :dados="marcas.data"
                            :visualizar="{ visivel: true, dataBsToggle: 'modal', dataBsTarget: '#visualizarModal'}"
                            :atualizar="true"
                            :remover="{ visivel: true, dataBsToggle: 'modal', dataBsTarget: '#removerModal'}"
                            :titulos="{
                                id: {titulo: 'ID', tipo: 'texto'},
                                nome: {titulo: 'Nome', tipo: 'texto'},
                                imagem: {titulo: 'Imagem', tipo: 'imagem'},
                                created_at: {titulo: 'Data de criação', tipo: 'data'}
                            }"
                        ></table-component>
                    </template>
                    <template v-slot:footer>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links" :key="key" :class="l.active ? 'page-item active' : 'page-item'" @click="paginacao(l)"><a class="page-link" style="cursor: pointer" v-html="l.label"></a></li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#adicionarModal">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- fim do card de listagem de marcas -->
            </div>
        </div>

        <!-- inicio do modal de adição de marcas -->
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
        <!-- fim do modal de adição de marcas -->

        <!-- inicio do modal de visualização de marcas -->
        <modal-component id="visualizarModal" titulo="Visualizar marca">
            <template v-slot:alertas></template>
            <template v-slot:conteudo>
                <div class="row">
                    <div class="col-6">
                        <input-container-component titulo="ID">
                            <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                        </input-container-component>
                    </div>

                    <div class="col-6">
                        <input-container-component titulo="Nome">
                            <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                        </input-container-component>
                    </div>
                </div>
                
                <input-container-component titulo="Imagem: ">
                    <img :src="'storage/'+$store.state.item.imagem" class="ms-3" disabled v-if="$store.state.item.imagem">
                </input-container-component>

                <input-container-component titulo="Data de Criacão">
                    <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!-- fim do modal de visualização de marcas -->

        <!-- inicio do modal de remover de marcas -->
        <modal-component id="removerModal" titulo="Remover marca">
            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Operação realizada com sucesso" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na operação" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
                <div class="row">
                    <div class="col-6">
                        <input-container-component titulo="ID">
                            <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                        </input-container-component>
                    </div>

                    <div class="col-6">
                        <input-container-component titulo="Nome">
                            <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                        </input-container-component>
                    </div>
                </div>
            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status != 'sucesso'">Excluir</button>
            </template>
        </modal-component>
        <!-- fim do modal de remover de marcas -->
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
                urlPaginacao: '',
                urlPesquisa: '',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoDetalhes: '',
                transacaoStatus: '',
                marcas:{ data: []},
                busca: {id: '', nome: ''}
            }
        },
        methods: {
            remover(){
                let confirmacao = confirm('Tem certeza que deseja excluir a marca?')

                if (!confirmacao) {
                    return false
                }

                let url = this.urlBase+'/'+this.$store.state.item.id

                let formData = new FormData()
                formData.append('_method', 'delete')

                let config = {
                    headers: {
                        'Accept' : 'aplication/json',
                        'Authorization' : this.token
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'sucesso'
                        this.$store.state.transacao.mensagem = response.data.msg
                        this.carregarLista()
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.erro
                        console.log('Houve um erro na tentativa de excluir o registro', errors.response.data)
                    })
            },
            pesquisar() {

                let filtro = ''

                for (let chave in this.busca) {

                    if (this.busca[chave]) {
                        if (filtro != '') {
                            filtro+=";"
                        }
                        filtro += chave+ ':like:' + this.busca[chave]
                    }
                }

                if (filtro != '') {
                    this.urlPaginacao = 'page=1'
                    this.urlPesquisa = '&filtro='+filtro
                } else {
                    this.urlFiltro = ''
                }

                this.carregarLista()
            },
            paginacao(l) {
                this.urlPaginacao = l.url.split('?')[1] //ajustando url para qual será realizada a requisição
                this.carregarLista() //realizada a requisição dos registros a serem exibidos
            },
            carregarLista() {
                
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlPesquisa

                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(url, config)
                    .then(response=> {
                        this.marcas = response.data
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
                
                this.carregarLista();
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>