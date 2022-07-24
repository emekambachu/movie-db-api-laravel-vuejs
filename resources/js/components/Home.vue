<template>

</template>

<script>
    export default {
        props:{
            api_key: String,
        },
        data(){
            return {
                movies: []
            }
        },
        methods: {
            async getMovieFromApi() {
                console.log(this.api_key);
                try {
                    const url = 'https://api.themoviedb.org/3/movie/popular?api_key=' + this.api_key
                    const response = await axios.get(url)
                    const results = response.data.results
                    this.movies = results.map(movie => ({
                        id: movie.title,
                        title: movie.title,
                        overview: movie.overview,
                        poster_path: movie.poster_path,
                        release_date: movie.release_date,
                    }))
                } catch (err) {
                    if (err.response) {
                        // client received an error response (5xx, 4xx)
                        console.log("Server Error:", err)
                    } else if (err.request) {
                        // client never received a response, or request never left
                        console.log("Network Error:", err)
                    } else {
                        console.log("Client Error:", err)
                    }
                }
            }
        },
        created(){
            this.getMovieFromApi();
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>
