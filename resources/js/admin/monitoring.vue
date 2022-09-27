<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>MONITORING</h1>
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
                    <h2 class="section-title">Monitoring</h2>
                    <p class="section-lead">
                        Anda bisa melakukan aksi pada aplikasi ini.
                    </p>
                </div>
                <div>
                    <div id="output-status"></div>
                    <div class="d-flex justify-content-end my-4">
                        <form>
                            <div class="input-group">
                                <Input
                                    search
                                    v-model="search"
                                    @on-keyup="cariCalonSiswa"
                                    placeholder="Cari.."
                                />
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="clearfix mb-3"></div>
                        <div class="table-responsive" v-if="showSearch">
                            <table
                                class="table table-bordered table-md text-center"
                            >
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Asal sekolah</th>
                                    <th>Photo</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                </tr>
                                <tr v-for="(d, index) in data" :key="index">
                                    <td>#</td>
                                    <td>
                                        {{ d.nama.toLowerCase() }}
                                    </td>
                                    <td>
                                        {{ d.asal_sekolah.toLowerCase() }}
                                    </td>
                                    <td>
                                        <img
                                            v-for="(f, index) in file"
                                            :key="index"
                                            :src="`${
                                                d.file_id === f.id
                                                    ? f.photo
                                                    : ''
                                            }`"
                                            class="rounded-circle"
                                            width="25"
                                            data-toggle="title"
                                            title=""
                                            @click="
                                                $router.push(
                                                    `/detailCalonSiswa/${d.id}`
                                                )
                                            "
                                        />
                                        <div class="d-inline-block ml-1"></div>
                                    </td>
                                    <td>
                                        <p
                                            v-for="(f, index) in file"
                                            :key="index"
                                        >
                                            {{
                                                d.file_id == f.id
                                                    ? f.nilai_rapot
                                                    : null
                                            }}
                                        </p>
                                    </td>
                                    <td>
                                        <div v-if="d.status === 0">
                                            <div class="table">
                                                <Button
                                                    type="info"
                                                    size="small"
                                                    @click="
                                                        $router.push(
                                                            `/detailCalonSiswa/${d.id}`
                                                        )
                                                    "
                                                    >Detail</Button
                                                >
                                                <Button
                                                    type="success"
                                                    size="small"
                                                    @click="
                                                        terimaCalonSiswa(
                                                            d.id,
                                                            index
                                                        )
                                                    "
                                                    >Terima</Button
                                                >
                                                <Button
                                                    type="error"
                                                    size="small"
                                                    @click="
                                                        hapusCalonSiswa(
                                                            d.id,
                                                            index
                                                        )
                                                    "
                                                    >Hapus</Button
                                                >
                                            </div>
                                        </div>
                                        <div v-else>
                                            <Button
                                                type="warning"
                                                size="small"
                                                @click="batalkan(d.id, index)"
                                            >
                                                Batalkan</Button
                                            >
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive" v-else>
                            <table
                                class="table table-bordered table-md text-center"
                            >
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Asal sekolah</th>
                                    <th>Photo</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                </tr>
                                <tr v-for="(d, index) in data" :key="index">
                                    <td>#</td>
                                    <td>
                                        {{ d.nama.toLowerCase() }}
                                    </td>
                                    <td>
                                        {{ d.asal_sekolah.toLowerCase() }}
                                    </td>
                                    <td>
                                        <img
                                            v-for="(f, index) in file"
                                            :key="index"
                                            :src="`${
                                                d.file_id === f.id
                                                    ? f.photo
                                                    : ''
                                            }`"
                                            class="rounded-circle"
                                            width="25"
                                            data-toggle="title"
                                            title=""
                                            @click="
                                                $router.push(
                                                    `/detailCalonSiswa/${d.id}`
                                                )
                                            "
                                        />
                                        <div class="d-inline-block ml-1"></div>
                                    </td>
                                    <td>
                                        <p
                                            v-for="(f, index) in file"
                                            :key="index"
                                        >
                                            {{
                                                d.file_id == f.id
                                                    ? f.nilai_rapot
                                                    : null
                                            }}
                                        </p>
                                    </td>
                                    <td>
                                        <div v-if="d.status === 0">
                                            <div class="table">
                                                <Button
                                                    type="info"
                                                    size="small"
                                                    @click="
                                                        $router.push(
                                                            `/detailCalonSiswa/${d.id}`
                                                        )
                                                    "
                                                    >Detail</Button
                                                >
                                                <Button
                                                    type="success"
                                                    size="small"
                                                    @click="
                                                        terimaCalonSiswa(
                                                            d.id,
                                                            index
                                                        )
                                                    "
                                                    >Terima</Button
                                                >
                                                <Button
                                                    type="error"
                                                    size="small"
                                                    @click="
                                                        hapusCalonSiswa(
                                                            d.id,
                                                            index
                                                        )
                                                    "
                                                    >Hapus</Button
                                                >
                                            </div>
                                        </div>
                                        <div v-else>
                                            <Button
                                                type="warning"
                                                size="small"
                                                @click="batalkan(d.id, index)"
                                            >
                                                Batalkan</Button
                                            >
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive" v-if="!data.length">
                            <div class="col-md">
                                <Alert type="error"
                                    >Opps.. data tidak ada atau belum
                                    ditemukan</Alert
                                >
                            </div>
                        </div>
                        <div class="float-right mt-4">
                            <Page
                                :total="pageInfo.total"
                                :current="pageInfo.current_page"
                                :page-size="parseInt(pageInfo.per_page)"
                                prev-text="Previous"
                                next-text="Next"
                                v-if="pageInfo"
                                size="small"
                                @on-change="getMonitorData"
                            />
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
            file: [],
            nilai: [],
            index: -9999,
            search: "",
            showSearch: false,
            caris: [],
            dataPageItems: [],
            total: 20,
            pageInfo: null,
        };
    },
    methods: {
        async terimaCalonSiswa(data, index) {
            let id = data;
            this.index = index;
            const res = await this.callApi(
                "post",
                `app/terimaCalonSiswa/${id}`
            );
            if (res.status === 200) {
                if (this.showSearch) {
                    this.caris[this.index].status = res.data.status;
                }
                this.data[this.index].status = res.data.status;
            } else {
                this.error("Tidak bisa dikomfirmasi");
            }
        },
        async batalkan(data, index) {
            let id = data;
            this.index = index;
            const res = await this.callApi(
                "post",
                `app/batalkanCalonSiswa/${id}`
            );
            if (res.status === 200) {
                if (this.showSearch) {
                    this.caris[this.index].status = res.data.status;
                }
                this.data[this.index].status = res.data.status;
            } else {
                this.error("Tidak bisa dibatalkan");
            }
        },
        async hapusCalonSiswa(data, index) {
            let id = data;
            const res = await this.callApi(
                "delete",
                `app/hapusCalonSiswa/${id}`
            );
            if (this.showSearch) {
                this.caris.splice(index, 1);
            }
            this.data.splice(index, 1);
        },
        async cariCalonSiswa() {
            let data = this.search;
            const res = await this.callApi(
                "get",
                "app/cariCalonSiswa?q=" + data
            );
            if (res.status === 200) {
                this.data = [];
                this.caris = res.data;
                this.data = this.caris;
                this.showSearch = true;
            } else {
                return "mohon maaf mungkin ada sesuatu yang salah";
            }
        },
        onChangePage(pageOfItems) {
            // update page of items
            this.dataPageItems = pageOfItems;
        },
        async getMonitorData(page = 1) {
            const [res, file] = await Promise.all([
                this.callApi(
                    "get",
                    `/app/getCalonSiswa?page=${page}&total=${this.total}`
                ),
                this.callApi("get", "/app/getFile"),
            ]);
            this.pageInfo = res.data;
            if (res.status === 200) {
                this.data = res.data.data;
                this.pageInfo = res.data;
                this.file = file.data;
            }
        },
    },

    async created() {
        this.getMonitorData();
    },
};
</script>
