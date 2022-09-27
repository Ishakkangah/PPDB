<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Hero</h1>
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
                    <h2 class="section-title">Terima kasih</h2>
                    <p class="section-lead">Permintaan anda kami prosess</p>

                    <div class="row">
                        <div class="col-12 mb-4">
                            <div
                                class="hero align-items-center bg-success text-white"
                            >
                                <div class="hero-inner text-center">
                                    <h2>Selamat</h2>
                                    <p class="lead">
                                        Sekarang anda telah terdaptar di
                                        penerimaan peserta didik baru SMK Negeri
                                        1 Kayuagung
                                    </p>
                                    <div class="mt-4">
                                        <a
                                            href="#"
                                            class="btn btn-outline-white btn-lg btn-icon icon-left"
                                            ><i class="fas fa-sign-in-alt"></i>
                                            Login</a
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

<script>
export default {
    data() {
        return {
            data: {},
            isAdding: false,
        };
    },
    methods: {},

    async created() {
        this.token = window.Laravel.csrfToken;
    },
};
</script>
