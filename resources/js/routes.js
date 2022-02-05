import home from './components/home.vue'
import users from './components/user/users.vue'
import foods from './components/foods/index.vue'
import order from './components/order/index.vue'
import cartorder from './components/order/cart.vue'
import showSell from './components/sell/sell.vue'
import auth from './components/auth/index.vue'
import backup from './components/backup/index.vue'
import report from './components/report/index.vue'
export const routes=[
    {path:'/home',name:home,component:home},
    {path:'/users',name:users,component:users},
    {path:'/foods',name:foods,component:foods},
    {path:'/order',name:order,component:order},
    {path:'/showSell',name:showSell,component:showSell},
    {path:'/cartorder',name:cartorder,component:cartorder},
    {path:'/change',name:auth,component:auth},
    {path:'/backup',name:backup,component:backup},
    {path:'/report',name:report,component:report}
];