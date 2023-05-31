import axiosInstance from '../api/axiosInstance';

class AuthService {
    login(credentials) {
        return axiosInstance.post("/auth/login", credentials);
    }
}

export default new AuthService();