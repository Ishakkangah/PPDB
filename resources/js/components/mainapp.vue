<template>
    <div>
        <div>
            <div class="main-wrapper">
                <div v-if="$store.state.user">
                    <div class="navbar-bg"></div>
                    <nav class="navbar navbar-expand-lg main-navbar">
                        <form class="form-inline mr-auto">
                            <ul class="navbar-nav mr-3">
                                <li>
                                    <a
                                        href="#"
                                        data-toggle="sidebar"
                                        class="nav-link nav-link-lg"
                                        ><i class="fas fa-bars"></i
                                    ></a>
                                </li>
                            </ul>
                        </form>
                        <ul class="navbar-nav navbar-right">
                            <li class="dropdown">
                                <a
                                    href="#"
                                    data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                                >
                                    <img
                                        alt="image"
                                        src="https://www.psdgraphics.com/file/user-icon.jpg"
                                        class="rounded-circle mr-1"
                                    />
                                    <div class="d-sm-none d-lg-inline-block">
                                        {{ user.name }}
                                    </div></a
                                >
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a
                                        href="features-profile.html"
                                        class="dropdown-item has-icon"
                                    >
                                        <i class="far fa-user"></i> Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a
                                        href="/logout"
                                        class="dropdown-item has-icon text-danger"
                                    >
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="main-sidebar">
                        <aside id="sidebar-wrapper">
                            <div class="sidebar-brand">
                                <a href="#">SMKN 1 KAYUAGUNG</a>
                            </div>
                            <ul class="sidebar-menu">
                                <li class="menu-header">Menu</li>
                                <li
                                    class="nav-item dropdown"
                                    v-for="(menuItem, index) in permissions"
                                    :key="index"
                                    v-if="permissions.length && menuItem.lihat"
                                >
                                    <router-link
                                        :to="'/' + menuItem.name"
                                        class="nav-link"
                                        ><Icon
                                            :type="menuItem.icon"
                                            size="20"
                                        /><span>{{
                                            menuItem.nama
                                        }}</span></router-link
                                    >
                                </li>
                                <li class="nav-item dropdown">
                                    <a
                                        href="#"
                                        class="nav-link has-dropdown"
                                        data-toggle="dropdown"
                                        ><i class="fas fa-columns"></i>
                                        <span>Data Halaman Web</span></a
                                    >
                                    <ul class="dropdown-menu">
                                        <li>
                                            <router-link
                                                to="/tag"
                                                class="nav-link"
                                                >Tag</router-link
                                            >
                                        </li>
                                        <li>
                                            <router-link
                                                to="/kategori"
                                                class="nav-link"
                                                >Kategori</router-link
                                            >
                                        </li>
                                        <li>
                                            <router-link
                                                to="/data_Halaman_web"
                                                class="nav-link"
                                                >Postingan</router-link
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="/logout" class="nav-link">
                                        <Icon
                                            type="md-return-left"
                                            size="20"
                                        /><span>Logout</span></a
                                    >
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>

                <!-- Main Content -->
                <router-view></router-view>
                <footer class="main-footer" v-if="$store.state.user">
                    <div class="footer-left">
                        Copyright &copy; 2022
                        <div class="bullet"></div>
                        Design By
                        <a href="#">SMK NEGERI 1 KAYUAGUNG</a>
                    </div>
                    <div class="footer-right">2.3.0</div>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user", "permissions"],
    data() {
        return {};
    },
    created() {
        this.$store.commit("setUpdateUser", this.user);
        this.$store.commit("setUserPermission", this.permissions);
    },
};
</script>
