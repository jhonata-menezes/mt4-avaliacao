<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.4.1"></script>
</head>
<body>
<div id="app">
    <div>
        <div>
            <button @click="getContatos()">Contatos</button>
        </div>
        <div>
            <div v-for="v of contatos">
                <div>
                    {{v.nome}} - {{v.criado}} <button class="button is-success">Visualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            contatos: []
        },

        methods: {
            getContatos: function () {
                axios.get('/contatos').then(r => {
                    this.contatos = r.data;
                });
            }
        }
    })
</script>
</body>
</html>