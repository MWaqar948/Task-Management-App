const TaskList = () => import('./components/Tasks/List.vue')
const TaskCreate = () => import('./components/Tasks/Add.vue')
const TaskEdit = () => import('./components/Tasks/Edit.vue')

export const routes = [
    {
        name: 'taskList',
        path: '/',
        component: TaskList
    },
    {
        name: 'taskEdit',
        path: '/task/:id/edit',
        component: TaskEdit
    },
    {
        name: 'taskAdd',
        path: '/task/add',
        component: TaskCreate
    }
]