import Veiculo from '../components/veiculo/Veiculo.vue';
import NovoVeiculo from '../components/veiculo/Novo.vue';
import EditarVeiculo from '../components/veiculo/Editar.vue';
import VisualizarVeiculo from '../components/veiculo/Visualizar.vue';
export default [
    {
        path: '/',
        component: Veiculo,
        name: 'veiculos'
    },
    {
        path: '/novo-veiculo',
        component: NovoVeiculo,
        name: 'novo_veiculo'
    },
    {
        path: '/editar-veiculo/:id',
        component: EditarVeiculo,
        name: 'editar_veiculo',
        props:true,
    },
    {
        path: '/veiculo/:id',
        component: VisualizarVeiculo,
        name: 'visualizar_veiculo',
        props:true,
    }
]