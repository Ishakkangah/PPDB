<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>KATEGORI</h1>
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
                    <h2 class="section-title">Kategori</h2>
                    <p class="section-lead">Anda bisa membuat kategori baru.</p>

                    <div class="mt-4">
                        <p>
                            Tag
                            <Button @click="modalTambahKategori = true"
                                ><Icon type="ios-add" /> Tambah kategori baru
                            </Button>
                        </p>
                        <div class="clearfix mb-3"></div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-md text-center"
                            >
                                <tr>
                                    <th>ID</th>
                                    <th>Nama kategori</th>
                                    <th>Dibuat pada</th>
                                    <th>Actions</th>
                                </tr>
                                <tr
                                    v-for="(k, index) in data"
                                    :key="index"
                                    v-if="data.length"
                                >
                                    <td>#</td>
                                    <td>{{ k.categoryName }}</td>
                                    <td>{{ k.created_at }}</td>
                                    <td>
                                        <Button
                                            type="info"
                                            size="small"
                                            @click="
                                                showModalEditKategori(k, index)
                                            "
                                            >Edit</Button
                                        >
                                        <Button
                                            type="error"
                                            size="small"
                                            @click="
                                                showModalDeleteKategori(
                                                    k.id,
                                                    index
                                                )
                                            "
                                            >Hapus</Button
                                        >
                                    </td>
                                </tr>
                                <div
                                    class="table-responsive"
                                    v-if="!data.length"
                                >
                                    <div class="col-md">
                                        <Alert type="error"
                                            >Opps.. data tidak ada atau belum
                                            ditemukan</Alert
                                        >
                                    </div>
                                </div>
                            </table>
                            <div class="float-left mt-4">
                                <Page
                                    :total="pageInfo.total"
                                    :current="pageInfo.current_page"
                                    :page-size="parseInt(pageInfo.per_page)"
                                    prev-text="Previous"
                                    next-text="Next"
                                    v-if="pageInfo"
                                    size="small"
                                    @on-change="getKategoriData"
                                />
                            </div>
                        </div>
                    </div>

                    <div id="output-status"></div>
                </div>
                <!-- tambah tag -->
                <Modal
                    v-model="modalTambahKategori"
                    title="Tambah kategori baru"
                >
                    <div class="mt-3">
                        <label>Nama kategori</label>
                        <Input
                            type="text"
                            maxlength="40"
                            v-model="category.categoryName"
                            show-word-limit
                            placeholder="Masukan nama ketegori"
                            clearable
                        />
                    </div>
                    <div slot="footer">
                        <Button type="default" @click="closeKategori"
                            >Batal</Button
                        >
                        <Button
                            type="primary"
                            @click="tambahKategoriBaru"
                            :isLoading="isTambahKategori"
                            :disabled="isTambahKategori"
                            >{{
                                isTambahKategori
                                    ? "Proses.."
                                    : "Tambah ketegori"
                            }}</Button
                        >
                    </div>
                </Modal>
                <!-- Edit tag -->
                <Modal v-model="modalEditKategori" title="Edit kategori">
                    <div class="mt-3">
                        <label>Nama Kategori</label>
                        <Input
                            type="text"
                            maxlength="40"
                            v-model="editKategori.categoryName"
                            show-word-limit
                            placeholder="Masukan nama kategori"
                            clearable
                        />
                    </div>
                    <div slot="footer">
                        <Button type="default" @click="closeKategori"
                            >Batal</Button
                        >
                        <Button
                            type="primary"
                            @click="editKategoriName"
                            :isLoading="isEditKategori"
                            :disabled="isEditKategori"
                            >{{
                                isEditKategori ? "Proses.." : "Edit kategori"
                            }}</Button
                        >
                    </div>
                </Modal>

                <!-- delete tag -->
                <modalDeleteAdmin></modalDeleteAdmin>
            </section>
        </div>
    </div>
</template>

<script>
import modalDeleteAdmin from "./components/deleteModalAdmin.vue";
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            data: [],
            category: {
                categoryName: "",
            },
            modalTambahKategori: false,
            modalEditKategori: false,
            isTambahKategori: false,
            editKategori: {
                id: null,
                categoryName: "",
            },
            index: -9999,
            isEditKategori: false,
            total: 10,
            pageInfo: null,
        };
    },
    methods: {
        async tambahKategoriBaru() {
            if (this.category.categoryName.trim() === "") {
                return this.error("Masukan kategori");
            }
            this.isTambahKategori = true;
            const res = await this.callApi(
                "post",
                "app/tambahKategoriBaru",
                this.category
            );
            if (res.status === 201) {
                this.data.unshift(res.data);
                this.success("Kategori baru berhasil ditambah");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.category.categoryName = "";
            this.isTambahKategori = false;
            this.modalTambahKategori = false;
        },
        // close
        closeKategori() {
            this.modalTambahKategori = false;
            this.category.categoryName = "";
            this.editKategori = "";
            this.modalEditKategori = false;
        },
        // delete tag
        showModalDeleteKategori(k, index) {
            const deleteModalObj = {
                tampilDeleteModalObj: true,
                deleteUrl: "app/deleteKategori",
                id: k,
                deletingIndex: index,
                isDeleting: false,
                msg: "Anda yakin ingin menghapus ini ?",
                msgSuccess: "tag berhasil dihapus",
            };
            this.$store.commit("setDeletingModalAdminObj", deleteModalObj);
        },
        // edit tag
        showModalEditKategori(k, index) {
            let obj = {
                id: k.id,
                categoryName: k.categoryName,
            };
            this.editKategori = obj;
            this.index = index;
            this.modalEditKategori = true;
        },
        async editKategoriName() {
            if (this.editKategori.categoryName.trim() === "") {
                return this.error("Masukan kategori");
            }
            this.isEditKategori = true;
            const res = await this.callApi(
                "post",
                "app/editKategori",
                this.editKategori
            );
            if (res.status === 200) {
                this.data[this.index] = this.editKategori;
                this.success("Ubah berhasil");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isEditKategori = false;
            this.modalEditKategori = false;
        },
        // tampil semua data kategori
        async getKategoriData(page = 1) {
            const res = await this.callApi(
                "get",
                `app/tampilSemuaDataKategori?page=${page}&total=${this.total}`
            );
            this.pageInfo = res.data;
            if (res.status === 200) {
                this.data = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.swr();
            }
        },
    },

    // get all tag
    async created() {
        this.getKategoriData();
    },
    // components
    components: {
        modalDeleteAdmin,
    },
    computed: { ...mapGetters(["getDeleteModalAdminObj"]) },
    watch: {
        getDeleteModalAdminObj(obj) {
            if (obj.isDeleting) {
                this.data.splice(obj.deletingIndex, 1);
            }
        },
    },
};
</script>
