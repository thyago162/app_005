<template>
  <b-container fluid>
    <b-row class="titulo">
      <b-col cols="12">
       
        <b-row>
          <b-col cols="10"> Veículos </b-col>
          <b-col cols="2">
            <b-button
              size="sm"
              variant="primary"
              :to="{ name: 'novo_veiculo' }"
            >
              <b-icon icon="plus"></b-icon>
            </b-button>
          </b-col>
        </b-row>
      </b-col>
      <b-col cols="12" xl="6" lg="6" offset-xl="3" offset-lg="3">
        <b-form>
          <b-input-group class="mt-3" size="sm">
            <template #prepend>
              <b-input-group-text
                ><strong><b-icon :font-scale="1" icon="search"></b-icon></strong
              ></b-input-group-text>
            </template>

            <b-form-input
              size="sm"
              v-model="busca"
              @blur="buscar()"
            ></b-form-input>
          </b-input-group>
        </b-form>
      </b-col>
    </b-row>
    <b-row class="tabela-veiculo">
      <b-col>
        <b-table
          :busy="loading"
          :items="veiculos.data"
          stacked="sm"
          id="tabela-veiculo"
          :per-page="perPage"
          :current-page="currentPage"
          :fields="fields"
        >
          <template #table-busy>
            <div class="text-center text-danger my-2">
              <b-spinner class="align-middle"></b-spinner>
              <strong>Loading...</strong>
            </div>
          </template>
          <template v-slot:cell(vendido)="row">
            <b-icon
              icon="check-circle-fill"
              variant="success"
              v-if="row.item.vendido == 1"
            ></b-icon>
            <b-icon icon="circle" variant="secondary" v-else></b-icon>
          </template>
          <template v-slot:cell(acoes)="row">
            <b-button
              size="sm"
              variant="primary"
              :to="{ name: 'visualizar_veiculo', params: { id: row.item.id } }"
            >
              <b-icon icon="eye" variant="light"></b-icon>
            </b-button>

            <b-button
              size="sm"
              variant="info"
              v-b-modal.form-veiculo
              :to="{ name: 'editar_veiculo', params: { id: row.item.id } }"
            >
              <b-icon icon="pen" variant="light"></b-icon>
            </b-button>

            <b-button size="sm" variant="danger">
              <b-icon
                icon="trash"
                variant="light"
                @click="remover(row.item.id)"
              ></b-icon>
            </b-button>
          </template>
        </b-table>
        <div>
          <b-pagination
            align="center"
            v-model="currentPage"
            :total-rows="veiculos.total"
            :perPage="perPage"
            aria-controls="tabela-veiculo"
          ></b-pagination>
        </div>
        
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import veiculoMixin from "../../mixin/veiculo-mixin";
export default {
  name: "veiculos",
  mixins: [veiculoMixin],
  data() {
    return {
      windowWidth: window.innerWidth,
      veiculo_id: "",
      busca: "",
      loading: false,
      currentPage: 1,
      fields: [
        { key: "veiculo", label: "Veículo", sortable: true },
        { key: "marca", label: "Marca", sortable: true },
        { key: "ano", label: "Ano", sortable: true },
        { key: "acoes", label: "Ações" },
      ],
    };
  },
  created() {
    this.getVeiculos();
  },

  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },

  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },

  computed: {
    veiculos: function () {
      return this.$store.getters.getVeiculos;
    },
    perPage: function() {
      return this.windowWidth >= 576 ? 10 : 1
    }
  },

  watch: {
    windowWidth(newWidth, oldWidth) {
     
    },
  },

  methods: {
    buscar() {
      if (this.busca.length > 0) {
        this.$axios(`api/veiculos/find/` + this.busca).then((response) => {
          this.$store.dispatch("veiculos", response.data.veiculos);
        });
      } else {
        this.getVeiculos();
      }
    },

    remover(id) {
      this.$swal
        .fire({
          title: "Ação de exclusão",
          text: "Deseja realmente excluir o veículo?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Sim, remover",
        })
        .then((result) => {
          this.$axios
            .delete(`api/veiculos/${id}`)
            .then(() => {
              this.$swal.fire({
                title: "Sucesso",
                text: "Veículo removido com sucesso",
                type: "success",
              });
              this.getVeiculos();
            })
            .catch(() => {
              this.$swal.fire({
                title: "Erro",
                text: "Falha ao tentar remover o veículo, tente novamente mais tarde",
                type: "error",
              });
            });
        });
    },

    onResize() {
      this.windowWidth = window.innerWidth;
    },
  },
};
</script>

<style scoped>
.titulo {
  font-size: 22px;
  margin-top: 20px;
}

.tabela-veiculo {
  margin-top: 10px;
}
</style>
