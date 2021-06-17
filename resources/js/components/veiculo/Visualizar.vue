<template>
  <div>
    <b-container>
      <b-row class="mt-3">
        <b-col>
          <b-card>
            <b-card-header header-bg-variant="info" header-text-variant="light">
              <b-card-title>{{veiculo.veiculo}}</b-card-title>
            </b-card-header>
            <b-card-body>
                <div class="d-flex flex-row justify-content-between">
                    <b-card-text><b>Marca:</b> {{veiculo.marca}}</b-card-text>
                    <b-card-text><b>Ano:</b> {{veiculo.ano}}</b-card-text>
                </div>
                <div>
                    <b-card-text><b>Descrição do veículo</b></b-card-text>
                    <b-card-text v-html="veiculo.descricao"></b-card-text>
                </div>
            </b-card-body>
            <b-card-footer>
                <b-card-text>Vendido: {{veiculo.vendido == 1 ? 'Sim' : 'Não'}}</b-card-text>
            </b-card-footer>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "visualizar_veiculo",
  data() {
    return {
      veiculo: {},
    };
  },
  created() {
    if (this.$route.params.id) {
      this.buscarVeiculo(this.$route.params.id);
    }
  },
  methods: {
    buscarVeiculo(id) {
      this.$axios(`api/veiculos/${id}`).then((response) => {
        this.$store.dispatch("veiculoId", null);
        this.veiculo = response.data.veiculos;
      });
    },
  },
};
</script>