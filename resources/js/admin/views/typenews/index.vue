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
                        <th scope="col">Tên Loại Tin</th>
                        <th scope="col">Thứ Tự</th>
                        <th scope="col">Ngôn Ngữ</th>
                        <th scope="col">Ẩn Hiện</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(type, index) in typenews.data" :key="index">
                        <td>{{type.id}}</td>
                        <td>{{type.Ten}}</td>
                        <td>{{type.ThuTu}}</td>
                        <td>{{type.lang}}</td>
                        <td v-if="type.AnHien == 1">Hiện</td>
                        <td v-else>Ẩn</td>
                        <td>
                            <span v-for="(name,index) in namecate" :key="index">
                                <span v-if="type.idTL == name.id">{{name.TenTL}}</span>
                            </span>
                        </td>
                        <td>
                            <a @click="ShowFromEdit(type)"><i class="fas fa-edit green"></i></a>
                            <a @click="DeleteType(type.id)"><i class="fas fa-trash red"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="typenews" @pagination-change-page="getResults"></pagination>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModelAction" tabindex="-1" role="dialog" aria-labelledby="ModelActionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-success" id="exampleModalLongTitle" v-if="AddOrEdit==false">Thêm Loại Tin</h3>
                            <h3 class="modal-title text-primary" id="exampleModalLongTitle" v-if="AddOrEdit==true">Sửa Loại Tin</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Ten">Tên Loại Tin</label>
                                <input type="text" class="form-control" id="Ten" name="Ten"  v-model="form.Ten">
                                <small class="text-danger" v-if="errors.Ten">{{errors.Ten[0]}} <i class="fas fa-exclamation-triangle"></i></small>
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
                                <label for="idTL">Thể Loại</label>
                                <select  class="form-control" id="idTL" name="idTL" v-model="form.idTL">
                                    <option v-for="(name,index) in namecate" :key="index" :value="name.id">{{name.TenTL}}</option>
                                </select>
                                <small class="text-danger" v-if="errors.idTL">{{errors.idTL[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" v-if="!AddOrEdit" :disabled="hideButton" @click="AddNewsType">Thêm</button>
                            <button type="button" class="btn btn-danger" v-if="AddOrEdit" :disabled="hideButton" @click="UpdateType">Sửa</button>
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
            typenews :{},
            namecate : {},
            AddOrEdit : false,   // default false = Add
            hideButton : false,   // default true = hide
            form : {},
            errors : {},
        };
    },methods : {
        loadData(){                                        // load data
            this.$Progress.start()
            axios.get('api/typenews').then((res)=>{
                    this.typenews = res.data.typenews;
                    this.namecate = res.data.namecate;
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
        },ShowFromEdit(data){                          // Show Form Edit
            $('#ModelAction').modal('show');
            this.AddOrEdit = true;
            this.errors = {};
            this.form = data;
        },ShowFromAdd(){                                // Show Form Create
            $('#ModelAction').modal('show');
            this.AddOrEdit = false;
            this.form = {};
            this.errors = {};
            this.form.Ten_KhongDau = "";
        },AddNewsType(){                                    // function Create
            this.$Progress.start()
            axios.post('api/add_typenews',this.form)
            .then((res)=>{
                $('#ModelAction').modal('hide');
                Fire.$emit('AfterAction');
                Toast.fire({
                    type: 'success',
                    title: 'Thêm mới Loại tin ' + this.form.Ten + ' thành Công',
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
        },DeleteType(id){                               // function Delete
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
                    axios.post('api/delete_typenews/' + id).then(res =>{
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
        },UpdateType(){                                       // function Update
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
                    axios.post('api/update_typenews',this.form).then(res =>{
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
        },getResults(page = 1) {                                    // function paginate
            axios.get('api/typenews?page=' + page)
                .then(response => {
                    this.typenews = response.data.typenews;
                    //console.log(this.typenews);
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
