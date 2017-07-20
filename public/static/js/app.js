Vue.use(VeeValidate);
new Vue({
    el: '#app',
    data: {
        page: 1,
        total: 0,
        contatos: [],
        contatoVisualizar: {},
        cadastroNovo: false,
        input: [{
            email: '',
            emailTipo: 'pessoal',
            telefone: '',
            telefoneTipo: 'celular'
        }],
        edit: {},
        nome: '',
        salvando: false,
        cadastroEditar: false,
        noti: {
            ativo: false,
            tipo: '',
            msg: ''
        }
    },

    methods: {
        getContatos: function () {
            axios.get('/contatos/' + this.page).then(r => {
                this.contatos = r.data;
            });
        },

        closeModal: function () {
            this.contatoVisualizar = {}
            this.cadastroNovo = false;
            this.cadastroEditar = false;
        },

        formataTelefone: function (telefone) {
            if (telefone.length > 4) {
                telefone = telefone.slice(0, -4) + '-' + telefone.slice(-4);
            }
            return telefone;
        },

        getTotal: function () {
            axios.get('/contatos/total').then(r => {
                this.total = r.data.total;
            });
        },

        cadastroSalvar: function () {
            let body = {
                input: this.input,
                nome: this.nome
            };
            axios.post('/contatos/salvar', body).then(r => {
                if (this.input.length > 1) {
                    location.reload();
                }
                this.salvando = false;
                this.getTotal();
                this.cadastroNovo = false;
                this.input = [];
                this.cadastroAdicionar();
                this.nome = '';
                this.getContatos();
                this.notificar('Contato salvo', 'success')
            });
        },

        cadastroAdicionar: function () {
            this.input.push({
                email: '',
                emailTipo: 'pessoal',
                telefone: '',
                telefoneTipo: 'celular'
            })
        },

        apagar: function (contato, i) {
            axios.get('/contatos/apagar/'+ contato.id).then(r => {
                this.contatos.splice(i, 1);
                this.getTotal();
                this.notificar('contato removido', 'danger');
            });
        },
        editar: function (contato, i) {
            this.edit = contato;
        },

        cadastroAtualizar: function () {
            axios.post('/contatos/atualizar', this.edit).then(r => {
                this.salvando = false;
                this.cadastroEditar = false;
                this.edit = {};
                this.notificar('contato atualizado', 'success');
            });
        },
        
        notificar: function (msg, tipo) {
            this.noti.msg = msg;
            this.noti.tipo = 'is-'+tipo;
            this.noti.ativo = true;
            window.setTimeout(() => {
                this.noti.ativo = false;
            }, 8000);
        }
    },

    created: function () {
        this.getContatos();
        document.addEventListener('keydown', (e) => {
            if (e.keyCode === 27) {
            this.closeModal()
            }
        });
        this.getTotal();
    }
})