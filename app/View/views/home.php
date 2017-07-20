<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>Contatos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.css">
    <link rel="stylesheet" href="/static/css/style.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.4.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
</head>
<body>
<nav class="navbar ">
    <div class="navbar-brand">
        <div class="navbar-start">
            <a class="navbar-item " href="/">
                Home
            </a>
        </div>
    </div>
</nav>
<div id="app">
    <div class="section">
        <div>
            <div v-show="noti.ativo" class="notification" :class="noti.ativo ? noti.tipo : ''">
                {{noti.msg}}
            </div>
            <div class="field is-grouped">
                <p class="control">
                    <button class="button is-warning" @click="cadastroNovo = true;">Adicionar Contato</button>
                </p>
                <p class="control">
                    <button disabled class="button is-white">Total de contatos: {{total}}</button> &nbsp
                    <button class="button is-info" title="Página anterior" :disabled="page <= 1" @click="--page; getContatos();"> < </button>
                </p>
                <p class="control">
                    <input class="input is-input-mini" disabled :value="page">
                </p>
                <p class="control">
                    <button class="button is-info" title="Próxima página" :disabled="((page*10) >= total)" @click="++page; getContatos();"> > </button>
                </p>
            </div>
            <table class="table is-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(v, i) of contatos">
                        <td>{{v.id}}</td>
                        <td>{{v.nome}}</td>
                        <td><button class="button is-success is-small" @click="contatoVisualizar = v">Visualizar</button></td>
                        <td><button class="button is-info is-small" @click="editar(v, i); cadastroEditar = true">Editar</button></td>
                        <td><button class="button is-danger is-small" @click="apagar(v, i)">Apagar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="modal" :class="contatoVisualizar.nome ? 'is-active': ''" @click="closeModal()">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box" @click.stop>
                    <div class="media">
                        <div class="media-content">
                            <p class="content">
                                <div>Nome: <strong>{{contatoVisualizar.nome}}</strong></div>
                                <div v-if="contatoVisualizar.email && contatoVisualizar.email.length > 0" class="title is-6">
                                    <div><strong>Emails</strong>
                                        <div v-for="e of contatoVisualizar.email">
                                            <strong>{{e.email}}</strong> - Tipo: <strong>{{e.tipo}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="contatoVisualizar.telefone && contatoVisualizar.telefone.length > 0" class="title is-6">
                                    <div><strong>Telefones</strong>
                                        <div v-for="e of contatoVisualizar.telefone">
                                            <strong>{{formataTelefone(e.telefone)}}</strong> - Tipo: <strong>{{e.tipo}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="modal-close is-large" @click="closeModal()"></button>
        </div>
        <div class="modal" :class="cadastroNovo ? 'is-active': ''" @click="closeModal()">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box" @click.stop>
                    <div class="media">
                        <div class="media-content">
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <p class="control">
                                            <input class="input" type="text" v-validate="'required'" name="nome" placeholder="Nome" v-model="nome">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div v-for="i of input">
                                <div class="field has-addons has-addons-left">
                                    <p class="control">
                                        <input class="input" v-validate="'email'" type="text" name="email" placeholder="Email" v-model="i.email">
                                    </p>
                                    <p class="control" v-if="i.email">
                                        <span class="select">
                                          <select v-model="i.emailTipo" v-validate="'required'" name="emailTipo">
                                            <option value="pessoal">Pessoal</option>
                                            <option value="trabalho">Trabalho</option>
                                          </select>
                                        </span>
                                    </p>
                                </div>
                                <div class="field has-addons has-addons-left">
                                    <p class="control">
                                        <input class="input" type="text" v-validate="'numeric|min:10|max:11'" name="telefone" placeholder="Telefone" v-model="i.telefone">
                                    </p>
                                    <p class="control" v-if="i.telefone">
                                        <span class="select">
                                          <select v-model="i.telefoneTipo" v-validate="'required'" name="telefoneTipo">
                                            <option selected value="celular">Celular</option>
                                            <option value="residencial">Residencial</option>
                                            <option value="trabalho">Trabalho</option>
                                          </select>
                                        </span>
                                    </p>
                                </div>
                                <br>
                            </div>
                            <div class="field is-grouped">
                                <p class="control">
                                    <button class="button is-info" @click="cadastroAdicionar();">Adicionar Mais</button>
                                </p>
                                <p class="control">
                                    <button class="button is-success" :disabled="nome == '' || (this.errors.errors && this.errors.errors.length >= 1)" :class="{'is-loading': salvando}" @click="salvando = true; cadastroSalvar();">Salvar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="modal-close is-large" @click="closeModal()"></button>
        </div>
        <div class="modal" :class="cadastroEditar ? 'is-active': ''" @click="closeModal()">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box" @click.stop>
                    <div class="media">
                        <div class="media-content">
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" v-validate="'required'" name="nome" placeholder="Nome" v-model="edit.nome">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="field has-addons has-addons-left" v-for="i of edit.email">
                                    <p class="control">
                                        <input class="input" type="text" v-validate="'email'" name="email" placeholder="Email" v-model="i.email">
                                    </p>
                                    <p class="control" v-show="i.email">
                                        <span class="select">
                                          <select v-model="i.tipo" v-validate="'required'" name="emailTipo">
                                            <option value="pessoal">Pessoal</option>
                                            <option value="trabalho">Trabalho</option>
                                          </select>
                                        </span>
                                    </p>
                                </div>
                                <div class="field has-addons has-addons-left" v-for="i of edit.telefone">
                                    <p class="control">
                                        <input class="input" type="text" v-validate="'numeric|min:10|max:11'" name="telefone" placeholder="Telefone" v-model="i.telefone">
                                    </p>
                                    <p class="control" v-show="i.telefone">
                                        <span class="select">
                                          <select v-model="i.tipo" v-validate="'required'" name="telefoneTipo">
                                            <option value="celular">Celular</option>
                                            <option value="residencial">Residencial</option>
                                            <option value="trabalho">Trabalho</option>
                                          </select>
                                        </span>
                                    </p>
                                </div>
                                <br>
                            </div>
                            <div class="field is-grouped">
                                <p class="control">
                                    <button class="button is-success" :class="{'is-loading': salvando}" :disabled="edit.nome == '' || (this.errors.errors && this.errors.errors.length >= 1)" @click="salvando = true; cadastroAtualizar();">Atualizar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="modal-close is-large" @click="closeModal()"></button>
        </div>
    </div>
</div>

<script src="/static/js/app.js"></script>
</body>
</html>