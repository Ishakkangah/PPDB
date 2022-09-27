<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>MANAJEMEN ATURAN</h1>
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
                    <h2 class="section-title">Manajemen admin</h2>
                    <p class="section-lead">
                        Anda bisa membuat admin baru sesuai dengan aturan yang
                        anda buat.
                    </p>

                    <div id="output-status"></div>

                    <div class="row">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="my-4">
                                    <Button @click="ModalTambahAdmin = true"
                                        ><Icon type="ios-add" /> Tambah admin
                                        baru
                                    </Button>
                                </div>
                                <div>
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered table-md text-center"
                                        >
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr
                                                v-for="(
                                                    admin, index
                                                ) in dataAdmin"
                                                :key="index"
                                            >
                                                <td>#</td>
                                                <td>{{ admin.name }}</td>
                                                <td>{{ admin.email }}</td>
                                                <td>
                                                    <p
                                                        v-for="(
                                                            d, index
                                                        ) in data"
                                                        :key="index"
                                                    >
                                                        {{
                                                            admin.role_id ==
                                                            d.id
                                                                ? d.roleName
                                                                : null
                                                        }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-blog">
                                                        <Button
                                                            type="info"
                                                            size="small"
                                                            @click="
                                                                showEditModalAdmin(
                                                                    admin,
                                                                    index
                                                                )
                                                            "
                                                            >Edit</Button
                                                        >
                                                        <Button
                                                            type="error"
                                                            size="small"
                                                            @click="
                                                                showModalDeleteAdmin(
                                                                    admin.id,
                                                                    index
                                                                )
                                                            "
                                                            >Hapus</Button
                                                        >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="!dataAdmin.length">
                                                <td></td>
                                                <td>
                                                    <Alert type="error"
                                                        >Sedang mencari data
                                                        atau data tidak
                                                        ditemukan.</Alert
                                                    >
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- Modal tambah admin -->
                                        <Modal
                                            v-model="ModalTambahAdmin"
                                            title="Tambah admin"
                                        >
                                            <div class="mt-3">
                                                <label>Nama</label>
                                                <Input
                                                    type="text"
                                                    maxlength="20"
                                                    show-word-limit
                                                    v-model="admin.nama"
                                                    placeholder="Masukan nama"
                                                    clearable
                                                />
                                            </div>
                                            <div class="mt-3">
                                                <label>Email</label>
                                                <Input
                                                    type="email"
                                                    maxlength="35"
                                                    show-word-limit
                                                    v-model="admin.email"
                                                    placeholder="Masukan email"
                                                    clearable
                                                />
                                            </div>
                                            <div class="mt-3">
                                                <label>Pilih aturan</label>
                                                <Select
                                                    v-model="admin.role_id"
                                                    placeholder="Choose one"
                                                    clearable
                                                >
                                                    ><Alert
                                                        v-if="!data.length"
                                                        type="error"
                                                        >Anda harus membuat
                                                        aturan di menu manajemen
                                                        aturan</Alert
                                                    >
                                                    <Option
                                                        v-for="(
                                                            role, index
                                                        ) in data"
                                                        :key="index"
                                                        :value="role.id"
                                                        >{{
                                                            role.roleName
                                                        }}</Option
                                                    >
                                                </Select>
                                            </div>
                                            <div class="mt-3">
                                                <label>Password</label>
                                                <Input
                                                    type="password"
                                                    password
                                                    v-model="admin.password"
                                                    placeholder="Masukan password"
                                                />
                                            </div>
                                            <div slot="footer">
                                                <Button
                                                    type="default"
                                                    @click="batalModalAdmin"
                                                    >Batal</Button
                                                >
                                                <Button
                                                    type="primary"
                                                    @click="tambahAdminBaru"
                                                    :loading="
                                                        isLoadingAdminBaru
                                                    "
                                                    :disabled="
                                                        isLoadingAdminBaru
                                                    "
                                                    >Tambah admin</Button
                                                >
                                            </div>
                                        </Modal>
                                        <!-- Modal Edit Admin -->
                                        <Modal
                                            v-model="ModalEditAdmin"
                                            title="Edit admin"
                                        >
                                            <div class="mt-3">
                                                <label>Nama</label>
                                                <Input
                                                    type="text"
                                                    maxlength="20"
                                                    show-word-limit
                                                    v-model="editAdmin.name"
                                                    placeholder="Masukan nama"
                                                    clearable
                                                />
                                            </div>
                                            <div class="mt-3">
                                                <label>Email</label>
                                                <Input
                                                    type="email"
                                                    maxlength="35"
                                                    show-word-limit
                                                    v-model="editAdmin.email"
                                                    placeholder="Masukan email"
                                                    clearable
                                                />
                                            </div>
                                            <div class="mt-3">
                                                <label>Pilih aturan</label>
                                                <Select
                                                    v-model="editAdmin.role_id"
                                                    placeholder="Choose one"
                                                    clearable
                                                >
                                                    ><Alert
                                                        v-if="!data.length"
                                                        type="error"
                                                        >Anda harus membuat
                                                        aturan di menu manajemen
                                                        aturan</Alert
                                                    >
                                                    <Option
                                                        v-for="(
                                                            role, index
                                                        ) in data"
                                                        :key="index"
                                                        :value="role.id"
                                                        >{{
                                                            role.roleName
                                                        }}</Option
                                                    >
                                                </Select>
                                            </div>
                                            <div slot="footer">
                                                <Button
                                                    type="default"
                                                    @click="batalModalAdmin"
                                                    >Batal</Button
                                                >
                                                <Button
                                                    type="primary"
                                                    @click="EditAdmin"
                                                    :loading="
                                                        isLoadingAdminBaru
                                                    "
                                                    :disabled="
                                                        isLoadingAdminBaru
                                                    "
                                                    >Edit admin</Button
                                                >
                                            </div>
                                        </Modal>
                                        <!-- Delete Modal -->
                                        <modalDeleteAdmin></modalDeleteAdmin>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body mt-5">
                    <h2 class="section-title">Manajemen aturan</h2>
                    <p class="section-lead">
                        Anda bisa membuat aturan sendiri pada aplikasi ini.
                    </p>

                    <div id="output-status"></div>

                    <div class="row">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="my-4">
                                    <Button @click="ModalTambahAturan = true"
                                        ><Icon type="ios-add" /> Tambah aturan
                                        baru
                                    </Button>
                                </div>
                                <div>
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered table-md text-center"
                                        >
                                            <tr>
                                                <th>#</th>
                                                <th>Nama aturan</th>
                                                <th>Dibuat pada</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr
                                                v-for="(role, index) in data"
                                                :key="index"
                                            >
                                                <td>#</td>
                                                <td>{{ role.roleName }}</td>
                                                <td>
                                                    {{ role.created_at }}
                                                </td>
                                                <td>
                                                    <div class="d-blog">
                                                        <Button
                                                            type="info"
                                                            size="small"
                                                            @click="
                                                                showModalEditAturan(
                                                                    role,
                                                                    index
                                                                )
                                                            "
                                                            >Edit</Button
                                                        >
                                                        <Button
                                                            type="error"
                                                            size="small"
                                                            @click="
                                                                showModalDelete(
                                                                    role,
                                                                    index
                                                                )
                                                            "
                                                            >Hapus</Button
                                                        >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="!data.length">
                                                <td></td>
                                                <td>
                                                    <Alert type="error"
                                                        >Sedang mencari data
                                                        atau data tidak
                                                        ditemukan.</Alert
                                                    >
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="float-left mt-2">
                                            <div class="float-right mt-4">
                                                <Page
                                                    :total="pageInfo.total"
                                                    :current="
                                                        pageInfo.current_page
                                                    "
                                                    :page-size="
                                                        parseInt(
                                                            pageInfo.per_page
                                                        )
                                                    "
                                                    prev-text="Previous"
                                                    next-text="Next"
                                                    v-if="pageInfo"
                                                    size="small"
                                                    @on-change="getBlogData"
                                                />
                                            </div>
                                        </div>
                                        <!-- tambah aturan -->
                                        <Modal
                                            v-model="ModalTambahAturan"
                                            title="Tambah aturan"
                                        >
                                            <div class="mt-3">
                                                <label>Nama aturan</label>
                                                <Input
                                                    type="text"
                                                    maxlength="20"
                                                    show-word-limit
                                                    v-model="aturan.nama_aturan"
                                                    placeholder="Masukan nama aturan"
                                                    clearable
                                                />
                                            </div>
                                            <div slot="footer">
                                                <Button
                                                    type="default"
                                                    @click="batalAturanBaru"
                                                    >Batal</Button
                                                >
                                                <Button
                                                    type="primary"
                                                    @click="tambahAturanBaru"
                                                    :loading="isLoading"
                                                    :disabled="isLoading"
                                                    >Tambah aturan</Button
                                                >
                                            </div>
                                        </Modal>
                                        <!-- edit aturan -->
                                        <Modal
                                            v-model="ModalEditAturan"
                                            title="Edit aturan"
                                        >
                                            <div class="mt-3">
                                                <label>Nama aturan</label>
                                                <Input
                                                    type="text"
                                                    maxlength="20"
                                                    show-word-limit
                                                    v-model="
                                                        editData.nama_aturan
                                                    "
                                                    placeholder="Masukan nama aturan"
                                                    clearable
                                                />
                                            </div>
                                            <div slot="footer">
                                                <Button
                                                    type="default"
                                                    @click="batalAturanBaru"
                                                    >Batal</Button
                                                >
                                                <Button
                                                    type="primary"
                                                    @click="editAturanBaru"
                                                    :loading="isLoading"
                                                    :disabled="isLoading"
                                                    >Simpan perubahan</Button
                                                >
                                            </div>
                                        </Modal>
                                        <!-- Delete Modal -->
                                        <modalDelete></modalDelete>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import modalDelete from "./components/deleteModal.vue";
