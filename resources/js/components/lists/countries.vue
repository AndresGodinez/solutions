<template>
    <div class="form-row">
        <div class="form-group">
            <label for="country">País</label>
            <b-form-select v-model="country" :options="optionCountries">
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>
                        -- Seleccione una opción --
                    </b-form-select-option>
                </template>
            </b-form-select>
        </div>

        <div class="form-group">
            <label for="country">Región</label>
            <b-form-select v-model="region" :options="optionRegion">
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
        this.getRegion();
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
        },
        async getRegion() {
            let regiones = await axios.get('/get-regiones', {
                params:{
                    country : 2
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
