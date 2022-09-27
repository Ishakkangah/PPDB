<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>LAPORAN</h1>
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
                    <h2 class="section-title">Laporan PDF</h2>
                    <p class="section-lead">
                        Daptar peserta calon peserta didik baru yang telah di
                        terima
                    </p>

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA</th>
                                        <th>ASAL SEKOLAH</th>
                                        <th>JENIS KELAMIN</th>
                                    </tr>
                                    <tr v-for="(d, index) in data" :key="index">
                                        <td>{{ ++index }}</td>
                                        <td>{{ d.nama }}</td>
                                        <td>{{ d.asal_sekolah }}</td>
                                        <td>{{ d.jenis_kelamin }}</td>
                                    </tr>
                                </table>
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
            data: [],
        };
    },

    async created() {
        const res = await this.callApi("get", "app/lihat_laporan_pdf");
        if (res.status === 200) {
            console.log("res", res);
            this.data = res.data;
        } else {
            this.swr();
        }
    },
};
</script>
