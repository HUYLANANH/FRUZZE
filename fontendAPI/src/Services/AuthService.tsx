// src/api/apiClient.js
import axios from "axios";
import { handleError } from "../Helpers/ErrorHandler";


interface RegisterPayload {
  email: string; password: string; nameOfUser: string;
}

interface ResetPasswordPayload { 
  email: string; newPassword: string; otp: string;
}

// Cấu hình Axios với Base URL mới
const apiClient = axios.create({
  baseURL: "http://127.0.0.1:8000/api/", // Thay bằng URL thực tế của API Laravel
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

export const loginAPI = async (email:string, password:string) => {
  try {
    const response = await apiClient.post("auth/login", {
      email, // Laravel API yêu cầu trường email thay vì username
      password,
    });
    return response.data; // Trả về dữ liệu từ API
  } catch (error) {
    handleError(error); // Xử lý lỗi
    throw error; // Ném lỗi để phía frontend xử lý nếu cần
  }
};

export const registerAPI = async (payload: RegisterPayload) => {
  try {
    const response = await apiClient.post("auth/register", {
      email: payload.email, // Laravel API yêu cầu email
      password: payload.password, // Không cần fallback mật khẩu mặc định
      name: payload.nameOfUser, // Laravel API yêu cầu trường name
    });
    return response.data; // Trả về dữ liệu từ API
  } catch (error) {
    handleError(error);
    throw error;
  }
};

export const resetPasswordAPI = async (payload: ResetPasswordPayload) => {
  try {
    const response = await apiClient.patch("forgot-password/reset-password", {
      email: payload.email,
      password: payload.newPassword,
      otp: payload.otp, // Giả sử cần gửi OTP để xác nhận
    });
    return response.data; // Trả về dữ liệu từ API
  } catch (error) {
    handleError(error);
    throw error;
  }
};
export const getProfileAPI = async () => {
  try {
    const response = await apiClient.get("auth/profile");
    return response.data; // Trả về dữ liệu người dùng
  } catch (error) {
    handleError(error);
    throw error;
  }
};
export const sendOtpAPI = async (email:string) => {
  try {
    const response = await apiClient.post("forgot-password/send-otp", {
      email,
    });
    return response.data;
  } catch (error) {
    handleError(error);
    throw error;
  }
};

export const verifyOtpAPI = async (email:string, otp:string) => {
  try {
    const response = await apiClient.post("forgot-password/verify-otp", {
      email,
      otp,
    });
    return response.data;
  } catch (error) {
    handleError(error);
    throw error;
  }
};
