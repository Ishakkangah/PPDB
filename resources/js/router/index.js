import Vue from 'vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import home from '../admin/home.vue';
import pendaptaran from '../admin/pendaptaran.vue';
import isi_data_wali from '../admin/isi_data_wali.vue';
import pendaptaran_berhasil from '../admin/pendaptaran_berhasil.vue';
import monitoring from '../admin/monitoring.vue';
import detailCalonSiswa from '../admin/detailCalonSiswa.vue';
import pengaturan from '../admin/pengaturan.vue';
import laporan from '../admin/laporan.vue';
import manajemen_aturan from '../admin/manajemen_aturan.vue';
import lihat_laporan_pdf from '../admin/lihat_laporan_pdf';
import login from '../admin/login.vue';
import data_halaman_web from '../admin/data_halaman_web.vue';
import tag from '../admin/tag.vue';
import kategori from '../admin/kategori.vue';
import create_blog from '../admin/create_blog.vue';
import edit_blog from '../admin/edit_blog.vue';
import detailPostinganBlog from '../admin/detailPostinganBlog.vue';

import register from '../admin/register.vue';
import notfound from '../admin/notfound.vue';

const routes = [
    // Admin routes
    {
        name: '/',
        path: '/',
        component: home
    },
    {
        name: 'pendaptaran',
        path: '/pendaptaran',
        component: pendaptaran
    },
    {
        name: 'isi_data_wali',
        path: '/isi_data_wali',
        component: isi_data_wali
    },
    {
        name: 'pendaptaran_berhasil',
        path: '/pendaptaran_berhasil',
        component: pendaptaran_berhasil
    },
    {
        name: 'monitoring',
        path: '/monitoring',
        component: monitoring
    },
    {
        name: 'detailCalonSiswa',
        path: `/detailCalonSiswa/:id`,
        component: detailCalonSiswa
    },
    {
        name: 'pengaturan',
        path: '/pengaturan',
        component: pengaturan
    },
    {
        name: 'laporan',
        path: '/laporan',
        component: laporan
    },
    {
        name: 'manajemen_aturan',
        path: '/manajemen_aturan',
        component: manajemen_aturan
    },
    {
        name: 'lihat_laporan_pdf',
        path: '/lihat_laporan_pdf',
        component: lihat_laporan_pdf
    },
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'Data Halaman web',
        path: '/Data_Halaman_web',
        component: data_halaman_web
    },
    {
        name: 'tag',
        path: '/tag',
        component: tag
    },
    {
        name: 'kategori',
        path: '/kategori',
        component: kategori
    },
    {
        name: 'create_blog',
        path: '/create_blog',
        component: create_blog,
    },
    {
        name: 'edit_blog',
        path: '/edit_blog/:id',
        component: edit_blog,
    },
    {
        name: 'detailPostinganBlog',
        path: '/detailPostinganBlog/:id',
        component: detailPostinganBlog,
    },
    {
        name: 'notfound',
        path: '*',
        component: notfound
    },
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router;