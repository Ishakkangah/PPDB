<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>EDIT POSTINGAN</h1>
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
                    <h2 class="section-title">Edit postingan</h2>
                    <p class="section-lead">
                        Anda bisa merubah postingan disini.
                    </p>

                    <div class="mt-4">
                        <div class="clearfix mb-3"></div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="container">
                                    <div class="form-group mt-4">
                                        <Input
                                            v-model="data.title"
                                            placeholder="Masukan judul"
                                            clearable
                                        />
                                    </div>
                                    <div class="form-group mt-2 blog_editor">
                                        <editor
                                            ref="editor"
                                            :config="config"
                                            autofocus
                                            holder-id="codex-editor"
                                            save-button-id="save-button"
                                            :init-data="initData"
                                            @save="onSave"
                                        />
                                    </div>
                                    <div class="form-group mt-2">
                                        <Input
                                            v-model="data.post_excerpt"
                                            placeholder="Masukan post excerpt"
                                            clearable
                                        />
                                    </div>
                                    <div class="form-group mt-2">
                                        <Select
                                            v-model="data.kategori_id"
                                            multiple
                                            clearable
                                            placeholder="Pilih kategori"
                                        >
                                            <Option
                                                v-for="(c, i) in kategori"
                                                :value="c.id"
                                                :key="i"
                                                >{{ c.categoryName }}</Option
                                            >
                                        </Select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <Select
                                            v-model="data.tag_id"
                                            multiple
                                            clearable
                                            placeholder="Pilih tag"
                                        >
                                            <Option
                                                v-for="(t, index) in tag"
                                                :key="index"
                                                :value="t.id"
                                                >{{ t.tagName }}</Option
                                            >
                                        </Select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <Input
                                            v-model="data.metaDescription"
                                            type="textarea"
                                            :rows="4"
                                            clearable
                                            placeholder="Masukan meta description"
                                        />
                                    </div>
                                    <div class="form-group mt-2">
                                        <Button
                                            type="primary"
                                            @click="tambahPostinganBaru"
                                            :loading="isAddPost"
                                            :disabled="isAddPost"
                                            >{{
                                                isAddPost
                                                    ? "Prosess.."
                                                    : "Simpan"
                                            }}</Button
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="output-status"></div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            config: {},
            initData: null,
            data: {
                title: "",
                post: "",
                post_excerpt: "",
                kategori_id: [],
                tag_id: [],
                metaDescription: "",
                jsonData: "",
            },
            kategori: [],
            tag: [],
            isAddPost: false,
            articleHtml: "",
        };
    },
    methods: {
        async tambahPostinganBaru() {
            this.$refs.editor.save();
        },
        async onSave(response) {
            var data = response;
            await this.outputHTML(data.blocks);
            this.data.post = this.articleHtml;
            this.data.jsonData = JSON.stringify(data);

            if (this.data.title.trim() === "") {
                return this.error("Masukan title");
            }
            if (this.data.post.trim() === "") {
                return this.error("Masukan post");
            }

            if (this.data.post_excerpt.trim() === "") {
                return this.error("Masukan post excerpt");
            }
            if (!this.data.kategori_id.length) {
                return this.error("Pilih salah satu kategori");
            }
            if (!this.data.tag_id.length) {
                return this.error("Pilih salah satu tag");
            }
            if (this.data.metaDescription.trim() === "") {
                return this.error("Masukan meta description");
            }
            this.isAddPost = true;
            const res = await this.callApi(
                "post",
                `/app/editPostingan/${this.$route.params.id}`,
                this.data
            );

            if (res.status === 200) {
                this.success("Posting berhasil di edit");
                this.$router.push("/data_Halaman_web");
            } else {
                if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.swr();
                }
            }
            this.isAddPost = false;
        },
        outputHTML(articleObj) {
            articleObj.map((obj) => {
                switch (obj.type) {
                    case "paragraph":
                        this.articleHtml += this.makeParagraph(obj);
                        break;
                    case "image":
                        this.articleHtml += this.makeImage(obj);
                        break;
                    case "header":
                        this.articleHtml += this.makeHeader(obj);
                        break;
                    case "raw":
                        this.articleHtml += `<div class="ce-block">
                            <div class="ce-block_content">
                                <div class="ce-code">
                                    <code>${obj.data.html}</code>
                                </div>
                            </div>
                        </div>\n`;
                        break;
                    case "code":
                        this.articleHtml += this.makeCode(obj);
                        break;
                    case "list":
                        this.articleHtml += this.makeList(obj);
                        break;
                    case "quote":
                        this.articleHtml += this.makeQuote(obj);
                        break;
                    case "warning":
                        this.articleHtml += this.makeWarning(obj);
                        break;
                    case "checklist":
                        this.articleHtml += this.makeChecklist(obj);
                        break;
                    case "embed":
                        this.articleHtml += this.makeEmbed(obj);
                        break;
                    case "delimeter":
                        this.articleHtml += this.makeDelimeter(obj);
                        break;
                    default:
                        return "";
                }
            });
        },
    },

    // get all tag
    async created() {
        let id = parseInt(this.$route.params.id);
        if (!id) {
            return this.$router.push("/notfound");
        }

        const [blog, kategori, tag] = await Promise.all([
            this.callApi("get", `/app/tampilDataBerdasarkanId/${id}`),
            this.callApi("get", "/app/tampilSemuaDataKategori"),
            this.callApi("get", "/app/tampilSemuaDataTag"),
        ]);
        if (blog.status === 200) {
            if (!blog.data) {
                return this.$router.push("/notfound");
            }
            this.initData = JSON.parse(blog.data.jsonData);
            this.kategori = kategori.data.data;
            this.tag = tag.data.data;
            for (let k of blog.data.categoris) {
                this.data.kategori_id.push(k.id);
            }
            for (let t of blog.data.tags) {
                this.data.tag_id.push(t.id);
            }
            this.data.title = blog.data.title;
            this.data.jsonData = blog.data.jsonData;
            this.data.post_excerpt = blog.data.post_excerpt;
            this.data.metaDescription = blog.data.metaDescription;
        } else {
            this.swr();
        }
    },
};
</script>

<style>
.blog_editor {
    padding: 4px 70px;
    font-size: 14px;
    border: 1px solid #dcdee2;
    border-radius: 4px;
    color: #515a6e;
    background-color: #fff;
    background-image: none;
    z-index: -1;
}
.blog_editor:hover {
    border: 1px solid #57a3f3;
}
</style>
