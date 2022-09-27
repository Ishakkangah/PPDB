<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>PROFIL CALON SISWA</h1>
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
                    <h2 class="section-title">Profil</h2>
                    <p class="section-lead">
                        Profil lengkap calon siswa smk negeri kayuagung.
                    </p>

                    <div id="output-status"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div style="text-align: center">
                                                    <img
                                                        v-for="(
                                                            f, index
                                                        ) in file"
                                                        :key="index"
                                                        :src="`${
                                                            f.id ===
                                                            data.file_id
                                                                ? f.photo
                                                                : ''
                                                        }`"
                                                        style="width: 320px"
                                                    />
                                                    <h3>
                                                        {{ data.nama }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td>{{ data.nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal lahir</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ data.tanggal_lahir }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis kelamin</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ data.jenis_kelamin }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Agama</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ data.agama }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>
                                                        {{ data.alamat }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nilai rata-rata</td>
                                                    <td>:</td>
                                                    <td>
                                                        <p
                                                            class="fw-bold"
                                                            v-for="(
                                                                f, index
                                                            ) in file"
                                                            :key="index"
                                                        >
                                                            {{
                                                                data.file_id ===
                                                                f.id
                                                                    ? f.nilai_rapot
                                                                    : null
                                                            }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center" class="mt-0">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <img
                                                v-for="(f, index) in file"
                                                :key="index"
                                                :src="`${
                                                    data.file_id === f.id
                                                        ? f.ijazah
                                                        : ''
                                                }`"
                                                width="90%"
                                            />
                                            <p>Ijazah</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <img
                                                v-for="(f, index) in file"
                                                :key="index"
                                                :src="`${
                                                    data.file_id === f.id
                                                        ? f.akta_kelahiran
                                                        : ''
                                                }`"
                                                width="90%"
                                            />
                                            <p>Akta kelahiran</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <img
                                                v-for="(f, index) in file"
                                                :key="index"
                                                :src="`${
                                                    data.file_id === f.id
                                                        ? f.kartu_keluarga
                                                        : ''
                                                }`"
                                                width="90%"
                                            />
                                            <p>Kartu keluarga</p>
                                        </div>
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
            data: {},
            file: [],
        };
    },
    methods: {},

    async created() {
        const id = parseInt(this.$route.params.id);
        const [res, file] = await Promise.all([
            this.callApi("get", `/app/detailCalonSiswa/${id}`),
            this.callApi("get", "/app/getFile"),
        ]);
        this.data = res.data;
        this.file = file.data;
        console.log("ini data:", this.data);
        console.log("ini file:", this.file);
    },
};
</script>

<style></style>
