<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <router-link class="btn btn-primary btn-sm float-left mb-4" to="/">Voltar</router-link>
            </div>
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tag Respositorio</th>
                            <th>Mensagem do Tag</th>
                            <th>Sha</th>
                            <th>Url</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(repo, index) in tags.data" :key="index">
                            <td>{{repo.id}}</td>
                            <td>{{repo.tagrepo}}</td>
                            <td>{{repo.message}}</td>
                            <td>{{repo.sharepo}}</td>
                            <td><a bind-href="repo.url" target="_blank" rel="noopener noreferrer"></a>{{repo.url}}</td>
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
                tags: {},
            }
        },

     
        methods: {
            
        },

        mounted() {
            // window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            axios.get('getAllAtribTags').then((response) => {
                this.tags = response
                console.log(this.tags)
                // console.log(this.repoName)
                // console.log("listagem de todos tags")
            }).catch((errors) => {
                console.log(errors)
            })
        },
    }
</script>   