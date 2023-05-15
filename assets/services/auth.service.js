import axiosInstance from '../api/axiosInstance';

class PageDataService {
    login(credentials) {
        return axiosInstance.post("/auth/login", credentials);
    }
}

export default new PageDataService();