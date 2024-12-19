import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import SearchPage from "../Components/Search/Search";
import CategoryList from "../Pages/Admin/CategoryList";
import LoginPage from "../Pages/Accounts/LoginPage";
import ProductUpdate from "../Pages/Admin/Products/ProductUpdate";
import ProductList from "../Pages/Admin/Products/ProducList";
import ProductAdd from "../Pages/Admin/Products/ProductAdd";
import UserList from "../Pages/Admin/UserList";
import AllOrders from "../Pages/Admin/AllOrders";
import Finance from "../Pages/Admin/Finance";
import Admin from "../Pages/Admin/Admin";
import Winter2024 from "../Components/InformationWeb/winter2024";
import ProtectedRoute from "./ProtectedRoute";
export const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    children: [
        { path: "admin", 
          element: (
            // <ProtectedRoute>
            //   <Admin />
            // </ProtectedRoute> 
            <Admin></Admin>
          ),
      children: [
        { index: true, element: <Finance /> },
        { path: "productlist", element: <ProductList /> },
        { path : "orders", element: <AllOrders/>},
        { path: "category", element: <CategoryList/>},
        { path: "user", element: <UserList/> },
        { path:"finance", element: <Finance/>},
        { path: "product/update/:id", element: <ProductUpdate/>},
        { path: "product/add", element: <ProductAdd/>},
       ],
      },
     
      { path: "login", element: <LoginPage /> },
      {path:"gioi-thieu", element:<Winter2024/>},
      {path:"tuyen-dung", element:<Winter2024/>},
      {path:"tin-tuc", element:<Winter2024/>},
      {path:"he-thong-cua-hang", element:<Winter2024/>},
    {
        path: "search",
        element: (
            <SearchPage />
        ),
      }, 

      
    ],
  },

]);
