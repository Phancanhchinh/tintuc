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
                        <th style="width: 10%" scope="col">Tiêu Đề</th>
                        <th scope="col">Tóm Tắt</th>
                        <th scope="col">Hình</th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Loại Tin</th>
                        <th scope="col">Ngôn Ngữ</th>
                        <th scope="col">Số Lần Xem</th>
                        <th scope="col">Ẩn Hiện</th>
                        <th scope="col">Nỗi Bật</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Ngày Đăng</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in news.data" :key="index">
                        <td>{{item.id}}</td>
                        <td>{{item.TieuDe}}</td>
                        <td v-if="item.TomTat">
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" :title="item.TomTat">
                                Hover
                            </button>
                        </td>
                        <td v-else>
                            -------------
                        </td>
                        <td v-if="item.urlHinh"><img width="100px" height="100px" :src='url + item.urlHinh' :alt="item.urlHinh" /></td>
                        <td v-if="item.urlHinh =='' ">-------------</td>
                        <td v-if="item.Content">
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" :title="item.Content">
                                Hover
                            </button>
                        </td>
                        <td v-else>
                            -------------
                        </td>
                        <td>
                            <span v-for="(data1,index) in cate" :key="index">
                                <p v-if="data1.id == item.idTL">{{data1.TenTL}}</p>
                            </span>
                        </td>
                        <td>
                            <span v-for="(data2,index) in type" :key="index">
                                <p v-if="data2.id == item.idLT">{{data2.Ten}}</p>
                            </span>
                        </td>
                        <td>{{item.lang}}</td>
                        <td>{{item.SoLanXem}}</td>
                        <td v-if="item.AnHien == 1">Hiện</td>
                        <td v-else>Ẩn</td>
                        <td v-if="item.TinNoiBat == 1">Có</td>
                        <td v-else>Không</td>
                        <td>{{item.tags}}</td>
                        <td>{{item.Ngay}}</td>
                        <td>
                            <a @click="ShowFromEdit(item)"><i class="fas fa-edit green"></i></a>
                            <a @click="DeleteCate(item.id)"><i class="fas fa-trash red"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <pagination :data="news" align="center"  @pagination-change-page="getResults"></pagination>
        <!-- Modal -->
        <div class="modal fade" id="ModelAction" tabindex="-1" role="dialog" aria-labelledby="ModelActionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-success" id="exampleModalLongTitle" v-if="AddOrEdit==false">Thêm Tin Tức</h3>
                            <h3 class="modal-title text-primary" id="exampleModalLongTitle" v-if="AddOrEdit==true">Sửa Tin Tức</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="TieuDe">Tiêu Đề</label>
                                <input type="text" class="form-control" id="TieuDe" name="TieuDe"  v-model="form.TieuDe">
                                <small class="text-danger" v-if="errors.TieuDe">{{errors.TieuDe[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="TomTat">Tóm Tắt</label>
                                <textarea class="form-control" id="TomTat" name="TomTat" v-model="form.TomTat" rows="3"></textarea>
                                <small class="text-danger" v-if="errors.TomTat">{{errors.TomTat[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div v-show="!AddOrEdit" class="form-group">
                                <label for="urlHinh">Hình</label>
                                <input @change="UploadImage" type="file"  class="form-control-file" name="urlHinh"  id="urlHinh">
                            </div>
                            <div class="form-group">
                                <label for="Content">Nội Dung</label>
                                <textarea class="form-control" id="Content" name="Content" v-model="form.Content" rows="5"></textarea>
                                <small class="text-danger" v-if="errors.Content">{{errors.Content[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="idTL">Thể Loại</label>
                                <select class="form-control"  id="idTL" name="idTL" v-model="form.idTL" @change="changeCate(form.idTL)">
                                    <option v-for="(namecate,index) in cate" :key="index" :value="namecate.id">{{namecate.TenTL}}</option>
                                </select>
                                <small class="text-danger" v-if="errors.idTL">{{errors.idTL[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="idLT">Loại Tin</label>
                                <select class="form-control"  id="idLT" name="idLT" v-model="form.idLT">
                                    <option v-for="(nametype,index) in type_in_cate" :key="index" :value="nametype.id">{{nametype.Ten}}</option>
                                </select>
                                <small class="text-danger" v-if="errors.idLT">{{errors.idLT[0]}} <i class="fas fa-exclamation-triangle"></i></small>
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
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                                <small class="text-danger" v-if="errors.AnHien">{{errors.AnHien[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="TinNoiBat">Nổi Bật</label>
                                <select class="form-control" id="TinNoiBat" name="TinNoiBat" v-model="form.TinNoiBat">
                                    <option value="0">Có</option>
                                    <option value="1">Không</option>
                                </select>
                                <small class="text-danger" v-if="errors.TinNoiBat">{{errors.TinNoiBat[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" id="tags" name="tags"  v-model="form.tags">
                                <small class="text-danger" v-if="errors.tags">{{errors.tags[0]}} <i class="fas fa-exclamation-triangle"></i></small>
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
            news : {},
            cate : {},
            type : {},
            type_in_cate : {},
            url : "/mid/upload/images/",
            AddOrEdit : false,   // default false = Add
            hideButton : false,   // default true = hide
            form : {},
            errors : {},
        };
    },methods : {
        loadData(){                                        // load data
            this.$Progress.start()
            axios.get('api/news').then((res)=>{
                    this.news = res.data.news;
                    this.cate = res.data.cate;
                    this.type = res.data.type;
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
            this.form.TieuDe_KhongDau = '';
            this.form.Ngay = '';
        },AddNewsCategory(){
            this.$Progress.start()
            axios.post('api/add_news',this.form)
            .then((res)=>{
                $('#ModelAction').modal('hide');
                Fire.$emit('AfterAction');
                Toast.fire({
                    type: 'success',
                    title: 'Thêm mới thể loại ' + this.form.TieuDe + ' thành Công',
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
                    axios.post('api/delete_news/' + id).then(res =>{
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
                    axios.post('api/update_news',this.form).then(res =>{
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
        },changeCate(idTL){
            axios.post('api/id_category',{idTL}).then(res=>{
                this.type_in_cate = res.data.type_in_cate;
            }).catch(err => {
                console.log(err);
            })
        },
        getResults(page = 1) {
            axios.get('api/news?page=' + page)
                .then(response => {
                    this.news = response.data.news;
                });
        },UploadImage(e){
            let data = e.target.files[0]
            let file = new FileReader();
            if(data.size > 2000000){
                    Swal.fire(
                        'Lỗi!',
                        'Ảnh không được vượt quá 2MB',
                        'error'
                    )
                this.hideSubmit = true;
            }else if(data.type != "image/jpeg" && data.type != "image/png" && data.type != "image/jpg"){
                Swal.fire(
                    'Lỗi!',
                    'Không đúng định dạng của ảnh',
                    'error'
                )
                this.hideSubmit = true;
            }else{
                file.onloadend = (data) => {
                    this.form.urlHinh = file.result;
                }
                file.readAsDataURL(data);
                this.hideSubmit = false;
            }
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
