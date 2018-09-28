<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="float-left">
                    <h1>Pedidos</h1>
                </div>
                <div class="float-right">
                    <div class="btn-group">
                        <a class="btn btn-outline-info" href="/pedido" role="button">Crear Pedido</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-container">
                  <table id="mytable" class="table table-bordred table-striped">
                     <thead>
                       <th>Fecha Solicitud</th>
                       <th>Fecha Entrega</th>
                       <th>Persona</th>
                       <th>Vianda</th>
                       <th>Acciones</th>
                   </thead>
                   <tbody>
                    <tr v-for="pedido in pedidos" v-if="pedidos">
                      <td>{{pedido.fecha_solicitud}}</td>
                      <td>{{pedido.fecha_entrega == null? 'no entregado':pedido.fecha_entrega }}</td>
                      <td>{{pedido.persona.nombre+" "+pedido.persona.apellido}}</td>
                      <td>{{pedido.vianda.nombre}}</td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm" v-on:click="remove(pedido.id)" >T
                          <span class="glyphicon glyphicon-envelope"></span>
                        </button>
                      </td>
                  </tr>
                  <tr v-if="!pedidos">
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
            pedidos: [],
            pageCount: 1,
            endpoint: 'api/pedidos/'
        };
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch(page = 1) {
            axios.get(this.endpoint)
            .then(({data}) => {
                this.pedidos = data.data;
                // this.pageCount = data.meta.last_page;
            });
        },

        remove(id) {
            axios.delete(this.endpoint+id)
            .then(({data}) => {
                this.pedidos = data.data;
                // this.pageCount = data.meta.last_page;
                this.pedidos = _.remove(this.pedidos, function (pedido) {
                    return pedido.id !== id;
                });
            });

        }
    }
}
</script>
