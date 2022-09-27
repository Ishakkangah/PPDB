<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>PENGATURAN</h1>
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
                    <h2 class="section-title">Pengaturan umum</h2>
                    <p class="section-lead">
                        Anda bisa mengatur batas umur dan batas pendaptaran
                        disini.
                    </p>

                    <div id="output-status"></div>
                    <div class="row">
                        <div class="col-md-8">
                            <form id="setting-form">
                                <div class="card" id="settings-card">
                                    <div class="card-body">
                                        <div
                                            class="form-group row align-items-center"
                                        >
                                            <label
                                                for="site-title"
                                                class="form-control-label col-sm-3 text-md-right"
                                                >Batas pendaftaran</label
                                            >
                                            <div class="col-sm-6 col-md-9">
                                                <Input
                                                    v-model="
                                                        data.batas_pendaptaran
                                                    "
                                                    type="date"
                                                    placeholder="Batas pendaptaran"
                                                    clearable
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="form-group row align-items-center"
                                        >
                                            <label
                                                for="site-description"
                                                class="form-control-label col-sm-3 text-md-right"
                                                >Batas umur</label
                                            >
                                            <div class="col-sm-6 col-md-9">
                                                <Input
                                                    v-model="data.batas_umur"
                                                    type="date"
                                                    placeholder="Batas umur"
                                                    clearable
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="card-footer bg-whitesmoke text-md-right"
                                    >
                                        <Button
                                            type="primary"
                                            @click="sampanPengaturan"
                                            :loading="isLoadingPengaturanUmum"
                                            :disabled="isLoadingPengaturanUmum"
                                        >
                                            Simpan perubahan
                                        </Button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-body">
                    <h2 class="section-title">Pengaturan khusus</h2>
                    <p class="section-lead">
                        Anda bisa mengatur siapa saja yang bisa mengakses menu
                        yang di izinkan.
                    </p>

                    <div id="output-status"></div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Buat aturan khusus</h4>
                                </div>
                                <div class="card-body">
                                    <p class="_title0 mb-3">
                                        Aturan
                                        <Select
                                            v-model="role.id"
                                            style="width: 150px"
                                            placeholder="Select"
                                            @on-change="changeAdmin"
                                        >
                                            <Option
                                                v-for="(role, index) in roles"
                                                :key="index"
                                                :value="role.id"
                                                >{{ role.roleName }}</Option
                                            >
                                        </Select>
                                    </p>
                                    <table
                                        class="table table-bordered table-md"
                                    >
                                        <tr>
                                            <th>#</th>
                                            <th>Nama menu</th>
                                            <th>Lihat</th>
                                            <th>Tambah</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                        <tr
                                            v-for="(r, index) in resources"
                                            :key="index"
                                        >
                                            <td>#</td>
                                            <td>
                                                {{ r.nama }}
                                            </td>
                                            <td>
                                                <Checkbox
                                                    v-model="r.lihat"
                                                    border
                                                ></Checkbox>
                                            </td>
                                            <td>
                                                <Checkbox
                                                    border
                                                    v-model="r.tambah"
                                                ></Checkbox>
                                            </td>
                                            <td>
                                                <Checkbox
                                                    border
                                                    v-model="r.edit"
                                                ></Checkbox>
                                            </td>
                                            <td>
                                                <Checkbox
                                                    border
                                                    v-model="r.hapus"
                                                ></Checkbox>
                                            </td>
                                        </tr>
                                    </table>
                                    <div
                                        class="card-footer bg-whitesmoke text-md-right"
                                    >
                                        <Button
                                            type="primary"
                                            @click="assignRole"
                                            :loading="isLoadingPengaturanKhusus"
                                            :disabled="
                                                isLoadingPengaturanKhusus
                                            "
                                        >
                                            Simpan perubahan
                                        </Button>
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
export default {
    data() {
        return {
            data: {
                batas_umur: "",
                batas_pendaptaran: "",
            },
            role: {
                id: null,
            },
            roles: [],
            isLoading: false,
            resources: [
                {
                    nama: "Home",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "/",
                    icon: "ios-home-outline",
                },
                {
                    nama: "Pendaptaran",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "pendaptaran",
                    icon: "ios-contact",
                },
                {
                    nama: "Isi data wali",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "isi_data_wali",
                    icon: "md-desktop",
                },
                {
                    nama: "Data Pedaftaran",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "monitoring",
                    icon: "md-desktop",
                },
                {
                    nama: "Data Halaman web",
                    lhat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "data_Halaman_web",
                    icon: "md-desktop",
                },
                {
                    nama: "Pengaturan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "pengaturan",
                    icon: "ios-settings",
                },
                {
                    nama: "Manajemen_aturan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "manajemen_aturan",
                    icon: "ios-people",
                },
                {
                    nama: "Laporan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "laporan",
                    icon: "ios-paper-outline",
                },
            ],
            defaultResources: [
                {
                    nama: "Home",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "/",
                    icon: "ios-home-outline",
                },
                {
                    nama: "Pendaptaran",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "pendaptaran",
                    icon: "ios-contact",
                },
                {
                    nama: "Isi data wali",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "isi_data_wali",
                    icon: "md-desktop",
                },
                {
                    nama: "Data Pedaftaran",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "monitoring",
                    icon: "md-desktop",
                },
                {
                    nama: "Data Halaman web",
                    lhat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "data_Halaman_web",
                    icon: "md-desktop",
                },
                {
                    nama: "Pengaturan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "pengaturan",
                    icon: "ios-settings",
                },
                {
                    nama: "Manajemen_aturan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "manajemen_aturan",
                    icon: "ios-people",
                },
                {
                    nama: "Laporan ",
                    lihat: false,
                    tambah: false,
                    edit: false,
                    hapus: false,
                    name: "laporan",
                    icon: "ios-paper-outline",
                },
            ],
            isLoadingPengaturanUmum: false,
            isLoadingPengaturanKhusus: false,
        };
    },
    methods: {
        async sampanPengaturan() {
            this.isLoadingPengaturanUmum = true;
            const res = await this.callApi(
                "post",
                "app/simpanPengaturan",
                this.data
            );
            if (res.status === 200) {
                this.isLoadingPengaturanUmum = false;
                this.success("pengaturan berhasil");
            } else {
                if (res.status === 422) {
                    for (let i in res.status.data) {
                        this.error(res.error.data[i][0]);
                    }
                }
                this.swr();
            }
            this.isLoadingPengaturanUmum = false;
        },
        async assignRole() {
            this.isLoadingPengaturanKhusus = true;
            // ubah data pada this.resouces menjadi JSON.stringify
            let data = JSON.stringify(this.resources);
            // kemudian variable data dikirim ke ajax
            const res = await this.callApi("post", "app/assignRole", {
                id: this.role.id,
                permissions: data,
            });
            if (res.status === 200) {
                this.isLoadingPengaturanKhusus = false;
                this.success("Aturan berhasil di ubah");
                let index = this.roles.findIndex(
                    (role) => role.id === this.role.id
                );
                this.roles[index].permission = data;
            } else {
                if (res.data.errors) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isLoadingPengaturanKhusus = false;
        },
        async changeAdmin() {
            // Temukan index dari array roles
            let index = this.roles.findIndex(
                (role) => role.id === this.role.id
            );
            let permission = this.roles[index].permissions;
            // Jika permission tidak ada data nya maka variable this.resources di isi variable this.defaultResources
            if (!permission) {
                this.resources = this.defaultResources;
            } else {
                this.resources = JSON.parse(permission);
            }
        },
    },

    async created() {
        const [res, roles] = await Promise.all([
            this.callApi("get", "app/tampilkanTanggalPengaturan"),
            this.callApi("get", "app/tampilkanAturanUntukPengaturan"),
        ]);
        if (res.status === 200) {
            console.log("roles:", roles);
            this.data = res.data;
            this.roles = roles.data;
            // Jika roles ada isi nya maka masukan ke variable this.role.id
            if (roles.data.length) {
                this.role.id = roles.data[0].id;
                // Jika roles ada permissions
                if (roles.data[0].permissions) {
                    this.resources = JSON.parse(roles.data[0].permissions);
                }
            }
        } else {
            this.swr();
        }
    },
};
</script>
