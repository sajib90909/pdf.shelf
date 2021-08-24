<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <template v-for="menu in menus">
                    <li v-if="menu.subMenus && menu.subMenus.length" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" :id="`navbarDropdownMenuLink-${menu.id}`" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ menu.name }}
                        </a>
                        <div class="dropdown-menu" :aria-labelledby="`navbarDropdownMenuLink-${menu.id}`">
                            <template v-for="subMenu in menu.subMenus">
                                <router-link class="dropdown-item" :to="{ name:menu.urlName, query:{ [menu.key]:subMenu.id }}">{{ subMenu.name }}</router-link>
                            </template>
                        </div>
                    </li>
                    <li v-else class="nav-item">
                        <router-link class="nav-link menu-link" :to="{ name:menu.urlName }">{{ menu.name }}</router-link>
                    </li>
                </template>
                <li class="nav-item pt-1 pl-2">
                    <router-link class="btn btn-outline-info btn-sm rounded-pill" :to="{ name:'books' }">Books</router-link>
                </li>
            </ul>
        </div>
    </nav>
</div>
</template>

<script>
import {axiosGet, urlGenerator} from "../../../../core/helpers/AxiosHelper";

export default {
    name: "MenuBar",
    data() {
        return {
            urlGenerator,
            menus: [
                {
                    id: 'home',
                    name: 'Home',
                    key: 'writer',
                    urlName: 'home',
                },
                {
                    id: 'category',
                    name: 'Category',
                    key: 'category',
                    urlName: 'books',
                    subMenus: []
                },
            ]
        }
    },
    mounted() {
        this.getCategories()
    },
    methods: {
        getCategories(){
            axiosGet('app/selectable/categories').then(({data}) => {
                this.menus = this.menus.map((item) => {
                    if (item.key === 'category'){
                        item.subMenus = data
                    }
                    return item
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
