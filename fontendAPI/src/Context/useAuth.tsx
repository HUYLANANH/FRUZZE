// src/contexts/UserContext.tsx
import { createContext, useEffect, useState } from "react";
import { UserProfile } from "../Models/User";
import { useNavigate } from "react-router-dom";
import { loginAPI } from "../Services/AuthService";
import { toast } from "react-toastify";
import React from "react";
import axios from "axios";

type UserContextType = {
  user: UserProfile | null;
  token: string | null;
  loginUser: (username: string, password: string) => Promise<void>;
  logout: () => void;
  isLoggedIn: () => boolean;
};

type Props = { children: React.ReactNode };

const UserContext = createContext<UserContextType>({} as UserContextType);

export const UserProvider = ({ children }: Props) => {
  const navigate = useNavigate();
  const [token, setToken] = useState<string | null>(null);
  const [user, setUser] = useState<UserProfile | null>(null);
  const [isReady, setIsReady] = useState(false);

  const loadUserFromStorage = () => {
    try {
      const user = localStorage.getItem("user");
      const token = localStorage.getItem("token");

      if (user && token) {
        const parsedUser = JSON.parse(user);
        setUser(parsedUser);
        setToken(token);
        axios.defaults.headers.common["Authorization"] = "Bearer " + token;
      }
    } catch (error) {
      console.error("Error retrieving data from localStorage:", error);
      localStorage.clear();
    }
    setIsReady(true);
  };

  useEffect(() => {
    loadUserFromStorage();
  }, []);


  const loginUser = async (username: string, password: string) => {
    try {
      const res = await loginAPI(username, password);

      if (res) {
        const { token,  role } = res.data;
        const userObj = { username, token, role };
        localStorage.setItem("token", token);
        localStorage.setItem("user", JSON.stringify(userObj));

        setToken(token);
        setUser(userObj);

        toast.success("Login successful!");
        navigate(role === "Admin" ? "/admin" : "/product");
      }
    } catch (error) {
      toast.error("Server error. Please try again later.");
      console.error("Login Error:", error);
    }
  };

  const logout = () => {
    localStorage.clear();
    setUser(null);
    setToken(null);
    toast.info("Logged out successfully.");
    navigate("/login");
  };

  const isLoggedIn = () => Boolean(user);

  return (
    <UserContext.Provider
      value={{ user, token, loginUser, logout, isLoggedIn }}
    >
      {isReady ? children : <div>Loading...</div>}
    </UserContext.Provider>
  );
};

export const useAuth = () => React.useContext(UserContext);
