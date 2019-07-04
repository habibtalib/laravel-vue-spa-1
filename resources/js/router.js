import VueRouter from "vue-router";

// Pages
import Home from "./pages/Home";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Sell from "./pages/Sell";
import Merchandise from "./pages/Merchandise";
import Cart from "./pages/Cart";
import Genelogy from "./pages/Genelogy";
import History from "./pages/History";
import HistoryDetail from "./pages/HistoryDetail";
import User from "./pages/User";
import DownlineOrder from "./pages/DownlineOrder";
import InviteMembers from "./pages/InviteMembers";
import Setting from "./pages/Setting";
import Checkout from "./pages/Checkout";
import OrderDetail from "./pages/OrderDetail";
import Buy from "./pages/Buy";
import Dashboard from "./pages/user/Dashboard";
import AdminDashboard from "./pages/admin/Dashboard";
import ThankYou from "./pages/ThankYou";
import Inbox from "./pages/Inbox";

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
        path: "/inbox",
        name: "inbox",
        component: Inbox,
        meta: {
            auth: true
        }
    },
    {
        path: "/user/:id",
        name: "user",
        component: User,
        meta: {
            auth: true
        }
    },
    {
        path: "/register/:id",
        name: "register",
        component: Register,
        meta: {
            auth: undefined
        }
    },
    {
        path: "/thankyou",
        name: "thankyou",
        component: ThankYou,
        meta: {
            auth: undefined
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
        path: "/buy",
        name: "buy",
        component: Buy,
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
        path: "/sell/:id",
        name: "sell",
        component: Sell,
        meta: {
            auth: true
        }
    },
    {
        path: "/merchandise",
        name: "merchandise",
        component: Merchandise,
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
        path: "/history/:id",
        name: "historyDetail",
        component: HistoryDetail,
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
    {
        path: "/downline-order",
        name: "downlineOrder",
        component: DownlineOrder,
        meta: {
            auth: true
        }
    },
    {
        path: "/invite-members",
        name: "inviteMembers",
        component: InviteMembers,
        meta: {
            auth: true
        }
    },
    {
        path: "/order/:id",
        name: "orderDetail",
        component: OrderDetail,
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
