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
                        <th scope="col">Họ Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Địa Chỉ</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users.data" :key="index">
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.phone}}</td>
                        <td>{{user.address}}</td>
                        <td v-if="user.role == 1">Admin</td>
                        <td v-else>Khách</td>
                        <td>
                            <a @click="ShowFromEdit(user)"><i class="fas fa-edit green"></i></a>
                            <a @click="DeleteUser(user.id)"><i class="fas fa-trash red"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <pagination :data="users" @pagination-change-page="getResults"></pagination>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModelAction" tabindex="-1" role="dialog" aria-labelledby="ModelActionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-success" id="exampleModalLongTitle" v-if="!AddOrEdit">Thêm Tài Khoản</h3>
                            <h3 class="modal-title text-primary" id="exampleModalLongTitle" v-if="AddOrEdit">Sửa Tài Khoản</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Họ Tên</label>
                                <input type="text" class="form-control" id="name" name="name"  v-model="form.name">
                                <small class="text-danger" v-if="errors.name">{{errors.name[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"  v-model="form.email">
                                <small class="text-danger" v-if="errors.email">{{errors.email[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div v-show="!AddOrEdit" class="form-group">
                                <label for="password">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"  v-model="form.password">
                                <small class="text-danger" v-if="errors.password">{{errors.password[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"  v-model="form.address">
                                <small class="text-danger" v-if="errors.address">{{errors.address[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"  v-model="form.phone">
                                <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                            <div class="form-group">
                                <label for="role">Quyền</label>
                                <select class="form-control" id="role" name="role" v-model="form.role">
                                    <option value="0">Khách</option>
                                    <option value="1">Admin</option>
                                </select>
                                <small class="text-danger" v-if="errors.role">{{errors.role[0]}} <i class="fas fa-exclamation-triangle"></i></small>
                            </div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" v-if="!AddOrEdit" :disabled="hideButton" @click="AddNewUsers">Thêm</button>
                            <button type="button" class="btn btn-danger" v-if="AddOrEdit" :disabled="hideButton" @click="UpdateUsers">Sửa</button>
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
            users : {},
            AddOrEdit : false,   // default false = Add
            hideButton : false,   // default true = hide
            form : {},
            errors : {},
        };
    },methods : {
        loadData(){                                        // load data
            this.$Progress.start()
            axios.get('api/users').then((res)=>{
                    this.users = res.data.user;
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
            console.log(this.form);
        },ShowFromAdd(){
            $('#ModelAction').modal('show');
            this.AddOrEdit = false;
            this.form = {};
            this.errors = {};
        },AddNewUsers(){
            this.$Progress.start()
            axios.post('api/add_users',this.form)
            .then((res)=>{
                $('#ModelAction').modal('hide');
                Fire.$emit('AfterAction');
                Toast.fire({
                    type: 'success',
                    title: 'Thêm mới thể loại ' + this.form.name + ' thành Công',
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
        },DeleteUser(id){
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
                    axios.post('api/delete_users/' + id).then(res =>{
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
        },UpdateUsers(){
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
                    axios.post('api/update_users',this.form).then(res =>{
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
        },
        getResults(page = 1) {
            axios.get('api/users?page=' + page)
                .then(response => {
                    this.users = response.data.user;
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

