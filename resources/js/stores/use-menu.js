import { defineStore } from 'pinia'

export const useMenu = defineStore('menuId', {
  state: () => {
    return {
        selectedKeys: [],
        openKeys: [],
    }
  },

  actions: {
    onSelectKeys(data) {
        this.selectedKeys = data;
    },
    onOpenKeys(data) {
        this.openKeys = data;
    }
  }
})
