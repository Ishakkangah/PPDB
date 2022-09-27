<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>TAG</h1>
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
                    <h2 class="section-title">Tag</h2>
                    <p class="section-lead">Anda bisa membuat tag baru.</p>

                    <div class="mt-4">
                        <p>
                            Tag
                            <Button @click="modalTambahTag = true"
                                ><Icon type="ios-add" /> Tambah tag baru
                            </Button>
                        </p>
                        <div class="clearfix mb-3"></div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-md text-center"
                            >
                                <tr>
                                    <th>ID</th>
                                    <th>Nama tag</th>
                                    <th>Dibuat pada</th>
                                    <th>Actions</th>
                                </tr>
                                <tr
                                    v-for="(d, index) in data"
                                    :key="index"
                                    v-if="data.length"
                                >
                                    <td>#</td>
                                    <td>{{ d.tagName }}</td>
                                    <td>{{ d.created_at }}</td>
                                    <td>
                                        <Button
                                            type="info"
                                            size="small"
                                            @click="showModalEditTag(d, index)"
                                            >Edit</Button
                                        >
                                        <Button
                                            type="error"
                                            size="small"
                                            @click="
                                                showModalDeleteTag(d.id, index)
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
                                    @on-change="tampilSemuaDataTag"
                                />
                            </div>
                        </div>
                    </div>

                    <div id="output-status"></div>
                </div>
                <!-- tambah tag -->
                <Modal v-model="modalTambahTag" title="Tambah tag baru">
                    <div class="mt-3">
                        <label>Nama tag</label>
                        <Input
                            type="text"
                            maxlength="40"
                            v-model="tag.tagName"
                            show-word-limit
                            placeholder="Masukan nama tag"
                            clearable
                        />
                    </div>
                    <div slot="footer">
                        <Button type="default" @click="closeTag">Batal</Button>
                        <Button
                            type="primary"
                            @click="tambahTagBaru"
                            :isLoading="isAddTambahTag"
                            :disabled="isAddTambahTag"
                            >{{
                                isAddTambahTag ? "Proses.." : "Tambah tag"
                            }}</Button
                        >
                    </div>
                </Modal>
                <!-- Edit tag -->
                <Modal v-model="modalEditTag" title="Edit tag">
                    <div class="mt-3">
                        <label>Nama tag</label>
                        <Input
                            type="text"
                            maxlength="40"
                            v-model="editTag.tagName"
                            show-word-limit
                            placeholder="Masukan nama tag"
                            clearable
                        />
                    </div>
                    <div slot="footer">
                        <Button type="default" @click="closeTag">Batal</Button>
                        <Button
                            type="primary"
                            @click="edittagName"
                            :isLoading="isEditTag"
                            :disabled="isEditTag"
                            >{{ isEditTag ? "Proses.." : "Edit tag" }}</Button
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
            tag: {
                tagName: "",
            },
            modalTambahTag: false,
            modalEditTag: false,
            isAddTambahTag: false,
            editTag: {
                id: null,
                tagName: "",
            },
            index: -9999,
            isEditTag: false,
            total: 10,
            pageInfo: null,
        };
    },
    methods: {
        async tambahTagBaru() {
            if (this.tag.tagName.trim() === "") {
                return this.error("Masukan tag");
            }
            this.isAddTambahTag = true;
            const res = await this.callApi(
                "post",
                "app/tambahTagBaru",
                this.tag
            );
            if (res.status === 201) {
                this.data.unshift(res.data);
                this.success("Tag baru berhasil ditambah");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.tag.tagName = "";
            this.isAddTambahTag = false;
            this.modalTambahTag = false;
        },
        // close
        closeTag() {
            this.modalTambahTag = false;
            this.tag.tagName = "";
            this.editTag = "";
            this.modalEditTag = false;
        },
        // delete tag
        showModalDeleteTag(d, index) {
            const deleteModalObj = {
                tampilDeleteModalObj: true,
                deleteUrl: "app/deleteTag",
                id: d,
                deletingIndex: index,
                isDeleting: false,
                msg: "Anda yakin ingin menghapus ini ?",
                msgSuccess: "tag berhasil dihapus",
            };
            this.$store.commit("setDeletingModalAdminObj", deleteModalObj);
        },
        // edit tag
        showModalEditTag(d, index) {
            let obj = {
                id: d.id,
                tagName: d.tagName,
            };
            this.editTag = obj;
            this.index = index;
            this.modalEditTag = true;
        },
        async edittagName() {
            if (this.editTag.tagName.trim() === "") {
                return this.error("Masukan tag");
            }
            this.isEditTag = true;
            const res = await this.callApi("post", "app/editTag", this.editTag);
            if (res.status === 200) {
                this.data[this.index] = this.editTag;
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
            this.isEditTag = false;
            this.modalEditTag = false;
        },
        async tampilSemuaDataTag(page = 1) {
            const response = await this.callApi(
                "get",
                `app/tampilSemuaDataTag?page=${page}&total=${this.total}`
            );
            console.log("response.", response);
            this.pageInfo = response.data;
            if (response.status === 200) {
                this.data = response.data.data;
                this.pageInfo = response.data;
            } else {
                this.swr();
            }
        },
    },

    // get all tag
    async created() {
        this.tampilSemuaDataTag();
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
