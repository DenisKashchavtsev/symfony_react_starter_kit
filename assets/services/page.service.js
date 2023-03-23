import http from "../utils/http-common";

class PageDataService {
    getAll() {
        return http.get("/pages/");
    }

    get(id) {
        return http.get(`/pages/${id}`);
    }

    create(data) {
        return http.post("/pages/", data);
    }

    update(id, data) {
        return http.put(`/pages/${id}`, data);
    }

    delete(id) {
        return http.delete(`/pages/${id}`);
    }
}

export default new PageDataService();