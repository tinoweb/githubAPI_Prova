<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <router-link class="btn btn-primary btn-sm float-left mb-4" to="/">Voltar</router-link>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Atribuindo Tag</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Selecione a Tag</label>
                            <select class="form-control" id="exampleFormControlSelect1" v-model="formData.tag">
                                <option v-for="(tag, index) in tags.data" :key="index" v-bind:value="tag.id">
                                    {{tag.tag}}
                                </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            {{formData.tag}}
                            <button @click.prevent="create" class="btn btn-primary">Atribuir Tag</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                formData: {
                    name: '',
                    tag: '',
                    owner: this.owner,
                    repoName: this.repoName
                },
                tags: {},
            }
        },

        props: {
            owner: {
                type: String,
                default: null
            },
            repoName:{
                type: String,
                default: null
            }
        },

        methods: {
            create() {
                axios.post('setTag', this.formData).then((response) => {
                    console.log('criado com sucesso!')
                    if (response.data.msg === 'empty') {
                        this.$toaster.error('Repositorio Vazio tente novamente.',{timeOut: 5000})
                    }else{
                        this.$toaster.success('Tag Atribuida com sucesso.',{timeOut: 5000})
                        this.$router.push('/')
                        this.formData.name = ''
                    }
                }).catch((error) => {
                    console.log(error)
                });
            }
        },

        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            axios.get('getTags').then((response) => {
                this.tags = response
                console.log(this.owner)
                console.log(this.repoName)
                console.log("listagem de todos tags")
            }).catch((errors) => {
                console.log(errors)
            })
        },
    }
</script>   