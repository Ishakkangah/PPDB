import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        deleteModalObj: {
            tampilDeleteModalObj: false,
            deleteUrl: "",
            data: null,
            deletingIndex: -0,
            isDeleting: false,
            msg: "",
            msgSuccess: "",
        },
        deleteModalAdminObj: {
            tampilDeleteModalObj: false,
            deleteUrl: "",
            id: null,
            deletingIndex: -0,
            isDeleting: false,
            msg: "",
            msgSuccess: "",
        },
        deleteDataAdminObj: {
            url: "",
            id: null
        },
        user: false,
        userPermission: null,
    },
    getters: {
        getDeleteModalObj(state) {
            return state.deleteModalObj;
        },
        getDeleteModalAdminObj(state) {
            return state.deleteModalAdminObj;
        },
        getDeleteDataAdminObj(state) {
            return state.deleteDataAdminObj;
        },
        getUserPermission(state) {
            return state.userPermission;
        }
    },
    mutations: {
        setDeleteModal(state, data) {
            const deleteModalObj = {
                tampilDeleteModalObj: false,
                deleteUrl: "",
                data: null,
                deletingIndex: state.deleteModalObj.deletingIndex,
                isDeleting: data,
                msg: "",
                msgSuccess: "",
            }
            state.deleteModalObj = deleteModalObj;
        },
        setDeleteModalAdmin(state, data) {
            const deleteModalObj = {
                tampilDeleteModalObj: false,
                deleteUrl: "",
                id: null,
                deletingIndex: state.deleteModalAdminObj.deletingIndex,
                isDeleting: data,
                msg: "",
                msgSuccess: "",
            }
            state.deleteModalAdminObj = deleteModalObj;
        },
        setDeletingModalObj(state, data) {
            state.deleteModalObj = data;
        },
        closeModal(state) {
            state.deleteModalObj.tampilDeleteModalObj = false;
            state.deleteModalAdminObj.tampilDeleteModalObj = false;
        },
        setDataAdminYangInginDiHapus(state, data) {
            state.deleteDataAdminObj = data;
        },
        setDeletingModalAdminObj(state, data) {
            state.deleteModalAdminObj = data;
        },
        setUpdateUser(state, data) {
            state.user = data;
        },
        setUserPermission(state, data) {
            state.userPermission = data;
        }

    }
});