export default {
    methods: {
        getVeiculos() {
            this.$axios.get("api/veiculos").then((response) => {
                this.$store.dispatch('veiculos', response.data.veiculos)
            });
        }
    }
}