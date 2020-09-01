<template>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="country">País</label>
            <b-form-select v-model="country" :options="optionCountries" @change="getRegion" name="country">
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>
                        -- Seleccione una opción --
                    </b-form-select-option>
                </template>
            </b-form-select>
        </div>

        <div class="form-group col-md-4 pl-2">
            <label for="region">Región</label>
            <b-form-select v-model="region" :options="optionRegion" name="region">
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>
                        -- Seleccione una opción --
                    </b-form-select-option>
                </template>
            </b-form-select>
        </div>
    </div>
</template>

<script>
export default {
    data: () => {
        let country = {};
        let optionCountries = [];
        let optionRegion=[];
        let region = {};

        return {
            country,
            optionCountries,
            optionRegion,
            region
        };
    },
    mounted() {
        this.getCountries();
    },
    methods: {
        async getCountries() {
            let countries = await axios.get('/get-countries');
            this.optionCountries = countries.data.map( (item) => {
                return {
                    text : item.name,
                    value : item.id
                }
            } );
            if (!!this.$attrs.usuario){
                this.country = this.$attrs.usuario.id_contry;
                this.getRegion();
                this.region = this.$attrs.usuario.id_region;
            }
        },
        async getRegion() {
            let regiones = await axios.get('/get-regiones', {
                params:{
                    country : this.country
                }
            });

            this.optionRegion = regiones.data.map( (item) => {
                return {
                    text : item.name,
                    value : item.id
                }
            } );
        },
    },
};
</script>
