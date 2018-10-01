<template>
	<div>
		<!-- <h1>Hello, {{this.pedido_id}}</h1> -->

		<div class="alert alert-success" v-if="saved">
			<strong>Success!</strong> Su pedido ha sido guardado exitosamente.
			<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button> -->
		</div>
		<div class="alert alert-warning" v-if="!ready">
			<strong>Warning!</strong> Por favor ingrese los datos faltantes.
			<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button> -->
		</div>

		<div class="well well-sm" id="pedido-form">
			<form class="form-horizontal" method="post" @submit.prevent="onSubmit">
				<div class="form-group">
					<label>Fecha Solicitud(*)</label>
					<input type="date" v-model="pedido.fecha_solicitud" class="form-control input-sm" required>
					<!-- <input-date v-model="pedido.fecha_solicitud"></input-date> -->
				</div>
				<div class="form-group">
					<label>Fecha Entrega : {{pedido.fecha_entrega == null? 'Todabia no existe fecha de entrega':pedido.fecha_entrega }}</label>
					<input type="date" v-model="pedido.fecha_entrega" class="form-control input-sm" >
				</div>

				<div class="form-group">
					<label for="input">Persona(*) : {{selectedPersona == null? '':selectedPersona.nombre+" "+selectedPersona.apellido }}</label>
					<vue-bootstrap-typeahead
								v-model="personaModel"
								:serializer="s => s.nombre+' '+ s.apellido"
								@hit="selectedPersona = $event;pedido.persona_id = selectedPersona.id"
								:data="personas"/>

  			</div>

				<div class="form-group">
					<label>Vianda(*) : {{selectedVianda == null? '':selectedVianda.nombre }}</label>
					<vue-bootstrap-typeahead
								v-model="viandaModel"
								:serializer="s => s.nombre"
								@hit="selectedVianda = $event"
								:data="viandas" />
				</div>
				<button type="submit" class="btn btn-primary">Guardar</button>
				<button  type="button"class="btn btn-success" onclick="window.location.href='/pedidos'">Cancelar</button>
			</form>

		</div>
	</div>
</template>

<script>

export default {

	props: ['pedido_id'],

	created() {

		this.fetchPedido();
		this.fetchPersonas();
		this.fetchViandas();
	},

	data() {
		return {
			errors: [],
			saved: false,
			ready: true,

			selectedPersona: null,
			personaModel:'',
			selectedVianda: null,
			viandaModel:'',

			personas: [],
			endpointPersonas: '../api/personas',
			pageCountPersonas: 1,

			viandas: [],
			endpointViandas: '../api/viandas?page=',
			pageCountViandas: 1,

			pedido: {
				id : null,
				fecha_solicitud: new Date().toISOString().slice(0,10),
				fecha_entrega: null,
				// persona: {id:0,nombre:null},
				// vianda: {id:0,nombre:null},
				persona_id: null,
				vianda_id: null
			}
		};
	},
	watch: {
    // When the query value changes, fetch new results from
    // the API - in practice this action should be debounced
    query(newQuery) {
			console.log(newQuery);
      axios.get("../api/personas/search/"+newQuery+"/"+newQuery+"/"+newQuery)
        .then(({data}) => {
          this.personas = data.data;
        })
    }
  },

	methods: {

		fetchPedido(){
			if(this.pedido_id == null){
				return;
			}
			 axios.get("../api/pedidos/"+this.pedido_id)
			 .then(({data}) => {
					 this.pedido = data.data;
					 this.selectedVianda = this.pedido.vianda;
					 this.selectedPersona = this.pedido.persona;
					 this.personaModel = this.pedido.persona.nombre;
			 });
		},

		fetchPersonas() {
				axios.get(this.endpointPersonas)
				.then(({data}) => {
						this.personas = data.data;
						console.log(data.data);
				});
		},

		fetchViandas(){
			axios.get(this.endpointViandas)
			.then(({data}) => {
					this.viandas = data.data;
			});
		},

		onSubmit() {
			if(this.selectedPersona == null || this.selectedVianda == null){
					this.ready = false;
					return;
			}
			this.ready = true;
			this.saved = false;
			this.pedido.persona_id = this.selectedPersona.id;
			this.pedido.vianda_id = this.selectedVianda.id;
			console.log(this.pedido);

			// Crea un nuevo pedido
			if(this.pedido.id == null){
				axios.post('../api/pedidos', this.pedido)
				.then(({data}) => this.setSuccessMessage())
				.catch(({response}) => this.setErrors(response));
			}else{
				// Modifica un pedido existente
				axios.put('../api/pedidos/'+this.pedido.id, this.pedido)
				.then(({data}) => this.setSuccessMessage())
				.catch(({response}) => this.setErrors(response));
			}
		},

		setErrors(response) {
			this.errors = response.data.errors;
		},

		setSuccessMessage() {
			this.reset();
			this.saved = true;
		},

		reset() {
			window.location.href='/pedidos';
			alert("Pedido guardado");
		}
	}
}
</script>
