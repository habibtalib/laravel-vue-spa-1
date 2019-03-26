import VueRouter from "vue-router";

// Pages
import Home from "./pages/Home";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Sell from "./pages/Sell";
import Cart from "./pages/Cart";
import Genelogy from "./pages/Genelogy";
import History from "./pages/History";
import User from "./pages/User";
import Setting from "./pages/Setting";
import Checkout from "./pages/Checkout";
import Dashboard from "./pages/user/Dashboard";
import AdminDashboard from "./pages/admin/Dashboard";

// Routes
const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: "/cart",
        name: "cart",
        component: Cart,
        meta: {
            auth: true
        }
    },
    {
        path: "/sell",
        name: "sell",
        component: Sell,
        meta: {
            auth: true
        }
    },
    {
        path: "/genelogy",
        name: "genelogy",
        component: Genelogy,
        meta: {
            auth: true
        }
    },
    {
        path: "/history",
        name: "history",
        component: History,
        meta: {
            auth: true
        }
    },
    {
        path: "/user",
        name: "user",
        component: User,
        meta: {
            auth: true
        }
    },
    {
        path: "/setting",
        name: "setting",
        component: Setting,
        meta: {
            auth: true
        }
    },
    {
        path: "/checkout",
        name: "checkout",
        component: Checkout,
        meta: {
            auth: true
        }
    },
    // ADMIN ROUTES
    {
        path: "/admin",
        name: "admin.dashboard",
        component: AdminDashboard,
        meta: {
            auth: {
                roles: 2,
                redirect: { name: "login" },
                forbiddenRedirect: "/403"
            }
        }
    }
];

const router = new VueRouter({
    history: true,
    mode: "history",
    routes
});

export default router;
