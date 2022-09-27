<template>
    <div>
        <Modal :value="getDeleteModalObj.tampilDeleteModalObj" width="360">
            <p slot="header" style="color: #f60; text-align: center">
                <Icon type="ios-information-circle"></Icon>
                <span>Delete confirmation</span>
            </p>
            <div style="text-align: center">
                <p>
                    {{ getDeleteModalObj.msg }}
                </p>
            </div>
            <div slot="footer">
                <Button
                    type="default"
                    size="small"
                    :loading="isLoading"
                    :disabled="isLoading"
                    @click="closeModal"
                    >Batal</Button
                >
                <Button
                    type="error"
                    size="small"
                    :loading="isLoading"
                    :disabled="isLoading"
                    @click="deleteModal"
                    >Hapus</Button
                >
            </div>
        </Modal>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            isLoading: false,
        };
    },
    computed: {
        ...mapGetters(["getDeleteModalObj", "getDeleteDataAdminObj"]),
    },
    methods: {
        async deleteModal() {
            this.isLoading = true;
            const [res, admin] = await Promise.all([
                this.callApi(
                    "delete",
                    this.getDeleteModalObj.deleteUrl,
                    this.getDeleteModalObj.data
                ),
                this.callApi("delete", this.getDeleteDataAdminObj.url, {
                    id: this.getDeleteDataAdminObj.id,
                }),
            ]);
            if (res.status === 200) {
                this.success(this.getDeleteModalObj.msgSuccess);
                this.$store.commit("setDeleteModal", true);
            } else {
                this.error("Aturan gagagl dihapus");
                this.$store.commit("setDeleteModal", false);
            }
            this.isLoading = false;
            this.getDeleteModalObj.tampilDeleteModalObj = false;
        },
        closeModal() {
            this.$store.commit("closeModal");
        },
    },
};
</script>
