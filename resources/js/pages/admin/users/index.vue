<template>
    <a-card title="Tài khoản" style="width: 100%">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <a-button type="primary">
                    <router-link :to="{ name: 'admin-users-create' }">
                        <i class="fa-solid fa-plus"></i>
                    </router-link>
                </a-button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
                    <template #bodyCell="{ column, index, record }">
                        <template v-if="column.key === 'index'">
                            <span>{{ index + 1 }}</span>
                        </template>
                        <template v-if="column.key === 'avatar'">
                            <img src="../../../assets/logo.png" alt="Avatar" height="32">
                        </template>
                        <template v-if="column.key === 'status'">
                            <span v-if="record.status_id == 1" class="text-primary">{{ record.status }}</span>
                            <span v-else-if="record.status_id == 2" class="text-danger">{{ record.status }}</span>
                        </template>
                        <template v-if="column.key === 'action'">
                            <router-link :to="{ name: 'admin-users-edit', params: { id: record.id } }">
                                <a-button type="primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a-button>    
                            </router-link>
                        </template>
                    </template>
                </a-table>
            </div>
        </div>
    </a-card>
</template>

<script>
import { defineComponent, ref } from 'vue'; // vue3 phai khai bao de components ben trong day du thanh phan
import { useMenu } from '../../../stores/use-menu';
export default defineComponent({
    setup() {
        useMenu().onSelectKeys(['admin-users']);

        const users = ref([]);
        const columns = [
            {
                title: 'STT',
                key: 'index',
            },
            {
                title: 'Avatar',
                key: 'avatar',
            },
            {
                title: 'Tài khoản',
                dataIndex: 'username',
                key: 'username',
            },
            {
                title: 'Họ tên',
                dataIndex: 'name',
                key: 'name',
            },
            {
                title: 'Phòng ban',
                dataIndex: 'department',
                key: 'department',
                responsive: ['sm']
            },
            {
                title: 'Vai trò',
                key: 'role',
            },
            {
                title: 'Trạng thái',
                dataIndex: 'status',
                key: 'status',
            },
            {
                title: 'Công cụ',
                key: 'action',
                fixed: 'right'
            },
        ];
        const getUsers = () => {
            axios.get('http://127.0.0.1:8000/api/users')
                .then(function (response) {
                    users.value = response.data.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }

        // const getUsers2 = async () => {
        //     try {
        //         const response = await axios.get('/user?ID=12345');
        //         console.log(response);
        //     } catch (error) {
        //         console.error(error);
        //     }
        // }

        getUsers();
        return {
            users,
            columns
        }
    },
})
</script>
