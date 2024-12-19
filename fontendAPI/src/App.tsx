import { Outlet } from "react-router";
import Navbar from "./Components/Navbar/Navbar";
import "react-toastify/dist/ReactToastify.css";
import { ToastContainer } from "react-toastify";
import { UserProvider } from "./Context/useAuth";
import Adminn  from "./Pages/Admin/Admin";


function App() {
  return (
    <>
  
      <UserProvider>
        <Navbar></Navbar>
        <Outlet />
        <ToastContainer />
      </UserProvider>
    </>
  );
}

export default App;
