// src/api/apiClient.js
import axios from "axios";
import { handleError } from "../Helpers/ErrorHandler";


// Cấu hình Axios với Base URL mới
const apiClient = axios.create({
  baseURL: "http://127.0.0.1:8000", // Thay bằng URL thực tế của API Laravel
  timeout: 10000,
  headers: {
    "Content-Type": "application/json",
  },
});

// Thêm Interceptor để đính kèm Token (nếu cần)
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem("token"); // Lấy token từ localStorage
  if (token) {
    config.headers.Authorization = `Bearer ${token}`; // Đính kèm token vào header Authorization
  }
  return config;
});

export default apiClient;

export const loginAPI = async (username:string, password:string) => {
  try {
    const response = await apiClient.post("/api/auth/login", {
      username, 
      password,
    });
    return response.data; // Trả về dữ liệu từ API
  } catch (error) {
    handleError(error); // Xử lý lỗi
    throw error; // Ném lỗi để phía frontend xử lý nếu cần
  }
};

