<template>
  <div>
    <b-alert :show="error.errors ? true : false" variant="danger" dismissible>
      <div v-for="(err, index) in error.errors" :key="index">
        <p>{{err}}</p>
      </div>
    </b-alert>
    <b-form @submit.stop.prevent="salvarOuAtualizar">
      <b-form-group label="Veículo">
        <b-form-input v-model="form.veiculo"></b-form-input>
      </b-form-group>

      <b-form-group label="Marca">
        <b-form-select v-model="form.marca">
          <b-form-select-option
            v-for="(marca, index) in marcas"
            :key="index"
            :value="marca.nome"
            >{{ marca.nome }}</b-form-select-option
          >
        </b-form-select>
      </b-form-group>

      <b-form-group label="Ano">
        <b-form-input v-model="form.ano" type="number"></b-form-input>
      </b-form-group>

      <b-form-group label="Descrição">
        <vue-editor v-model="form.descricao"></vue-editor>
      </b-form-group>

      <b-form-group label="Vendido">
        <b-form-radio-group
          id="veiculo-vendido"
          v-model="form.vendido"
          :options="options"
        ></b-form-radio-group>
      </b-form-group>

      <div class="d-flex flex-row-reverse">
        <b-button type="submit" variant="success">Salvar</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";
import veiculoMixin from "../../../mixin/veiculo-mixin";
import { VueEditor } from "vue2-editor";
export default {
  name: "form",
  mixins: [veiculoMixin],
  props: ["id"],
  components: {
    VueEditor,
  },

  created() {
    if (this.$route.params.id) {
      this.buscarVeiculo(this.$route.params.id);
    }
  },
  data() {
    return {
      error: {},
      marcas: [
        { nome: "Chevrolet " },
        { nome: "Hyndai " },
        { nome: "Fiat " },
        { nome: "Volkswagen" },
        { nome: "Honda" },
        { nome: "Toyota" },
        { nome: "Nissan" },
      ],
      options: [
        { text: "Sim", value: 1 },
        { text: "Não", value: 0 },
      ],
      form: {
        id: "",
        veiculo: "",
        marca: "",
        ano: "",
        descricao: "",
        vendido: 0,
      },
    };
  },

  methods: {
    salvarOuAtualizar() {
      if (this.form.id) {
        this.atualizarVeiculo();
      }

      this.salvarVeiculo();
    },
    salvarVeiculo() {
      this.$axios
        .post("api/veiculos", this.form)
        .then(() => {
          this.$swal.fire({
            title: "Sucesso",
            text: "Veículo salvo com sucesso.",
            icon: "success",
          });
          this.$router.push({ name: "veiculos" });
        })
       .catch((error) => {
          console.log(error.response)
          if (error.response.status == 422) {
            this.error = error.response.data
            this.$swal.fire({
              title: "Erro",
              text:  'Preencha todos os campos obrigatórios',
              icon: "error",
            });
          } else {
            this.$swal.fire({
              title: "Erro",
              text: "Não foi possível salvar o veículo.",
              icon: "error",
            });
          }
        });
    },

    atualizarVeiculo() {
      this.$axios
        .put(`api/veiculos/${this.form.id}`, this.form)
        .then(() => {
          this.$swal.fire({
            title: "Sucesso",
            text: "Veículo salvo com sucesso.",
            icon: "success",
          });
          this.$router.push({ name: "veiculos" });
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.error = error.response.data
            this.$swal.fire({
              title: "Erro",
              text: 'Preencha todos os campos obrigatórios',
              icon: "error",
            });
          } else {
            this.$swal.fire({
              title: "Erro",
              text: "Não foi possível salvar o veículo.",
              icon: "error",
            });
          }
        });
    },

    buscarVeiculo(id) {
      this.$axios(`api/veiculos/${id}`).then((response) => {
        this.$store.dispatch("veiculoId", null);
        let veiculo = response.data.veiculos;

        for (let key in veiculo) {
          this.form[key] = veiculo[key];
        }
      });
    },
  },
};
</script>