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
                    <h2 class="section-title">Cetak laporan</h2>
                    <p class="section-lead">
                        Anda bisa mencetak laporan berupa format pdf atau
                        ms.excell
                    </p>

                    <div class="row">
                        <div class="col-12 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="empty-state" data-height="400">
                                        <div class="empty-state-icon">
                                            <Icon type="md-grid" />
                                        </div>
                                        <h2>CETAK MS EXCELL</h2>
                                        <p class="lead">
                                            Click tombol download Ms.excell
                                            untuk download laporan dengan format
                                            Excell
                                        </p>
                                        <a
                                            href="/app/downloadExcell"
                                            class="btn btn-primary mt-4"
                                        >
                                            Download Excell
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="empty-state" data-height="400">
                                        <div class="empty-state-icon bg-danger">
                                            <Icon type="md-document" />
                                        </div>
                                        <h2>CETAK PDF</h2>
                                        <p class="lead">
                                            Click tombol download PDF untuk
                                            download laporan dengan format PDF.
                                            <a
                                                class="text-primary"
                                                @click="
                                                    $router.push(
                                                        '/lihat_laporan_pdf'
                                                    )
                                                "
                                                >Lihat?</a
                                            >
                                        </p>
                                        <a
                                            href="/app/downloadPDF"
                                            class="btn btn-danger mt-4"
                                            >Donwload PDF</a
                                        >
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
