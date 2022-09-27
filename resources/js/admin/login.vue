<template>
    <div>
        <div>
            <section class="section">
                <div class="d-flex flex-wrap align-items-stretch">
                    <div
                        class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white"
                    >
                        <div class="mb-5"></div>
                        <div class="p-4 m-3 mt-5">
                            <h4 class="text-dark font-weight-normal">
                                Welcome to
                                <span class="font-weight-bold"
                                    >SMKN 1 KAYUAGUNG</span
                                >
                            </h4>
                            <p class="text-muted">
                                Sebelum anda login, anda harus login atau
                                register jika anda tidak memiliki akun segera
                                buat akun.
                            </p>
                            <div class="needs-validation mt-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <Input
                                        type="email"
                                        maxlength="40"
                                        v-model="data.email"
                                        show-word-limit
                                        placeholder="Masukan email"
                                        clearable
                                    />
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label class="control-label"
                                            >Password</label
                                        >
                                    </div>
                                    <Input
                                        type="password"
                                        password
                                        v-model="data.password"
                                        placeholder="Masukan password"
                                    />
                                </div>
                                <div class="form-group text-right">
                                    <Button
                                        type="primary"
                                        :loading="isLoading"
                                        :disabled="isLoading"
                                        @click="login"
                                        >Login</Button
                                    >
                                </div>

                                <div class="mt-5 text-center">
                                    Tidak memiliki akun?
                                    <a href="#">Buat baru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                        :data-background="logo"
                    >
                        <div class="absolute-bottom-left index-2">
                            <div class="text-light p-5 pb-2">
                                <div class="mb-5 pb-3">
                                    <h1 class="mb-2 display-4 font-weight-bold">
                                        Thanks you was join us
                                    </h1>
                                    <h5
                                        class="font-weight-normal text-muted-transparent"
                                    >
                                        Kayuagung, Indonesia
                                    </h5>
                                </div>
                                Info: Ibu maya - 089798888889
                                <a
                                    class="text-light bb"
                                    target="_blank"
                                    href="#"
                                    >Justin Kauffman</a
                                >
                                Info: Ibu Rudi - 089978768888
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
            logo: "./../../../img/unplash/3.jpg",
            isLoading: false,
            data: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        async login() {
            if (this.data.email.trim() === "") {
                return this.error("Masukan email");
            }
            if (this.data.password.trim() === "") {
                return this.error("Masukan password");
            }
            if (this.data.password.length <= 5) {
                return this.error("Password minimal 5 kata");
            }
            this.isLoading = true;
            console.log("ok", this.data);
            const res = await this.callApi("post", "app/login", this.data);
            console.log("res", res);
            if (res.status === 200) {
                this.success("Anda sekarang login");
                window.location = "/";
                this.data.email = "";
                this.data.password = "";
            } else {
                if (res.status === 401) {
                    this.info(res.data.msg);
                } else if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isLoading = false;
        },
    },
};
</script>
