<template>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-lg-12">
                <form class="form-inline my-2 my-lg-0">
                    <input  class="form-control mr-sm-2" placeholder="Search">
                    <button  class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
                </form>
                <button type="button" class="btn btn-outline-success btn-lg float-right" @click="ShowFromAdd()">
                    Thêm <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-hover  mt-5">
                <thead>
                    <tr class="text-primary">
                        <th scope="col">Id</th>
                        <th scope="col">Tên Thể Loại</th>
                        <th scope="col">Thứ Tự</th>
                        <th scope="col">Ngôn Ngữ</th>
                        <th scope="col">Ẩn Hiện</th>
                        <th scope="col">Hiện Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(cate, index) in category.data" :key="index">
                        <td>{{cate.id}}</td>
                        <td>{{cate.TenTL}}</td>
                        <td>{{cate.ThuTu}}</td>
                        <td>{{cate.lang}}</td>
                        <td v-if="cate.AnHien == 1">Hiện</td>
                        <td v-else>Ẩn</td>
                        <td v-if="cate.HienMenu == 1">Có</td>
                        <td v-else>Không</td>
                        <td>
                            <a @click="ShowFromEdit(cate)"><i class="fas fa-edit green"></i></a>
                            <a @click="DeleteCate(cate.id)"><i class="fas fa-trash red"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="category" @pagination-change-page="getResults"></pagination>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModelAction" tabindex="-1" role="dialog" aria-labelledby="ModelActionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-success" id="exampleModalLongTitle" v-if="AddOrEdit==false">Thêm Thể Loại</h3>
                            <h3 class="modal-title text-primary" id="exampleModalLongTitle" v-if="AddOrEdit==true">Sửa Thể Loại</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="TenTL">Tên Thể Loại</label>
                                <input type="text" class="form-control" id="TenTL" name="TenTL"  v-model="form.TenTL">
                                <small class="text-danger" v-if="errors.TenTL">{{errors.TenTL[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="ThuTu">Thứ Tự</label>
                                <select class="form-control"  id="ThuTu" name="ThuTu" v-model="form.ThuTu">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                </select>
                                <small class="text-danger" v-if="errors.ThuTu">{{errors.ThuTu[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="lang">Ngôn Ngữ</label>
                                <select class="form-control" id="lang" name="lang" v-model="form.lang">
                                    <option value="en">en</option>
                                    <option value="vi">vi</option>
                                </select>
                                <small class="text-danger" v-if="errors.lang">{{errors.lang[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="AnHien">Ẩn Hiện</label>
                                <select class="form-control" id="AnHien" name="AnHien" v-model="form.AnHien">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                                <small class="text-danger" v-if="errors.AnHien">{{errors.AnHien[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="HienMenu">Hiện Menu</label>
                                <select class="form-control" id="HienMenu" name="HienMenu" v-model="form.HienMenu">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                                <small class="text-danger" v-if="errors.HienMenu">{{errors.HienMenu[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" v-if="!AddOrEdit" :disabled="hideButton" @click="AddNewsCategory">Thêm</button>
                            <button type="button" class="btn btn-danger" v-if="AddOrEdit" :disabled="hideButton" @click="UpdateCate">Sửa</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
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
            category :{},
            AddOrEdit : false,   // default false = Add
            hideButton : false,   // default true = hide
            form : {},
            errors : {},
        };
    },methods : {
        loadData(){                                        // load data
            this.$Progress.start()
            axios.get('api/category').then((res)=>{
                    this.category = res.data.data;
                    this.$Progress.finish()
                }).catch((err)=>{
                    Swal.fire({
                        type: 'error',
                        title: 'Errors !!!!!!',
                        text: 'Không Thể Tải Dữ Liệu!',
                    })
                    this.$Progress.fail()
                })
            this.getResults();
        },ShowFromEdit(data){
            $('#ModelAction').modal('show');
            this.AddOrEdit = true;
            this.errors = {};
            this.form = data;
        },ShowFromAdd(){
            $('#ModelAction').modal('show');
            this.AddOrEdit = false;
            this.form = {};
            this.errors = {};
            this.form.TenTL_KhongDau = "";
        },AddNewsCategory(){
            this.$Progress.start()
            axios.post('api/add_category',this.form)
            .then((res)=>{
                $('#ModelAction').modal('hide');
                Fire.$emit('AfterAction');
                Toast.fire({
                    type: 'success',
                    title: 'Thêm mới thể loại ' + this.form.TenTL + ' thành Công',
                })
                this.$Progress.finish()
            })
            .catch((err)=>{
                this.errors = err.response.data.errors;
                $('#ModelAction').modal('show');
                Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Thêm Mới Dữ Liệu Thất Bại!',
                    })
                this.$Progress.fail()
            });
        },DeleteCate(id){
            Swal.fire({
                title: 'Bạn Chắc Chắn Muốn Xóa?',
                text: "Xóa Khổng Thể Khôi Phục Lại Được",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0BFA0F',
                cancelButtonColor: '#F50606',
                confirmButtonText: 'Có Hãy Xóa Nó'
                }).then((result) => {
                if (result.value) {
                    axios.post('api/delete_category/' + id).then(res =>{
                        Fire.$emit('AfterAction');
                        Swal.fire({
                                type: 'success',
                                title: 'Ok',
                                text: 'Dữ Liệu Đã Bị Xóa!',
                            })
                    }).catch(err => {
                        Swal.fire({
                                type: 'error',
                                title: 'Error',
                                text: 'Vui Lòng Kiểm Tra Lại',
                            })
                    })
                }
                })
        },UpdateCate(){
            Swal.fire({
                title: 'Bạn Chắc Chắn Muốn Sửa?',
                text: "Thay Đổi Dữ Liệu ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có Hãy Sửa Nó'
                }).then((result) => {
                if (result.value) {
                    axios.post('api/update_category',this.form).then(res =>{
                        Swal.fire({
                                type: 'success',
                                title: 'Ok',
                                text: 'Dữ Liệu Đã Được Sửa!',
                            })
                        $('#ModelAction').modal('hide');
                        Fire.$emit('AfterAction');
                    }).catch(err => {
                        Swal.fire({
                                type: 'error',
                                title: 'Error',
                                text: 'Vui Lòng Kiểm Tra Lại',
                            })
                    })
                }
                })
        },getResults(page = 1) {
            axios.get('api/category?page=' + page)
                .then(response => {
                    //console.log(response.data.data);
                    this.category = response.data.data;
                });
        }
    },created(){
        this.loadData();
        Fire.$on('AfterAction',()=>{
            this.loadData();
        })
    },mounted(){
        // this.getResults();
    }
}
</script>
