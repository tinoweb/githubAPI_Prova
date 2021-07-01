<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h5 class="text-center">Bem vindo ao GithubApp Tag App</h5>
                <p class="text-center"> {{currentUser.email}}</p>
                <button class="btn btn-danger btn-sm" @click="logout">sair</button>
                <router-link class="btn btn-primary btn-sm float-right" to="/createTags">Criar Tag</router-link>
            </div>
        </div>
        <br>
        

        <div class="row justify-content-center">

            <h2 id="fluid-containers" class="mt-4 mb-3">
                Pequisar Repositorio
            </h2>

            <div class="col-md-10">
                
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRepo" v-model="formData.inputRepo">
                    </div>
                    <div class="col-auto">
                        <button type="button" @click="pesquisarRepo" class="btn btn-primary mb-3">Pesquisar</button>
                    </div>
                    <!-- <label for="inputPassword" class="col-sm-2 col-form-label">Password</label> -->
                </div>

                <hr>

                <table class="table" v-if="this.showTable.status">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Id Node</th>
                            <th>Nome Repo</th>
                            <th>Nome Repo completo</th>
                            <th>Repo Status</th>
                            <th>Nome Dono</th>
                            <th>Id Dono</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr v-for="(repo, index) in repos.data" :key="index">
                            <td>{{repo.id}}</td>
                            <td>{{repo.node_id}}</td>
                            <td>{{repo.name}}</td>
                            <td>{{repo.full_name}}</td>
                            <td>{{repo.status}}</td>
                            <td>{{repo.owner.login}}</td>
                            <td>{{repo.owner.id}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                repos: {},
                showTable: {staus: false},
                currentUser: {},
                token: localStorage.getItem('token'),
                formData: {
                    inputRepo: ''
                },
                errors: {},

            }
        },
        methods: {
           pesquisarRepo(){
                axios.post('getRepo', this.formData).then((response) => {
                    this.repos = response
                    this.formData.inputRepo = ''
                    if (Object.keys(this.repos).length !== 0 ) {
                        this.showTable.status = true
                    }

                    for (let [key, value] of Object.entries(this.repos.data)) {
                        console.log(`${key}: ${value.name}`);
                        if (value.private===false) {
                            value.status="Publico"
                        }else{
                            value.status="Privado"
                        }
                    }
                    
                    console.log(this.repos.data)
                }).catch((error) => {
                    console.log(error)
                });
            },
           

            logout(){
                axios.post('api/logout').then((response) => {
                    localStorage.removeItem('token')
                    this.$router.push('/login')
                }).catch((errors) => {
                    console.log(errors)
                })
            }
        },

        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            axios.get('api/user').then((response) => {
                this.currentUser = response.data
            }).catch((errors) => {
                console.log(errors)
            })
        }
    }
</script>
