import restauranteAll from './components/restaurante/all.vue';
import restauranteAdd  from './components/restaurante/add.vue';
import restauranteEdit from './components/restaurante/edit.vue';
import reservaAll from './components/reserva.vue';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: restauranteAll
    },
    {
        name: 'restauranteAdd',
        path: '/restauranteadd',
        component: restauranteAdd
    },
    {
        name: 'restauranteEdit',
        path: '',
        component: restauranteEdit
    },
    {
        name: '/reservar',
        path: '/reservar',
        component: reservaAll
    }
    
   
]