<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="float-left">
                    <h1>Personas</h1>
                </div>
                <div class="float-right">
                    <div class="btn-group">
                        <a class="btn btn-outline-info" href="/persona" role="button">Crear Persona</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-container">
                  <table id="mytable" class="table table-bordred table-striped">
                     <thead>
                       <th>Nombre</th>
                       <th>Apellido</th>
                       <th>Email</th>
                   </thead>
                   <tbody>
                    <tr v-for="persona in personas" v-if="personas">
                      <td>{{persona.nombre}}</td>
                      <td>{{persona.apellido}}</td>
                      <td>{{persona.email}}</td>
                  </tr>
                  <tr v-if="!personas">
                      <td colspan="8">No hay registro !!</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>
</div>
</template>

<script>
export default {

    data() {
        return {
            personas: [],
            pageCount: 1,
            endpoint: 'api/personas?page='
        };
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch(page = 1) {
            axios.get(this.endpoint + page)
            .then(({data}) => {
                this.personas = data.data;
      //          this.pageCount = data.meta.last_page;
            });
        },

        remove(id) {
            this.personas = _.remove(this.personas, function (persona) {
                return persona.id !== id;
            });
        }
    }
}
</script>
