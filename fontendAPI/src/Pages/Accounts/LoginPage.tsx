import React, { useState } from 'react';
import * as Yup from 'yup';
import { yupResolver } from '@hookform/resolvers/yup';
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { useAuth } from '../../Context/useAuth';
import { useForm } from 'react-hook-form';

type Props = {};

type LoginFormsInputs = {
  username: string;
  password: string;
};

const validation = Yup.object().shape({
  username: Yup.string().required('Tên đăng nhập là bắt buộc'),
  password: Yup.string().required('Mật khẩu là bắt buộc'),
});

const LoginPage = (props: Props) => {  
  const { loginUser } = useAuth();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<LoginFormsInputs>({ resolver: yupResolver(validation) });

  const [showPassword, setShowPassword] = useState(false);

  const handleLogin = (form: LoginFormsInputs) => {
    loginUser(form.username, form.password);
  };

  return (
    <div className="w-full">
      <section className="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
        <div className="w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-800">
          <div className="p-6 space-y-2 sm:p-8">
            <h1 className="text-2xl font-bold text-center text-gray-900 dark:text-white">
              Đăng nhập
            </h1>
            
            <form onSubmit={handleSubmit(handleLogin)} className="space-y-4">
              <div>
                <label htmlFor="username" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                  Tên đăng nhập
                </label>
                <input
                  type="text"
                  id="username"
                  placeholder="Tên đăng nhập"
                  className="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                  {...register('username')}
                />
                {errors.username && <p className="text-red-500 text-sm">{errors.username.message}</p>}
              </div>

              <div>
                <label htmlFor="password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                  Mật khẩu
                </label>
                <div className="relative">
                  <input
                    type={showPassword ? "text" : "password"}
                    id="password"
                    placeholder="••••••••"
                    className="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    {...register('password')}
                  />
                  <button
                    type="button"
                    onClick={() => setShowPassword(!showPassword)}
                    className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"
                  >
                    <FontAwesomeIcon icon={showPassword ? faEye : faEyeSlash} />
                  </button>
                </div>
                {errors.password && <p className="text-red-500 text-sm">{errors.password.message}</p>}
              </div>

              <button
                type="submit"
                className="w-full h-10 bg-green-500 text-white rounded-full font-semibold hover:bg-green-600 transition duration-200"
              >
                Đăng nhập
              </button>

            </form>
          </div>
        </div>
      </section>
    </div>
  );
};

export default LoginPage;
