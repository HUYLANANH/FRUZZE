import axios from "axios";
import { handleError } from "../Helpers/ErrorHandler";
import { UserProfileToken } from "../Models/User";

const api = "v1/";

export const loginAPI = async (username: string, password: string) => {
  try {
    const data = await axios.post<UserProfileToken>(api + "account/Login", {
      username: username,
      password: password,
    });
    return data;
  } catch (error) {
    handleError(error);
  }
};

export const registerAPI = async (
  payload: {
    username: string;
    email: string;
    password: string | null; // Cho phép null nếu đăng ký bằng Google
    nameOfUser: string;

  }
) => {
  try {
    const data = await axios.post<UserProfileToken>(api + "account/register", {
      Username: payload.username,  // Tên trường đúng backend
      EmailAddress: payload.email,
      Password: payload.password ?? "ThanhLoc@123", // Mật khẩu mặc định nếu null
      NameOfUser: payload.nameOfUser,
    });
    return data;
  } catch (error) {
    handleError(error);
  }
};
