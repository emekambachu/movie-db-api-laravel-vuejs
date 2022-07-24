<template>
    <div class="row">

        <div class="col-4" v-for="(movie, index) in movies"
             :key="movie.id">
            <div class="card mb-3">
                <h5 class="card-header">{{ movie.title }}</h5>
<!--                <div class="card-body">-->
<!--                    <h5 class="card-title">Special title treatment</h5>-->
<!--                    <h6 class="card-subtitle text-muted">Support card subtitle</h6>-->
<!--                </div>-->
                <img :src="'https://image.tmdb.org/t/p/w500/'+movie.poster_path"/>
                <div class="card-body">
                    <p class="card-text">{{ movie.overview }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Lang: {{ movie.original_language }}</li>
                    <li class="list-group-item">Vote Count: {{ movie.vote_count }}</li>
                    <li class="list-group-item">Vote Average: {{ movie.vote_average }}</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-rounded">More</a>
                </div>
                <div class="card-footer text-muted">
                    {{ movie.release_date }}
                </div>
            </div>
        </div>
    </div>

    <div class="justify-content-center d-flex mt-5">
<!--        <ul class="pagination">-->
<!--            <li class="page-item disabled">-->
<!--                <a class="page-link" href="#">&laquo;</a>-->
<!--            </li>-->
<!--            <li class="page-item active">-->
<!--                <a class="page-link" href="#">1</a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#">2</a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#">3</a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#">4</a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#">5</a>-->
<!--            </li>-->
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#">&raquo;</a>-->
<!--            </li>-->
<!--        </ul>-->

<!--        <paginate-->
<!--            v-model="page"-->
<!--            :page-count="5"-->
<!--            :page-range="3"-->
<!--            :margin-pages="2"-->
<!--            :click-handler="getMovieFromApi"-->
<!--            :prev-text="'Prev'"-->
<!--            :next-text="'Next'"-->
<!--            :container-class="'pagination'"-->
<!--            :page-class="'page-item'"-->
<!--            :page-link-class="'page-link'"-->
<!--            :active-class="'active'"-->
<!--            :disabled-class="'disabled'"-->
<!--        ></paginate>-->

        <pagination
            v-model="page"
            :records="total_pages"
            :per-page="25"
            @paginate="getMovieFromApi">
        </pagination>
    </div>

</template>

<script>
    import Pagination from 'v-pagination-3';
    export default {
        props:{
            api_key: String,
        },
        components:{
            Pagination
        },
        data(){
            return {
                movies: [],
                page: 1,
                total_pages: 1
            }
        },
        methods: {
            async getMovieFromApi() {
                console.log(this.api_key);
                try {
                    const url = 'https://api.themoviedb.org/3/movie/popular?api_key='+this.api_key+'&language=en-US&page='+this.page;
                    const response = await axios.get(url);
                    const results = response.data.results;
                    this.total_pages = response.data.total_pages;
                    this.movies = results.map(movie => ({
                        id: movie.title,
                        title: movie.title,
                        overview: movie.overview,
                        poster_path: movie.poster_path,
                        original_language: movie.original_language,
                        vote_count: movie.vote_count,
                        vote_average: movie.vote_average,
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
