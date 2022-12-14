import { mapGetters } from "vuex";

export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj,
                });
            } catch (error) {
                return error.response
            }
        },

        info(desc, title = "Hey.") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        success(desc, title = "Great") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        warningk(desc, title = "Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        error(desc, title = "Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        swr(desc = "Something went wrong! please try again", title = "Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        checkUserPermission(key) {
            if (!this.userPermission) return true;
            let isPermitted = false;
            for (let d of this.userPermission) {
                if (d.name === this.$route.name) {
                    if (d[key]) {
                        isPermitted = true;
                    }
                }
            }
            return isPermitted;
        }
    },

    computed: {
        ...mapGetters({
            'userPermission': "getUserPermission"
        }),
        lihatPermission() {
            return this.checkUserPermission('lihat');
        },
        tambahPermission() {
            return this.checkUserPermission('tambah');
        },
        editPermission() {
            return this.checkUserPermission('edit');
        },
        hapusPermission() {
            return this.checkUserPermission('hapus');
        },
    }




}