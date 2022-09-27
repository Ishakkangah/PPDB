<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>BIODATA ORANG TUA / WALI</h1>
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
                    <h2 class="section-title">Biodata orang tua / wali</h2>
                    <p class="section-lead">
                        Di form ini calon siswa di wajibkan untuk mengisi data
                        orang tua / wali yang valid dan benar, terimah kasih.
                    </p>

                    <div id="output-status"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>BIODATA AYAH</h4>
                                    <hr class="mb-4 mt-2" />
                                    <div>
                                        <label>Nama ayah</label>
                                        <Input
                                            type="text"
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.nama_ayah"
                                            placeholder="Masukan nama ayah"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Tanggal lahir</label>
                                        <Input
                                            type="date"
                                            v-model="data.tanggal_lahir_ayah"
                                            placeholder="Masukan tanggal lahir"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Perkerjaan</label>
                                        <Input
                                            type="text"
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.perkerjaan_ayah"
                                            placeholder="Masukan perkerjaan ayah"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>No ktp</label>
                                        <Input
                                            type="number"
                                            v-model="data.nomor_ktp_ayah"
                                            placeholder="~~ Optional ~~"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Agama</label>
                                        <Input
                                            type="text"
                                            maxlength="12"
                                            show-word-limit
                                            v-model="data.agama_ayah"
                                            placeholder="Masukan agama"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Alamat</label>
                                        <Input
                                            maxlength="40"
                                            show-word-limit
                                            v-model="data.alamat_ayah"
                                            type="textarea"
                                            placeholder="Masukan alamat"
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Pendidikan terakhir</label>
                                        <Input
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.pendidikan_ayah"
                                            placeholder="Masukan pendidikan terakhir"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>BIODATA IBU</h4>
                                    <hr class="mb-4 mt-2" />
                                    <div>
                                        <label>Nama ibu</label>
                                        <Input
                                            type="text"
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.nama_ibu"
                                            placeholder="Masukan nama ayah"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Tanggal lahir</label>
                                        <Input
                                            type="date"
                                            v-model="data.tanggal_lahir_ibu"
                                            placeholder="Masukan tanggal lahir"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Perkerjaan</label>
                                        <Input
                                            type="text"
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.perkerjaan_ibu"
                                            placeholder="Masukan perkerjaan ibu"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>No ktp</label>
                                        <Input
                                            type="number"
                                            v-model="data.nomor_ktp_ibu"
                                            placeholder="~~ Optional ~~"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Agama</label>
                                        <Input
                                            type="text"
                                            maxlength="12"
                                            show-word-limit
                                            v-model="data.agama_ibu"
                                            placeholder="Masukan agama"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Alamat</label>
                                        <Input
                                            maxlength="40"
                                            show-word-limit
                                            v-model="data.alamat_ibu"
                                            type="textarea"
                                            placeholder="Masukan alamat"
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Pendidikan terakhir</label>
                                        <Input
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.pendidikan_ibu"
                                            placeholder="Masukan pendidikan terakhir"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div
                                    class="card-footer bg-whitesmoke text-md-left"
                                >
                                    <Button
                                        type="primary"
                                        :loading="isAdding"
                                        :disabled="isAdding"
                                        @click="addDataWali"
                                        >{{
                                            isAdding
                                                ? "Sedang memproses.."
                                                : "Mendaftarkan sekarang"
                                        }}</Button
                                    >
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
export default {
    data() {
        return {
            data: {
                nama_ayah: "",
                tanggal_lahir_ayah: "",
                perkerjaan_ayah: "",
                nomor_ktp_ayah: null,
                agama_ayah: "",
                alamat_ayah: "",
                pendidikan_ayah: "",
                nama_ibu: "",
                tanggal_lahir_ibu: "",
                perkerjaan_ibu: "",
                nomor_ktp_ibu: null,
                agama_ibu: "",
                alamat_ibu: "",
                pendidikan_ibu: "",
            },
            isAdding: false,
        };
    },
    methods: {
        // Masukan biodata
        async addDataWali() {
            if (this.data.nama_ayah.trim() === "") {
                return this.error("Masukan nama ayah");
            }
            if (this.data.tanggal_lahir_ayah.trim() === "") {
                return this.error("Masukan tanggal lahir ayah");
            }
            if (this.data.perkerjaan_ayah.trim() === "") {
                return this.error("Masukan perkerjaan ayah");
            }
            if (!this.data.nomor_ktp_ayah) {
                return this.error("Masukan nomor ktp ayah");
            }
            if (this.data.agama_ayah.trim() === "") {
                return this.error("Masukan agama ayah");
            }
            if (this.data.alamat_ayah.trim() === "") {
                return this.error("Masukan alamat ayah");
            }
            if (this.data.pendidikan_ayah.trim() === "") {
                return this.error("Masukan pendidikan ayah");
            }
            // ibu
            if (this.data.nama_ibu.trim() === "") {
                return this.error("Masukan nama ibu");
            }
            if (this.data.tanggal_lahir_ibu.trim() === "") {
                return this.error("Masukan tanggal lahir ibu");
            }
            if (this.data.perkerjaan_ibu.trim() === "") {
                return this.error("Masukan perkerjaan ibu");
            }
            if (!this.data.nomor_ktp_ibu) {
                return this.error("Masukan nomor ktp ibu");
            }
            if (this.data.agama_ibu.trim() === "") {
                return this.error("Masukan agama ibu");
            }
            if (this.data.alamat_ibu.trim() === "") {
                return this.error("Masukan alamat ibu");
            }
            if (this.data.pendidikan_ibu.trim() === "") {
                return this.error("Masukan pendidikan ibu");
            }
            this.isAdding = true;
            const res = await this.callApi(
                "Post",
                "app/addDataWali",
                this.data
            );
            console.log("this is data wali", res);
            if (res.status === 200) {
                this.success("Data berhasil dikirim");
                this.isAdding = false;
                this.$router.push("/pendaptaran_berhasil");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                }
                this.swr();
            }
            this.data.nama_ayah = "";
            this.data.tanggal_lahir_ayah = "";
            this.data.perkerjaan_ayah = "";
            this.data.nomor_ktp_ayah = null;
            this.data.agama_ayah = "";
            this.data.alamat_ayah = "";
            this.data.pendidikan_ayah = "";
            this.data.nama_ibu = "";
            this.data.tanggal_lahir_ibu = "";
            this.data.perkerjaan_ibu = "";
            this.data.nomor_ktp_ibu = null;
            this.data.agama_ibu = "";
            this.data.alamat_ibu = "";
            this.data.pendidikan_ibu = "";
            this.isAdding = false;
        },
    },

    async created() {
        this.token = window.Laravel.csrfToken;
    },
};
</script>
