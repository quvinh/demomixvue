import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router/index';
import App from './App.vue';
import axios from 'axios';
window.axios = axios;

import {
    Checkbox,
    Input,
    Select,
    Avatar,
    Table,
    Card,
    Menu,
    List,
    Drawer,
    Button,
    message
} from 'ant-design-vue';

import './static/fontawesome/css/all.min.css';
import 'ant-design-vue/dist/antd.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css';
import 'bootstrap/dist/css/bootstrap-utilities.min.css';

const app = createApp(App);
const pinia = createPinia();
app.use(router);
app.use(pinia);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(Card);
app.use(Table);
app.use(Avatar);
app.use(Select);
app.use(Input);
app.use(Checkbox);
app.mount('#app');

app.config.globalProperties.$message = message;
