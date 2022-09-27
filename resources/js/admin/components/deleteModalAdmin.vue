<template>
    <div>
        <Modal :value="getDeleteModalAdminObj.tampilDeleteModalObj" width="360">
            <p slot="header" style="color: #f60; text-align: center">
                <Icon type="ios-information-circle"></Icon>
                <span>Delete confirmation</span>
            </p>
            <div style="text-align: center">
                <p>
                    {{ getDeleteModalAdminObj.msg }}
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
        ...mapGetters(["getDeleteModalAdminObj"]),
    },
    methods: {
        async deleteModal() {
            this.isLoading = true;
            const res = await this.callApi(
                "delete",
                this.getDeleteModalAdminObj.deleteUrl,
                {
                    id: this.getDeleteModalAdminObj.id,
                    test: "test",
                }
            );
            if (res.status === 200) {
                this.success(this.getDeleteModalAdminObj.msgSuccess);
                this.$store.commit("setDeleteModalAdmin", true);
            } else {
                this.error("Admin gagal dihapus");
                this.$store.commit("setDeleteModalAdmin", false);
            }
            this.isLoading = false;
            this.getDeleteModalAdminObj.tampilDeleteModalObj = false;
            console.log(
                "tampil",
                this.getDeleteModalAdminObj.tampilDeleteModalObj
            );
        },
        closeModal() {
            this.$store.commit("closeModal");
        },
    },
};
</script>
