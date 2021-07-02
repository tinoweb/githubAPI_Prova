<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <router-link class="btn btn-primary btn-sm float-left" to="/">Voltar</router-link>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Criando uma nova Tag</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name">
                            <p class="text-danger" v-text="errors.name"></p>
                        </div>
                        
                        <div class="form-group">
                            <button @click.prevent="create" class="btn btn-primary">Criar Tag</button>
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
                },
                errors: {}
            }
        },
        methods: {
            create() {
                axios.post('createTag', this.formData).then((response) => {
                    console.log('criado com sucesso!')
                    this.$router.push('/')
                    this.formData.name = ''
                    this.$toaster.success('tag Criada com sucesso.')
                }).catch((error) => {
                    this.errors = error.response.data.errors
                    console.log(errors)
                });
            }
        }
    }
</script>