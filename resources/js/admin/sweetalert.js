import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({    // cau hinh tuy` y'
    toast : true,
    position:'top-end',
    showConfirmButton :false,
    timer : 7000,
});
window.Toast = Toast;

export default {Swal}
