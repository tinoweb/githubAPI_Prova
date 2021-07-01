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
                            <select class="form-control" id="exampleFormControlSelect1" >
                                <option v-for="(tag, index) in tags.data" :key="index" v-bind:value="tag.id">
                                    {{tag.tag}}
                                </option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <!-- <button @click.prevent="create" class="btn btn-primary">Atribuir Tag</button> -->
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
                },
                tags: {},
            }
        },
        methods: {
            create() {
                // axios.post('createTag', this.formData).then((response) => {
                //     console.log('criado com sucesso!')
                //     this.$router.push('/')
                //     this.formData.name = ''
                //     this.$toaster.success('tag Criada com sucesso.')
                // }).catch((error) => {
                //     console.log(error)
                // });
            }
        },

        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            axios.get('getTags').then((response) => {
                this.tags = response
                console.log("listagem de todos tags")
                console.log(this.tags.data)
            }).catch((errors) => {
                console.log(errors)
            })
        },
    }
</script>   