import axiosInstance from "../api/axiosInstance";

class PageDataService {
    getAll() {
        return axiosInstance.get("/pages/");
    }

    get(id) {
        return axiosInstance.get(`/pages/${id}`);
    }

    create(data) {
        return axiosInstance.post("/pages/", data);
    }

    update(id, data) {
        return axiosInstance.put(`/pages/${id}`, data);
    }

    delete(id) {
        return axiosInstance.delete(`/pages/${id}`);
    }
}

export default new PageDataService();