<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Detail postingan</h1>
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

                <div class="row d-flex justify-content-center">
                    <div class="container">
                        <div>
                            <div class="mt-4">
                                <p>
                                    <Button
                                        @click="
                                            $router.push('/Data_Halaman_web')
                                        "
                                        ><Icon type="ios-add" /> Data halaman
                                        web
                                    </Button>
                                </p>
                                <div>
                                    <!-- card -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ data.title.toUpperCase() }}
                                            </h5>
                                            <div
                                                class="card-text"
                                                v-html="data.post"
                                            ></div>
                                            <div class="card-text">
                                                <small class="text-muted">{{
                                                    data.created_at
                                                }}</small>
                                            </div>
                                            <div class="small text-muted">
                                                Punished on
                                                {{ data.created_at }}
                                            </div>
                                            <div
                                                v-for="(
                                                    categoris, index
                                                ) in data.categoris"
                                                :key="index"
                                                v-if="data.categoris.length"
                                            >
                                                <a
                                                    >{{
                                                        categoris.categoryName
                                                    }}
                                                    -
                                                </a>
                                            </div>
                                            <div
                                                v-for="(
                                                    tag, index
                                                ) in data.tags"
                                                :key="index"
                                                v-if="data.tags.length"
                                            >
                                                <a
                                                    >{{ tag.tagName }}
                                                    -
                                                </a>
                                            </div>
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
            data: {
                title: "",
                post: "",
                post_excerpt: "",
                kategori_id: [],
                tag_id: [],
                metaDescription: "",
                jsonData: "",
            },
        };
    },
    methods: {},
    async created() {
        let id = parseInt(this.$route.params.id);
        const res = await this.callApi(
            "get",
            `/app/getBlogBerdasarkanId/${id}`
        );
        if (res.status === 200) {
            console.log(res.data);
            this.data = res.data;
        } else {
            this.swr();
        }
    },
};
</script>

<style>
img {
    border-style: none;
    width: 100%;
    box-shadow: 2em;
}
</style>
