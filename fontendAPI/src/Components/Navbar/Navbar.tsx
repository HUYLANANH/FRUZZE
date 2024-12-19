import React, { useEffect, useState } from "react";
import { Link, useNavigate, useLocation } from "react-router-dom";
import logo from "./logo.png";
import { useAuth } from "../../Context/useAuth";
import { FaUserCircle, FaShoppingCart } from 'react-icons/fa'; 

interface Props {}

const Navbar: React.FC<Props> = () => {
  const { isLoggedIn, user, logout } = useAuth();
  const [menuOpen, setMenuOpen] = useState<boolean>(false);
  const location = useLocation();

  return (
    <nav className="relative w-full p-2 bg-green-500 shadow-md sticky top-0 z-50 px-32 text-white">
      <div className="flex items-center text-lg justify-between">
        <div className="flex items-center space-x-6">
          <Link to="/product">
            <img src={logo} alt="Logo" className="h-20" />
          </Link>

    </div>
        <div className="flex items-center space-x-6">
          {isLoggedIn() && (
             <div className="flex items-center space-x-4 ">
                <span className="text-white italic">{user?.username }</span> 
                      <div className="relative">
                        <Link to="/cart" className="hover:text-blue-600 flex items-center">
                          <FaShoppingCart className="text-2xl" />
                        </Link>
                      </div>
              </div>
          )}

          {isLoggedIn() ? (
            <div className="hidden lg:flex items-center space-x-6">
              <div className="relative flex items-start">
                <button onClick={() => setMenuOpen(!menuOpen)}>
                  <FaUserCircle className="text-2xl hover:text-blue-600" />
                </button>
                {menuOpen && (
                  
                  <div className="absolute right-0 mt-2 w-52 bg-white text-green-700 border rounded-lg shadow-lg z-10 text-lg">
                    
                    <Link to={`/user/${user?.username}`} className="block px-4 py-2 hover:bg-gray-100">
                      Hồ sơ
                    </Link>
                    <Link to="/change-password" className="block px-4 py-2 hover:bg-gray-100">
                      Đổi mật khẩu
                    </Link>
                    <button onClick={logout} className="block w-full text-left px-4 py-2 hover:bg-gray-100">
                      Đăng xuất
                    </button>
                  </div>
                )}
              </div>
            </div>
          ) : (
            <div className="hidden lg:flex items-center space-x-6 font-bold text-white">
              <Link to="/login" className="hover:text-blue-600">Đăng nhập</Link>
              <Link to="/register" className="px-5 py-2 font-bold rounded text-white bg-blue-500 hover:bg-blue-600">
                Đăng ký
              </Link>
            </div>
          )}
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
