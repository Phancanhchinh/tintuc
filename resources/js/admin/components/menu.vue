<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <span class="navbar-brand"><i class="fab fa-vuejs"></i> Admin</span>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/admin/category" class="nav-link">Thể Loại</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/admin/typenews" class="nav-link">Loại Tin</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/admin/news" class="nav-link">Tin Tức</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/admin/comment" class="nav-link">Bình Luận</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/admin/users" class="nav-link">Tài Khoản</router-link>
                    </li>
                </ul>
                <div>
                    <a class="text-danger"  href="/backend/logout">
                        <i class="fas fa-sign-out-alt fa-2x">
                            logout
                        </i>
                    </a>
                </div>
            </div>
        </nav>
</template>
