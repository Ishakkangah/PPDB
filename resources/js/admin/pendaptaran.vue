<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>PENDAFTARAN SMK NEGERI 1 KAYUAGUNG</h1>
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
                    <h2 class="section-title">
                        Form penerimaan peserta didik baru
                    </h2>
                    <p class="section-lead">
                        Di form ini calon siswa di wajibkan untuk mengisi data
                        terima kasih.
                    </p>

                    <div id="output-status"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>BIODATA</h4>
                                    <hr class="mb-4 mt-2" />
                                    <div>
                                        <label>Nama</label>
                                        <Input
                                            type="text"
                                            maxlength="25"
                                            show-word-limit
                                            v-model="data.nama"
                                            placeholder="Masukan nama"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Asal sekolah</label>
                                        <Input
                                            type="text"
                                            maxlength="50"
                                            show-word-limit
                                            v-model="data.asal_sekolah"
                                            placeholder="Masukan asal sekolah"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Jenis kelamin</label>
                                        <Select
                                            v-model="data.jenis_kelamin"
                                            placeholder="Pilih jenis kelamin"
                                        >
                                            <Option
                                                v-for="item in jenis_kelamins"
                                                :value="item.name"
                                                :key="item.value"
                                                >{{ item.name }}</Option
                                            >
                                        </Select>
                                    </div>
                                    <div class="mt-3">
                                        <label>Tanggal lahir</label>
                                        <Input
                                            type="date"
                                            v-model="data.tanggal_lahir"
                                            placeholder="Masukan tanggal lahir"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Agama</label>
                                        <Input
                                            type="text"
                                            maxlength="12"
                                            show-word-limit
                                            v-model="data.agama"
                                            placeholder="Masukan agama"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Alamat</label>
                                        <Input
                                            maxlength="40"
                                            show-word-limit
                                            v-model="data.alamat"
                                            type="textarea"
                                            placeholder="Masukan alamat"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>NILAI</h4>
                                    <hr class="mb-4 mt-2" />
                                    <div class="mt-3">
                                        <label>NISN</label>
                                        <Input
                                            type="number"
                                            v-model="data.nisn"
                                            placeholder="Masukan Nomor NISN"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Bahasa Indonesia</label>
                                        <Input
                                            maxlength="2"
                                            type="number"
                                            show-word-limit
                                            v-model="data.b_indonesia"
                                            placeholder="Masukan nilai"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Matematika</label>
                                        <Input
                                            type="number"
                                            maxlength="2"
                                            show-word-limit
                                            v-model="data.matematika"
                                            placeholder="Masukan nilai"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>Bahasa Inggris</label>
                                        <Input
                                            type="number"
                                            maxlength="2"
                                            show-word-limit
                                            v-model="data.b_inggris"
                                            placeholder="Masukan nilai"
                                            clearable
                                        />
                                    </div>
                                    <div class="mt-3">
                                        <label>IPA</label>
                                        <Input
                                            type="number"
                                            maxlength="2"
                                            show-word-limit
                                            v-model="data.ipa"
                                            placeholder="Masukan nilai"
                                            clearable
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>BERKAS</h4>
                                    <hr class="mb-4 mt-2" />
                                    <!-- Upload profile -->
                                    <div class="mt-3">
                                        <label
                                            >Upload photo (JPEG|JPG|PNG)</label
                                        >
                                        <Upload
                                            v-show="issAddImage"
                                            ref="upload"
                                            :headers="{
                                                'x-csrf-token': token,
                                                'X-Requested-With':
                                                    'XMLHttpRequest',
                                            }"
                                            :max-size="2048"
                                            :format="['jpg', 'jpeg', 'png']"
                                            :on-success="handleSuccessPhoto"
                                            :on-error="handleError"
                                            :on-format-error="handleFormatError"
                                            :on-exceeded-size="handleMaxSize"
                                            type="drag"
                                            action="/app/uploadPhotoProfile"
                                        >
                                            <div style="padding: 20px 0">
                                                <Icon
                                                    type="ios-cloud-upload"
                                                    size="52"
                                                    style="color: #3399ff"
                                                ></Icon>
                                                <p>
                                                    Pastikan poto anda di upload
                                                    disini!
                                                </p>
                                            </div>
                                        </Upload>
                                    </div>
                                    <div
                                        class="demo-upload-list"
                                        v-if="data.photo"
                                    >
                                        <img
                                            :src="`/uploadProfile/${data.photo}`"
                                        />
                                        <div class="demo-upload-list-cover">
                                            <Icon
                                                type="ios-trash-outline"
                                                @click="deleteImage"
                                            ></Icon>
                                        </div>
                                    </div>
                                    <!-- Upload Ijazah -->
                                    <div class="mt-3">
                                        <label
                                            >Upload Ijazah / SKHU
                                            (JPEG|JPG|PNG)</label
                                        >
                                        <Upload
                                            v-show="issAddIjazah"
                                            ref="uploadIjazah"
                                            :headers="{
                                                'x-csrf-token': token,
                                                'X-Requested-With':
                                                    'XMLHttpRequest',
                                            }"
                                            :max-size="2048"
                                            :format="['jpg', 'jpeg', 'png']"
                                            :on-success="handleSuccessIjazah"
                                            :on-error="handleErrorIjazah"
                                            :on-format-error="
                                                handleFormatErrorIjazah
                                            "
                                            :on-exceeded-size="
                                                handleMaxSizeIjazah
                                            "
                                            type="drag"
                                            action="/app/uploadIjazah"
                                        >
                                            <div style="padding: 20px 0">
                                                <Icon
                                                    type="ios-cloud-upload"
                                                    size="52"
                                                    style="color: #3399ff"
                                                ></Icon>
                                                <p>
                                                    Pastikan Ijazah / SKHU anda
                                                    di upload disini!
                                                </p>
                                            </div>
                                        </Upload>
                                    </div>
                                    <div
                                        class="demo-upload-list"
                                        v-if="data.ijazah"
                                    >
                                        <iframe
                                            :src="`/uploadIjazah/${data.ijazah}`"
                                        />
                                        <div class="demo-upload-list-cover">
                                            <Icon
                                                type="ios-trash-outline"
                                                @click="deleteIjazah"
                                            ></Icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>BERKAS</h4>
                                    <hr class="mb-4 mt-2" />
                                    <!-- Upload Kartu keluarga -->
                                    <div class="mt-3">
                                        <label
                                            >Upload Kartu keluarga
                                            (JPEG|JPG|PNG)</label
                                        >
                                        <Upload
                                            v-show="issAddKartuKeluarga"
                                            ref="uploadKartuKeluarga"
                                            :headers="{
                                                'x-csrf-token': token,
                                                'X-Requested-With':
                                                    'XMLHttpRequest',
                                            }"
                                            :max-size="2048"
                                            :format="['jpg', 'jpeg', 'png']"
                                            :on-success="
                                                handleSuccessKartuKeluarga
                                            "
                                            :on-error="handleErrorKartuKeluarga"
                                            :on-format-error="
                                                handleFormatErrorKartuKeluarga
                                            "
                                            :on-exceeded-size="
                                                handleMaxSizeKartuKeluarga
                                            "
                                            type="drag"
                                            action="/app/uploadKartuKeluarga"
                                        >
                                            <div style="padding: 20px 0">
                                                <Icon
                                                    type="ios-cloud-upload"
                                                    size="52"
                                                    style="color: #3399ff"
                                                ></Icon>
                                                <p>
                                                    Pastikan kartu keluarga anda
                                                    di upload disini!
                                                </p>
                                            </div>
                                        </Upload>
                                    </div>
                                    <div
                                        class="demo-upload-list"
                                        v-if="data.kartu_keluarga"
                                    >
                                        <iframe
                                            :src="`/uploadKartuKeluarga/${data.kartu_keluarga}`"
                                        />
                                        <div class="demo-upload-list-cover">
                                            <Icon
                                                type="ios-trash-outline"
                                                @click="deleteKartuKeluarga"
                                            ></Icon>
                                        </div>
                                    </div>
                                    <!-- Upload Akta Kelahiran -->
                                    <div class="mt-3">
                                        <label
                                            >Upload Akta Kelahiran
                                            (JPEG|JPG|PNG)</label
                                        >
                                        <Upload
                                            v-show="issAddAktaKelahiran"
                                            ref="uploadAktaKelahiran"
                                            :headers="{
                                                'x-csrf-token': token,
                                                'X-Requested-With':
                                                    'XMLHttpRequest',
                                            }"
                                            :max-size="2048"
                                            :format="['jpg', 'jpeg', 'png']"
                                            :on-success="
                                                handleSuccessAktaKelahiran
                                            "
                                            :on-error="handleErrorAktaKelahiran"
                                            :on-format-error="
                                                handleFormatErrorAktaKelahiran
                                            "
                                            :on-exceeded-size="
                                                handleMaxSizeAktaKelahiran
                                            "
                                            type="drag"
                                            action="/app/uploadAktaKelahiran"
                                        >
                                            <div style="padding: 20px 0">
                                                <Icon
                                                    type="ios-cloud-upload"
                                                    size="52"
                                                    style="color: #3399ff"
                                                ></Icon>
                                                <p>
                                                    Pastikan akta kelahiran anda
                                                    di upload disini!
                                                </p>
                                            </div>
                                        </Upload>
                                    </div>
                                    <div
                                        class="demo-upload-list"
                                        v-if="data.akta_kelahiran"
                                    >
                                        <iframe
                                            :src="`/uploadAktaKelahiran/${data.akta_kelahiran}`"
                                        />
                                        <div class="demo-upload-list-cover">
                                            <Icon
                                                type="ios-trash-outline"
                                                @click="deleteAktaKelahiran"
                                            ></Icon>
                                        </div>
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
                                        @click="addBiodata"
                                        >{{
                                            isAdding
                                                ? "Sedang memproses.."
                                                : "Mendaftar"
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
                nama: "",
                asal_sekolah: "",
                jenis_kelamin: "",
                tanggal_lahir: "",
                agama: "",
                alamat: "",
                nisn: null,
                b_indonesia: null,
                matematika: null,
                b_inggris: null,
                ipa: null,
                photo: "",
                kartu_keluarga: "",
                akta_kelahiran: "",
                ijazah: "",
            },
            jenis_kelamins: [
                {
                    name: "laki-laki",
                    value: "laki-laki",
                },
                {
                    name: "perempuan",
                    value: "perempuan",
                },
            ],
            isAdding: false,
            isIconImageNew: false,
            token: "",
            issAddImage: true,
            issAddIjazah: true,
            issAddKartuKeluarga: true,
            issAddAktaKelahiran: true,
        };
    },
    methods: {
        // Masukan biodata
        async addBiodata() {
            if (this.data.nama.trim() === "") {
                return this.error("Masukan nama");
            }
            if (this.data.asal_sekolah.trim() === "") {
                return this.error("Masukan asal sekolah");
            }
            if (this.data.jenis_kelamin.trim() === "") {
                return this.error("Masukan jenis kelamin");
            }
            if (this.data.tanggal_lahir.trim() === "") {
                return this.error("Masukan tanggal lahir");
            }
            if (this.data.agama.trim() === "") {
                return this.error("Masukan agama");
            }
            if (this.data.alamat.trim() === "") {
                return this.error("Masukan alamat");
            }
            if (!this.data.nisn) {
                return this.error("Masukan nisn anda");
            }
            if (!this.data.b_indonesia) {
                return this.error("Masukan nilai bahasa indonesia anda");
            }
            if (!this.data.matematika) {
                return this.error("Masukan nilai bahasa matematika anda");
            }
            if (!this.data.b_inggris) {
                return this.error("Masukan nilai bahasa inggris anda");
            }
            if (!this.data.ipa) {
                return this.error("Masukan nilai IPA anda");
            }
            if (this.data.photo.trim() === "") {
                return this.error("Masukan photo asli anda");
            }
            if (this.data.kartu_keluarga.trim() === "") {
                return this.error("Masukan kartu_keluarga anda");
            }
            if (this.data.akta_kelahiran.trim() === "") {
                return this.error("Masukan akta kelahiran anda");
            }
            if (this.data.ijazah.trim() === "") {
                return this.error("Masukan ijazah anda");
            }
            this.isAdding = true;
            const res = await this.callApi("Post", "app/addBiodata", this.data);
            console.log("this is res", res);
            if (res.status === 200) {
                this.success("Data berhasil dikirim");
                this.isAdding = false;
                this.$router.push("/isi_data_wali");
            } else {
                if (res.status === 502) {
                    this.info(res.data.msg);
                } else if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                }
            }
            this.data.nama = "";
            this.data.asal_sekolah = "";
            this.data.jenis_kelamin = "";
            this.data.tanggal_lahir = "";
            this.data.alamat = "";
            this.data.agama = "";
            this.data.nisn = null;
            this.data.b_indonesia = null;
            this.data.b_inggris = null;
            this.data.matematika = null;
            this.data.ipa = null;
            this.data.photo = "";
            this.data.kartu_keluarga = "";
            this.data.ijazah = "";
            this.data.akta_kelahiran = "";
            this.issAddImage = true;
            this.issAddIjazah = true;
            this.issAddKartuKeluarga = true;
            this.issAddAktaKelahiran = true;
            this.$refs.upload.clearFiles();
            this.$refs.uploadIjazah.clearFiles();
            this.$refs.uploadKartuKeluarga.clearFiles();
            this.$refs.uploadAktaKelahiran.clearFiles();
            this.isAdding = false;
        },
        // upload photo success
        handleSuccessPhoto(res, file) {
            this.issAddImage = false;
            this.data.photo = res;
        },
        // handle error
        handleError(res, file) {
            this.$Notice.warning({
                title: "the file format is wrong!",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something want wrong!"
                }`,
            });
        },
        // handle format error
        handleFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select JPEG or PNG.",
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
        async deleteImage() {
            this.issAddImage = true;
            let image;
            image = this.data.photo;
            this.data.photo = "";
            this.$refs.upload.clearFiles();
            const response = await this.callApi("post", "app/deleteImage", {
                photo: image,
            });
            if (response.status !== 200) {
                this.data.photo = image;
                this.swr();
            }
        },

        // upload Ijazah success
        handleSuccessIjazah(res, file) {
            this.issAddIjazah = false;
            this.data.ijazah = res;
        },
        // handle error ijazah
        handleErrorIjazah(res, file) {
            this.$Notice.warning({
                title: "the file format is wrong!",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something want wrong!"
                }`,
            });
        },
        // handle format error ijazah
        handleFormatErrorIjazah(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select PDF.",
            });
        },
        // handle size ijazah
        handleMaxSizeIjazah(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
        // delete ijazah
        async deleteIjazah() {
            this.issAddIjazah = true;
            let ijazah;
            ijazah = this.data.ijazah;
            this.data.ijazah = "";
            this.$refs.uploadIjazah.clearFiles();
            const response = await this.callApi("post", "app/deleteIjazah", {
                ijazah: ijazah,
            });
            if (response.status !== 200) {
                this.data.ijazah = ijazah;
                this.swr();
            }
        },

        // upload Kartu kelurga success
        handleSuccessKartuKeluarga(res, file) {
            this.issAddKartuKeluarga = false;
            this.data.kartu_keluarga = res;
        },
        // handle error kartu keluarga
        handleErrorKartuKeluarga(res, file) {
            this.$Notice.warning({
                title: "the file format is wrong!",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something want wrong!"
                }`,
            });
        },
        // handle format error kartu keluarga
        handleFormatErrorKartuKeluarga(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select PDF.",
            });
        },
        // handle size kartu keluarga
        handleMaxSizeKartuKeluarga(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
        // delete kartu keluarga
        async deleteKartuKeluarga() {
            this.issAddKartuKeluarga = true;
            let Kartu_Keluarga;
            Kartu_Keluarga = this.data.kartu_keluarga;
            this.data.kartu_keluarga = "";
            this.$refs.uploadKartuKeluarga.clearFiles();
            const response = await this.callApi(
                "post",
                "app/deleteKartuKeluarga",
                {
                    Kartu_Keluarga: Kartu_Keluarga,
                }
            );
            if (response.status !== 200) {
                this.data.kartu_keluarga = Kartu_Keluarga;
                this.swr();
            }
        },

        // upload akta kelahiran success
        handleSuccessAktaKelahiran(res, file) {
            this.issAddAktaKelahiran = false;
            this.data.akta_kelahiran = res;
        },
        // handle error akta kelahiran
        handleErrorAktaKelahiran(res, file) {
            this.$Notice.warning({
                title: "the file format is wrong!",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something want wrong!"
                }`,
            });
        },
        // handle format error akta kelahiran
        handleFormatErrorAktaKelahiran(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select PDF.",
            });
        },
        // handle size akta kelahiran
        handleMaxSizeAktaKelahiran(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },
        // delete akta kelahiran
        async deleteAktaKelahiran() {
            this.issAddAktaKelahiran = true;
            let Akta_Kelahiran;
            Akta_Kelahiran = this.data.akta_kelahiran;
            this.data.akta_kelahiran = "";
            this.$refs.uploadAktaKelahiran.clearFiles();
            const response = await this.callApi(
                "post",
                "app/deleteAktaKelahiran",
                {
                    Akta_Kelahiran: Akta_Kelahiran,
                }
            );
            if (response.status !== 200) {
                this.data.akta_kelahiran = Akta_Kelahiran;
                this.swr();
            }
        },
    },

    created() {
        this.token = window.Laravel.csrfToken;
    },
};
</script>

<style>
.demo-upload-list {
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    border: 1px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    margin-right: 4px;
}
.demo-upload-list img {
    width: 100%;
    height: 100%;
}
.demo-upload-list-cover {
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.6);
}
.demo-upload-list:hover .demo-upload-list-cover {
    display: block;
}
.demo-upload-list-cover i {
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
}
</style>
