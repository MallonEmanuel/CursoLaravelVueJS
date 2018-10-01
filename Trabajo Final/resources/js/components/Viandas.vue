<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="float-left">
                    <h1>Viandas</h1>
                </div>
                <div class="float-right">
                    <div class="btn-group">
                        <a class="btn btn-outline-info" href="/vianda/nueva" role="button">Crear Vianda</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-container">
                  <table id="mytable" class="table table-bordred table-striped">
                     <thead>
                       <th>Nombre</th>
                       <th>Descripción</th>
                       <th>Precio</th>
                       <th>Vegetariana</th>
                   </thead>
                   <tbody>
                    <tr v-for="vianda in viandas" v-if="viandas">
                      <td>{{vianda.nombre}}</td>
                      <td>{{vianda.descripcion}}</td>
                      <td>{{vianda.precio}}</td>
                      <td>{{vianda.vegetariana == 0 ? 'No' : 'Si'}}</td>
                      <td>
                        <!-- <button type="button" class="btn-outline-danger btn-sm" v-on:click="remove(vianda.id)" >
                          <v-icon name="trash"/>
                        </button> -->

                        <button type="button" class="btn-outline-success btn-sm" v-on:click="edit(vianda.id)" >
                          <v-icon name="edit"/>
                        </button>
                      </td>
                  </tr>
                  <tr v-if="!viandas">
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
            viandas: [],
            pageCount: 1,
            endpoint: 'api/viandas'
        };
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get(this.endpoint)
            .then(({data}) => {
                this.viandas = data.data;
            //    this.pageCount = data.meta.last_page;
            });
        },
        edit(id){
            window.location.href='/vianda/'+id;
        },
        remove(id) {
          if(confirm("Esta seguro que desea eliminar la vianda "+ id)){
            axios.delete(this.endpoint+id)
            .then(({data}) => {
                  alert("Vianda"+id +" eliminada");
                  this.viandas = _.remove(this.viandas, function (vianda) {
                      return vianda.id !== id;
                  });
            });
          }


        }
    }
}
</script>