import modalDeleteAdmin from "./components/deleteModalAdmin.vue";
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            data: [],
            aturan: {
                nama_aturan: "",
            },
            editData: {
                nama_aturan: "",
            },
            isLoading: false,
            ModalTambahAturan: false,
            ModalEditAturan: false,
            index: -9999,
            total: 6,
            pageInfo: null,
            ModalTambahAdmin: false,
            dataAdmin: [],
            admin: {
                nama: "",
                email: "",
                role_id: null,
            },
            isLoadingAdminBaru: false,
            editAdmin: {
                id: null,
                name: "",
                email: "",
                role_id: null,
            },
            ModalEditAdmin: false,
        };
    },
    methods: {
        // tambah aturan
        async tambahAturanBaru() {
            if (this.aturan.nama_aturan.trim() === "") {
                this.error("Masukan nama aturan");
            }
            this.isLoading = true;
            const res = await this.callApi(
                "post",
                "app/tambahAturan",
                this.aturan
            );
            if (res.status === 201) {
                this.data.unshift(res.data);
                this.ModalTambahAturan = false;
                this.aturan.nama_aturan = "";
                this.success("Aturan berhasil ditambah");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.ModalTambahAturan = false;
            this.aturan.nama_aturan = "";
            this.isLoading = false;
        },
        async showModalEditAturan(role, index) {
            let obj = {
                id: role.id,
                nama_aturan: role.roleName,
            };
            this.editData = obj;
            this.ModalEditAturan = true;
            this.index = index;
        },
        async editAturanBaru() {
            this.isLoading = true;
            const res = await this.callApi(
                "post",
                "app/editAturan",
                this.editData
            );
            if (res.status === 200) {
                this.ModalEditAturan = false;
                this.isLoading = false;
                this.data[this.index].roleName = this.editData.nama_aturan;
                this.success("Nama aturan berhasil di ubah");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.error[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isLoading = false;
            this.ModalEditAturan = false;
        },
        batalAturanBaru() {
            this.aturan.nama_aturan = "";
            this.editData.nama_aturan = "";
            this.ModalTambahAturan = false;
            this.ModalEditAturan = false;
        },
        showModalDelete(role, index) {
            const deleteModalObj = {
                tampilDeleteModalObj: true,
                deleteUrl: "app/deleteAturan",
                data: role,
                deletingIndex: index,
                isDeleting: false,
                msg: "Anda yakin ingin menghapus ini ?",
                msgSuccess: "Aturan berhasil dihapus",
            };
            this.$store.commit("setDeletingModalObj", deleteModalObj);
        },
        showModalDeleteAdmin(admin, index) {
            const deleteModalObj = {
                tampilDeleteModalObj: true,
                deleteUrl: "app/deleteAdmin",
                id: admin,
                deletingIndex: index,
                isDeleting: false,
                msg: "Anda yakin ingin menghapus ini ?",
                msgSuccess: "Admin berhasil dihapus",
            };
            this.$store.commit("setDeletingModalAdminObj", deleteModalObj);
        },
        async tambahAdminBaru() {
            if (this.admin.nama.trim() === "") {
                return this.error("Masukan nama");
            }
            if (this.admin.email.trim() === "") {
                return this.error("Masukan email");
            }
            if (!this.admin.role_id) {
                return this.error("Pilih satu satu aturan");
            }
            if (this.admin.password.trim() === "") {
                return this.error("Masukan password");
            }
            if (this.admin.password.length < 5) {
                return this.error("Password min 5 huruf/angka");
            }
            this.isLoadingAdminBaru = true;
            const res = await this.callApi(
                "post",
                "app/tambahAdminBaru",
                this.admin
            );
            if (res.status === 201) {
                this.dataAdmin.unshift(res.data);
                this.ModalTambahAdmin = false;
                this.admin.nama = "";
                this.admin.email = "";
                this.admin.role_id = null;
                this.admin.password = "";
                this.success("Admin baru berhasil ditambahkan");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isLoadingAdminBaru = false;
        },
        batalModalAdmin() {
            this.ModalTambahAdmin = false;
            this.admin.nama = "";
            this.admin.email = "";
            this.admin.password = "";
            this.admin.role_id = null;
        },
        async showEditModalAdmin(admin, index) {
            let obj = {
                id: admin.id,
                name: admin.name,
                email: admin.email,
                role_id: admin.role_id,
            };
            this.editAdmin = obj;
            this.index = index;
            this.ModalEditAdmin = true;
        },
        async EditAdmin() {
            if (this.editAdmin.name.trim() === "") {
                return this.error("Masukan nama");
            }
            if (this.editAdmin.email.trim() === "") {
                return this.error("Masukan email");
            }
            if (!this.editAdmin.role_id) {
                return this.error("Pilih salah satu aturan");
            }
            this.isLoadingAdminBaru = true;
            const res = await this.callApi(
                "post",
                "app/editAdmin",
                this.editAdmin
            );
            if (res.status === 200) {
                this.success("Admin berhasil di ubah");
                this.dataAdmin[this.index] = this.editAdmin;
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        return this.error(res.data.errors[i][0]);
                    }
                }
                this.swr();
            }
            this.ModalEditAdmin = false;
            this.isLoadingAdminBaru = false;
        },
        async getBlogData(page = 1) {
            const res = await this.callApi(
                "get",
                `app/tampilkanAturan?page=${page}&total=${this.total}`
            );
            this.pageInfo = res.data;
            if (res.status === 200) {
                this.data = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.swr();
            }
        },
        async getAdminData() {
            const res = await this.callApi("get", "app/tampilkanAdmin");
            if (res.status === 200) {
                this.dataAdmin = res.data;
            } else {
                this.swr();
            }
        },
    },
    async created() {
        this.getBlogData();
        this.getAdminData();
    },
    components: {
        modalDelete,
        modalDeleteAdmin,
    },
    computed: {
        ...mapGetters(["getDeleteModalObj", "getDeleteModalAdminObj"]),
    },
    watch: {
        async getDeleteModalObj(obj) {
            // hapus admin pada font end
            setTimeout(() => {
                let data = [];
                data = this.dataAdmin.filter((i) => i.role_id !== obj.data.id);
                this.dataAdmin = data;
            }, 4000);

            // hapus aturan pada font end
            if (obj.isDeleting) {
                this.data.splice(obj.deletingIndex, 1);
            }

            // hapus data admin pada database
            let semuaAdmin = [];
            semuaAdmin.push(this.dataAdmin);

            let hasilFilterSemuaAdmin = [];
            hasilFilterSemuaAdmin = semuaAdmin[0].filter(
                (admin) => admin.role_id === obj.data.id
            );
            let id = hasilFilterSemuaAdmin[0].role_id;
            const dataAdminYangInginDiHapus = {
                url: "app/deleteAdmin",
                id: id,
            };

            this.$store.commit(
                "setDataAdminYangInginDiHapus",
                dataAdminYangInginDiHapus
            );
        },
        getDeleteModalAdminObj(obj) {
            console.log("obj", obj);
            console.log("obj_deletingIndex", obj.deletingIndex);
            if (obj.isDeleting) {
                this.dataAdmin.splice(obj.deletingIndex, 1);
            }
        },
    },
};
</script>

<style>
.ivu-page-item-active {
    color: rgb(255, 153, 0);
}
</style>
