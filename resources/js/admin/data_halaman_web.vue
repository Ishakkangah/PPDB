<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>DATA HALAMAN WEB</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active">
                            <a href="#" @click="$router.push('/')">Dashboard</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="#">Components</a>
                        </div>
                        <div class="breadcrumb-item">Hero</div>
                    </div>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Postingan</h2>
                    <p class="section-lead">Menu halaman postingan.</p>

                    <div class="mt-4">
                        Blogs
                        <Button @click="$router.push('/create_blog')"
                            ><Icon type="md-add" /> Create blog</Button
                        >
                        <div class="clearfix mb-3"></div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-md text-center"
                            >
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Tag</th>
                                    <th>Kategori</th>
                                    <th>Actions</th>
                                </tr>
                                <tr
                                    v-for="(blog, index) in blogs"
                                    :key="index"
                                    v-if="blogs.length"
                                >
                                    <td>#</td>
                                    <td>{{ blog.title }}</td>
                                    <td>
                                        <span
                                            v-for="(t, index) in blog.tags"
                                            :key="index"
                                        >
                                            <Tag type="border">{{
                                                t.tagName
                                            }}</Tag>
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            v-for="(c, index) in blog.categoris"
                                            :key="index"
                                        >
                                            <Tag type="border">{{
                                                c.categoryName
                                            }}</Tag>
                                        </span>
                                    </td>
                                    <td>
                                        <Button
                                            type="info"
                                            size="small"
                                            @click="
                                                $router.push(
                                                    `/detailPostinganBlog/${blog.id}`
                                                )
                                            "
                                            >Lihat postingan</Button
                                        >
                                        <Button
                                            type="info"
                                            size="small"
                                            @click="
                                                $router.push(
                                                    `/edit_blog/${blog.id}`
                                                )
                                            "
                                            >Edit</Button
                                        >
                                        <Button
                                            type="error"
                                            size="small"
                                            @click="
                                                showModalHapusPostingan(
                                                    blog,
                                                    index
                                                )
                                            "
                                            >Hapus</Button
                                        >
                                    </td>
                                </tr>
                                <div
                                    class="table-responsive"
                                    v-if="!blogs.length"
                                >
                                    <div class="col-md">
                                        <Alert type="error"
                                            >Opps.. data tidak ada atau belum
                                            ditemukan</Alert
                                        >
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- delete blog -->
            <modalDeleteAdmin></modalDeleteAdmin>
        </div>
    </div>
</template>

<script>
import modalDeleteAdmin from "./components/deleteModalAdmin.vue";
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            blogs: [],
            kategori: [],
            tag: [],
            addModal: false,
            editModal: false,
            isAdding: false,
        };
    },
    methods: {
        async showModalHapusPostingan(blog, index) {
            const deleteModalObj = {
                tampilDeleteModalObj: true,
                deleteUrl: "app/deleteBlog",
                id: blog.id,
                deletingIndex: index,
                isDeleting: false,
                msg: "Anda yakin ingin menghapus ini ?",
                msgSuccess: "Blog berhasil dihapus",
            };
            this.$store.commit("setDeletingModalAdminObj", deleteModalObj);
        },
    },

    // get all blogs
    async created() {
        const [res, kategori, tag] = await Promise.all([
            this.callApi("get", "app/tampilSemuaDataBlog"),
            this.callApi("get", "app/tampilSemuaDataKategori"),
            this.callApi("get", "app/tampilSemuaDataTag"),
        ]);
        if (res.status === 200) {
            this.blogs = res.data;
            this.kategori = kategori.data;
            this.tag = tag.data;
        } else {
            this.swr();
        }
    },
    // components
    components: {
        modalDeleteAdmin,
    },
    // computed
    computed: { ...mapGetters(["getDeleteModalAdminObj"]) },
    // watch
    watch: {
        getDeleteModalAdminObj(obj) {
            if (obj.isDeleting) {
                this.blogs.splice(obj.deletingIndex, 1);
            }
        },
    },
};
</script>
