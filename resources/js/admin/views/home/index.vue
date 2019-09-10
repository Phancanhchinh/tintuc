<template>
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-3 text-danger text-center">Trang Quản Lý Website Tin Tức </h1>
                <hr class="my-10">
            </div>
        </div>
    </div>
</template>


<script>
    import star from './star.jpg';
    import pikachu from './nyan-cat.gif';
    export default {
        data (){
            return {
                star : star,
                pikachu : pikachu
            }
        },created(){
            this.$Progress.start()
            Swal.fire({
                title: '<p style="color:red">WellCome Trang Quản Trị Tin Tức</p>',
                width: 600,
                padding: '3em',
                background: '#fff url(' +this.star+ ')',
                backdrop: `
                    rgba(0,0,123,0.4)
                    center bottom
                    repeat-x
                    url("` + pikachu + `")`
                })
            this.$Progress.finish()
        }
    }
</script>
