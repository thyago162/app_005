<template>
    <div>
        <b-container class="mt-4">
            <b-row>
                <b-col>
                    <b-card>
                        <b-card-header header-bg-variant="info" header-text-variant="light">
                            <b-card-title>Editar Veículo</b-card-title>
                        </b-card-header>
                        <b-card-body>
                            <Form />
                        </b-card-body>
                    </b-card>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
import Form from './components/Form.vue'
export default {
    name: 'editar_veiculo',
    components: {
        Form
    },   
}
</script>