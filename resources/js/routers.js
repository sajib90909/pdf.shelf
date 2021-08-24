export const AdminRouter = [
    { path: '/admin-panel/dashboard', component: require('./components/dashboard.vue').default },
    { path: '/admin-panel/profile/:id', name:'amin-profile', component: require('./components/profile.vue').default },
    { path: '/admin-panel/users', component: require('./components/users.vue').default },
    { path: '/admin-panel/books', component: require('./components/books.vue').default },
    { path: '/admin-panel/categories', component: require('./components/category.vue').default },
]
export const FrontRouter = [
    { path: '/', name: 'home', component: require('./components/front/components/Home').default },
    { path: '/books', name: 'books', component: require('./components/front/components/Books').default },
    { path: '/profile/:id', name: 'profile', component: require('./components/front/components/Profile').default },
    { path: '/book/:id', name: 'book', component: require('./components/front/components/Book').default },
    { path: '/book/view/:id', name: 'view-book', component: require('./components/front/components/ViewBook').default }
]
