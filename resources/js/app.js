import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router/index';
import App from './App.vue';
import {
    Menu,
    List,
    Drawer,
    Button,
    message
} from 'ant-design-vue';

import 'ant-design-vue/dist/antd.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css';
import 'bootstrap/dist/css/bootstrap-utilities.min.css';

const app = createApp(App);
const pinia = createPinia();
app.use(router);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(pinia)
app.mount('#app');

app.config.globalProperties.$message = message;
